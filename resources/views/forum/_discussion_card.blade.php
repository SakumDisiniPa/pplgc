<div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 @if($pinned ?? false) border-yellow-500 @else border-primary-500 @endif">
    <div class="p-5">
        <div class="flex justify-between items-start">
            <div>
                <a href="{{ route('forum.show', $discussion) }}" class="text-lg font-bold text-gray-800 hover:text-primary-600">
                    @if($pinned ?? false)
                    <i class="fas fa-thumbtack text-yellow-500 mr-1"></i>
                    @endif
                    {{ $discussion->title }}
                </a>
                <div class="flex items-center mt-2 text-sm text-gray-500">
                    <span class="flex items-center mr-3">
                        <i class="fas fa-user mr-1"></i>
                        {{ $discussion->user->name }}
                    </span>
                    <span class="flex items-center mr-3">
                        <i class="fas fa-clock mr-1"></i>
                        {{ $discussion->created_at->diffForHumans() }}
                    </span>
                    <span class="flex items-center mr-3">
                        <i class="fas fa-comment mr-1"></i>
                        {{ $discussion->comments_count }}
                    </span>
                </div>
            </div>
            <div class="flex items-center">
                <span class="flex items-center bg-gray-100 px-3 py-1 rounded-full text-sm">
                    {{ $discussion->category->name }}
                </span>
            </div>
        </div>
        <div class="mt-3 text-gray-600 line-clamp-2">
            {!! Str::markdown($discussion->content) !!}
        </div>
        
        <!-- Bagian Share -->
        <div class="mt-4 flex justify-between items-center border-t border-gray-100 pt-3">
            <div class="flex space-x-2">
                @if($discussion->images_count > 0)
                <span class="flex items-center text-xs text-gray-500">
                    <i class="fas fa-image mr-1"></i> {{ $discussion->images_count }} gambar
                </span>
                @endif
            </div>
            <div class="flex space-x-2">
                <!-- Social Sharing -->
                <button onclick="shareToFacebook('{{ route('forum.show', $discussion) }}')" class="text-gray-500 hover:text-blue-600">
                    <i class="fab fa-facebook"></i>
                </button>
                <button onclick="shareToTwitter('{{ route('forum.show', $discussion) }}', '{{ $discussion->title }}')" class="text-gray-500 hover:text-blue-400">
                    <i class="fab fa-twitter"></i>
                </button>
                <button onclick="shareToWhatsApp('{{ route('forum.show', $discussion) }}', '{{ $discussion->title }}')" class="text-gray-500 hover:text-green-500">
                    <i class="fab fa-whatsapp"></i>
                </button>
                <button onclick="copyLink('{{ route('forum.show', $discussion) }}')" class="text-gray-500 hover:text-gray-700" title="Salin tautan">
                    <i class="fas fa-link"></i>
                </button>
            </div>
        </div>
    </div>
</div>