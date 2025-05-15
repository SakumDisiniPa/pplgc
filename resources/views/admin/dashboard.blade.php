@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
        <div class="mt-2 md:mt-0">
            <span class="text-sm text-gray-600">Last updated: {{ now()->format('d M Y, H:i') }}</span>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Siswa -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Siswa</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $stats['siswa'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Guru -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                    <i class="fas fa-chalkboard-teacher text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Guru</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $stats['guru'] }}</p>
                </div>
            </div>
        </div>

        <!-- Saldo Kas -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-cyan-500 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-cyan-100 text-cyan-600 mr-4">
                    <i class="fas fa-wallet text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Saldo Kas</p>
                    <p class="text-2xl font-semibold text-gray-800">Rp {{ number_format($stats['saldo'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Total Berita -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-amber-500 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-amber-100 text-amber-600 mr-4">
                    <i class="fas fa-newspaper text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Berita</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $stats['berita'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 gap-4">
                    <a href="{{ route('admin.berita.create') }}" class="flex items-center justify-between p-4 rounded-lg border border-blue-200 bg-blue-50 hover:bg-blue-100 transition-colors">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-blue-100 text-blue-600 mr-3">
                                <i class="fas fa-plus"></i>
                            </div>
                            <span class="font-medium">Tambah Berita</span>
                        </div>
                        <i class="fas fa-chevron-right text-blue-500"></i>
                    </a>

                    <a href="{{ route('admin.galeri.create') }}" class="flex items-center justify-between p-4 rounded-lg border border-green-200 bg-green-50 hover:bg-green-100 transition-colors">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-green-100 text-green-600 mr-3">
                                <i class="fas fa-images"></i>
                            </div>
                            <span class="font-medium">Tambah Galeri</span>
                        </div>
                        <i class="fas fa-chevron-right text-green-500"></i>
                    </a>

                    <a href="{{ route('admin.keuangan') }}" class="flex items-center justify-between p-4 rounded-lg border border-cyan-200 bg-cyan-50 hover:bg-cyan-100 transition-colors">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-cyan-100 text-cyan-600 mr-3">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <span class="font-medium">Kelola Keuangan</span>
                        </div>
                        <i class="fas fa-chevron-right text-cyan-500"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Aktivitas Terakhir</h3>
                    <a href="#" class="text-sm text-primary-600 hover:text-primary-800">Lihat Semua</a>
                </div>
            </div>
            <div class="divide-y divide-gray-200">
                @foreach($recentActivities as $activity)
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 p-2 rounded-full bg-{{ $activity->color }}-100 text-{{ $activity->color }}-500 mr-3">
                            <i class="{{ $activity->icon }}"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $activity->description }}</p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $activity->created_at->diffForHumans() }}
                                <span class="mx-1">•</span>
                                <span class="text-{{ $activity->color }}-600">{{ $activity->type }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

        <!-- Calendar -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900">Kalender</h3>
            </div>
            <div class="p-4">
                <div class="bg-gray-50 rounded-lg p-3 text-center">
                    <div class="text-lg font-bold text-gray-800">{{ now()->format('F Y') }}</div>
                    <div class="grid grid-cols-7 gap-1 mt-3">
                        @foreach(['M', 'T', 'W', 'T', 'F', 'S', 'S'] as $day)
                        <div class="text-xs font-medium text-gray-500 py-1">{{ $day }}</div>
                        @endforeach
                        
                        @php
                            $firstDay = now()->startOfMonth()->dayOfWeek;
                            $daysInMonth = now()->daysInMonth;
                        @endphp
                        
                        @for($i = 0; $i < $firstDay; $i++)
                            <div class="h-8"></div>
                        @endfor
                        
                        @for($day = 1; $day <= $daysInMonth; $day++)
                            <div class="h-8 w-8 flex items-center justify-center mx-auto rounded-full 
                                {{ $day == now()->day ? 'bg-primary-100 text-primary-800 font-bold' : 'text-gray-700' }}">
                                {{ $day }}
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection