@extends('layouts.app')

@section('content')
<section class="py-12 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Galeri Sekolah</h1>
            
            @auth
            <a href="{{ route('galeri.create') }}" 
               class="bg-gradient-to-r from-primary-600 to-secondary-500 text-white px-6 py-3 rounded-lg font-medium hover:shadow-lg transition-all duration-300 flex items-center">
                <i class="fas fa-plus mr-2"></i> Buat Galeri Baru
            </a>
            @endauth
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($galeris as $galeri)
            <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 dark:border-gray-700">
                <a href="{{ route('galeri.show', $galeri->slug) }}" class="block">
                    <div class="aspect-w-16 aspect-h-9 relative">
                        <img src="{{ $galeri->thumbnail_url }}" alt="{{ $galeri->judul }}" 
                             class="w-full h-48 object-cover">
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                            <i class="fas fa-images mr-1"></i> {{ $galeri->image_count }}
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-900 dark:text-white mb-1">{{ $galeri->judul }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm">{{ Str::limit($galeri->deskripsi, 50) }}</p>
                        <div class="mt-2 flex items-center text-xs text-gray-500 dark:text-gray-400">
                            <i class="fas fa-database mr-1"></i> {{ $galeri->total_size }} MB
                            <span class="mx-2">•</span>
                            <i class="fas fa-calendar mr-1"></i> {{ $galeri->created_at->format('d M Y') }}
                        </div>
                    </div>
                </a>
                
                @auth
                @can('delete', $galeri)
                <div class="px-4 pb-4 border-t border-gray-100 dark:border-gray-700 pt-3">
                    <form action="{{ route('galeri.destroy', $galeri->slug) }}" method="POST" 
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus galeri ini beserta semua fotonya?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium flex items-center">
                            <i class="fas fa-trash mr-1"></i> Hapus Galeri
                        </button>
                    </form>
                </div>
                @endcan
                @endauth
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="text-gray-400 dark:text-gray-500 mb-4">
                    <i class="fas fa-images text-4xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Belum ada galeri</h3>
                @auth
                <p class="text-gray-500 dark:text-gray-400 mt-2">Buat galeri pertama Anda!</p>
                @endauth
            </div>
            @endforelse
        </div>

        @if($galeris->hasPages())
        <div class="mt-8">
            {{ $galeris->links('vendor.pagination.tailwind') }}
        </div>
        @endif
    </div>
</section>
@endsection