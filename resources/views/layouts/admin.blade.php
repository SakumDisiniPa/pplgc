<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false, dropdownOpen: false }" x-cloak>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard - {{ config('app.name') }}</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Font Awesome 6 (latest) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via CDN (for demo) - Recommended to use Vite in production -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    spacing: {
                        4.5: '1.125rem',
                        18: '4.5rem',
                        22: '5.5rem',
                    }
                }
            }
        }
    </script>

    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        
        /* Smooth transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 200ms;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        
        /* Sidebar animation */
        .sidebar {
            transition: width 0.3s ease;
        }
        .sidebar-collapsed {
            width: 5rem;
        }
        .sidebar-expanded {
            width: 16rem;
        }
        
        /* Active menu item indicator */
        .active-menu-item {
            position: relative;
        }
        .active-menu-item::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 60%;
            background-color: white;
            border-radius: 2px 0 0 2px;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">
    <!-- Main Layout -->
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar (Desktop) -->
        <aside class="hidden md:flex flex-col sidebar sidebar-collapsed hover:sidebar-expanded bg-primary-800 text-white h-full fixed z-50">
            <!-- Logo -->
            <div class="flex items-center justify-center py-5 px-4 border-b border-primary-700">
                <div class="flex items-center">
                    <i class="fas fa-school text-2xl"></i>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-1 px-2">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center py-3 px-4 text-white hover:bg-primary-700 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-primary-700 active-menu-item' : '' }}">
                            <i class="fas fa-tachometer-alt text-lg w-6 text-center"></i>
                        </a>
                    </li>

                    <!-- Berita -->
                    <li>
                        <a href="{{ route('admin.berita.index') }}" 
                           class="flex items-center py-3 px-4 text-white hover:bg-primary-700 rounded-lg transition-colors {{ request()->routeIs('admin.berita.*') ? 'bg-primary-700 active-menu-item' : '' }}">
                            <i class="fas fa-newspaper text-lg w-6 text-center"></i>
                        </a>
                    </li>

                    <!-- Galeri -->
                    <li>
                        <a href="{{ route('admin.galeri.index') }}" 
                           class="flex items-center py-3 px-4 text-white hover:bg-primary-700 rounded-lg transition-colors {{ request()->routeIs('admin.galeri.*') ? 'bg-primary-700 active-menu-item' : '' }}">
                            <i class="fas fa-images text-lg w-6 text-center"></i>
                        </a>
                    </li>

                    <!-- Forum -->
                    <li>
                        <a href="{{ route('admin.forum.index') }}" 
                           class="flex items-center py-3 px-4 text-white hover:bg-primary-700 rounded-lg transition-colors {{ request()->routeIs('admin.forum.*') ? 'bg-primary-700 active-menu-item' : '' }}">
                            <i class="fas fa-comments text-lg w-6 text-center"></i>
                        </a>
                    </li>

                    <!-- Informasi -->
                    <li>
                        <a href="{{ route('admin.informasi.index') }}" 
                           class="flex items-center py-3 px-4 text-white hover:bg-primary-700 rounded-lg transition-colors {{ request()->routeIs('admin.informasi.*') ? 'bg-primary-700 active-menu-item' : '' }}">
                            <i class="fas fa-info-circle text-lg w-6 text-center"></i>
                        </a>
                    </li>

                    <!-- Keuangan -->
                    <li>
                        <a href="{{ route('admin.keuangan') }}" 
                           class="flex items-center py-3 px-4 text-white hover:bg-primary-700 rounded-lg transition-colors {{ request()->routeIs('admin.keuangan*') ? 'bg-primary-700 active-menu-item' : '' }}">
                            <i class="fas fa-money-bill-wave text-lg w-6 text-center"></i>
                        </a>
                    </li>

                    <!-- Manajemen User -->
                    <li>
                        <a href="{{ route('admin.users.index') }}" 
                           class="flex items-center py-3 px-4 text-white hover:bg-primary-700 rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-primary-700 active-menu-item' : '' }}">
                            <i class="fas fa-users-cog text-lg w-6 text-center"></i>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-primary-700">
                <div class="flex items-center justify-center">
                    <button class="text-white hover:text-primary-200 transition-colors">
                        <i class="fas fa-cog text-lg"></i>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Mobile Sidebar Backdrop -->
        <div x-show="sidebarOpen" 
             class="fixed inset-0 z-40 bg-black bg-opacity-50 md:hidden"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false">
        </div>

        <!-- Mobile Sidebar -->
        <aside x-show="sidebarOpen" 
               class="fixed inset-y-0 left-0 z-50 w-64 bg-primary-800 text-white transform transition-transform duration-300 ease-in-out md:hidden"
               x-transition:enter="transition-transform ease-in-out duration-300"
               x-transition:enter-start="-translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transition-transform ease-in-out duration-300"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="-translate-x-full">
            <div class="flex items-center justify-between p-4 border-b border-primary-700">
                <div class="flex items-center">
                    <i class="fas fa-school text-2xl"></i>
                </div>
                <button @click="sidebarOpen = false" class="text-white hover:text-primary-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <nav class="py-4">
                <ul class="space-y-1 px-2">
                    <!-- Mobile menu items same as desktop -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="block py-3 px-6 text-white hover:bg-primary-700 rounded-lg">
                            <i class="fas fa-tachometer-alt text-lg w-6 text-center"></i> Dashboard
                        </a>
                    </li>
                    <!-- Berita -->
                    <li>
                        <a href="{{ route('admin.berita.index') }}" class="block py-3 px-6 text-white hover:bg-primary-700 rounded-lg">
                            <i class="fas fa-newspaper text-lg w-6 text-center"></i> Berita
                        </a>
                    </li>

                    <!-- Galeri -->
                    <li>
                        <a href="{{ route('admin.galeri.index') }}" 
                           class="block py-3 px-6 text-white hover:bg-primary-700 rounded-lg transition-colors {{ request()->routeIs('admin.galeri.*') ? 'bg-primary-700 active-menu-item' : '' }}">
                            <i class="fas fa-images text-lg w-6 text-center"></i> Galeri
                        </a>
                    </li>

                    <!-- Forum -->
                    <li>
                        <a href="{{ route('admin.forum.index') }}" 
                           class="block py-3 px-6 text-white hover:bg-primary-700 rounded-lg transition-colors {{ request()->routeIs('admin.forum.*') ? 'bg-primary-700 active-menu-item' : '' }}">
                            <i class="fas fa-comments text-lg w-6 text-center"></i> Forum
                        </a>
                    </li>

                    <!-- Informasi -->
                    <li>
                        <a href="{{ route('admin.informasi.index') }}" 
                           class="block py-3 px-6 text-white hover:bg-primary-700 rounded-lg transition-colors {{ request()->routeIs('admin.informasi.*') ? 'bg-primary-700 active-menu-item' : '' }}">
                            <i class="fas fa-info-circle text-lg w-6 text-center"></i> Informasi
                        </a>
                    </li>

                    <!-- Keuangan -->
                    <li>
                        <a href="{{ route('admin.keuangan') }}" 
                           class="block py-3 px-6 text-white hover:bg-primary-700 rounded-lg transition-colors {{ request()->routeIs('admin.keuangan*') ? 'bg-primary-700 active-menu-item' : '' }}">
                            <i class="fas fa-money-bill-wave text-lg w-6 text-center"></i> Keuangan kas
                        </a>
                    </li>

                    <!-- Manajemen User -->
                    <li>
                        <a href="{{ route('admin.users.index') }}" 
                           class="block py-3 px-6 text-white hover:bg-primary-700 rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-primary-700 active-menu-item' : '' }}">
                            <i class="fas fa-users-cog text-lg w-6 text-center"></i> User
                        </a>
                    </li>
                </ul>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden md:ml-16 lg:ml-20">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <!-- Hamburger Menu (Mobile) -->
                    <div class="flex items-center md:hidden">
                        <button @click="sidebarOpen = true" class="text-gray-500 hover:text-gray-600 focus:outline-none">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>

                    <!-- Search Bar -->
                    <div class="flex-1 max-w-md mx-4 hidden md:block">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" placeholder="Search..." 
                                   class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                        </div>
                    </div>

                    <!-- Right Side Menu -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="p-1 text-gray-500 hover:text-gray-600 focus:outline-none relative">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                            </button>
                        </div>

                        <!-- User Profile Dropdown -->
                        <div class="relative ml-3">
                            <div>
                                <button @click="dropdownOpen = !dropdownOpen" 
                                        class="flex items-center max-w-xs text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" 
                                        id="user-menu">
                                    <div class="h-9 w-9 rounded-full bg-primary-500 flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                    <span class="ml-2 hidden md:inline-block font-medium text-gray-700">{{ auth()->user()->name }}</span>
                                    <i class="fas fa-chevron-down ml-1 hidden md:inline-block text-xs text-gray-500"></i>
                                </button>
                            </div>

                            <!-- Dropdown Menu -->
                            <div x-show="dropdownOpen" 
                                 @click.away="dropdownOpen = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1 z-50">
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

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <!-- Notifications -->
                @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
                @endif

                @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <div>
                            <p class="font-medium">Terjadi kesalahan:</p>
                            <ul class="list-disc list-inside mt-1">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Page Content -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>