@extends('adminlte::page')

@section('title', 'Thêm Danh Mục')

@section('content_header')
    <h1>Thêm Danh Mục Mới</h1>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Lỗi!</strong> Vui lòng kiểm tra lại dữ liệu.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Nhập tên danh mục" required>
        </div>
        <label for="name" class="form-label">Danh Mục Cha</label>
        <select name="parent_id" id="parent_id" class="form-select">

            <option value="">-- Nếu không chọn thì danh mục được thêm là Danh mục gốc --</option>
            @foreach ($danhMucsCha as $parent)
                <option value="{{ $parent['id'] }}">{{ $parent['name'] }}</option>
            @endforeach
        </select>


        <div class="mb-3">

            <input type="hidden" name="slug" id="slug">
        </div>


        <button type="submit" class="btn btn-primary">Thêm danh mục</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
