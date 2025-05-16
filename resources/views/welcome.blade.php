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
            <div class="relative max-w-md mx-auto w-44 h-44">
                <div class="absolute top-1/2 left-1/4 transform -translate-x-1/2 -translate-y-1/2 w-28 h-28 bg-primary-400 rounded-full mix-blend-multiply filter blur-md opacity-50 animate-blob"></div>
                <div class="absolute top-1/2 right-1/4 transform translate-x-1/2 -translate-y-1/2 w-28 h-28 bg-secondary-400 rounded-full mix-blend-multiply filter blur-md opacity-50 animate-blob animation-delay-2000"></div>
                <div class="absolute top-1/4 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-28 h-28 bg-yellow-400 rounded-full mix-blend-multiply filter blur-md opacity-50 animate-blob animation-delay-4000"></div>
                <img src="{{ asset('logo-pplg.png') }}" alt="Kelas XI PPLG C" class="rounded-xl w-40 h-auto relative z-10 mx-auto block" />
            </div>
            </div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
</section>

<!-- Dashboard Stats Section with Counting Animation -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Siswa Card -->
            <div class="p-6 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 shadow-sm transition-all hover:shadow-md" 
                 data-aos="fade-up"
                 x-data="{ 
                     count: 0, 
                     target: {{ $siswaCount }}, 
                     duration: 3000,
                     increment: 1,
                     delay: 10
                 }"
                 x-init="
                     $nextTick(() => {
                         let start = null;
                         const step = (timestamp) => {
                             if (!start) start = timestamp;
                             const progress = timestamp - start;
                             const percentage = Math.min(progress / duration, 1);
                             count = Math.floor(percentage * target);
                             
                             if (percentage < 1) {
                                 window.requestAnimationFrame(step);
                             } else {
                                 count = target;
                             }
                         };
                         setTimeout(() => {
                             window.requestAnimationFrame(step);
                         }, delay);
                     })">
                <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-blue-100 text-blue-600 mx-auto">
                    <i class="fas fa-user-graduate text-xl"></i>
                </div>
                <div class="text-4xl font-bold text-blue-600 mb-2" x-text="count.toLocaleString()"></div>
                <div class="text-gray-600 font-medium">Total Siswa</div>
            </div>

            <!-- Kegiatan Card -->
            <div class="p-6 rounded-xl bg-gradient-to-br from-green-50 to-green-100 border border-green-200 shadow-sm transition-all hover:shadow-md" 
                 data-aos="fade-up"
                 data-aos-delay="100"
                 x-data="{ 
                     count: 0, 
                     target: {{ $kegiatanCount }}, 
                     duration: 2000,
                     increment: 1,
                     delay: 200
                 }"
                 x-init="
                     $nextTick(() => {
                         let start = null;
                         const step = (timestamp) => {
                             if (!start) start = timestamp;
                             const progress = timestamp - start;
                             const percentage = Math.min(progress / duration, 1);
                             count = Math.floor(percentage * target);
                             
                             if (percentage < 1) {
                                 window.requestAnimationFrame(step);
                             } else {
                                 count = target;
                             }
                         };
                         setTimeout(() => {
                             window.requestAnimationFrame(step);
                         }, delay);
                     })">
                <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-green-100 text-green-600 mx-auto">
                    <i class="fas fa-calendar-check text-xl"></i>
                </div>
                <div class="text-4xl font-bold text-green-600 mb-2" x-text="count.toLocaleString()"></div>
                <div class="text-gray-600 font-medium">Kegiatan</div>
            </div>

            <!-- Guru Card -->
            <div class="p-6 rounded-xl bg-gradient-to-br from-amber-50 to-amber-100 border border-amber-200 shadow-sm transition-all hover:shadow-md" 
                 data-aos="fade-up"
                 data-aos-delay="200"
                 x-data="{ 
                     count: 0, 
                     target: {{ $guruCount }}, 
                     duration: 000,
                     increment: 1,
                     delay: 300
                 }"
                 x-init="
                     $nextTick(() => {
                         let start = null;
                         const step = (timestamp) => {
                             if (!start) start = timestamp;
                             const progress = timestamp - start;
                             const percentage = Math.min(progress / duration, 1);
                             count = Math.floor(percentage * target);
                             
                             if (percentage < 1) {
                                 window.requestAnimationFrame(step);
                             } else {
                                 count = target;
                             }
                         };
                         setTimeout(() => {
                             window.requestAnimationFrame(step);
                         }, delay);
                     })">
                <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-amber-100 text-amber-600 mx-auto">
                    <i class="fas fa-chalkboard-teacher text-xl"></i>
                </div>
                <div class="text-4xl font-bold text-amber-600 mb-2" x-text="count.toLocaleString()"></div>
                <div class="text-gray-600 font-medium">Guru</div>
            </div>

            <!-- Kas Card -->
            <div class="p-6 rounded-xl bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 shadow-sm transition-all hover:shadow-md" 
                 data-aos="fade-up"
                 data-aos-delay="300"
                 x-data="{ 
                     count: 0, 
                     target: {{ $kasCount }}, 
                     duration: 6000,
                     increment: 1,
                     delay: 300
                 }"
                 x-init="
                     $nextTick(() => {
                         let start = null;
                         const step = (timestamp) => {
                             if (!start) start = timestamp;
                             const progress = timestamp - start;
                             const percentage = Math.min(progress / duration, 1);
                             count = Math.floor(percentage * target);
                             
                             if (percentage < 1) {
                                 window.requestAnimationFrame(step);
                             } else {
                                 count = target;
                             }
                         };
                         setTimeout(() => {
                             window.requestAnimationFrame(step);
                         }, delay);
                     })">
                <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-purple-100 text-purple-600 mx-auto">
                    <i class="fas fa-wallet text-xl"></i>
                </div>
                <div class="text-4xl font-bold text-purple-600 mb-2">Rp <span x-text="new Intl.NumberFormat('id-ID').format(count)"></span></div>
                <div class="text-gray-600 font-medium">Uang Kas</div>
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
                <h3 class="text-xl font-bold text-gray-900 mb-3">Informasi Kalender</h3>
                <p class="text-gray-600">
                    Akses kalender lengkap dan informasi hari libur nasional serta jadwal kegiatan tahun ajaran 24/25.
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

<!-- Holiday Countdown Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-8 shadow-md">
            <div class="text-center mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2" data-aos="fade-up">
                    <i class="fas fa-calendar-star mr-2 text-yellow-500"></i> Hari Libur Nasional 2025
                </h2>
                <p class="text-gray-600" data-aos="fade-up" data-aos-delay="100">
                    Hitung mundur menuju hari libur nasional berikutnya
                </p>
            </div>
            
            <!-- Current Date & Time -->
            <div class="bg-white p-4 rounded-lg shadow-inner mb-8 text-center">
                <div class="text-sm text-gray-500">Waktu Sekarang:</div>
                <div class="text-xl font-semibold text-gray-800" id="currentDateTime">
                    {{ now()->timezone('Asia/Jakarta')->isoFormat('dddd, D MMMM YYYY HH:mm:ss') }}
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Upcoming Holiday Countdown -->
                <div class="bg-white p-6 rounded-lg shadow-md" data-aos="fade-right">
                    <h3 class="text-lg font-bold text-indigo-700 mb-4 text-center">Hari Libur Berikutnya</h3>
                    <div class="text-center mb-4">
                        <div id="next-holiday-name" class="text-xl font-bold text-indigo-600">Memuat...</div>
                        <div id="next-holiday-date" class="text-gray-700">-</div>
                    </div>
                    <div class="grid grid-cols-4 gap-2">
                        <div class="bg-indigo-50 rounded-lg p-2">
                            <div class="text-2xl font-bold text-indigo-600" id="countdown-days">00</div>
                            <div class="text-xs text-gray-500">Hari</div>
                        </div>
                        <div class="bg-indigo-50 rounded-lg p-2">
                            <div class="text-2xl font-bold text-indigo-600" id="countdown-hours">00</div>
                            <div class="text-xs text-gray-500">Jam</div>
                        </div>
                        <div class="bg-indigo-50 rounded-lg p-2">
                            <div class="text-2xl font-bold text-indigo-600" id="countdown-minutes">00</div>
                            <div class="text-xs text-gray-500">Menit</div>
                        </div>
                        <div class="bg-indigo-50 rounded-lg p-2">
                            <div class="text-2xl font-bold text-indigo-600" id="countdown-seconds">00</div>
                            <div class="text-xs text-gray-500">Detik</div>
                        </div>
                    </div>
                </div>
                
                <!-- Holiday List -->
                <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md" data-aos="fade-left">
                    <h3 class="text-lg font-bold text-indigo-700 mb-4 text-center">Daftar Hari Libur Nasional 2025</h3>
                    <div class="overflow-auto max-h-96">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Hari Libur</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="holiday-list">
                                <!-- Data hari libur akan diisi oleh JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
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
            @foreach($galeriKegiatan as $galeri)
            <div class="group rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300" data-aos="fade-up">
                <a href="{{ route('galeri.show', $galeri->slug) }}">
                <img src="{{ $galeri->thumbnail_url }}" alt="{{ $galeri->judul }}" 
                class="w-full h-48 object-cover">
            </a>
                <div class="p-3 bg-white">
                    <h3 class="font-semibold text-gray-800">{{ $galeri->judul }}</h3>
                    <p class="text-sm text-gray-500">
                    {{ $galeri->created_at->format('d M Y') }}
                    </p>
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

@push('scripts')
<script>
    // Daftar hari libur nasional Indonesia 2025
    const holidays2025 = [
        { date: '2025-01-01', name: 'Tahun Baru 2025 Masehi', day: 'Rabu', note: '' },
        { date: '2025-01-29', name: 'Tahun Baru Imlek 2576 Kongzili', day: 'Rabu', note: '' },
        { date: '2025-01-27', name: 'Isra Mikraj Nabi Muhammad SAW', day: 'Senin', note: '' },
        { date: '2025-03-29', name: 'Hari Suci Nyepi Tahun Baru Saka 1947', day: 'Sabtu', note: '' },
        { date: '2025-03-31', name: 'Hari Raya Idul Fitri 1446 Hijriyah', day: 'Senin', note: '1 Syawal 1446 H' },
        { date: '2025-04-01', name: 'Hari Raya Idul Fitri 1446 Hijriyah', day: 'Selasa', note: '2 Syawal 1446 H' },
        { date: '2025-04-18', name: 'Wafat Isa Al Masih (Jumat Agung)', day: 'Jumat', note: '' },
        { date: '2025-04-20', name: 'Hari Raya Paskah', day: 'Minggu', note: '' },
        { date: '2025-05-01', name: 'Hari Buruh Internasional', day: 'Kamis', note: '' },
        { date: '2025-05-12', name: 'Hari Raya Waisak 2569 BE', day: 'Senin', note: '' },
        { date: '2025-05-29', name: 'Kenaikan Isa Al Masih', day: 'Kamis', note: '' },
        { date: '2025-06-01', name: 'Hari Lahir Pancasila', day: 'Minggu', note: '' },
        { date: '2025-06-06', name: 'Hari Raya Idul Adha 1446 Hijriyah', day: 'Jumat', note: '10 Dzulhijjah 1446 H' },
        { date: '2025-06-27', name: 'Tahun Baru Islam 1447 Hijriyah', day: 'Jumat', note: '1 Muharram 1447 H' },
        { date: '2025-08-17', name: 'Hari Kemerdekaan Republik Indonesia', day: 'Minggu', note: '' },
        { date: '2025-09-05', name: 'Maulid Nabi Muhammad SAW', day: 'Jumat', note: '12 Rabiul Awal 1447 H' },
        { date: '2025-12-25', name: 'Hari Raya Natal', day: 'Kamis', note: '' },
        { date: '2025-12-31', name: 'Tutup Tahun 2025', day: 'Rabu', note: 'Bukan Hari Libur Nasional (opsional cuti bersama)' }
    ];

    // Fungsi untuk mengisi daftar hari libur
    function populateHolidayList() {
        const holidayList = document.getElementById('holiday-list');
        holidayList.innerHTML = '';
        
        holidays2025.forEach(holiday => {
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50';
            
            row.innerHTML = `
                <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">${formatDate(holiday.date)}</td>
                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">${holiday.day}</td>
                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 font-medium">${holiday.name}</td>
                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">${holiday.note || '-'}</td>
            `;
            
            holidayList.appendChild(row);
        });
    }

    // Fungsi untuk memformat tanggal
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
    }

    // Fungsi untuk menemukan hari libur berikutnya
    function findNextHoliday() {
        const now = new Date();
        now.setHours(0, 0, 0, 0); // Set ke awal hari
        
        for (const holiday of holidays2025) {
            const holidayDate = new Date(holiday.date);
            if (holidayDate >= now) {
                return {
                    ...holiday,
                    dateObj: holidayDate
                };
            }
        }
        
        // Jika semua hari libur tahun ini sudah lewat, kembalikan hari libur pertama tahun depan
        const firstHolidayNextYear = holidays2025[0];
        const nextYearDate = new Date(firstHolidayNextYear.date);
        nextYearDate.setFullYear(nextYearDate.getFullYear() + 1);
        
        return {
            ...firstHolidayNextYear,
            dateObj: nextYearDate
        };
    }

    // Fungsi untuk update countdown dan waktu sekarang
    function updateCountdown() {
        const nextHoliday = findNextHoliday();
        
        // Update info hari libur berikutnya
        document.getElementById('next-holiday-name').textContent = nextHoliday.name;
        document.getElementById('next-holiday-date').textContent = `${nextHoliday.day}, ${formatDate(nextHoliday.date)}`;
        
        // Hitung selisih waktu
        const now = new Date();
        const diff = nextHoliday.dateObj - now;
        
        // Hitung hari, jam, menit, detik
        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);
        
        // Update tampilan countdown
        document.getElementById('countdown-days').textContent = days.toString().padStart(2, '0');
        document.getElementById('countdown-hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('countdown-minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('countdown-seconds').textContent = seconds.toString().padStart(2, '0');
        
        // Update waktu sekarang
        const options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false,
            timeZone: 'Asia/Jakarta'
        };
        document.getElementById('currentDateTime').textContent = new Intl.DateTimeFormat('id-ID', options).format(now);
    }

    // Inisialisasi
    document.addEventListener('DOMContentLoaded', () => {
        populateHolidayList();
        updateCountdown();
        setInterval(updateCountdown, 1000);
    });
</script>
@endpush

@endsection