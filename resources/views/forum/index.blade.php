@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar Kategori -->
        <div class="md:w-1/4">
            <div class="bg-white rounded-lg shadow p-6 sticky top-4">
                <h2 class="text-xl font-bold mb-4 text-primary-600">Kategori Diskusi</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('forum.index') }}" class="flex justify-between items-center px-3 py-2 rounded hover:bg-gray-100 {{ !request('category') ? 'bg-gray-100' : '' }}">
                            <span>Semua Kategori</span>
                            <span class="bg-gray-200 text-gray-700 text-xs font-semibold px-2 py-1 rounded-full">
                                {{ $totalDiscussions }}
                            </span>
                        </a>
                    </li>
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('forum.index', ['category' => $category->id]) }}" class="flex justify-between items-center px-3 py-2 rounded hover:bg-gray-100 {{ request('category') == $category->id ? 'bg-gray-100' : '' }}">
                            <span>{{ $category->name }}</span>
                            <span class="bg-gray-200 text-gray-700 text-xs font-semibold px-2 py-1 rounded-full">
                                {{ $category->discussions_count }}
                            </span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="md:w-3/4">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Forum Diskusi Kelas</h1>
                <a href="{{ route('forum.create') }}" class="btn-primary flex items-center">
                    <i class="fas fa-plus mr-2"></i> Buat Diskusi
                </a>
            </div>

            <!-- Pinned Discussions -->
            @if($pinned->count() > 0)
            <div class="mb-8">
                <h2 class="text-lg font-semibold mb-4 flex items-center text-yellow-600">
                    <i class="fas fa-thumbtack mr-2"></i> Diskusi Penting
                </h2>
                <div class="space-y-4">
                    @foreach($pinned as $discussion)
                    @include('forum._discussion_card', ['discussion' => $discussion, 'pinned' => true])
                    @endforeach
                </div>
            </div>
            @endif

            <!-- All Discussions -->
            <div>
                <h2 class="text-lg font-semibold mb-4">Diskusi Terbaru</h2>
                <div class="space-y-4">
                    @forelse($discussions as $discussion)
                    @include('forum._discussion_card', ['discussion' => $discussion])
                    @empty
                    <div class="bg-white rounded-lg shadow p-6 text-center">
                        <i class="fas fa-comments text-4xl text-gray-400 mb-3"></i>
                        <p class="text-gray-600">Belum ada diskusi</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $discussions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection