@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard Admin</h1>
    
    <!-- Stat Cards -->
    <div class="row mt-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Siswa</h5>
                    <h2 class="card-text">{{ $stats['siswa'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Guru</h5>
                    <h2 class="card-text">{{ $stats['guru'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Saldo Kas</h5>
                    <h2 class="card-text">Rp {{ number_format($stats['saldo'], 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Berita</h5>
                    <h2 class="card-text">{{ $stats['berita'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Berita
                        </a>
                        <a href="{{ route('admin.galeri.create') }}" class="btn btn-success">
                            <i class="fas fa-images me-2"></i>Tambah Galeri
                        </a>
                        <a href="{{ route('admin.keuangan') }}" class="btn btn-info">
                            <i class="fas fa-money-bill-wave me-2"></i>Kelola Keuangan
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Activity -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Aktivitas Terakhir</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($recentActivities as $activity)
                        <li class="list-group-item">
                            {{ $activity->description }} 
                            <span class="text-muted small">{{ $activity->created_at->diffForHumans() }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection