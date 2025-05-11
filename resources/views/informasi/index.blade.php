@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Error Message -->
    @if(isset($error))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8" role="alert">
        <p>{{ $error }}</p>
    </div>
    @endif

    <!-- Header Section -->
    <div class="text-center mb-12" data-aos="fade-up">
        <h1 class="text-4xl font-bold gradient-text mb-4">Struktur Kelas XI PPLG C</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Berikut adalah susunan pengurus kelas dan wali kelas yang bertugas membimbing kita selama tahun ajaran ini.</p>
    </div>

    <!-- Pengurus Kelas Section -->
    <div class="mb-16">
        <h2 class="text-2xl font-semibold mb-8 text-center gradient-text" data-aos="fade-up">Pengurus Kelas</h2>
        
        @if($ketua || $wakil || $pengurus->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Ketua Kelas -->
            @if($ketua)
            <div class="card-hover bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg" data-aos="fade-up" data-aos-delay="100">
                <div class="p-6">
                    <div class="flex flex-col items-center text-center">
                        <div class="relative mb-4">
                            <img class="w-32 h-32 rounded-full object-cover border-4 border-primary-100" 
                                 src="{{ $ketua->foto ? asset('storage/'.$ketua->foto) : asset('images/default-avatar.jpg') }}" 
                                 alt="{{ $ketua->nama }}">
                            <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-primary-500 text-white px-4 py-1 rounded-full text-xs font-bold">
                                KETUA KELAS
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $ketua->nama }}</h3>
                        <p class="text-gray-600 mt-1">NIS: {{ $ketua->nis }}</p>
                        @if($ketua->alamat)
                        <p class="text-gray-500 text-sm mt-2">{{ $ketua->alamat }}</p>
                        @endif
                        <div class="mt-4 flex space-x-3 justify-center">
                            @if($ketua->instagram)
                            <a href="https://instagram.com/{{ $ketua->instagram }}" class="text-blue-500 hover:text-blue-700" target="_blank">
                                <i class="fab fa-instagram text-lg"></i>
                            </a>
                            @endif
                            @if($ketua->email)
                            <a href="mailto:{{ $ketua->email }}" class="text-gray-600 hover:text-gray-800">
                                <i class="fas fa-envelope text-lg"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Wakil Ketua Kelas -->
            @if($wakil)
            <div class="card-hover bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg" data-aos="fade-up" data-aos-delay="150">
                <div class="p-6">
                    <div class="flex flex-col items-center text-center">
                        <div class="relative mb-4">
                            <img class="w-32 h-32 rounded-full object-cover border-4 border-primary-100" 
                                 src="{{ $wakil->foto ? asset('storage/'.$wakil->foto) : asset('images/default-avatar.jpg') }}" 
                                 alt="{{ $wakil->nama }}">
                            <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-secondary-500 text-white px-4 py-1 rounded-full text-xs font-bold">
                                WAKIL KETUA
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $wakil->nama }}</h3>
                        <p class="text-gray-600 mt-1">NIS: {{ $wakil->nis }}</p>
                        @if($wakil->alamat)
                        <p class="text-gray-500 text-sm mt-2">{{ $wakil->alamat }}</p>
                        @endif
                        <div class="mt-4 flex space-x-3 justify-center">
                            @if($wakil->instagram)
                            <a href="https://instagram.com/{{ $wakil->instagram }}" class="text-blue-500 hover:text-blue-700" target="_blank">
                                <i class="fab fa-instagram text-lg"></i>
                            </a>
                            @endif
                            @if($wakil->email)
                            <a href="mailto:{{ $wakil->email }}" class="text-gray-600 hover:text-gray-800">
                                <i class="fas fa-envelope text-lg"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Anggota Pengurus Kelas -->
            @forelse($pengurus as $jabatan => $items)
                @foreach($items as $anggota)
                <div class="card-hover bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg" data-aos="fade-up" data-aos-delay="{{ 200 + ($loop->parent->index * 50) }}">
                    <div class="p-6">
                        <div class="flex flex-col items-center text-center">
                            <div class="relative mb-4">
                                <img class="w-32 h-32 rounded-full object-cover border-4 border-primary-100" 
                                     src="{{ $anggota->foto ? asset('storage/'.$anggota->foto) : asset('images/default-avatar.jpg') }}" 
                                     alt="{{ $anggota->nama }}">
                                <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-gray-600 text-white px-4 py-1 rounded-full text-xs font-bold">
                                    {{ strtoupper($jabatan) }}
                                </div>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">{{ $anggota->nama }}</h3>
                            <p class="text-gray-600 mt-1">NIS: {{ $anggota->nis }}</p>
                            @if($anggota->alamat)
                            <p class="text-gray-500 text-sm mt-2">{{ $anggota->alamat }}</p>
                            @endif
                            <div class="mt-4 flex space-x-3 justify-center">
                                @if($anggota->instagram)
                                <a href="https://instagram.com/{{ $anggota->instagram }}" class="text-blue-500 hover:text-blue-700" target="_blank">
                                    <i class="fab fa-instagram text-lg"></i>
                                </a>
                                @endif
                                @if($anggota->email)
                                <a href="mailto:{{ $anggota->email }}" class="text-gray-600 hover:text-gray-800">
                                    <i class="fas fa-envelope text-lg"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @empty
                @if(!$ketua && !$wakil)
                <div class="col-span-full text-center text-gray-500 py-8">
                    <i class="fas fa-users-slash text-4xl mb-4"></i>
                    <p>Data pengurus kelas belum tersedia</p>
                </div>
                @endif
            @endforelse
        </div>
        @else
        <div class="text-center text-gray-500 py-12">
            <i class="fas fa-users-slash text-5xl mb-4"></i>
            <p class="text-xl">Data struktur kelas belum tersedia</p>
        </div>
        @endif
    </div>

    <!-- Wali Kelas & Guru Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-8 text-center gradient-text" data-aos="fade-up">Guru Pengajar</h2>
        
        @if($gurus->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($gurus as $guru)
            <div class="card-hover bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="p-5">
                    <div class="flex flex-col items-center text-center">
                        <img class="w-24 h-24 rounded-full object-cover border-4 border-primary-100 mb-4" 
                             src="{{ $guru->foto ? asset('storage/'.$guru->foto) : asset('images/default-teacher.jpg') }}" 
                             alt="{{ $guru->nama }}">
                        <h3 class="text-lg font-bold text-gray-800">{{ $guru->nama }}</h3>
                        <p class="text-primary-600 font-medium">{{ $guru->jabatan }}</p>
                        <p class="text-gray-500 text-sm mt-1">Mengajar: {{ $guru->mapel }}</p>
                        <div class="mt-3 flex space-x-3 justify-center">
                            @if($guru->no_hp)
                            <a href="tel:{{ $guru->no_hp }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-phone-alt"></i>
                            </a>
                            @endif
                            @if($guru->email)
                            <a href="mailto:{{ $guru->email }}" class="text-gray-600 hover:text-gray-800">
                                <i class="fas fa-envelope"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center text-gray-500 py-12">
            <i class="fas fa-chalkboard-teacher text-5xl mb-4"></i>
            <p class="text-xl">Data guru belum tersedia</p>
        </div>
        @endif
    </div>

    <!-- Informasi Tambahan -->
    <div class="bg-gradient-to-r from-primary-50 to-secondary-50 rounded-xl p-6 md:p-8 mt-12" data-aos="fade-up">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-6 md:mb-0">
                <h3 class="text-xl font-bold text-gray-800 mb-3">Informasi Kelas</h3>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start">
                        <i class="fas fa-calendar-alt text-primary-500 mt-1 mr-2"></i>
                        <span>Tahun Ajaran: 2023/2024</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-users text-primary-500 mt-1 mr-2"></i>
                        <span>Jumlah Siswa: {{ $jumlahSiswa }} orang</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection