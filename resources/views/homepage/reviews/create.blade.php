@extends('layout.main')

@section('content')
<div class="container">
    <h2>Viết đánh giá cho: {{ $book->TenSach }}</h2>
    <form method="POST" action="{{ route('review.store') }}">
        @csrf
        <input type="hidden" name="MaSach" value="{{ $book->MaSach }}">

        <div class="mb-3">
            <label for="SoSao">Số sao:</label>
            <select name="SoSao" class="form-control" required>
                <option value="">Chọn số sao</option>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }} sao</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="NoiDung">Nội dung:</label>
            <textarea name="NoiDung" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
    </form>
</div>
@endsection
