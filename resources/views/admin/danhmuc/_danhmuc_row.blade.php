<tr>
    <td>{{ $danhMuc->id }}</td>
    <td>
        {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level) !!}
        {{ $danhMuc->name }}
    </td>
    <td>{{ $danhMuc->slug }}</td>
    <td>
        {{ $danhMuc->parent ? $danhMuc->parent->name : '—' }}
    </td>
    <td>
        <a href="{{ route('admin.categories.edit', $danhMuc->id) }}" class="btn btn-sm btn-warning">Sửa</a>
        <form action="{{ route('admin.categories.destroy', $danhMuc->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm('Bạn có chắc muốn xoá danh mục này không?')">
                Xoá
            </button>
        </form>
    </td>
</tr>

{{-- Render các danh mục con --}}
@foreach ($danhMuc->children as $child)
    @include('admin.danhmuc._danhmuc_row', ['danhMuc' => $child, 'level' => $level + 1])

@endforeach
