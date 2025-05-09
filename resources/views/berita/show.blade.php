@extends('layouts.app')

@section('content')
<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <article class="prose prose-lg max-w-none">
            <!-- Header Berita -->
            <header class="mb-10">
                <!-- Info Tanggal dan Author -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm text-gray-500 mb-4">
                    <div class="flex items-center mb-2 sm:mb-0">
                        <i class="far fa-calendar-alt mr-2"></i>
                        Dipublikasikan pada {{ $berita->created_at->translatedFormat('d F Y') }}
                    </div>
                    @if($berita->user)
                    <div class="flex items-center">
                        <i class="far fa-user mr-2"></i>
                        Ditulis oleh: <span class="font-medium ml-1">{{ $berita->user->name }}</span>
                    </div>
                    @endif
                </div>
                
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                    {{ $berita->judul }}
                </h1>
                
                @if($berita->gambar)
                <div class="rounded-xl overflow-hidden shadow-lg mb-8">
                    <img src="{{ Storage::url($berita->gambar) }}" alt="{{ $berita->judul }}" 
                         class="w-full h-auto object-cover">
                </div>
                @endif
            </header>

            <!-- Konten Berita -->
            <div class="text-gray-700 text-lg leading-relaxed">
                {!! nl2br(e($berita->konten)) !!}
            </div>

            <!-- Bagian Share -->
            <div class="mt-12 bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Bagikan berita ini:</h3>
                <div class="flex space-x-4">
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                       target="_blank"
                       class="bg-blue-600 text-white p-2 rounded-full w-10 h-10 flex items-center justify-center hover:bg-blue-700 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    
                    <!-- Twitter -->
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($berita->judul) }}&url={{ urlencode(url()->current()) }}" 
                       target="_blank"
                       class="bg-blue-400 text-white p-2 rounded-full w-10 h-10 flex items-center justify-center hover:bg-blue-500 transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    
                    <!-- WhatsApp -->
                    <a href="https://wa.me/?text={{ urlencode($berita->judul . ' ' . url()->current()) }}" 
                       target="_blank"
                       class="bg-green-500 text-white p-2 rounded-full w-10 h-10 flex items-center justify-center hover:bg-green-600 transition-colors">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    
                    <!-- Telegram -->
                    <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($berita->judul) }}" 
                       target="_blank"
                       class="bg-blue-500 text-white p-2 rounded-full w-10 h-10 flex items-center justify-center hover:bg-blue-600 transition-colors">
                        <i class="fab fa-telegram-plane"></i>
                    </a>
                    
                    <!-- Copy Link -->
                    <button onclick="copyToClipboard('{{ url()->current() }}')"
                            class="bg-gray-600 text-white p-2 rounded-full w-10 h-10 flex items-center justify-center hover:bg-gray-700 transition-colors">
                        <i class="fas fa-link"></i>
                    </button>
                </div>
            </div>

            <!-- Bagian Footer Berita -->
            <footer class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <a href="{{ route('berita.index') }}" class="inline-flex items-center text-primary-600 hover:text-primary-800 font-medium mb-4 sm:mb-0">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Berita
                    </a>
                    <div class="text-sm text-gray-500">
                        <i class="far fa-clock mr-1"></i> Terakhir diperbarui: {{ $berita->updated_at->diffForHumans() }}
                    </div>
                </div>
            </footer>
        </article>
    </div>
</section>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Link berita berhasil disalin!');
        }, function() {
            alert('Gagal menyalin link');
        });
    }
</script>
@endsection