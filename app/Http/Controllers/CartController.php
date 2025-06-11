<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $bookId = $request->input('book_id');

        try {
            if (!$bookId) {
                return response()->json(['status' => 'error', 'message' => 'Book ID is required!'], 400);
            }

            $book = Book::findOrFail($bookId);

            if ($book->SoLuong < 1) {
                return response()->json(['status' => 'error', 'message' => 'Sản phẩm hiện đã hết hàng!'], 400);
            }

            $cart = session()->get('cart', []);

            if (isset($cart[$bookId])) {
                $cart[$bookId]['quantity']++;
            } else {
                $cart[$bookId] = [
                    'name' => $book->TenSach,
                    'price' => $book->GiaBan,
                    'quantity' => 1,
                    'image' => $book->HinhAnh,
                ];
            }

            session()->put('cart', $cart);

            return response()->json(['status' => 'success', 'message' => 'Sản phẩm đã được thêm vào giỏ hàng!']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => 'error', 'message' => 'Sách không tồn tại!'], 404);
        } catch (\Exception $e) {
            \Log::error('Cart Add Error: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['status' => 'error', 'message' => 'Đã có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('homepage.cart', compact('cart', 'total'));
    }

    public function update(Request $request)
    {
        $quantities = $request->input('quantity', []);

        foreach ($quantities as $id => $quantity) {
            if (isset($cart[$id])) {
                $quantity = max(1, min((int)$quantity, 10));
                $cart[$id]['quantity'] = $quantity;
            }
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Đã xóa tất cả sản phẩm trong giỏ hàng!');
    }
}
