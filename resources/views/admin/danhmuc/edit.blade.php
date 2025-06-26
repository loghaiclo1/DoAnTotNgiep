@extends('adminlte::page')

@section('title', 'Sửa Danh Mục')

@section('content_header')
    <h1>Sửa Danh Mục</h1>
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

    <form action="{{ route('admin.categories.update', $danhMuc->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" name="name" class="form-control" id="name"
                   value="{{ old('name', $danhMuc->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="parent_id" class="form-label">Danh mục cha</label>
            <select name="parent_id" id="parent_id" class="form-select">
                <option value="">-- Không có (Gốc) --</option>
                @foreach ($danhMucsCha as $parent)
                    <option value="{{ $parent['id'] }}"
                        {{ $danhMuc->parent_id == $parent['id'] ? 'selected' : '' }}>
                        {{ $parent['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
