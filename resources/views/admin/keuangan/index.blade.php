@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manajemen Kas</h1>
    
    <!-- Card Saldo -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Saldo Saat Ini</h5>
                    <h2 class="card-text">Rp {{ number_format($saldo, 2, ',', '.') }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Pemasukan</h5>
                    <h2 class="card-text">Rp {{ number_format(Kas::pemasukan()->sum('jumlah'), 2, ',', '.') }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Pengeluaran</h5>
                    <h2 class="card-text">Rp {{ number_format(Kas::pengeluaran()->sum('jumlah'), 2, ',', '.') }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Transaksi -->
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5>Tambah Pemasukan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.keuangan.pemasukan') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Jumlah (Rp)</label>
                            <input type="number" class="form-control" name="jumlah" min="1000" step="500" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" required>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus-circle me-1"></i> Tambah Pemasukan
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <h5>Tambah Pengeluaran</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.keuangan.pengeluaran') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Jumlah (Rp)</label>
                            <input type="number" class="form-control" name="jumlah" min="1000" step="500" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" required>
                        </div>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-minus-circle me-1"></i> Tambah Pengeluaran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Transaksi -->
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Riwayat Transaksi</h5>
                <a href="{{ route('admin.keuangan.laporan') }}" class="btn btn-info">
                    <i class="fas fa-file-pdf me-1"></i> Generate Laporan
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Jumlah (Rp)</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi as $trx)
                        <tr>
                            <td>{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge bg-{{ $trx->jenis == 'masuk' ? 'success' : 'danger' }}">
                                    {{ ucfirst($trx->jenis) }}
                                </span>
                            </td>
                            <td class="{{ $trx->jenis == 'masuk' ? 'text-success' : 'text-danger' }}">
                                {{ $trx->jenis == 'masuk' ? '+' : '-' }} 
                                Rp {{ number_format($trx->jumlah, 2, ',', '.') }}
                            </td>
                            <td>{{ $trx->keterangan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $transaksi->links() }}
        </div>
    </div>
</div>
@endsection