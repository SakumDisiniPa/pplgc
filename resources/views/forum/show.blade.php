@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Tombol Kembali -->
        <a href="{{ route('forum.index') }}" class="inline-flex items-center text-primary-600 hover:text-primary-800 mb-6">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Forum
        </a>

        <!-- Diskusi Utama -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <!-- Header Diskusi -->
            <div class="border-b border-gray-200 px-6 py-4 bg-gray-50 flex justify-between items-center">
                <div>
                    <span class="inline-block bg-primary-100 text-primary-800 text-xs px-2 py-1 rounded-full font-semibold mr-2">
                        {{ $discussion->category->name }}
                    </span>
                    @if($discussion->is_pinned)
                    <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-semibold">
                        <i class="fas fa-thumbtack mr-1"></i> Penting
                    </span>
                    @endif
                </div>
                <span class="text-sm text-gray-500">
                    Diposting {{ $discussion->created_at->diffForHumans() }}
                </span>
            </div>

            <!-- Konten Diskusi -->
            <div class="p-6">
                <div class="flex items-start mb-6">
                    @if($discussion->user->profile_photo_path)
                    <img class="w-12 h-12 rounded-full object-cover border-2 border-primary-200 mr-4" 
                         src="{{ asset('storage/profile-photos/' . basename($discussion->user->profile_photo_path)) }}" 
                         alt="{{ $discussion->user->name }}">
                    @else
                    <div class="w-12 h-12 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-lg font-bold border-2 border-primary-200 mr-4">
                        {{ strtoupper(substr($discussion->user->name, 0, 1)) }}
                    </div>
                    @endif
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $discussion->title }}</h1>
                        <p class="text-gray-600 font-medium">{{ $discussion->user->name }}</p>
                    </div>
                </div>

                <div class="prose max-w-none text-gray-700 mb-6">
                    {!! Str::markdown($discussion->content) !!}
                </div>

                <!-- Tampilkan Gambar yang Diupload -->
                @if($discussion->images->count() > 0)
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Lampiran Gambar</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($discussion->images as $image)
                        <div class="relative group">
                            <a href="{{ asset('storage/'.$image->path) }}" target="_blank" class="block">
                                <img src="{{ asset('storage/'.$image->path) }}" 
                                     alt="Gambar lampiran diskusi"
                                     class="w-full h-48 object-cover rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                            </a>
                            @can('delete', $discussion)
                            <form action="{{ route('forum.images.destroy', $image) }}" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 text-white p-1 rounded-full hover:bg-red-600"
                                        onclick="return confirm('Hapus gambar ini?')">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            </form>
                            @endcan
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Tombol Aksi -->
                @can('update', $discussion)
                <div class="flex space-x-3 border-t border-gray-200 pt-4">
                    <a href="{{ route('forum.edit', $discussion) }}" class="text-sm text-primary-600 hover:text-primary-800 flex items-center">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <form action="{{ route('forum.destroy', $discussion) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800 flex items-center" onclick="return confirm('Hapus diskusi ini?')">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
                    </form>
                </div>
                @endcan
            </div>
        </div>

        <!-- Bagian Komentar -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="border-b border-gray-200 px-6 py-4 bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-comments mr-2 text-primary-500"></i>
                    Komentar ({{ $discussion->comments->count() }})
                </h2>
            </div>

            <!-- Form Komentar -->
            <div class="p-6 border-b border-gray-200">
                <form action="{{ route('forum.comments.store', $discussion) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="comment" class="sr-only">Komentar</label>
                        <textarea id="comment" name="content" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('content') border-red-500 @enderror"
                                  placeholder="Tulis komentar Anda..." required></textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors text-sm">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Komentar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Daftar Komentar -->
            <div class="divide-y divide-gray-200">
                @forelse($discussion->comments as $comment)
                <div class="p-6">
                    <div class="flex items-start">
                        @if($comment->user->profile_photo_path)
                        <img class="w-10 h-10 rounded-full object-cover border-2 border-primary-200 mr-4" 
                             src="{{ asset('storage/profile-photos/' . basename($comment->user->profile_photo_path)) }}" 
                             alt="{{ $comment->user->name }}">
                        @else
                        <div class="w-10 h-10 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-base font-bold border-2 border-primary-200 mr-4">
                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                        </div>
                        @endif
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <h3 class="font-medium text-gray-800">{{ $comment->user->name }}</h3>
                                <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="prose prose-sm max-w-none text-gray-600">
                                {!! Str::markdown($comment->content) !!}
                            </div>
                            @can('delete', $comment)
                            <form action="{{ route('forum.comments.destroy', [$discussion, $comment]) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-500 hover:text-red-700" onclick="return confirm('Hapus komentar ini?')">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>
                            </form>
                            @endcan
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-500">
                    <i class="fas fa-comment-slash text-2xl mb-2"></i>
                    <p>Belum ada komentar</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

