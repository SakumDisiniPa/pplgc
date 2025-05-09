@extends('layouts.app')

@section('content')
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Galeri Sekolah</h1>
            
            @auth
            <a href="{{ route('galeri.create') }}" 
               class="bg-gradient-to-r from-primary-600 to-secondary-500 text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transition-all duration-300 flex items-center">
                <i class="fas fa-plus mr-2"></i> Upload Gambar
            </a>
            @endauth
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($galeris as $galeri)
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                <a href="{{ route('galeri.show', $galeri->id) }}" class="block">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="{{ $galeri->gambar }}" alt="{{ $galeri->judul }}" 
                             class="w-full h-48 object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-900 mb-1">{{ $galeri->judul }}</h3>
                        <p class="text-gray-600 text-sm">{{ Str::limit($galeri->deskripsi, 50) }}</p>
                    </div>
                </a>
                
                @auth
                <div class="px-4 pb-4">
                    <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST" 
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
                    </form>
                </div>
                @endauth
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-images text-4xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Belum ada gambar di galeri</h3>
                @auth
                <p class="text-gray-500 mt-2">Upload gambar pertama Anda!</p>
                @endauth
            </div>
            @endforelse
        </div>

        @if($galeris->hasPages())
        <div class="mt-8">
            {{ $galeris->links() }}
        </div>
        @endif
    </div>
</section>
@endsection