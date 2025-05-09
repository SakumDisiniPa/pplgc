@extends('layouts.app')

@section('content')
<section class="py-12 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header dengan tombol kembali -->
        <div class="mb-8 flex justify-between items-center">
            <a href="{{ route('galeri.index') }}" 
               class="inline-flex items-center text-primary-600 hover:text-primary-800 transition-colors duration-300">
                <i class="fas fa-arrow-left mr-2"></i> 
                <span class="font-medium">Kembali ke Galeri</span>
            </a>
            
            @auth
            <div class="flex space-x-4">
                <a href="{{ route('galeri.edit', $galeri->id) }}" 
                   class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-300">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST" 
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-300">
                        <i class="fas fa-trash mr-2"></i> Hapus
                    </button>
                </form>
            </div>
            @endauth
        </div>

        <!-- Card utama -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-500">
            <!-- Header card -->
            <div class="p-6 bg-gradient-to-r from-primary-500 to-secondary-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white">{{ $galeri->judul }}</h1>
                        <div class="flex items-center mt-2">
                            <div class="w-8 h-8 rounded-full overflow-hidden border-2 border-white">
                                @if($galeri->user->profile_photo_path)
                                <img src="{{ Storage::url($galeri->gambar) }}" 
                                    alt="{{ $galeri->judul }}" 
                                    class="w-full h-auto max-h-[70vh] object-contain transition-transform duration-500 group-hover:scale-105">
                                @else
                                <div class="bg-white text-primary-600 w-full h-full flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($galeri->user->name, 0, 1)) }}
                                </div>
                                @endif
                            </div>
                            <span class="ml-3 text-white font-medium">{{ $galeri->user->name }}</span>
                        </div>
                    </div>
                    <span class="text-white/80 text-sm bg-white/10 px-3 py-1 rounded-full">
                        {{ $galeri->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>

            <!-- Gambar utama -->
            <div class="relative group">
                <img src="{{ $galeri->gambar }}" 
                     alt="{{ $galeri->judul }}" 
                     class="w-full h-auto max-h-[70vh] object-contain transition-transform duration-500 group-hover:scale-105">
                
                <!-- Overlay untuk zoom -->
                <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <button onclick="openLightbox('{{ asset('storage/galeri/'.$galeri->gambar) }}')" 
                            class="bg-white/90 text-primary-600 p-3 rounded-full shadow-lg hover:bg-white transition-all duration-300 transform scale-90 group-hover:scale-100">
                        <i class="fas fa-expand text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Deskripsi dan metadata -->
            <div class="p-6">
                @if($galeri->deskripsi)
                <div class="prose max-w-none mb-6">
                    <p class="text-gray-700">{{ $galeri->deskripsi }}</p>
                </div>
                @endif
                
                <!-- Info tambahan -->
                <div class="flex flex-wrap gap-4 text-sm text-gray-500 border-t pt-4 mt-4">
                    <div class="flex items-center">
                        <i class="fas fa-eye mr-2"></i>
                        <span>1.2k dilihat</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-heart mr-2 text-red-500"></i>
                        <span>56 suka</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-comment mr-2 text-primary-500"></i>
                        <span>12 komentar</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Komentar -->
        <div class="mt-12 bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-bold mb-6 text-gray-800 border-b pb-2">
                <i class="fas fa-comments mr-2 text-primary-500"></i> Komentar (3)
            </h3>
            
            <!-- Form komentar -->
            @auth
            <div class="mb-8">
                <form class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-primary-500">
                            @if(auth()->user()->profile_photo_path)
                            <img src="{{ asset('storage/profile-photos/'.basename(auth()->user()->profile_photo_path)) }}" 
                                 alt="{{ auth()->user()->name }}" 
                                 class="w-full h-full object-cover">
                            @else
                            <div class="bg-primary-100 text-primary-600 w-full h-full flex items-center justify-center font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex-grow">
                        <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent" 
                                  rows="3" 
                                  placeholder="Tulis komentar Anda..."></textarea>
                        <button type="submit" 
                                class="mt-2 px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors duration-300 float-right">
                            Kirim Komentar
                        </button>
                    </div>
                </form>
            </div>
            @endauth
            
            <!-- Daftar komentar -->
            <div class="space-y-6">
                <!-- Contoh komentar 1 -->
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center">
                            <span class="font-bold text-gray-600">J</span>
                        </div>
                    </div>
                    <div class="flex-grow">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-bold text-gray-800">John Doe</h4>
                                    <span class="text-xs text-gray-500">2 jam yang lalu</span>
                                </div>
                                <button class="text-gray-400 hover:text-red-500">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                            <p class="mt-2 text-gray-700">Foto yang sangat bagus! Keren banget!</p>
                        </div>
                    </div>
                </div>
                
                <!-- Contoh komentar 2 -->
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center">
                            <span class="font-bold text-gray-600">S</span>
                        </div>
                    </div>
                    <div class="flex-grow">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-bold text-gray-800">Sarah Smith</h4>
                                    <span class="text-xs text-gray-500">1 hari yang lalu</span>
                                </div>
                                <button class="text-gray-400 hover:text-red-500">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                            <p class="mt-2 text-gray-700">Lokasi fotonya dimana ya? Pengen kesana juga!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center p-4">
    <div class="relative max-w-6xl w-full max-h-[90vh]">
        <button onclick="closeLightbox()" 
                class="absolute -top-12 right-0 text-white text-3xl hover:text-primary-500 transition-colors duration-300">
            <i class="fas fa-times"></i>
        </button>
        <img id="lightbox-image" src="" alt="" class="w-full h-full object-contain">
    </div>
</div>

<script>
    // Lightbox functionality
    function openLightbox(imageUrl) {
        document.getElementById('lightbox-image').src = imageUrl;
        document.getElementById('lightbox').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    
    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    
    // Close lightbox when clicking outside image
    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLightbox();
        }
    });
    
    // Close with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });
</script>

<style>
    /* Animasi untuk lightbox */
    #lightbox {
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    #lightbox:not(.hidden) {
        opacity: 1;
        display: flex !important;
    }
    
    #lightbox img {
        transform: scale(0.95);
        transition: transform 0.3s ease;
    }
    
    #lightbox:not(.hidden) img {
        transform: scale(1);
    }
</style>
@endsection