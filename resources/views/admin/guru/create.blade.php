@extends('layouts.admin', ['title' => $title])

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Header Form -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                <i class="fas fa-chalkboard-teacher mr-2 text-indigo-600"></i>
                {{ $title }}
            </h2>
        </div>
        
        <!-- Form Content -->
        <div class="p-6">
            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($guru))
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom 1 - Data Pribadi -->
                    <div class="space-y-4">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama', $guru->nama ?? '') }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                   required>
                            @error('nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="nip" class="block text-sm font-medium text-gray-700 mb-1">NIP <span class="text-red-500">*</span></label>
                            <input type="text" name="nip" id="nip" value="{{ old('nip', $guru->nip ?? '') }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                   required>
                            @error('nip')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <div class="flex space-x-4 mt-1">
                                <div class="flex items-center">
                                    <input id="jenis_kelamin_l" name="jenis_kelamin" type="radio" value="L" 
                                           {{ old('jenis_kelamin', $guru->jenis_kelamin ?? '') == 'L' ? 'checked' : '' }}
                                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300" required>
                                    <label for="jenis_kelamin_l" class="ml-2 block text-sm text-gray-700">Laki-laki</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="jenis_kelamin_p" name="jenis_kelamin" type="radio" value="P" 
                                           {{ old('jenis_kelamin', $guru->jenis_kelamin ?? '') == 'P' ? 'checked' : '' }}
                                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                    <label for="jenis_kelamin_p" class="ml-2 block text-sm text-gray-700">Perempuan</label>
                                </div>
                            </div>
                            @error('jenis_kelamin')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $guru->tempat_lahir ?? '') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                       required>
                                @error('tempat_lahir')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $guru->tanggal_lahir ?? '') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                       required>
                                @error('tanggal_lahir')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Kolom 2 - Data Profesional -->
                    <div class="space-y-4">
                        <div>
                            <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">Jabatan <span class="text-red-500">*</span></label>
                            <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $guru->jabatan ?? '') }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                   required>
                            @error('jabatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="mapel" class="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran <span class="text-red-500">*</span></label>
                            <input type="text" name="mapel" id="mapel" value="{{ old('mapel', $guru->mapel ?? '') }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                   required>
                            @error('mapel')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email', $guru->email ?? '') }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                   required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP <span class="text-red-500">*</span></label>
                            <input type="tel" name="no_hp" id="no_hp" value="{{ old('no_hp', $guru->no_hp ?? '') }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                   required>
                            @error('no_hp')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto Profil</label>
                            <div class="flex items-center">
                                <div class="relative">
                                    <input type="file" name="foto" id="foto" 
                                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                    <label for="foto" class="px-4 py-2 border border-gray-300 rounded-lg cursor-pointer bg-white text-gray-700 hover:bg-gray-50">
                                        <i class="fas fa-upload mr-2"></i> Pilih File
                                    </label>
                                </div>
                                <span id="file-name" class="ml-2 text-sm text-gray-500 truncate max-w-xs">
                                    @if(isset($guru) && $guru->foto)
                                        {{ basename($guru->foto) }}
                                    @else
                                        Belum ada file dipilih
                                    @endif
                                </span>
                            </div>
                            @error('foto')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @if(isset($guru) && $guru->foto)
                                <div class="mt-2 flex items-center">
                                    <img src="{{ asset('storage/'.$guru->foto) }}" alt="Foto guru" class="h-16 w-16 rounded-full object-cover border-2 border-gray-200">
                                    <button type="button" onclick="confirm('Yakin ingin menghapus foto?') ? document.getElementById('hapus-foto').value = '1' : ''" 
                                            class="ml-2 text-red-600 hover:text-red-800 text-sm flex items-center">
                                        <i class="fas fa-trash mr-1"></i> Hapus Foto
                                    </button>
                                    <input type="hidden" name="hapus_foto" id="hapus-foto" value="0">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="mt-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                    <textarea name="alamat" id="alamat" rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                              required>{{ old('alamat', $guru->alamat ?? '') }}</textarea>
                    @error('alamat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Media Sosial -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label for="instagram" class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                        <div class="flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500">@</span>
                            <input type="text" name="instagram" id="instagram" value="{{ old('instagram', $guru->instagram ?? '') }}" 
                                   class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        @error('instagram')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="facebook" class="block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                        <div class="flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500">fb.com/</span>
                            <input type="text" name="facebook" id="facebook" value="{{ old('facebook', $guru->facebook ?? '') }}" 
                                   class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        @error('facebook')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('admin.guru.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-save mr-2"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Menampilkan nama file yang dipilih
    document.getElementById('foto').addEventListener('change', function(e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : 'Belum ada file dipilih';
        document.getElementById('file-name').textContent = fileName;
    });
</script>
@endpush
@endsection