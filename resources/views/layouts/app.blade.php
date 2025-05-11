<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Website Kelas' }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Tailwind CSS via CDN (untuk development) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
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
                        },
                        secondary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Custom Styles */
        :root {
            --primary: #0ea5e9;
            --primary-dark: #0284c7;
            --secondary: #22c55e;
            --secondary-dark: #16a34a;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            @apply bg-gray-50 text-gray-800 antialiased;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            @apply w-2;
        }
        ::-webkit-scrollbar-track {
            @apply bg-gray-100;
        }
        ::-webkit-scrollbar-thumb {
            @apply bg-gradient-to-b from-primary-500 to-secondary-500 rounded-full;
        }
        
        /* Gradient Text */
        .gradient-text {
            @apply bg-gradient-to-r from-primary-600 to-secondary-500 bg-clip-text text-transparent;
        }
        
        /* Navbar Animation */
        .navbar {
            transition: all 0.3s ease;
        }
        .navbar.scrolled {
            @apply shadow-lg bg-white/90 backdrop-blur-sm;
        }
        
        /* Card Hover Effect */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            @apply shadow-lg;
        }

        .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        }

        .btn-primary {
            @apply bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors;
        }

        .prose img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1rem 0;
        }
        .prose pre {
            background-color: #f8fafc;
            padding: 1rem;
            border-radius: 0.5rem;
            overflow-x: auto;
        }
        .prose code {
            background-color: #f1f5f9;
            padding: 0.2rem 0.4rem;
            border-radius: 0.25rem;
            font-family: monospace;
        }
        
        /* Button Pulse Effect */
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        .btn-pulse:hover {
            animation: pulse 1.5s infinite;
        }
        
        /* Custom Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }
    </style>
    <style>
    /* Animasi untuk lightbox */
    #lightbox {
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    #lightbox:not(.hidden) {
        opacity: 1;
        display: flex !important;
    }
    
    #lightbox img {
        transform: scale(0.95);
        transition: transform 0.3s ease;
    }
    
    #lightbox:not(.hidden) img {
        transform: scale(1);
    }
</style>
</head>
<body class="font-inter">
    <!-- Navigation -->
    <nav id="navbar" class="fixed top-0 w-full z-50 bg-white shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="text-3xl font-bold gradient-text flex items-center">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        XI PPLG C
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden lg:flex space-x-8 items-center">
                    <a href="/" class="nav-link text-gray-700 hover:text-primary-600 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 flex items-center gap-2 group">
                        <i class="fas fa-home text-primary-500 group-hover:text-primary-600 transition-colors duration-300"></i>
                        <span>Beranda</span>
                    </a>
                    <a href="/informasi" class="nav-link text-gray-700 hover:text-primary-600 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 flex items-center gap-2 group">
                        <i class="fas fa-info-circle text-primary-500 group-hover:text-primary-600 transition-colors duration-300"></i>
                        <span>Informasi</span>
                    </a>
                    <a href="/galeri" class="nav-link text-gray-700 hover:text-primary-600 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 flex items-center gap-2 group">
                        <i class="fas fa-images text-primary-500 group-hover:text-primary-600 transition-colors duration-300"></i>
                        <span>Galeri</span>
                    </a>
                    <a href="/berita" class="nav-link text-gray-700 hover:text-primary-600 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 flex items-center gap-2 group">
                        <i class="fas fa-newspaper text-primary-500 group-hover:text-primary-600 transition-colors duration-300"></i>
                        <span>Berita</span>
                    </a>
                    <a href="/forum" class="nav-link text-gray-700 hover:text-primary-600 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 flex items-center gap-2 group">
                        <i class="fas fa-comments text-primary-500 group-hover:text-primary-600 transition-colors duration-300"></i>
                        <span>Forum</span>
                    </a>
                </div>
                
                <!-- Auth Section -->
                <div class="hidden lg:flex items-center space-x-4">
                    @auth
                    <!-- Tampilan untuk user yang sudah login -->
                    <div class="relative group" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                            <div class="w-8 h-8 rounded-full overflow-hidden border-2 border-primary-500">
                                @if(Auth::user()->profile_photo_path)
                                <img src="{{ asset('storage/profile-photos/' . basename(Auth::user()->profile_photo_path)) }}"  alt="Profile" class="w-full h-full object-cover">
                                @else
                                <div class="bg-primary-100 text-primary-600 w-full h-full flex items-center justify-center">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                @endif
                            </div>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" 
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user-circle mr-2"></i> Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <!-- Tampilan untuk guest -->
                    <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-800 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-300 hover:bg-primary-50">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn-gradient text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transition-all duration-300 relative overflow-hidden group">
                    <span class="relative z-10 text-blue-500">Daftar</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-primary-700 to-secondary-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    </a>
                    @endauth
                </div>
                
                <!-- Mobile menu button -->
                <div class="lg:hidden flex items-center">
                    <button id="mobile-menu-button" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-primary-600 hover:bg-gray-100 focus:outline-none transition duration-300 ease-in-out">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="lg:hidden hidden origin-top bg-white shadow-xl rounded-b-lg">
            <div class="px-4 pt-2 pb-4 space-y-2">
                <a href="/" class="block px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-colors duration-300 flex items-center">
                    <i class="fas fa-home mr-3 text-primary-500 w-5 text-center"></i>
                    Beranda
                </a>
                <a href="/informasi" class="block px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-colors duration-300 flex items-center">
                    <i class="fas fa-info-circle mr-3 text-primary-500 w-5 text-center"></i>
                    Informasi
                </a>
                <a href="/galeri" class="block px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-colors duration-300 flex items-center">
                    <i class="fas fa-images mr-3 text-primary-500 w-5 text-center"></i>
                    Galeri
                </a>
                <a href="/berita" class="block px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-colors duration-300 flex items-center">
                    <i class="fas fa-newspaper mr-3 text-primary-500 w-5 text-center"></i>
                    Berita
                </a>
                <a href="/forum" class="block px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-colors duration-300 flex items-center">
                    <i class="fas fa-comments mr-3 text-primary-500 w-5 text-center"></i>
                    Forum
                </a>
                
                @auth
                <div class="pt-2 border-t border-gray-200 mt-2 space-y-2">
                    <a href="{{ route('profile.show') }}" class="block px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-colors duration-300 flex items-center">
                        <i class="fas fa-user-circle mr-3 text-primary-500 w-5 text-center"></i>
                        Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-colors duration-300 flex items-center">
                            <i class="fas fa-sign-out-alt mr-3 text-primary-500 w-5 text-center"></i>
                            Logout
                        </button>
                    </form>
                </div>
                @else
                <div class="pt-2 border-t border-gray-200 mt-2 space-y-2">
                    <a href="{{ route('login') }}" class="block px-4 py-3 rounded-lg text-base font-medium text-primary-600 hover:bg-primary-50 transition-colors duration-300 flex items-center">
                        <i class="fas fa-sign-in-alt mr-3 text-primary-500 w-5 text-center"></i>
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="block px-4 py-3 rounded-lg text-base font-medium text-white bg-gradient-to-r from-primary-600 to-secondary-500 hover:shadow-md transition-all duration-300 flex items-center justify-center btn-pulse">
                        <i class="fas fa-user-plus mr-3 text-white w-5 text-center"></i>
                        Daftar
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="pt-20 min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- About Section -->
                <div class="space-y-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center">
                        <i class="fas fa-graduation-cap text-3xl gradient-text mr-2"></i>
                        <span class="text-2xl font-bold gradient-text">XI PPLG C</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Website resmi kelas XI PPLG C SMKN 1 PADAHERANG. Tempat berbagi informasi dan kegiatan kelas.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="social-icon text-gray-400 hover:text-primary-500 text-lg transition-colors duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon text-gray-400 hover:text-blue-400 text-lg transition-colors duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.instagram.com/xipplgc.nesapa_" class="social-icon text-gray-400 hover:text-pink-500 text-lg transition-colors duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-icon text-gray-400 hover:text-red-500 text-lg transition-colors duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-lg font-semibold text-white mb-6 relative pb-2 after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-gradient-to-r after:from-primary-500 after:to-secondary-500">
                        Menu Cepat
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="/" class="footer-link text-gray-400 hover:text-primary-500 text-sm transition-colors duration-300 flex items-center">
                            <i class="fas fa-chevron-right text-xs text-primary-500 mr-2"></i> Beranda
                        </a></li>
                        <li><a href="/informasi" class="footer-link text-gray-400 hover:text-primary-500 text-sm transition-colors duration-300 flex items-center">
                            <i class="fas fa-chevron-right text-xs text-primary-500 mr-2"></i> Informasi
                        </a></li>
                        <li><a href="/galeri" class="footer-link text-gray-400 hover:text-primary-500 text-sm transition-colors duration-300 flex items-center">
                            <i class="fas fa-chevron-right text-xs text-primary-500 mr-2"></i> Galeri
                        </a></li>
                        <li><a href="/berita" class="footer-link text-gray-400 hover:text-primary-500 text-sm transition-colors duration-300 flex items-center">
                            <i class="fas fa-chevron-right text-xs text-primary-500 mr-2"></i> Berita
                        </a></li>
                        <li><a href="/forum" class="footer-link text-gray-400 hover:text-primary-500 text-sm transition-colors duration-300 flex items-center">
                            <i class="fas fa-chevron-right text-xs text-primary-500 mr-2"></i> Forum
                        </a></li>
                    </ul>
                </div>
                
                <!-- Help Center -->
                <div data-aos="fade-up" data-aos-delay="300">
                    <h3 class="text-lg font-semibold text-white mb-6 relative pb-2 after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-gradient-to-r after:from-primary-500 after:to-secondary-500">
                        Bantuan
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="footer-link text-gray-400 hover:text-primary-500 text-sm transition-colors duration-300 flex items-center">
                            <i class="fas fa-chevron-right text-xs text-primary-500 mr-2"></i> FAQ
                        </a></li>
                        <li><a href="#" class="footer-link text-gray-400 hover:text-primary-500 text-sm transition-colors duration-300 flex items-center">
                            <i class="fas fa-chevron-right text-xs text-primary-500 mr-2"></i> Kontak Kami
                        </a></li>
                        <li><a href="#" class="footer-link text-gray-400 hover:text-primary-500 text-sm transition-colors duration-300 flex items-center">
                            <i class="fas fa-chevron-right text-xs text-primary-500 mr-2"></i> Kebijakan Privasi
                        </a></li>
                        <li><a href="#" class="footer-link text-gray-400 hover:text-primary-500 text-sm transition-colors duration-300 flex items-center">
                            <i class="fas fa-chevron-right text-xs text-primary-500 mr-2"></i> Syarat & Ketentuan
                        </a></li>
                    </ul>
                </div>
                
                <!-- Newsletter -->
                <div data-aos="fade-up" data-aos-delay="400">
                    <h3 class="text-lg font-semibold text-white mb-6 relative pb-2 after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-gradient-to-r after:from-primary-500 after:to-secondary-500">
                        Newsletter
                    </h3>
                    <p class="text-gray-400 text-sm mb-4">
                        Dapatkan update terbaru dari kami langsung ke email Anda.
                    </p>
                    <form class="mt-2 flex flex-col space-y-3">
                        <input type="email" placeholder="Email Anda" class="px-4 py-3 border border-gray-700 bg-gray-800 rounded-lg text-sm w-full focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-500 transition-all duration-300">
                        <button type="submit" class="bg-gradient-to-r from-primary-600 to-secondary-500 text-white px-6 py-3 rounded-lg font-medium hover:shadow-lg transition-all duration-300 flex items-center justify-center btn-pulse">
                            <i class="fas fa-paper-plane mr-2"></i> Berlangganan
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="mt-16 pt-8 border-t border-gray-800 text-center">
                <p class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} XI PPLG C. Powered By Sakum.
                </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 right-8 bg-gradient-to-r from-primary-600 to-secondary-500 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center opacity-0 invisible transition-all duration-300 z-50 hover:shadow-xl">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- GSAP for Animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
    function shareToFacebook(url) {
        window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url), '_blank', 'width=600,height=400');
    }

    function shareToTwitter(url, text) {
        window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(text) + '&url=' + encodeURIComponent(url), '_blank', 'width=600,height=400');
    }

    function shareToWhatsApp(url, text) {
        window.open('https://wa.me/?text=' + encodeURIComponent(text + ' - ' + url), '_blank', 'width=600,height=400');
    }

    function copyLink(url) {
        navigator.clipboard.writeText(url).then(function() {
            alert('Tautan berhasil disalin!');
        }, function() {
            alert('Gagal menyalin tautan');
        });
    }
</script>

<!--galeri create-->

<!--galeri show-->
<script>
    // Lightbox functionality
    function openLightbox(imageUrl) {
        document.getElementById('lightbox-image').src = imageUrl;
        document.getElementById('lightbox').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    
    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    
    // Close lightbox when clicking outside image
    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLightbox();
        }
    });
    
    // Close with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });
</script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropArea = document.getElementById('drop-area');
        const browseBtn = document.getElementById('browse-btn');
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.multiple = true;
        fileInput.accept = 'image/*';
        fileInput.style.display = 'none';
        document.body.appendChild(fileInput);
        
        let files = [];
        const maxFiles = 10;
        const maxSize = 5 * 1024 * 1024; // 2MB
        
        // Handle click on browse button
        browseBtn.addEventListener('click', () => fileInput.click());
        
        // Handle file selection via file input
        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
            this.value = ''; // Reset to allow selecting same files again
        });
        
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });
        
        // Highlight drop area when item is dragged over it
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });
        
        // Handle dropped files
        dropArea.addEventListener('drop', handleDrop, false);
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        function highlight() {
            dropArea.classList.add('highlight');
        }
        
        function unhighlight() {
            dropArea.classList.remove('highlight');
        }
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const droppedFiles = dt.files;
            handleFiles(droppedFiles);
        }
        
        function handleFiles(newFiles) {
            if (files.length + newFiles.length > maxFiles) {
                alert(`Anda hanya dapat mengupload maksimal ${maxFiles} gambar`);
                return;
            }
            
            for (let i = 0; i < newFiles.length; i++) {
                const file = newFiles[i];
                
                if (!file.type.match('image.*')) {
                    alert(`File ${file.name} bukan gambar yang valid`);
                    continue;
                }
                
                if (file.size > maxSize) {
                    alert(`File ${file.name} melebihi ukuran maksimal 2MB`);
                    continue;
                }
                
                files.push(file);
                addPreview(file);
            }
            
            updateFormData();
        }
        
        function addPreview(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const container = document.getElementById('image-upload-container');
                const previewId = 'preview-' + Date.now() + '-' + Math.floor(Math.random() * 1000);
                
                const previewElement = document.createElement('div');
                previewElement.className = 'preview-container';
                previewElement.id = previewId;
                previewElement.innerHTML = `
                    <img src="${e.target.result}" class="preview-image" alt="${file.name}">
                    <div class="preview-info">
                        <div class="preview-name">${file.name}</div>
                        <div class="preview-size">${formatFileSize(file.size)}</div>
                    </div>
                    <div class="preview-remove" onclick="removePreview('${previewId}')">
                        <i class="fas fa-times"></i>
                    </div>
                `;
                
                container.appendChild(previewElement);
            };
            reader.readAsDataURL(file);
        }
        
        function removePreview(id) {
            const previewElement = document.getElementById(id);
            if (previewElement) {
                const fileName = previewElement.querySelector('.preview-name').textContent;
                files = files.filter(file => file.name !== fileName);
                previewElement.remove();
                updateFormData();
            }
        }
        
        function updateFormData() {
            const form = document.getElementById('forum-form');
            const existingInputs = form.querySelectorAll('input[name="images[]"]');
            existingInputs.forEach(input => input.remove());
            
            files.forEach(file => {
                const input = document.createElement('input');
                input.type = 'file';
                input.name = 'images[]';
                input.style.display = 'none';
                
                // Create a new DataTransfer object and add the file
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                input.files = dataTransfer.files;
                
                form.appendChild(input);
            });
        }
        
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        // Make removePreview function available globally
        window.removePreview = removePreview;
        
        // Form submission validation
        document.getElementById('forum-form').addEventListener('submit', function(e) {
            let isValid = true;
            
            files.forEach(file => {
                if (file.size > maxSize) {
                    alert(`File ${file.name} melebihi ukuran maksimal 2MB`);
                    isValid = false;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
</script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
        
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', function() {
            if (mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.remove('hidden');
                gsap.from(mobileMenu, {
                    opacity: 0,
                    y: -20,
                    duration: 0.3,
                    ease: "power2.out"
                });
            } else {
                gsap.to(mobileMenu, {
                    opacity: 0,
                    y: -20,
                    duration: 0.2,
                    ease: "power2.in",
                    onComplete: () => mobileMenu.classList.add('hidden')
                });
            }
        });
        
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Back to top button
        const backToTopButton = document.getElementById('back-to-top');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.remove('opacity-100', 'visible');
                backToTopButton.classList.add('opacity-0', 'invisible');
            }
        });
        
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Animate elements on load
        document.addEventListener('DOMContentLoaded', function() {
            gsap.from(".navbar", {
                opacity: 0,
                y: -20,
                duration: 0.8,
                delay: 0.2
            });
            
            gsap.to(".gradient-text", {
                duration: 2,
                backgroundPosition: '100% 50%',
                ease: "sine.inOut",
                repeat: -1,
                yoyo: true
            });
        });
    </script>
</body>
</html>