@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Galeri Baru</h1>
    
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Input Judul -->
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Galeri</label>
                    <input type="text" class="form-control" id="judul" name="judul" required>
                </div>
                
                <!-- Input Thumbnail -->
                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <input type="file" class="form-control" id="thumbnail" name="thumbnail" required accept="image/*">
                    <small class="text-muted">Ukuran maksimal 5MB. Format: JPG, PNG, JPEG</small>
                </div>
                
                <!-- Input Gambar Galeri -->
                <div class="mb-3">
                    <label for="gallery_images" class="form-label">Gambar Galeri</label>
                    <input type="file" class="form-control" id="gallery_images" name="gallery_images[]" multiple required accept="image/*">
                    <small class="text-muted">Upload 1-150 gambar. Ukuran maksimal 15MB per gambar</small>
                </div>
                
                <!-- Input Deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan Galeri
                </button>
            </form>
        </div>
    </div>
</div>
@endsection