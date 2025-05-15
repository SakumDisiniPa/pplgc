@extends('layouts.app')

@section('content')
<section class="py-12 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header with back button -->
        <div class="mb-8 flex justify-between items-center">
            <a href="{{ route('galeri.index') }}" 
               class="inline-flex items-center text-primary-600 hover:text-primary-800 dark:text-primary-400 dark:hover:text-primary-300 transition-colors duration-300">
                <i class="fas fa-arrow-left mr-2"></i> 
                <span class="font-medium">Kembali ke Galeri</span>
            </a>
            
            @auth
            @can('update', $galeri)
            <div class="flex space-x-4">
                <a href="{{ route('galeri.edit', $galeri->slug) }}" 
                   class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-300">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                @can('delete', $galeri)
                <form action="{{ route('galeri.destroy', $galeri->slug) }}" method="POST" 
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus galeri ini beserta semua fotonya?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-300">
                        <i class="fas fa-trash mr-2"></i> Hapus
                    </button>
                </form>
                @endcan
            </div>
            @endcan
            @endauth
        </div>

        <!-- Main gallery card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-500 border border-gray-200 dark:border-gray-700">
            <!-- Gallery header -->
            <div class="p-6 bg-gradient-to-r from-primary-500 to-secondary-500">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-white">{{ $galeri->judul }}</h1>
                        <div class="flex items-center mt-2">
                            <div class="w-8 h-8 rounded-full overflow-hidden border-2 border-white">
                                @if($galeri->user->profile_photo_path)
                                <img src="{{ Storage::url($galeri->user->profile_photo_path) }}" 
                                    alt="{{ $galeri->user->name }}" 
                                    class="w-full h-full object-cover">
                                @else
                                <div class="bg-white text-primary-600 w-full h-full flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($galeri->user->name, 0, 1)) }}
                                </div>
                                @endif
                            </div>
                            <span class="ml-3 text-white font-medium">{{ $galeri->user->name }}</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-white/80 text-sm bg-white/10 px-3 py-1 rounded-full">
                            <i class="fas fa-images mr-1"></i> {{ $galeri->image_count }} Foto
                        </span>
                        <span class="text-white/80 text-sm bg-white/10 px-3 py-1 rounded-full">
                            <i class="fas fa-database mr-1"></i> {{ $galeri->total_size }} MB
                        </span>
                        <span class="text-white/80 text-sm bg-white/10 px-3 py-1 rounded-full">
                            <i class="fas fa-calendar mr-1"></i> {{ $galeri->created_at->format('d M Y') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Gallery description -->
            @if($galeri->deskripsi)
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="prose max-w-none dark:prose-invert">
                    <p>{{ $galeri->deskripsi }}</p>
                </div>
            </div>
            @endif

            <!-- Gallery images grid -->
            <div class="p-4">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach($galeri->images as $image)
                    <div class="group relative aspect-square rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-700">
                        <img src="{{ $image->url }}" 
                             alt="Gallery image {{ $loop->iteration }}"
                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        
                        <!-- Image overlay -->
                        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <button onclick="openLightbox('{{ $image->url }}')" 
                                    class="bg-white/90 text-primary-600 p-2 rounded-full shadow-lg hover:bg-white transition-all duration-300 transform scale-90 group-hover:scale-100">
                                <i class="fas fa-expand"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Comments section -->
        <div class="mt-12 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold mb-6 text-gray-800 dark:text-white border-b pb-2 dark:border-gray-700">
                <i class="fas fa-comments mr-2 text-primary-500"></i> Komentar ({{ $galeri->comments_count ?? 0 }})
            </h3>
            
            <!-- Comment form -->
            @auth
            <div class="mb-8">
                <form action="{{ route('comments.store', $galeri->slug) }}" method="POST" class="flex gap-4">
                    @csrf
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-primary-500">
                            @if(auth()->user()->profile_photo_path)
                            <img src="{{ Storage::url(auth()->user()->profile_photo_path) }}" 
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
                        <textarea name="content" 
                                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent" 
                                  rows="3" 
                                  placeholder="Tulis komentar Anda..."
                                  required></textarea>
                        <button type="submit" 
                                class="mt-2 px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors duration-300 float-right">
                            Kirim Komentar
                        </button>
                    </div>
                </form>
            </div>
            @else
            <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg text-center">
                <p class="text-gray-600 dark:text-gray-300">
                    <a href="{{ route('login') }}" class="text-primary-600 dark:text-primary-400 hover:underline">Login</a> 
                    untuk meninggalkan komentar
                </p>
            </div>
            @endauth
            
            <!-- Comments list -->
            <div class="space-y-6">
                @forelse($galeri->comments as $comment)
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                            @if($comment->user->profile_photo_path)
                            <img src="{{ Storage::url($comment->user->profile_photo_path) }}" 
                                 alt="{{ $comment->user->name }}" 
                                 class="w-full h-full object-cover">
                            @else
                            <span class="font-bold text-gray-600 dark:text-gray-300">
                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex-grow">
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-bold text-gray-800 dark:text-white">{{ $comment->user->name }}</h4>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                @auth
                                @if(auth()->id() === $comment->user_id)
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-500">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                                @endauth
                            </div>
                            <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $comment->content }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-6 text-gray-500 dark:text-gray-400">
                    <i class="fas fa-comment-slash text-2xl mb-2"></i>
                    <p>Belum ada komentar</p>
                </div>
                @endforelse
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
@endsection