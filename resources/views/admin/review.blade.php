@extends('adminlte::page')


@section('title', 'Quản lý đánh giá')

@section('content_header')
    <h1>Quản lý đánh giá sản phẩm</h1>
@stop

@section('content')
{{-- KẾT QUẢ TÌM KIẾM --}}
@if(request()->hasAny(['keyword', 'status', 'sosao']))
    <div class="alert alert-info">
        <strong>Kết quả tìm kiếm:</strong>
        @if(request('keyword'))
            Nội dung chứa từ khóa "<strong>{{ request('keyword') }}</strong>"
        @endif

        @if(request('status'))
            | Trạng thái:
            <strong>
                @switch(request('status'))
                    @case('approved') Đã duyệt @break
                    @case('pending') Chờ duyệt @break
                    @case('rejected') Đã ẩn @break
                @endswitch
            </strong>
        @endif

        @if(request('sosao'))
            | Đánh giá: <strong>{{ request('sosao') }} sao</strong>
        @endif
    </div>
@endif
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    {{-- FORM LỌC --}}
    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <input name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Từ khóa nội dung">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">-- Trạng thái --</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Đã duyệt</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Đã ẩn</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="sosao" class="form-control">
                    <option value="">-- Chọn sao --</option>
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ request('sosao') == $i ? 'selected' : '' }}>{{ $i }} sao</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
    </form>



    {{-- THÔNG BÁO --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <p class="text-muted mt-1">Tìm thấy <strong>{{ $reviews->total() }}</strong> đánh giá phù hợp.</p>

    {{-- BẢNG --}}
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Sách</th>
                <th>Người đánh giá</th>
                <th>Sao</th>
                <th>Nội dung</th>
                <th>Trạng thái</th>
                <th>Ngày</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
                <tr>
                    <td>{{ $review->MaDanhGia }}</td>
                    <td>{{ $review->book->TenSach ?? '[Sách đã xóa]' }}</td>
                    <td>
                        @if ($review->user)
                            {{ $review->user->Ho . ' ' . $review->user->Ten }}
                        @else
                            <span class="text-muted">[Ẩn danh]</span>
                        @endif
                    </td>
                    <td>{!! str_repeat('⭐', $review->SoSao) !!}</td>
                    <td>{{ $review->NoiDung }}</td>
                    <td>
                        @if($review->TrangThai == 1)
                            <span class="badge badge-success">Đã duyệt</span>
                        @elseif($review->TrangThai == 0)
                            <span class="badge badge-warning">Chờ duyệt</span>
                        @else
                            <span class="badge badge-secondary">Đã ẩn</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($review->NgayDanhGia)->format('d/m/Y') }}</td>
                    <td>
                        @if($review->TrangThai !== 1)
                            <form action="{{ route('admin.reviews.approve', $review->MaDanhGia) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-success">Duyệt</button>
                            </form>
                        @endif

                        @if($review->TrangThai !== 2)
                            <form action="{{ route('admin.reviews.reject', $review->MaDanhGia) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-warning">Ẩn</button>
                            </form>
                        @endif

                        <form action="{{ route('admin.reviews.destroy', $review->MaDanhGia) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa đánh giá này?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- PHÂN TRANG --}}
    <div class="mt-3" style="display: flex; justify-content: center;">
        {{ $reviews->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
    </div>
@stop
