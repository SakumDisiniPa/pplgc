@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-primary-50 to-secondary-50 py-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-24">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="text-center md:text-left" data-aos="fade-right">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                    Selamat Datang di <span class="gradient-text">XI PPLG C</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 mb-8 max-w-lg">
                    Website resmi kelas XI PPLG C SMKN 1 PADAHERANG. Tempat berbagi informasi, kegiatan, dan prestasi kelas kami.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="/informasi" class="bg-gradient-to-r from-primary-600 to-secondary-500 text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300 flex items-center justify-center btn-pulse">
                        <i class="fas fa-info-circle mr-2"></i> Informasi Kelas
                    </a>
                    <a href="/galeri" class="border-2 border-primary-600 text-primary-600 hover:bg-primary-50 px-8 py-3 rounded-lg font-semibold transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-images mr-2"></i> Lihat Galeri
                    </a>
                </div>
            </div>
            <div class="relative" data-aos="fade-left">
                <div class="relative max-w-md mx-auto">
                    <div class="absolute -top-6 -left-6 w-32 h-32 bg-primary-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                    <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-secondary-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                    <div class="absolute top-0 -right-4 w-32 h-32 bg-yellow-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
                    <div class="relative bg-white p-1 rounded-2xl shadow-xl">
                        <img src="{{ asset('images/classroom.jpg') }}" alt="Kelas XI PPLG C" class="rounded-xl w-full h-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
</section>

<!-- Dashboard Stats Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="p-6 rounded-xl bg-gray-50 border border-gray-100" data-aos="fade-up">
                <div class="text-3xl font-bold text-primary-600 mb-2">{{ $siswaCount }}</div>
                <div class="text-gray-600 text-sm font-medium">Jumlah Siswa</div>
            </div>
            <div class="p-6 rounded-xl bg-gray-50 border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                <div class="text-3xl font-bold text-secondary-600 mb-2">{{ $kegiatanCount }}</div>
                <div class="text-gray-600 text-sm font-medium">Jumlah Kegiatan</div>
            </div>
            <div class="p-6 rounded-xl bg-gray-50 border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                <div class="text-3xl font-bold text-yellow-600 mb-2">{{ $guruCount }}</div>
                <div class="text-gray-600 text-sm font-medium">Jumlah Guru</div>
            </div>
            <div class="p-6 rounded-xl bg-gray-50 border border-gray-100" data-aos="fade-up" data-aos-delay="300">
                <div class="text-3xl font-bold text-purple-600 mb-2">Rp {{ number_format($kasCount, 0, ',', '.') }}</div>
                <div class="text-gray-600 text-sm font-medium">Jumlah Uang Kas</div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4" data-aos="fade-up">
                Fitur <span class="gradient-text">Website Kami</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Website ini dibuat untuk memudahkan komunikasi dan berbagi informasi antar anggota kelas XI PPLG C.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white rounded-xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-primary-100 rounded-lg flex items-center justify-center mb-6">
                    <i class="fas fa-calendar-alt text-2xl text-primary-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Jadwal Pelajaran</h3>
                <p class="text-gray-600">
                    Akses jadwal pelajaran harian dan mingguan dengan mudah. Dapatkan notifikasi perubahan jadwal.
                </p>
            </div>
            
            <!-- Feature 2 -->
            <div class="bg-white rounded-xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-secondary-100 rounded-lg flex items-center justify-center mb-6">
                    <i class="fas fa-tasks text-2xl text-secondary-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Manajemen Tugas</h3>
                <p class="text-gray-600">
                    Catat dan kelola tugas sekolah dengan sistem pengingat. Tidak ada lagi tugas yang terlewat.
                </p>
            </div>
            
            <!-- Feature 3 -->
            <div class="bg-white rounded-xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300" data-aos="fade-up" data-aos-delay="400">
                <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mb-6">
                    <i class="fas fa-wallet text-2xl text-purple-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Kas Kelas</h3>
                <p class="text-gray-600">
                    Pantau keuangan kas kelas secara transparan. Lihat pemasukan dan pengeluaran kas kelas.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Preview -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4" data-aos="fade-up">
                <span class="gradient-text">Galeri</span> Kegiatan
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Dokumentasi momen-momen berharga kelas XI PPLG C.
            </p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($galeriKegiatan as $kegiatan)
            <div class="group rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300" data-aos="fade-up">
                <img src="{{ asset('storage/' . $kegiatan->gambar) }}" alt="{{ $kegiatan->judul }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="p-3 bg-white">
                    <h3 class="font-semibold text-gray-800">{{ $kegiatan->judul }}</h3>
                    <p class="text-sm text-gray-500">{{ $kegiatan->tanggal->format('d M Y') }}</p>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-10">
            <a href="/galeri" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-primary-600 to-secondary-500 hover:from-primary-700 hover:to-secondary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-300">
                Lihat Galeri Lengkap
            </a>
        </div>
    </div>
</section>

@guest
<!-- CTA Section (Hanya tampil untuk guest) -->
<section class="py-16 bg-gradient-to-r from-primary-600 to-secondary-500 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6" data-aos="fade-up">Bergabunglah dengan Komunitas Kami</h2>
        <p class="text-xl text-primary-100 max-w-3xl mx-auto mb-8" data-aos="fade-up" data-aos-delay="100">
            Dapatkan akses penuh ke semua fitur website kelas dengan membuat akun sekarang juga.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4" data-aos="fade-up" data-aos-delay="200">
            <a href="/register" class="bg-white text-primary-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-50 transition-colors duration-300 shadow-lg hover:shadow-xl">
                Daftar Sekarang
            </a>
            <a href="/login" class="bg-transparent border-2 border-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:bg-opacity-10 transition-colors duration-300">
                Masuk Akun
            </a>
        </div>
    </div>
</section>
@endguest
@endsection