@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div>
                    <h1 class="h2 text-primary mb-1">Tambah Berita Baru</h1>
                    <p class="text-muted">Isi form berikut untuk menambahkan berita</p>
                </div>
                <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
            <div class="alert alert-danger mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <h5 class="mb-0">Terdapat kesalahan!</h5>
                </div>
                <hr>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Form Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Judul Input -->
                        <div class="mb-4">
                            <label for="judul" class="form-label fw-semibold">
                                <span class="text-danger">*</span> Judul Berita
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('judul') is-invalid @enderror" 
                                   id="judul" 
                                   name="judul" 
                                   value="{{ old('judul') }}"
                                   placeholder="Masukkan judul berita">
                            @error('judul')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Konten Input -->
                        <div class="mb-4">
                            <label for="konten" class="form-label fw-semibold">
                                <span class="text-danger">*</span> Isi Berita
                            </label>
                            <textarea class="form-control @error('konten') is-invalid @enderror" 
                                      id="konten" 
                                      name="konten" 
                                      rows="10"
                                      placeholder="Tulis isi berita disini">{{ old('konten') }}</textarea>
                            @error('konten')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Gambar Input -->
                        <div class="mb-4">
                            <label for="gambar" class="form-label fw-semibold">
                                Gambar Utama
                            </label>
                            <input type="file" 
                                   class="form-control @error('gambar') is-invalid @enderror" 
                                   id="gambar" 
                                   name="gambar" 
                                   accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, JPEG (Maks. 2MB)</small>
                            @error('gambar')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Image Preview -->
                        <div class="mb-4 text-center" id="imagePreviewContainer" style="display:none;">
                            <img id="imagePreview" src="#" alt="Preview Gambar" class="img-fluid rounded border" style="max-height: 300px;">
                            <button type="button" class="btn btn-sm btn-outline-danger mt-2" id="removeImage">
                                <i class="fas fa-trash me-1"></i>Hapus Gambar
                            </button>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-end gap-3 pt-3">
                            <button type="reset" class="btn btn-light">
                                <i class="fas fa-eraser me-2"></i>Reset
                            </button>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection