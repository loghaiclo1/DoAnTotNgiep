<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function productdetail(Request $request, $slug)
    {

        $book = Book::where('slug', $slug)
            ->where('TrangThai', 1)
            ->firstOrFail();
            $visibleReviewsQuery = $book->reviews()->where('TrangThai', 1);

            // Thống kê chỉ dựa trên đánh giá được duyệt
            $reviewCount = $visibleReviewsQuery->count();
            $averageRating = $visibleReviewsQuery->avg('SoSao');
            $ratingDistribution = $visibleReviewsQuery
                ->selectRaw('SoSao, count(*) as count')
                ->groupBy('SoSao')
                ->pluck('count', 'SoSao')
                ->toArray();

        // Lọc & sắp xếp review
        $query = $book->reviews()
            ->where('TrangThai', 1)
            ->with('user');

        // Lọc theo số sao
        if ($request->filled('star')) {
            $query->where('SoSao', $request->star);
        }

        // XÓA ORDER CŨ TRƯỚC KHI ÁP DỤNG SẮP XẾP MỚI
        $query->getQuery()->orders = null;

        // Sắp xếp
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $query->orderBy('NgayDanhGia', 'asc');
                    break;
                case 'high_rating':
                    $query->orderBy('SoSao', 'desc');
                    break;
                case 'low_rating':
                    $query->orderBy('SoSao', 'asc');
                    break;
                default:
                    $query->orderBy('NgayDanhGia', 'desc');
            }
        } else {
            $query->orderBy('NgayDanhGia', 'desc');
        }

        $reviews = $query->paginate(5)->withQueryString();

        if ($request->ajax()) {
            return view('components.reviews-list', compact('reviews'))->render();
        }

        $relatedBooks = Book::where('TrangThai', 1)
            ->where('category_id', $book->category_id) // CÙNG THỂ LOẠI
            ->where('MaSach', '!=', $book->MaSach)     // KHÁC CHÍNH NÓ
            ->orderBy('LuotMua', 'desc')               // ƯU TIÊN SÁCH BÁN CHẠY
            ->limit(4)
            ->get();

        return view('homepage.productdetail', compact(
            'book',
            'reviewCount',
            'averageRating',
            'ratingDistribution',
            'reviews',
            'relatedBooks'
        ));
    }
    public function searchResults(Request $request)
    {
        $query = $request->input('query', '');
        $sort = $request->input('sort', '');
        $page = $request->input('page', 1);
        $perPage = 20;

        $results = collect();

        // Nếu có từ khóa tìm kiếm
        if (!empty($query)) {
            // Loại bỏ ký tự lạ và chuẩn hóa
            $cleanQuery = preg_replace('/[^A-Za-z0-9\s\p{L}]/u', '', $query);
            $searchTerms = trim($cleanQuery);
            $nonAccentQuery = $this->removeAccents($searchTerms);

            // Kiểm tra nếu người dùng nhập '10 lượt bán' hoặc '10 luot ban'
            $matchLuotBan = null;
            if (preg_match('/(\d+)\s*(lượt bán|luot ban)/iu', $searchTerms, $matches)) {
                $matchLuotBan = (int)$matches[1];
            }

            if (!empty($searchTerms)) {
                $queryBuilder = Book::query()
                    ->select([
                        'MaSach',
                        'TenSach',
                        'MoTa',
                        'NamXuatBan',
                        'GiaBan',
                        'GiaNhap',
                        'SoLuong',
                        'LuotMua',
                        'HinhAnh',
                        'slug'
                    ])
                    ->where('TrangThai', 1);

                if ($matchLuotBan !== null) {
                    // Nếu nhập kiểu "10 lượt bán"
                    $queryBuilder->where('LuotMua', $matchLuotBan);
                } elseif (is_numeric($searchTerms)) {
                    // Nếu là số → tìm theo giá, năm, hoặc lượt mua
                    $queryBuilder->where(function ($q) use ($searchTerms) {
                        $q->where('GiaBan', $searchTerms)
                          ->orWhere('NamXuatBan', $searchTerms)
                          ->orWhere('LuotMua', $searchTerms);
                    });
                } else {
                    // Nếu là chữ → tìm trong tên, mô tả (có dấu & không dấu)
                    $queryBuilder->where(function ($q) use ($searchTerms, $nonAccentQuery) {
                        $q->where(function ($q2) use ($searchTerms) {
                            $q2->where('TenSach', 'LIKE', "%{$searchTerms}%")
                               ->orWhere('MoTa', 'LIKE', "%{$searchTerms}%");
                        })
                        ->orWhere(function ($q3) use ($nonAccentQuery) {
                            $q3->whereRaw("LOWER(REPLACE(TenSach, 'đ', 'd')) LIKE ?", ["%{$nonAccentQuery}%"])
                               ->orWhereRaw("LOWER(REPLACE(MoTa, 'đ', 'd')) LIKE ?", ["%{$nonAccentQuery}%"]);
                        });
                    });
                }

                // Sắp xếp nếu có
                if ($sort === 'high-to-low') {
                    $queryBuilder->orderBy('GiaBan', 'desc')->orderBy('TenSach', 'asc');
                } elseif ($sort === 'low-to-high') {
                    $queryBuilder->orderBy('GiaBan', 'asc')->orderBy('TenSach', 'asc');
                }

                // Phân trang kết quả
                $results = $queryBuilder->paginate($perPage, ['*'], 'page', $page);
            } else {
                // Chuỗi sau khi xử lý rỗng
                $results = new LengthAwarePaginator([], 0, $perPage, $page, [
                    'path' => $request->url(),
                    'query' => $request->query()
                ]);
            }
        } else {
            // Không có query → trả về rỗng
            $results = new LengthAwarePaginator([], 0, $perPage, $page, [
                'path' => $request->url(),
                'query' => $request->query()
            ]);
        }

        return view('homepage.search-results', [
            'books' => $results,
            'query' => $query,
            'message' => $results->isEmpty() ? 'Không tìm thấy sách phù hợp.' : null
        ]);
    }

    private function removeAccents($str)
    {
        $str = \Normalizer::normalize($str, \Normalizer::FORM_D);
        $str = preg_replace('/[\p{Mn}]/u', '', $str);
        $str = str_replace(['đ', 'Đ'], ['d', 'D'], $str);
        return $str;
    }
    public function searchSuggestions(Request $request)
    {
        $query = $request->input('query', '');
        $suggestions = [];

        if (!empty($query)) {
            $cleanQuery = preg_replace('/[^A-Za-z0-9\s\p{L}]/u', '', trim($query));
            $nonAccentQuery = $this->removeAccents($cleanQuery);

            Log::info('Search query: ' . $cleanQuery . ', Non-accent: ' . $nonAccentQuery);

            $suggestions = Book::where('TrangThai', 1)
                ->where(function ($q) use ($cleanQuery, $nonAccentQuery) {
                    $q->where('TenSach', 'LIKE', $cleanQuery . '%')
                        ->orWhereRaw("LOWER(REPLACE(TenSach, 'đ', 'd')) LIKE ?", [strtolower($nonAccentQuery) . '%']);
                })
                ->select('TenSach', 'GiaBan', 'HinhAnh', 'slug')
                ->limit(5)
                ->get()
                ->map(function ($book) {
                    return [
                        'title' => $book->TenSach ?? 'Không có tiêu đề',
                        'price' => $book->GiaBan ?? null,
                        'image' => $book->HinhAnh ?? 'default.jpg',
                        'slug' => $book->slug ?? '' // Đảm bảo slug luôn có giá trị
                    ];
                })
                ->toArray();

            Log::info('Suggestions: ' . json_encode($suggestions));
        }

        return response()->json($suggestions);
    }
}
