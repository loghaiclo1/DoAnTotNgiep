<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Events\CartUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\CartHold;
use Carbon\Carbon;

class CartController extends Controller
{
    const HOLD_DURATION_MINUTES = 15; // Không còn dùng, giữ lại để tương thích
    const MAX_QUANTITY_THRESHOLD = 10000;

    protected function getIdentifier()
    {
        $identifier = [
            'user_id' => Auth::check() ? Auth::id() : null,
            'session_id' => session()->getId(),
        ];
        Log::info('Current identifier:', $identifier);
        return $identifier;
    }
    protected function syncCart()
    {
        if (!Auth::check()) {
            Log::info('syncCart: No authenticated user, skipping sync.');
            return;
        }

        $userId = Auth::id();
        $sessionId = session()->getId();
        $cart = session()->get('cart', []);

        // Log trước khi đồng bộ
        Log::info('syncCart: Before sync:', [
            'user_id' => $userId,
            'session_id' => $sessionId,
            'session_cart' => $cart,
            'cart_hold' => CartHold::where('user_id', $userId)->where('session_id', $sessionId)->get()->toArray(),
        ]);

        try {
            $userHolds = CartHold::where(function ($query) use ($userId, $sessionId) {
                $query->where('user_id', $userId)
                    ->orWhere(function ($q) use ($sessionId) {
                        $q->whereNull('user_id')->where('session_id', $sessionId);
                    });
            })->get()->keyBy('book_id');

            $updatedCart = [];
            foreach ($userHolds as $bookId => $hold) {
                $book = Book::find($bookId);
                if ($book && $hold->quantity <= $book->SoLuong) {
                    $updatedCart[$bookId] = [
                        'name' => $book->TenSach,
                        'price' => $book->GiaBan,
                        'quantity' => $hold->quantity,
                        'image' => $book->HinhAnh,
                    ];
                }
            }

            session()->put('cart', $updatedCart);

            foreach ($updatedCart as $bookId => $item) {
                CartHold::updateOrCreate(
                    ['user_id' => $userId, 'session_id' => $sessionId, 'book_id' => $bookId],
                    ['quantity' => $item['quantity'], 'expires_at' => null]
                );
            }

            CartHold::where('user_id', $userId)
                ->where('session_id', $sessionId)
                ->whereNotIn('book_id', array_keys($updatedCart))
                ->delete();

            // Log sau khi đồng bộ
            Log::info('syncCart: After sync:', [
                'user_id' => $userId,
                'session_id' => $sessionId,
                'session_cart' => session('cart'),
                'cart_hold' => CartHold::where('user_id', $userId)->where('session_id', $sessionId)->get()->toArray(),
            ]);
        } catch (\Exception $e) {
            Log::error('syncCart: Error syncing cart:', [
                'user_id' => $userId,
                'exception' => $e->getMessage(),
            ]);
        }
    }
    public function add(Request $request)
    {
        $bookId = $request->input('book_id');
        $quantity = (int) $request->input('quantity', 1);

        if (!$bookId) {
            return response()->json(['status' => 'error', 'message' => 'Thiếu mã sách!'], 400)
                ->header('Content-Type', 'application/json; charset=utf-8');
        }

        if ($quantity < 1) {
            return response()->json(['status' => 'error', 'message' => 'Số lượng phải lớn hơn 0!'], 400)
                ->header('Content-Type', 'application/json; charset=utf-8');
        }

        if ($quantity > self::MAX_QUANTITY_THRESHOLD) {
            return response()->json(['status' => 'error', 'message' => "Số lượng $quantity không hợp lệ! Vui lòng nhập nhỏ hơn " . number_format(self::MAX_QUANTITY_THRESHOLD, 0, ',', '.') . "."], 400)
                ->header('Content-Type', 'application/json; charset=utf-8');
        }

        try {
            // Khởi tạo $book
            $book = Book::findOrFail($bookId);

            if ($book->SoLuong < 1) {
                return response()->json(['status' => 'error', 'message' => 'Sản phẩm đã hết hàng!'], 400)
                    ->header('Content-Type', 'application/json; charset=utf-8');
            }

            $identifier = $this->getIdentifier();
            $cart = session()->get('cart', []);
            $currentQty = isset($cart[$bookId]) ? $cart[$bookId]['quantity'] : 0;

            // Kiểm tra CartHold hiện tại
            $existingHold = CartHold::where(array_merge($identifier, ['book_id' => $bookId]))->first();
            if ($existingHold) {
                $currentQty = $existingHold->quantity;
            }

            $newQty = $currentQty + $quantity;
            if ($newQty > $book->SoLuong) {
                return response()->json(['status' => 'error', 'message' => "Số lượng yêu cầu $newQty không có sẵn!"], 400)
                    ->header('Content-Type', 'application/json; charset=utf-8');
            }

            $cart[$bookId] = [
                'name' => $book->TenSach,
                'price' => $book->GiaBan,
                'quantity' => $newQty,
                'image' => $book->HinhAnh,
            ];

            session()->put('cart', $cart);
            Log::info('Session cart after add:', ['cart' => $cart, 'book_id' => $bookId, 'identifier' => $identifier]);

            CartHold::updateOrCreate(
                array_merge($identifier, ['book_id' => $bookId]),
                ['quantity' => $newQty, 'expires_at' => null]
            );

            $this->syncCart();
            Log::info('Add to cart success:', [
                'book_id' => $bookId,
                'quantity' => $quantity,
                'new_quantity' => $newQty,
                'SoLuong' => $book->SoLuong,
                'identifier' => $identifier
            ]);
            $totalQuantity = collect($cart)->sum('quantity');
            event(new CartUpdated($totalQuantity));
            return response()->json(['status' => 'success', 'message' => 'Đã thêm vào giỏ hàng!', 'new_quantity' => $newQty, 'cart_count' => $totalQuantity])
                ->header('Content-Type', 'application/json; charset=utf-8');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Book not found: ' . $e->getMessage(), ['book_id' => $bookId]);
            return response()->json(['status' => 'error', 'message' => 'Sách không tồn tại!'], 400)
                ->header('Content-Type', 'application/json; charset=utf-8');
        } catch (\Exception $e) {
            Log::error('Add to cart error: ' . $e->getMessage(), ['book_id' => $bookId, 'exception' => $e]);
            return response()->json(['status' => 'error', 'message' => 'Lỗi hệ thống!'], 500)
                ->header('Content-Type', 'application/json; charset=utf-8');
        }
    }
    public function index()
    {
        $this->syncCart();
        $cart = session()->get('cart', []);
        $identifier = $this->getIdentifier();
        $errors = [];
// Log dữ liệu giỏ hàng
            Log::info('Cart index data:', [
                'user_id' => $identifier['user_id'],
                'session_id' => $identifier['session_id'],
                'session_cart' => $cart,
                'cart_hold' => CartHold::where('user_id', $identifier['user_id'])
                    ->where('session_id', $identifier['session_id'])
                    ->get()->toArray(),
                'total_quantity' => collect($cart)->sum('quantity'),
            ]);
        Log::info('Cart before processing:', ['cart' => $cart, 'identifier' => $identifier]);

        foreach ($cart as $bookId => &$item) {
            $book = Book::find($bookId);
            if (!$book) {
                unset($cart[$bookId]);
                $errors[] = "Sách với mã $bookId không tồn tại và đã được xóa khỏi giỏ hàng.";
                Log::info('Removed book from cart: Book not found', ['book_id' => $bookId]);
                continue;
            }

            $userHold = CartHold::where(array_merge($identifier, ['book_id' => $bookId]))
                ->first();

            if (!$userHold) {
                unset($cart[$bookId]);
                $errors[] = "Sách {$book->TenSach} không có trong giỏ hàng và đã được xóa.";
                Log::info('Removed book from cart: No CartHold record', ['book_id' => $bookId]);
                continue;
            }

            // Kiểm tra số lượng tồn kho khả dụng
            if ($item['quantity'] > $book->SoLuong) {
                $errors[] = "Số lượng {$item['quantity']} quyển của sách {$book->TenSach} không sẵn yêu cầu, số lượng đã được đặt về 0.";
                $item['quantity'] = 0;
                CartHold::where(array_merge($identifier, ['book_id' => $bookId]))
                    ->update(['quantity' => 0, 'expires_at' => null]);
                Log::info('Adjusted book quantity to 0 due to insufficient stock', [
                    'book_id' => $bookId,
                    'quantity' => $item['quantity'],
                    'stock' => $book->SoLuong
                ]);
            }
        }

        session()->put('cart', $cart);
        $this->syncCart();

        Log::info('Cart after processing:', ['cart' => $cart, 'identifier' => $identifier]);
        Log::info('Errors before flashing:', ['errors' => $errors]);

        if (!empty($errors)) {
            session()->flash('cart_errors', $errors);
            session()->flash('cart_needs_reload', true);
            Log::info('Flashed cart_errors and cart_needs_reload', ['errors' => $errors]);
        }

        Log::info('Session data before render:', ['session' => session()->all()]);

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('homepage.cart', compact('cart', 'total'));
    }
    public function remove(Request $request, $bookId)
    {
        try {
            $sessionId = session()->getId();
            $userId = Auth::check() ? Auth::id() : null;

            Log::info('Attempting to remove book from cart:', [
                'book_id' => $bookId,
                'session_id' => $sessionId,
                'user_id' => $userId
            ]);

            if ($request->header('X-Requested-With') !== 'XMLHttpRequest') {
                Log::warning('Remove: Request is not AJAX.', ['book_id' => $bookId]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Yêu cầu không hợp lệ!'
                ], 400)->header('Content-Type', 'application/json; charset=utf-8');
            }

            $deletedRows = CartHold::where('book_id', $bookId)
                ->where(function ($query) use ($sessionId, $userId) {
                    if ($userId) {
                        $query->where('user_id', $userId);
                    } else {
                        $query->where('session_id', $sessionId)->whereNull('user_id');
                    }
                })
                ->delete();

            if ($deletedRows === 0) {
                Log::warning('Remove: No CartHold record found to delete.', [
                    'book_id' => $bookId,
                    'session_id' => $sessionId,
                    'user_id' => $userId
                ]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Sản phẩm không tồn tại trong giỏ hàng!'
                ], 404)->header('Content-Type', 'application/json; charset=utf-8');
            }

            $cart = session()->get('cart', []);
            if (isset($cart[$bookId])) {
                unset($cart[$bookId]);
                session()->put('cart', $cart);
                Log::info('Remove: Book removed from session cart.', [
                    'book_id' => $bookId,
                    'updated_cart' => $cart
                ]);
            }

            $this->syncCart();

            $total = collect($cart)->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });
            $totalQuantity = collect($cart)->sum('quantity');
            Log::info('Remove: New total calculated.', [
                'book_id' => $bookId,
                'total' => $total,
                'updated_cart' => $cart
            ]);
            event(new CartUpdated($totalQuantity));
            return response()->json([
                'status' => 'success',
                'message' => 'Đã xóa sản phẩm khỏi giỏ hàng!',
                'total' => $total
            ])->header('Content-Type', 'application/json; charset=utf-8');
        } catch (\Exception $e) {
            Log::error('Remove: Error removing product from cart.', [
                'book_id' => $bookId,
                'exception' => $e->getMessage()
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'Lỗi hệ thống khi xóa sản phẩm: ' . $e->getMessage()
            ], 500)->header('Content-Type', 'application/json; charset=utf-8');
        }
    }

    public function update(Request $request)
    {
        $this->syncCart();
        $cart = session()->get('cart', []);
        $identifier = $this->getIdentifier();

        // Xử lý request từ AJAX
        $bookId = $request->input('bookId');
        $quantity = $request->input('quantity');

        if ($bookId && $quantity) {
            $qty = max(1, (int)$quantity);

            if (!isset($cart[$bookId])) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Sản phẩm không tồn tại trong giỏ hàng!'
                ], 404);
            }

            try {
                $book = Book::findOrFail($bookId);
                if ($qty > $book->SoLuong) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Số lượng yêu cầu $qty không có sẵn!"
                    ], 400);
                }

                $cart[$bookId]['quantity'] = $qty;
                CartHold::updateOrCreate(
                    array_merge($identifier, ['book_id' => $bookId]),
                    ['quantity' => $qty, 'expires_at' => null]
                );

                session()->put('cart', $cart);
                $this->syncCart();

                $total = collect($cart)->sum(function ($item) {
                    return $item['price'] * $item['quantity'];
                });
                $totalQuantity = collect($cart)->sum('quantity');
                event(new CartUpdated($totalQuantity));
                return response()->json([
                    'status' => 'success',
                    'message' => 'Cập nhật số lượng thành công!',
                    'total' => $total
                ]);
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Sách không tồn tại!'
                ], 404);
            } catch (\Exception $e) {
                Log::error('Update cart error: ' . $e->getMessage(), ['book_id' => $bookId]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lỗi hệ thống!'
                ], 500);
            }
        }

        // Xử lý request từ form
        $quantities = $request->input('quantity', []);
        foreach ($quantities as $bookId => $qty) {
            $qty = max(1, (int)$qty);

            if (!isset($cart[$bookId])) {
                continue;
            }

            try {
                $book = Book::findOrFail($bookId);
                if ($qty > $book->SoLuong) {
                    return redirect()->back()->with('error', "Số lượng yêu cầu $qty không có sẵn!.");
                }

                $cart[$bookId]['quantity'] = $qty;
                CartHold::updateOrCreate(
                    array_merge($identifier, ['book_id' => $bookId]),
                    ['quantity' => $qty, 'expires_at' => null]
                );
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                Log::error('Book not found: ' . $e->Tree, ['book_id' => $bookId]);
                unset($cart[$bookId]);
            }
        }

        session()->put('cart', $cart);
        $this->syncCart();
        return redirect()->back()->with('success', 'Đã cập nhật giỏ hàng!');
    }

    public function mergeCart($oldSessionId = null)
    {
        if (!Auth::check()) {
            return;
        }

        $userId = Auth::id();
        $currentSessionId = session()->getId();
        $sessionIdToCheck = $oldSessionId ?? $currentSessionId;
        $cart = session()->get('cart', []);

        try {
            \Log::info('Starting cart merge:', [
                'user_id' => $userId,
                'current_session_id' => $currentSessionId,
                'old_session_id' => $oldSessionId,
                'initial_cart' => $cart,
            ]);

            // Lấy và nhóm bản ghi CartHold
            $userHolds = CartHold::where(function ($query) use ($userId, $sessionIdToCheck) {
                $query->where('user_id', $userId)
                    ->orWhere(function ($q) use ($sessionIdToCheck) {
                        $q->whereNull('user_id')->where('session_id', $sessionIdToCheck);
                    });
            })->get()->groupBy('book_id');

            // Khởi tạo mergedCart
            $mergedCart = $cart;

            foreach ($userHolds as $bookId => $holds) {
                $book = Book::find($bookId);
                if (!$book) {
                    \Log::warning('Sách không tồn tại trong CartHold:', ['book_id' => $bookId]);
                    continue;
                }

                $totalHoldQty = $holds->sum('quantity');
                $availableQty = $book->SoLuong;

                if ($totalHoldQty <= $availableQty) {
                    if (isset($mergedCart[$bookId])) {
                        $newQty = $mergedCart[$bookId]['quantity'] + $totalHoldQty;
                        $mergedCart[$bookId]['quantity'] = min($newQty, $availableQty);
                    } else {
                        $mergedCart[$bookId] = [
                            'name' => $book->TenSach,
                            'price' => $book->GiaBan,
                            'quantity' => min($totalHoldQty, $availableQty),
                            'image' => $book->HinhAnh,
                        ];
                    }
                } else {
                    \Log::warning('Số lượng trong CartHold vượt tồn kho:', [
                        'book_id' => $bookId,
                        'hold_qty' => $totalHoldQty,
                        'available_qty' => $availableQty,
                    ]);
                }
            }

            // Cập nhật session
            session()->put('cart', $mergedCart);

            // Xóa tất cả bản ghi CartHold cũ của user
            CartHold::where('user_id', $userId)->delete();

            // Tạo lại CartHold từ mergedCart
            foreach ($mergedCart as $bookId => $item) {
                CartHold::create([
                    'user_id' => $userId,
                    'session_id' => $currentSessionId,
                    'book_id' => $bookId,
                    'quantity' => $item['quantity'],
                    'expires_at' => null, // Không dùng expires_at
                ]);
            }

            // Xóa CartHold của session chưa đăng nhập
            CartHold::whereNull('user_id')->where('session_id', $sessionIdToCheck)->delete();

            session()->flash('success', 'Giỏ hàng đã được đồng bộ thành công!');
        } catch (\Exception $e) {
            \Log::error('Cart merge error: ' . $e->getMessage(), ['exception' => $e]);
            session()->flash('error', 'Không thể đồng bộ giỏ hàng: ' . $e->getMessage());
        }
    }

    public function clear()
    {
        $identifier = $this->getIdentifier();
        CartHold::where(function ($query) use ($identifier) {
            $query->where('user_id', $identifier['user_id'])
                ->orWhere(function ($q) use ($identifier) {
                    $q->whereNull('user_id')->where('session_id', $identifier['session_id']);
                });
        })->delete();
        session()->forget('cart');
        $this->syncCart();
        return redirect()->back()->with('success', 'Đã xóa tất cả sản phẩm khỏi giỏ hàng!');
    }
    public function checkStock(Request $request)
    {
        try {
            $this->syncCart();
            $cart = session()->get('cart', []);
            $identifier = $this->getIdentifier();
            $bookIds = $request->input('book_ids', []);

            Log::info('Check stock request:', [
                'book_ids' => $bookIds,
                'cart' => $cart,
                'identifier' => $identifier
            ]);

            if (empty($bookIds) || empty($cart)) {
                Log::info('Check stock: Giỏ hàng hoặc book_ids rỗng, không cần reload.');
                return response()->json(['needs_reload' => false], 200);
            }

            $errors = [];
            foreach ($bookIds as $bookId) {
                if (!isset($cart[$bookId])) {
                    Log::info('Check stock: Sách không có trong giỏ hàng, bỏ qua.', ['book_id' => $bookId]);
                    continue;
                }

                $book = Book::find($bookId);
                if (!$book) {
                    $errors[] = "Sách với mã $bookId không tồn tại.";
                    Log::warning('Check stock: Book not found', ['book_id' => $bookId]);
                    continue;
                }

                $item = $cart[$bookId];
                if ($item['quantity'] > $book->SoLuong) {
                    $errors[] = "Số lượng {$item['quantity']} quyển của sách {$book->TenSach} không sẵn yêu cầu, số lượng đã được đặt về 0.";
                    $cart[$bookId]['quantity'] = 0;
                    CartHold::where(array_merge($identifier, ['book_id' => $bookId]))
                        ->update(['quantity' => 0, 'expires_at' => null]);
                    Log::info('Check stock: Adjusted book quantity to 0 due to insufficient stock', [
                        'book_id' => $bookId,
                        'quantity' => $item['quantity'],
                        'stock' => $book->SoLuong
                    ]);
                }
            }

            if (!empty($errors)) {
                session()->put('cart', $cart);
                $this->syncCart();
                session()->flash('cart_errors', $errors);
                session()->flash('cart_needs_reload', true);
                Log::info('Check stock: Flashed cart_errors and cart_needs_reload', [
                    'errors' => $errors,
                    'session' => session()->all()
                ]);
                return response()->json(['needs_reload' => true], 200);
            }

            Log::info('Check stock: Không có lỗi tồn kho, không cần reload.');
            return response()->json(['needs_reload' => false], 200);
        } catch (\Exception $e) {
            Log::error('Check stock: Lỗi hệ thống', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'needs_reload' => false,
                'error' => 'Lỗi hệ thống khi kiểm tra tồn kho: ' . $e->getMessage()
            ], 500);
        }
    }
    public function getCartQuantity()
    {
        $cart = session('cart', []);
        $totalQuantity = collect($cart)->sum('quantity');

        return response()->json([
            'cart_total_quantity' => $totalQuantity
        ]);
    }
}
