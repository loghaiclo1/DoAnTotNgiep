<div class="card">
    <div class="card-body">
        {{-- Tên NXB --}}
        <div class="mb-3">
            <label for="TenNXB" class="form-label">Tên NXB</label>
            <input type="text" name="TenNXB" class="form-control @error('TenNXB') is-invalid @enderror"
                   value="{{ old('TenNXB', $nxb->TenNXB ?? '') }}" required maxlength="255">
            @error('TenNXB')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Địa chỉ --}}
        <div class="mb-3">
            <label for="DiaChi" class="form-label">Địa chỉ</label>
            <input type="text" name="DiaChi" class="form-control @error('DiaChi') is-invalid @enderror"
                   value="{{ old('DiaChi', $nxb->DiaChi ?? '') }}" required maxlength="255">
            @error('DiaChi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
                {{-- Điện thoại --}}
                <div class="mb-3">
                    <label for="DienThoai" class="form-label">Điện thoại</label>
                    <input type="text" name="DienThoai" class="form-control @error('DienThoai') is-invalid @enderror"
                        value="{{ old('DienThoai', $nxb->DienThoai ?? '') }}" required maxlength="20">
                    @error('DienThoai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


               {{-- Email --}}
               <div class="mb-3">
                   <label for="Email" class="form-label">Email</label>
                   <input type="email" name="Email" class="form-control @error('Email') is-invalid @enderror"
                          value="{{ old('Email', $nxb->Email ?? '') }}" required maxlength="255">
                   @error('Email')
                       <div class="invalid-feedback">{{ $message }}</div>
                   @enderror
               </div>

               {{-- Website --}}
               <div class="mb-3">
                   <label for="Website" class="form-label">Website</label>
                   <input type="url" name="Website" class="form-control @error('Website') is-invalid @enderror"
                          value="{{ old('Website', $nxb->Website ?? '') }}" required maxlength="255">
                   @error('Website')
                       <div class="invalid-feedback">{{ $message }}</div>
                   @enderror
               </div>

               {{-- Hình ảnh --}}
               <div class="mb-3">
                   <label for="image" class="form-label">Hình ảnh (tùy chọn)</label>
                   <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                          accept="image/png,image/jpeg,image/jpg,image/webp">
                   @error('image')
                       <div class="invalid-feedback">{{ $message }}</div>
                   @enderror

                   @if (!empty($nxb->image))
                       <img src="{{ Storage::url($nxb->image) }}" alt="Ảnh hiện tại" width="120" class="mt-2">
                   @endif
               </div>
           </div>

           {{-- Nút submit --}}
           <div class="card-footer">
               <a href="{{ route('admin.nxb.index') }}" class="btn btn-secondary">Quay lại</a>
               <button type="submit" class="btn btn-primary">{{ $submit }}</button>
           </div>
       </div>

       @section('js')
       <script>
           document.addEventListener('DOMContentLoaded', function () {
               document.querySelectorAll('input, textarea, select').forEach(input => {
                   input.addEventListener('input', function () {
                       if (this.classList.contains('is-invalid')) {
                           this.classList.remove('is-invalid');

                           const errorDiv = this.closest('.mb-3')?.querySelector('.invalid-feedback');
                           if (errorDiv) {
                               errorDiv.remove();
                           }
                       }
                   });
               });
           });
       </script>
       @endsection
