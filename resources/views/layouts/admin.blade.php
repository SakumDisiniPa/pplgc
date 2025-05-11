<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard - {{ config('app.name') }}</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .sidebar:hover {
            width: 250px;
        }
        .sidebar:hover .logo-text {
            display: block;
        }
        .sidebar:hover .nav-item-text {
            display: inline;
        }
    </style>
</head>
<body class="bg-gray-50 font-poppins" x-data="{ open: false }">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50">
        <div class="sidebar bg-blue-800 text-white h-full w-16 md:w-20 transition-all duration-300 ease-in-out overflow-hidden">
            <!-- Logo -->
            <div class="flex items-center justify-center py-5 px-2 border-b border-blue-700">
                <div class="flex items-center">
                    <i class="fas fa-school text-2xl"></i>
                    <span class="logo-text ml-3 font-bold text-lg hidden">SMA N 1</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-6">
                <div x-data="{ activeMenu: '' }">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center py-3 px-4 text-white hover:bg-blue-700 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-tachometer-alt text-lg"></i>
                        <span class="nav-item-text ml-3 hidden">Dashboard</span>
                    </a>

                    <!-- Berita -->
                    <a href="{{ route('admin.berita.index') }}" 
                       class="flex items-center py-3 px-4 text-white hover:bg-blue-700 transition-colors {{ request()->routeIs('admin.berita.*') ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-newspaper text-lg"></i>
                        <span class="nav-item-text ml-3 hidden">Berita</span>
                    </a>

                    <!-- Galeri -->
                    <a href="{{ route('admin.galeri.index') }}" 
                       class="flex items-center py-3 px-4 text-white hover:bg-blue-700 transition-colors {{ request()->routeIs('admin.galeri.*') ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-images text-lg"></i>
                        <span class="nav-item-text ml-3 hidden">Galeri</span>
                    </a>

                    <!-- Forum -->
                    <a href="{{ route('admin.forum.index') }}" 
                       class="flex items-center py-3 px-4 text-white hover:bg-blue-700 transition-colors {{ request()->routeIs('admin.forum.*') ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-comments text-lg"></i>
                        <span class="nav-item-text ml-3 hidden">Forum</span>
                    </a>

                    <!-- Informasi -->
                    <a href="{{ route('admin.informasi.index') }}" 
                       class="flex items-center py-3 px-4 text-white hover:bg-blue-700 transition-colors {{ request()->routeIs('admin.informasi.*') ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-info-circle text-lg"></i>
                        <span class="nav-item-text ml-3 hidden">Informasi</span>
                    </a>

                    <!-- Keuangan -->
                    <a href="{{ route('admin.keuangan') }}" 
                       class="flex items-center py-3 px-4 text-white hover:bg-blue-700 transition-colors {{ request()->routeIs('admin.keuangan*') ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-money-bill-wave text-lg"></i>
                        <span class="nav-item-text ml-3 hidden">Keuangan</span>
                    </a>

                    <!-- Manajemen User -->
                    <a href="{{ route('admin.users.index') }}" 
                       class="flex items-center py-3 px-4 text-white hover:bg-blue-700 transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-users-cog text-lg"></i>
                        <span class="nav-item-text ml-3 hidden">Manajemen User</span>
                    </a>
                </div>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-16 md:ml-20 min-h-screen">
        <!-- Top Navigation -->
        <header class="bg-white shadow-sm">
            <div class="flex justify-between items-center px-6 py-4">
                <!-- Hamburger Menu (Mobile) -->
                <button @click="open = !open" class="md:hidden text-gray-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- Search Bar -->
                <div class="hidden md:block w-1/3">
                    <div class="relative">
                        <input type="text" placeholder="Search..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <div class="relative">
                        <button class="text-gray-600 hover:text-blue-600">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                        </button>
                    </div>

                    <!-- User Profile -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="hidden md:inline-block font-medium">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs hidden md:inline-block"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i> Profile
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-cog mr-2"></i> Settings
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Mobile Sidebar -->
        <div x-show="open" class="fixed inset-0 z-40 md:hidden" @click="open = false">
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>
        <div x-show="open" 
             class="fixed inset-y-0 left-0 z-50 w-64 bg-blue-800 text-white transform transition-transform duration-300 ease-in-out md:hidden"
             @click.away="open = false">
            <div class="flex items-center justify-between p-4 border-b border-blue-700">
                <div class="flex items-center">
                    <i class="fas fa-school text-2xl"></i>
                    <span class="ml-3 font-bold text-lg">SMA N 1</span>
                </div>
                <button @click="open = false" class="text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <nav class="mt-4">
                <!-- Sama dengan menu sidebar desktop -->
                <a href="{{ route('admin.dashboard') }}" class="block py-3 px-6 text-white hover:bg-blue-700">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
                <!-- Tambahkan menu lainnya dengan pola yang sama -->
            </nav>
        </div>

        <!-- Page Content -->
        <main class="p-6">
            <!-- Notifikasi -->
            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p>{{ session('error') }}</p>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Konten Halaman -->
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>