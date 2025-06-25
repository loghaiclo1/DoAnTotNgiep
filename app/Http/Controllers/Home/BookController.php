<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
class BookController extends Controller
{
    public function productdetail($slug)
    {
        $book = Book::where('slug', $slug)->where('TrangThai', 1)->firstOrFail();
        return view('homepage.productdetail', compact('book'));
    }

    public function searchResults(Request $request)
    {
        $query = $request->input('query', '');
        $sort = $request->input('sort', '');
        $page = $request->input('page', 1);
        $perPage = 20;

        $results = collect();

        if (!empty($query)) {
            $cleanQuery = preg_replace('/[^A-Za-z0-9\s\p{L}]/u', '', $query);
            $searchTerms = trim($cleanQuery);
            $nonAccentQuery = $this->removeAccents($searchTerms);

            if (!empty($searchTerms)) {
                $queryBuilder = Book::query()
                    ->select([
                        'MaSach', 'TenSach', 'MoTa', 'NamXuatBan', 'GiaBan', 'GiaNhap',
                        'SoLuong', 'LuotMua', 'HinhAnh', 'slug'
                    ])
                    ->where('TrangThai', 1)
                    ->where(function ($q) use ($searchTerms, $nonAccentQuery) {
                        $q->where(function ($q2) use ($searchTerms) {
                            $q2->where('TenSach', 'LIKE', "%{$searchTerms}%")
                                ->orWhere('MoTa', 'LIKE', "%{$searchTerms}%");
                        })
                        ->orWhere(function ($q3) use ($nonAccentQuery) {
                            $q3->whereRaw("LOWER(REPLACE(TenSach, 'đ', 'd')) LIKE ?", ["%{$nonAccentQuery}%"])
                                ->orWhereRaw("LOWER(REPLACE(MoTa, 'đ', 'd')) LIKE ?", ["%{$nonAccentQuery}%"]);
                        });
                    })
                    ->orWhere(function ($q) use ($searchTerms) {
                        $q->where('NamXuatBan', '=', $searchTerms);
                    });
                    if ($sort === 'high-to-low') {
                        $queryBuilder->orderBy('GiaBan', 'desc')->orderBy('TenSach', 'asc');
                    } elseif ($sort === 'low-to-high') {
                        $queryBuilder->orderBy('GiaBan', 'asc')->orderBy('TenSach', 'asc');
                    }
                $results = $queryBuilder->paginate($perPage, ['*'], 'page', $page);
            } else {
                $results = new LengthAwarePaginator([], 0, $perPage, $page, [
                    'path' => $request->url(),
                    'query' => $request->query()
                ]);
            }
        } else {
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
