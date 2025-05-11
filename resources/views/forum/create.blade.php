@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- Header -->
            <div class="border-b border-gray-200 pb-4 mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Buat Diskusi Baru</h1>
                <p class="text-gray-600">Bagikan pertanyaan atau topik diskusi dengan kelas</p>
            </div>

            <!-- Form -->
            <form action="{{ route('forum.store') }}" method="POST" enctype="multipart/form-data" id="forum-form">
                @csrf
                
                <!-- Judul Diskusi -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Diskusi</label>
                    <input type="text" id="title" name="title" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('title') border-red-500 @enderror"
                           placeholder="Contoh: Cara mengerjakan tugas PHP Laravel"
                           value="{{ old('title') }}" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div class="mb-6">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Kategori</label>
                    <select id="category_id" name="category_id" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('category_id') border-red-500 @enderror" required>
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konten Diskusi -->
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Isi Diskusi</label>
                    <textarea id="content" name="content" rows="8"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('content') border-red-500 @enderror"
                              placeholder="Tulis detail diskusi Anda disini..." required>{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">
                        Anda bisa menggunakan <a href="https://www.markdownguide.org/basic-syntax/" target="_blank" class="text-primary-600 hover:underline">Markdown</a> untuk formatting.
                    </p>
                </div>

                <!-- Upload Foto -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Gambar (Maksimal 10)</label>
                    
                    <!-- Drag and Drop Area -->
                    <div id="drop-area" class="border-2 border-dashed border-gray-300 rounded-lg p-6 mb-4 text-center cursor-pointer hover:bg-gray-50 transition-colors">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-cloud-upload-alt text-4xl text-primary-500 mb-2"></i>
                            <p class="text-gray-600">Drag & drop gambar di sini atau</p>
                            <button type="button" id="browse-btn" class="mt-2 px-4 py-2 bg-primary-100 text-primary-700 rounded-lg hover:bg-primary-200 transition-colors">
                                Pilih File
                            </button>
                            <p class="text-xs text-gray-500 mt-2">Format yang didukung: JPG, PNG, GIF (Maksimal 5MB per gambar)</p>
                        </div>
                    </div>
                    
                    <!-- File Preview Container -->
                    <div id="image-upload-container" class="space-y-4">
                        <!-- Preview items will be added here dynamically -->
                    </div>
                    
                    @error('images.*')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('forum.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors flex items-center">
                        <i class="fas fa-paper-plane mr-2"></i> Publikasikan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .preview-container {
        display: flex;
        align-items: center;
        background-color: #f9fafb;
        padding: 0.75rem;
        border-radius: 0.5rem;
        margin-bottom: 0.5rem;
    }
    .preview-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 0.25rem;
        margin-right: 1rem;
    }
    .preview-info {
        flex: 1;
        overflow: hidden;
    }
    .preview-name {
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .preview-size {
        font-size: 0.75rem;
        color: #6b7280;
    }
    .preview-remove {
        color: #ef4444;
        cursor: pointer;
        margin-left: 1rem;
    }
    .preview-remove:hover {
        color: #dc2626;
    }
    #drop-area.highlight {
        border-color: #3b82f6;
        background-color: #eff6ff;
    }
</style>
@endpush
