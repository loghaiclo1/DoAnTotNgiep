@extends('adminlte::page')

@section('title', 'Quản lý Footer')

@section('content_header')
    <h1>Quản lý Footer</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="mb-3">
    <a href="{{ route('admin.footer.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Thêm mới
    </a>
</div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Loại</th>
                <th>Tên mục</th>
                <th>Tên mục con</th> {{-- Thêm dòng này --}}
                <th>Nội dung</th>
                <th>Đường dẫn</th>
                <th>Công ty</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($footers as $footer)
                <tr>
                    <td>{{ $footer->loai_du_lieu }}</td>
                    <td>{{ $footer->ten_muc }}</td>
                    <td>{{ $footer->ten_muc_con }}</td> {{-- Thêm dòng này --}}
                    <td>
                        <a href="#" data-toggle="modal" data-target="#modalNoiDung{{ $footer->id }}">
                            {{ \Illuminate\Support\Str::limit($footer->noi_dung, 60) }}
                        </a>
                    </td>
                    <td>{{ $footer->duong_dan }}</td>
                    <td>{{ $footer->ten_cong_ty }}</td>
                    <td>
                        <a href="{{ route('admin.footer.edit', $footer->id) }}" class="btn btn-primary btn-sm">Sửa</a>

                        <form action="{{ route('admin.footer.destroy', $footer->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xoá mục này không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xoá</button>
                        </form>
                    </td>

                </tr>
                <div class="modal fade" id="modalNoiDung{{ $footer->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $footer->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Nội dung chi tiết - {{ $footer->ten_muc }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <pre style="white-space: pre-wrap;">{{ $footer->noi_dung }}</pre>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
            @endforeach
        </tbody>
    </table>
@stop
