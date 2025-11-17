<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IT Learning Path | Primakara University</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />

    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Poppins', sans-serif;
        }
        .navbar-dark {
            background-color: #06192A; /* Biru tua navbar utama */
        }
        .scroll-container::-webkit-scrollbar {
            height: 8px;
        }
        .scroll-container::-webkit-scrollbar-thumb {
            background: #93c5fd;
            border-radius: 4px;
        }
        /* Style Sub Menu Container Baru */
        .sub-nav-menu-container {
            background-color: #173859; /* Biru sedikit lebih terang dari navbar */
            border-radius: 0.5rem;
            padding: 0.5rem;
            display: inline-flex; /* Agar lebar hanya sesuai konten */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }

        /* Transisi menu */
        .menu-hidden {
            max-height: 0;
            opacity: 0;
            padding-top: 0;
            padding-bottom: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out, opacity 0.3s ease-out, padding 0.3s ease-out;
            box-shadow: none;
        }
        .menu-visible {
            max-height: 250px; 
            opacity: 1;
            padding-top: 1rem;
            padding-bottom: 1rem;
            transition: max-height 0.3s ease-in, opacity 0.3s ease-in, padding 0.3s ease-in;
        }
    </style>
</head>

<body class="bg-white text-gray-800">

    <nav class="flex items-center justify-between px-8 py-4 navbar-dark fixed top-0 left-0 w-full z-50 shadow-xl">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" alt="PrimeLearn Logo" class="h-8" />
            <span class="font-bold text-white text-2xl tracking-wide md:hidden">PrimeLearn</span>
        </div>

        <div class="absolute left-1/2 transform -translate-x-1/2 hidden md:block">
            <span class="font-bold text-white text-2xl tracking-wide">PrimeLearn</span>
        </div>
    </nav>

    <div id="subMenuContainer" class="fixed top-16 left-0 w-full z-40 bg-white menu-hidden md:hidden">
        
        <div class="flex flex-col items-center px-8 pt-4">
            
            <div class="sub-nav-menu-container flex space-x-4 text-white font-medium mb-4">
                <a href="#home" class="px-4 py-2 bg-blue-700 rounded-lg transition text-sm font-bold">HOME</a>
                <a href="#about" class="px-4 py-2 hover:bg-blue-600 rounded-lg transition text-sm">ABOUT US</a>
                <a href="#faq" class="px-4 py-2 hover:bg-blue-600 rounded-lg transition text-sm">FAQ</a>
            </div>

            <div class="max-w-xs mx-auto w-full">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" placeholder="Search for........" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-inner" />
                </div>
            </div>
        </div>
    </div>

    <section id="home" class="pt-32 pb-20 px-6 md:px-20 flex flex-col-reverse md:flex-row items-center justify-between bg-gradient-to-b from-blue-50 to-white">
        <div class="md:w-1/2 mt-10 md:mt-0 text-center md:text-left">
            <h1 class="text-4xl md:text-5xl font-bold text-blue-800 leading-tight mb-6">
                Temukan Jalur Belajarmu di Dunia Teknologi Informasi
            </h1>

            <p class="text-gray-600 mb-8 max-w-md">
                Kami bantu kamu menemukan bidang IT yang paling sesuai dengan minatmu — dari pengembangan software hingga kecerdasan buatan.
            </p>

            <a href="{{ url('/apply') }}" class="px-6 py-3 bg-blue-700 text-white rounded-full font-semibold shadow hover:bg-blue-800 transition">
                Mulai Isi Peminatan
            </a>
        </div>

        <div class="md:w-1/2 flex justify-center">
            <img src="{{ asset('images/it.jpg') }}" alt="Belajar IT" class="w-80 md:w-[420px] drop-shadow-xl" />
        </div>
    </section>

    <section id="fields" class="py-20 bg-white px-6 md:px-20">
        <h2 class="text-3xl font-bold text-blue-800 mb-10 text-center tracking-wide">Bidang IT yang Bisa Kamu Pelajari</h2>

        <div class="relative max-w-6xl mx-auto">
            <button id="scrollLeftBtn" class="hidden md:block absolute left-[-20px] top-1/2 -translate-y-1/2 bg-white p-3 rounded-full shadow-lg border border-gray-200 text-blue-700 hover:bg-gray-100 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button id="scrollRightBtn" class="hidden md:block absolute right-[-20px] top-1/2 -translate-y-1/2 bg-white p-3 rounded-full shadow-lg border border-gray-200 text-blue-700 hover:bg-gray-100 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div id="cardContainer" class="scroll-container flex overflow-x-scroll pb-10 snap-x snap-mandatory space-x-6 md:space-x-8 -mx-6 px-6 md:mx-0 md:px-0">

                <div class="flex-shrink-0 w-80 md:w-96 snap-center p-6 border border-blue-100 bg-blue-50 rounded-2xl shadow-xl hover:shadow-2xl transition">
                    <h3 class="font-bold text-xl text-blue-800 mb-2">💻 Software Development</h3>
                    <p class="text-gray-600 text-sm">Belajar menulis kode, membuat <b>aplikasi web & mobile</b>, serta sistem fungsional dari nol.</p>
                </div>

                <div class="flex-shrink-0 w-80 md:w-96 snap-center p-6 border border-blue-100 bg-blue-50 rounded-2xl shadow-xl hover:shadow-2xl transition">
                    <h3 class="font-bold text-xl text-blue-800 mb-2">📈 Data & AI (Data Science)</h3>
                    <p class="text-gray-600 text-sm">Pelajari <b>data, machine learning, statistik</b>, dan cara membuat prediksi.</p>
                </div>

                <div class="flex-shrink-0 w-80 md:w-96 snap-center p-6 border border-blue-100 bg-blue-50 rounded-2xl shadow-xl hover:shadow-2xl transition">
                    <h3 class="font-bold text-xl text-blue-800 mb-2">⚙️ Jaringan & Infrastruktur</h3>
                    <p class="text-gray-600 text-sm">Mengelola <b>server, cloud, DevOps</b>, serta memastikan layanan teknologi berjalan stabil.</p>
                </div>

                <div class="flex-shrink-0 w-80 md:w-96 snap-center p-6 border border-blue-100 bg-blue-50 rounded-2xl shadow-xl hover:shadow-2xl transition">
                    <h3 class="font-bold text-xl text-blue-800 mb-2">🔒 Keamanan Siber</h3>
                    <p class="text-gray-600 text-sm">Belajar <b>enkripsi, firewall, penetration testing</b>, dan menghadapi ancaman peretas.</p>
                </div>

                <div class="flex-shrink-0 w-80 md:w-96 snap-center p-6 border border-blue-100 bg-blue-50 rounded-2xl shadow-xl hover:shadow-2xl transition">
                    <h3 class="font-bold text-xl text-blue-800 mb-2">🎨 UX/UI Design</h3>
                    <p class="text-gray-600 text-sm">Fokus pada pengalaman (UX) dan tampilan (UI). Merancang antarmuka digital yang intuitif dan menarik.</p>
                </div>

            </div>
        </div>
    </section>

    <section id="about" class="bg-blue-50 py-20 px-6 md:px-20 text-center">
        <h2 class="text-3xl font-bold text-blue-800 mb-6 tracking-wide">Mengapa Belajar Bersama Kami?</h2>

        <p class="text-gray-600 max-w-3xl mx-auto mb-10">
            Website ini dirancang untuk membantu kamu menentukan arah pembelajaran IT berdasarkan minat dan gaya belajarmu. Dapatkan rekomendasi bidang yang cocok, serta panduan belajar langkah demi langkah.
        </p>

        <a href="{{ url('/apply') }}" class="px-8 py-3 bg-blue-700 text-white rounded-full font-semibold hover:bg-blue-800 transition">
            Temukan Peminatanmu Sekarang
        </a>
    </section>

    <footer class="py-6 text-center text-gray-500 border-t border-blue-100">
        © {{ date('Y') }} Primakara University | IT Learning Path Project
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('cardContainer');
            const leftBtn = document.getElementById('scrollLeftBtn');
            const rightBtn = document.getElementById('scrollRightBtn');
            const menuToggle = document.getElementById('menuToggle');
            const subMenuContainer = document.getElementById('subMenuContainer');

            const scrollDistance = 350;

            leftBtn.addEventListener('click', () => {
                container.scrollBy({ left: -scrollDistance, behavior: 'smooth' });
            });

            rightBtn.addEventListener('click', () => {
                container.scrollBy({ left: scrollDistance, behavior: 'smooth' });
            });

            menuToggle.addEventListener('click', () => {
                subMenuContainer.classList.toggle('menu-hidden');
                subMenuContainer.classList.toggle('menu-visible');
            });

            function checkScreenWidth() {
                if (window.innerWidth < 768) {
                    // Mobile view
                    leftBtn.classList.add('hidden');
                    rightBtn.classList.add('hidden');
                } else {
                    // Desktop view
                    leftBtn.classList.remove('hidden');
                    rightBtn.classList.remove('hidden');
                    // Menyembunyikan sub menu di desktop
                    subMenuContainer.classList.add('menu-hidden');
                    subMenuContainer.classList.remove('menu-visible');
                }
            }

            checkScreenWidth();
            window.addEventListener('resize', checkScreenWidth);
        });
    </script>

</body>
</html>