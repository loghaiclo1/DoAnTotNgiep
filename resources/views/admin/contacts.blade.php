@extends('adminlte::page')

@section('right-navbar')
    @include('components.admin.logout-link')
@endsection

@section('title', 'Quản lý Liên hệ')

@section('content_header')
    <h1>Danh sách liên hệ</h1>
@endsection

@section('content')
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="mb-3">
    <form method="GET" action="{{ route('admin.contacts') }}" class="form-inline">
        <input type="text" name="search" class="form-control mr-2" placeholder="Tìm kiếm..."
               value="{{ request('search') }}">

        <select name="trang_thai" class="form-control mr-2">
            <option value="">-- Trạng thái --</option>
            <option value="0" {{ request('trang_thai') === '0' ? 'selected' : '' }}>Chưa duyệt</option>
            <option value="1" {{ request('trang_thai') === '1' ? 'selected' : '' }}>Đã duyệt</option>
        </select>

        <select name="sort" class="form-control mr-2">
            <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>Mới nhất</option>
            <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Cũ nhất</option>
        </select>

        <button type="submit" class="btn btn-primary">Lọc</button>
    </form>
</div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Liên hệ từ người dùng</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>

                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Chủ đề</th>
                        <th>Nội dung</th>
                        <th>Ngày gửi</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>

                            <td>{{ $contact->ho_ten }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->chu_de }}</td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#contactModal{{ $contact->id }}">
                                    {{ Str::limit($contact->noi_dung, 100) }}
                                </a>
                            </td>
                            <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($contact->trang_thai == 0)
                                    <span class="badge badge-warning">Chưa duyệt</span>
                                @else
                                    <span class="badge badge-success">Đã duyệt</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.contacts.updateStatus', $contact->id) }}" method="POST"
                                 onsubmit="return confirm('Bạn có chắc muốn {{ $contact->trang_thai == 0 ? 'duyệt' : 'hoàn tác' }} liên hệ này?')">

                                    @csrf
                                    @method('PUT')
                                    @if($contact->trang_thai == 0)
                                        <button class="btn btn-success btn-sm">Duyệt</button>
                                    @else
                                        <button class="btn btn-warning btn-sm">Hoàn tác</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                                                    <!-- Modal xem chi tiết -->
                            <div class="modal fade" id="contactModal{{ $contact->id }}" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel{{ $contact->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="contactModalLabel{{ $contact->id }}">Nội dung chi tiết</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <strong>Họ tên:</strong> {{ $contact->ho_ten }}<br>
                                            <strong>Email:</strong> {{ $contact->email }}<br>
                                            <strong>Chủ đề:</strong> {{ $contact->chu_de }}<br>
                                            <hr>
                                            <p>{!! nl2br(e($contact->noi_dung)) !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3 d-flex justify-content-center">
                {{ $contacts->appends(request()->query())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
            </div>
            <div class="text-muted mb-2">
                Hiển thị từ {{ $contacts->firstItem() }} đến {{ $contacts->lastItem() }} trong tổng số {{ $contacts->total() }} kết quả
            </div>
        </div>
    </div>
@endsection
