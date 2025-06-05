<?php
namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class AboutController extends Controller

    {
        public function index(Request $request)
        {
            // Bài viết nhóm "Thông tin nhóm"
            $baiVietNhom = About::where('trangthai', 1)
                ->where('chude', 'Thông tin nhóm')
                ->first();

            // Từ khóa tìm kiếm (nếu có)
            $tuKhoa = $request->input('search');

            // Lấy page từng phân trang cho từng chủ đề
            $pageSachThieuNhi = $request->input('sachThieuNhi_page', 1);
            $pageTamLyHoc = $request->input('tamLyHoc_page', 1);
            $pageVanHocCoDien = $request->input('vanHocCoDien_page', 1);
            $pageSachHay = $request->input('sachHay_page', 1);
            $tongHopPage = $request->input('tongHop_page', 1);

            // Truy vấn & phân trang cho từng chủ đề với số bài theo yêu cầu
            $sachThieuNhi = About::where('trangthai', 1)
                ->where('chude', 'SÁCH THIẾU NHI')
                ->when($tuKhoa, function ($query, $tuKhoa) {
                    return $query->where(function ($q) use ($tuKhoa) {
                        $q->where('tieude', 'LIKE', "%{$tuKhoa}%")
                          ->orWhere('noidung', 'LIKE', "%{$tuKhoa}%");
                    });
                })
                ->orderBy('created_at', 'desc')
                ->paginate(4, ['*'], 'sachThieuNhi_page', $pageSachThieuNhi);

            $tamLyHoc = About::where('trangthai', 1)
                ->where('chude', 'TÂM LÝ HỌC')
                ->when($tuKhoa, function ($query, $tuKhoa) {
                    return $query->where(function ($q) use ($tuKhoa) {
                        $q->where('tieude', 'LIKE', "%{$tuKhoa}%")
                          ->orWhere('noidung', 'LIKE', "%{$tuKhoa}%");
                    });
                })
                ->orderBy('created_at', 'desc')
                ->paginate(3, ['*'], 'tamLyHoc_page', $pageTamLyHoc);

            $vanHocCoDien = About::where('trangthai', 1)
                ->where('chude', 'VĂN HỌC CỔ ĐIỂN')
                ->when($tuKhoa, function ($query, $tuKhoa) {
                    return $query->where(function ($q) use ($tuKhoa) {
                        $q->where('tieude', 'LIKE', "%{$tuKhoa}%")
                          ->orWhere('noidung', 'LIKE', "%{$tuKhoa}%");
                    });
                })
                ->orderBy('created_at', 'desc')
                ->paginate(4, ['*'], 'vanHocCoDien_page', $pageVanHocCoDien);
                $sachHay = About::where('trangthai', 1)
                ->where('chude', 'SÁCH HAY')
                ->when($tuKhoa, function ($query, $tuKhoa) {
                    return $query->where(function ($q) use ($tuKhoa) {
                        $q->where('tieude', 'LIKE', "%{$tuKhoa}%")
                          ->orWhere('noidung', 'LIKE', "%{$tuKhoa}%");
                    });
                })
                ->orderBy('created_at', 'desc')
                ->paginate(4);


            $tongHop = About::where('trangthai', 1)
                ->whereNotIn('chude', [
                    'SÁCH THIẾU NHI',
                    'TÂM LÝ HỌC',
                    'VĂN HỌC CỔ ĐIỂN',
                    'SÁCH HAY',
                    'Thông tin nhóm',
                ])
                ->when($tuKhoa, function ($query, $tuKhoa) {
                    return $query->where(function ($q) use ($tuKhoa) {
                        $q->where('tieude', 'LIKE', "%{$tuKhoa}%")
                          ->orWhere('noidung', 'LIKE', "%{$tuKhoa}%");
                    });
                })
                ->orderBy('created_at', 'desc')
                ->paginate(8, ['*'], 'tongHop_page', $tongHopPage);
            // Trả về view với các biến dữ liệu
            return view('homepage.about', [
                'baiVietNhom' => $baiVietNhom,
                'sachHay' => $sachHay,
                'vanHocCoDien' => $vanHocCoDien,
                'tamLyHoc' => $tamLyHoc,
                'sachThieuNhi' => $sachThieuNhi,
                'tuKhoa' => $tuKhoa,
                'tongHop' => $tongHop,
            ]);
        }

                    public function search(Request $request)
                    {
                        $query = $request->input('search', '');
                        $page = $request->input('page', 1);
                        $perPage = 4;

                        if (!empty($query)) {
                            // Nếu có từ khóa tìm kiếm thì dùng full-text search
                            $results = DB::table('baiviet')
                                ->select('*')
                                ->where('trangthai', 1)
                                ->whereRaw("MATCH(tieude, noidung, chude) AGAINST (? IN NATURAL LANGUAGE MODE)", [$query])
                                ->paginate($perPage, ['*'], 'page', $page);
                        } else {
                            // Nếu không có từ khóa, tạo LengthAwarePaginator rỗng để tránh lỗi
                            $empty = collect();
                            $results = new LengthAwarePaginator(
                                $empty,
                                0,
                                $perPage,
                                $page,
                                ['path' => $request->url(), 'query' => $request->query()]
                            );
                        }

                        return view('homepage.aboutresult', [
                            'results' => $results,
                            'query' => $query,
                        ]);
                    }
    public function show($slug)
    {
        $article = About::where('slug', $slug)->firstOrFail();

        $noidungabout = About::where('chude', $article->chude)
        ->where('id', '!=', $article->id)
        ->paginate(2);

        return view('homepage.aboutcontent', compact('article', 'noidungabout'));
    }
    public function fetchVanHocCoDien(Request $request)
    {
        $page = $request->input('vanHocCoDien_page', 1);
        $vanHocCoDien = About::where('trangthai', 1)
            ->where('chude', 'VĂN HỌC CỔ ĐIỂN')
            ->orderBy('created_at', 'desc')
            ->paginate(4, ['*'], 'vanHocCoDien_page', $page);

        $html = view('homepage.partials.vanhoccodien', compact('vanHocCoDien'))->render();

        return response()->json(['html' => $html]);
    }
    public function tamLyHocAjax(Request $request)
    {
        $page = $request->input('tamLyHoc_page', 1);
        $tamLyHoc = About::where('trangthai', 1)
            ->where('chude', 'Tâm lý học')
            ->orderBy('created_at', 'desc')
            ->paginate(4, ['*'], 'tamLyHoc_page', $page);

        $html = view('homepage.partials.tamlyhoc', compact('tamLyHoc'))->render();

        return response()->json(['html' => $html]);
    }
        public function sachThieuNhiAjax(Request $request)
    {
        $page = $request->input('sachThieuNhi_page', 1);

        $sachThieuNhi = About::where('trangthai', 1)
            ->where('chude', 'Sách Thiếu Nhi')
            ->orderBy('created_at', 'desc')
            ->paginate(4, ['*'], 'sachThieuNhi_page', $page);

        $html = view('homepage.partials.sachthieunhi', compact('sachThieuNhi'))->render();

        return response()->json(['html' => $html]);
    }

    public function sachHayAjax(Request $request)
    {
        $page = $request->input('sachHay_page', 1);

        $sachHay = About::where('trangthai', 1)
            ->where('chude', 'Sách Hay')
            ->orderBy('created_at', 'desc')
            ->paginate(4, ['*'], 'sachHay_page', $page);

        $html = view('homepage.partials.sachhay', compact('sachHay'))->render();

        return response()->json(['html' => $html]);
    }


}
