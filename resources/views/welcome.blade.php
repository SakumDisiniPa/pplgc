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
                        <img src="https://source.unsplash.com/random/600x400/?classroom" alt="Kelas XI PPLG C" class="rounded-xl w-full h-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
</section>

<!-- Quick Info Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="p-6 rounded-xl bg-gray-50 border border-gray-100" data-aos="fade-up">
                <div class="text-3xl font-bold text-primary-600 mb-2">36</div>
                <div class="text-gray-600 text-sm font-medium">Siswa</div>
            </div>
            <div class="p-6 rounded-xl bg-gray-50 border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                <div class="text-3xl font-bold text-secondary-600 mb-2">12</div>
                <div class="text-gray-600 text-sm font-medium">Kegiatan</div>
            </div>
            <div class="p-6 rounded-xl bg-gray-50 border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                <div class="text-3xl font-bold text-yellow-600 mb-2">8</div>
                <div class="text-gray-600 text-sm font-medium">Prestasi</div>
            </div>
            <div class="p-6 rounded-xl bg-gray-50 border border-gray-100" data-aos="fade-up" data-aos-delay="300">
                <div class="text-3xl font-bold text-purple-600 mb-2">24</div>
                <div class="text-gray-600 text-sm font-medium">Postingan</div>
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
                Website ini dibuat untuk memudahkan komunikasi dan berbagi informasi antar anggota kelas X IPPLG C.
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
                    <i class="fas fa-users text-2xl text-purple-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Forum Diskusi</h3>
                <p class="text-gray-600">
                    Diskusikan materi pelajaran atau kegiatan kelas dengan teman sekelas dan guru secara online.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Recent Announcements -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4" data-aos="fade-up">
                <span class="gradient-text">Pengumuman</span> Terbaru
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Informasi penting dan pengumuman terbaru dari sekolah dan kelas.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Announcement 1 -->
            <div class="bg-gray-50 rounded-lg overflow-hidden border border-gray-200" data-aos="fade-up" data-aos-delay="200">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="bg-primary-100 text-primary-800 text-xs font-semibold px-3 py-1 rounded-full">
                            Penting
                        </div>
                        <span class="text-gray-500 text-sm ml-auto">2 hari lalu</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Ujian Semester Genap</h3>
                    <p class="text-gray-600 mb-4">
                        Jadwal ujian semester genap akan dilaksanakan pada tanggal 5-12 Juni 2023.
                    </p>
                    <a href="#" class="text-primary-600 hover:text-primary-800 font-medium text-sm flex items-center">
                        Baca selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            
            <!-- Announcement 2 -->
            <div class="bg-gray-50 rounded-lg overflow-hidden border border-gray-200" data-aos="fade-up" data-aos-delay="250">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">
                            Kegiatan
                        </div>
                        <span class="text-gray-500 text-sm ml-auto">1 minggu lalu</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Study Tour IT</h3>
                    <p class="text-gray-600 mb-4">
                        Persiapkan diri untuk study tour ke perusahaan IT pada tanggal 15 Juni 2023.
                    </p>
                    <a href="#" class="text-primary-600 hover:text-primary-800 font-medium text-sm flex items-center">
                        Baca selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            
            <!-- Announcement 3 -->
            <div class="bg-gray-50 rounded-lg overflow-hidden border border-gray-200" data-aos="fade-up" data-aos-delay="300">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                            Informasi
                        </div>
                        <span class="text-gray-500 text-sm ml-auto">2 minggu lalu</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Pembagian Raport</h3>
                    <p class="text-gray-600 mb-4">
                        Pembagian raport semester genap akan dilaksanakan pada tanggal 20 Juni 2023.
                    </p>
                    <a href="#" class="text-primary-600 hover:text-primary-800 font-medium text-sm flex items-center">
                        Baca selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-10">
            <a href="/berita" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-primary-600 to-secondary-500 hover:from-primary-700 hover:to-secondary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-300">
                Lihat Semua Pengumuman
            </a>
        </div>
    </div>
</section>

<!-- Gallery Preview -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4" data-aos="fade-up">
                <span class="gradient-text">Galeri</span> Kegiatan
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Dokumentasi momen-momen berharga kelas X IPPLG C.
            </p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <a href="#" class="group rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300" data-aos="fade-up">
                <img src="https://source.unsplash.com/random/300x300/?classroom,1" alt="Kegiatan Belajar" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
            </a>
            <a href="#" class="group rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300" data-aos="fade-up" data-aos-delay="100">
                <img src="https://source.unsplash.com/random/300x300/?school,1" alt="Kegiatan Sekolah" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
            </a>
            <a href="#" class="group rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300" data-aos="fade-up" data-aos-delay="200">
                <img src="https://source.unsplash.com/random/300x300/?student,1" alt="Siswa" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
            </a>
            <a href="#" class="group rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300" data-aos="fade-up" data-aos-delay="300">
                <img src="https://source.unsplash.com/random/300x300/?teamwork,1" alt="Kerja Kelompok" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
            </a>
        </div>
        
        <div class="text-center mt-10">
            <a href="/galeri" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-primary-600 to-secondary-500 hover:from-primary-700 hover:to-secondary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-300">
                Lihat Galeri Lengkap
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
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
@endsection