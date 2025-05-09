@extends('layouts.app')

@section('content')
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4" data-aos="fade-up">
                <span class="gradient-text">Berita Terkini</span> Sekolah
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Informasi dan berita terbaru seputar kegiatan sekolah dan kelas XI PPLG C
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($beritas as $berita)
            <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300" data-aos="fade-up">
                @if($berita->gambar)
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ Storage::url($berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                        <span class="text-xs font-semibold text-white bg-primary-600 px-2 py-1 rounded">Berita</span>
                    </div>
                </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <i class="far fa-calendar-alt mr-2"></i>
                        {{ $berita->created_at->format('d M Y') }}
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        <a href="{{ route('berita.show', $berita->id) }}" class="hover:text-primary-600 transition-colors duration-200">
                            {{ $berita->judul }}
                        </a>
                    </h3>
                    <p class="text-gray-600 mb-4">
                        {{ \Str::limit(strip_tags($berita->konten), 120) }}
                    </p>
                    <a href="{{ route('berita.show', $berita->id) }}" class="inline-flex items-center text-primary-600 hover:text-primary-800 font-medium text-sm">
                        Baca selengkapnya
                        <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        @if($beritas->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $beritas->links() }}
        </div>
        @endif
    </div>
</section>
@endsection