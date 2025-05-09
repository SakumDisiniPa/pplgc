@extends('layouts.app')

@section('content')
<section class="py-12 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">Upload Gambar ke Galeri</h1>
        
        <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data" 
              class="bg-gray-50 p-6 rounded-lg shadow-sm">
            @csrf
            
            <div class="mb-6">
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Gambar</label>
                <input type="text" name="judul" id="judul" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500">
            </div>
            
            <div class="mb-6">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" id="deskripsi" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"></textarea>
            </div>
            
            <div class="mb-6">
                <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Pilih Gambar</label>
                <input type="file" name="gambar" id="gambar" required accept="image/*"
                       class="block w-full text-sm text-gray-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-lg file:border-0
                              file:text-sm file:font-semibold
                              file:bg-primary-50 file:text-primary-700
                              hover:file:bg-primary-100">
                <p class="mt-1 text-xs text-gray-500">Format: JPEG, PNG, JPG, GIF (Maksimal 2MB)</p>
            </div>
            
            <div class="flex justify-end">
                <a href="{{ route('galeri.index') }}" class="mr-4 px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
                    Upload Gambar
                </button>
            </div>
        </form>
    </div>
</section>
@endsection