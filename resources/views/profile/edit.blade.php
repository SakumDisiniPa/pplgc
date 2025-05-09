@extends('layouts.app')

@section('content')
<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('status'))
        <div class="mb-6 p-4 rounded-md {{ session('success') ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
            {{ session('status') }}
        </div>
        @endif

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Profil</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Foto Profil -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Foto Profil</h2>
                    
                    @if($user->profile_photo_path)
                    <img src="{{ asset('storage/profile-photos/' . basename($user->profile_photo_path)) }}" 
                        alt="Profile Photo" 
                        class="w-20 h-20 rounded-full object-cover">
                    @else
                    <div class="w-20 h-20 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-2xl font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    @endif

                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="w-full">
                            @csrf
                            @method('patch')
                            
                            <div class="mb-4">
                                <input type="file" name="profile_photo" id="profile_photo" 
                                       class="block w-full text-sm text-gray-500
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-md file:border-0
                                              file:text-sm file:font-semibold
                                              file:bg-primary-50 file:text-primary-700
                                              hover:file:bg-primary-100">
                                @error('profile_photo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="w-full bg-primary-600 text-white py-2 px-4 rounded-md hover:bg-primary-700 transition-colors">
                                Update Foto
                            </button>
                        </form>

                        @if($user->profile_photo_path)
                        <form method="POST" action="{{ route('profile.photo.destroy') }}" class="w-full mt-2">
                            @csrf
                            @method('delete')
                            <button type="submit" class="w-full text-red-600 hover:text-red-800 text-sm font-medium">
                                Hapus Foto
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Informasi Profil -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Informasi Profil</h2>
                    
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="bg-primary-600 text-white py-2 px-6 rounded-md hover:bg-primary-700 transition-colors">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Hapus Akun -->
                <div class="bg-white rounded-lg shadow-md p-6 mt-6 border border-red-100">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Hapus Akun</h2>
                    <p class="text-sm text-gray-600 mb-4">Setelah akun Anda dihapus, semua data akan dihapus secara permanen.</p>
                    
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                   placeholder="Masukkan password Anda">
                            @error('password', 'userDeletion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan.')">
                            Hapus Akun
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection