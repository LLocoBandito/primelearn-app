<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>About Us - PrimeLearn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 

    <style>
        body { font-family: 'Poppins', sans-serif; }
        
        /* FIX ABOUT PAGE SECTION SPACING */
        section {
            min-height: auto !important;
            height: auto !important;
        }

        @keyframes slideInCenter {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="bg-white text-gray-800">

<header class="main-header">
    <div class="site-title">PrimeLearn</div>
    <div class="menu-icon" id="menuBtn">☰</div>
</header>

<nav class="secondary-nav">
    <a href="{{ route('segments.index') }}"
            class="nav-item {{ request()->routeIs('segments.index') ? 'active' : '' }}">HOME</a>
    <a href="{{ route('about') }}" class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">ABOUT US</a>
    <a href="{{ route('faq') }}" class="nav-item {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
</nav>

<section class="relative bg-gradient-to-br from-blue-900 to-teal-600 text-white">
    <div class="pointer-events-none absolute top-0 left-0 w-full h-14 bg-gradient-to-b from-black/10 to-transparent"></div>
    <div class="pointer-events-none absolute bottom-0 left-0 w-full h-14 bg-gradient-to-t from-black/10 to-transparent"></div>
    
    <div class="max-w-7xl mx-auto px-6 py-24 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6" data-aos="fade-down">
            Belajar dengan Cara yang Lebih Bermakna
        </h2>
        <p class="max-w-3xl mx-auto text-lg text-white/90 mb-10" data-aos="fade-up">
            PrimeLearn menjembatani teori akademik dan praktik nyata untuk menciptakan
            pengalaman belajar yang relevan dengan kebutuhan industri modern.
        </p>
        <div class="flex justify-center gap-4" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('segments.index') }}"
            class="group px-8 py-4 rounded-full bg-white text-blue-900 font-semibold shadow-md transition-all duration-500 hover:shadow-xl hover:-translate-y-0.5">
                <span class="inline-flex items-center gap-2">
                    Mulai Belajar Sekarang →
                </span>
            </a>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-16 items-center">
    <div>
        <h3 class="text-3xl font-bold text-blue-900 mb-6" data-aos="fade-right">
            Mengapa PrimeLearn Dibangun?
        </h3>
        <p class="text-gray-600 leading-relaxed mb-4" data-aos="fade-right">
            Banyak platform pembelajaran masih berfokus pada teori tanpa memberikan konteks
            penerapan di dunia nyata. Hal ini membuat pembelajar kesulitan beradaptasi
            dengan kebutuhan industri.
        </p>
        <p class="text-gray-600 leading-relaxed" data-aos="fade-right">
            PrimeLearn hadir sebagai solusi dengan pendekatan pembelajaran terstruktur,
            kontekstual, dan berbasis pemecahan masalah nyata.
        </p>
    </div>
    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=900&q=80"
     alt="Diskusi Tim PrimeLearn" data-aos="fade-left"
     class="w-full max-w-md mx-auto aspect-[4/3] object-cover rounded-3xl shadow-2xl">
</section>

<section class="relative bg-gradient-to-b from-gray-50 to-white py-24 overflow-hidden">
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-teal-200/40 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-blue-200/40 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-6">
        <h3 class="text-3xl md:text-4xl font-bold text-center text-blue-900 mb-4" data-aos="fade-up">
            Visi & <span class=" text-teal-600">Misi </span>
        </h3>
        <div class="grid md:grid-cols-2 gap-12 mt-12">
            <div class="bg-white p-12 rounded-3xl shadow-xl hover:-translate-y-2 transition" data-aos="zoom-in">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-teal-100 text-2xl">🎯</div>
                    <h4 class="text-2xl font-semibold text-blue-900">Visi</h4>
                </div>
                <p class="text-gray-600 text-lg">Menjadi platform pembelajaran digital yang unggul dalam membentuk pembelajar yang kritis dan adaptif.</p>
            </div>
            <div class="bg-white p-12 rounded-3xl shadow-xl hover:-translate-y-2 transition" data-aos="zoom-in" data-aos-delay="150">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-blue-100 text-2xl">🚀</div>
                    <h4 class="text-2xl font-semibold text-teal-600">Misi</h4>
                </div>
                <ul class="space-y-4 text-gray-600 text-lg">
                    <li>✓ Materi terstruktur & aplikatif</li>
                    <li>✓ Studi kasus dunia nyata</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="relative bg-gray-50 py-24 overflow-hidden">
    <div class="relative max-w-6xl mx-auto px-6">
        <h3 class="text-3xl font-bold text-center text-blue-900 mb-16" data-aos="fade-up">Tim di Balik PrimeLearn</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-10 justify-center text-center">
            @php
                $team = [
                    ['name' => 'Mas Heri', 'img' => 'heri.webp', 'role' => 'Admin'],
                    ['name' => 'Nyoman Bagus', 'img' => 'william.webp', 'role' => 'Backend'],
                    ['name' => 'Dinda Dev', 'img' => 'dinda.webp', 'role' => 'UI/UX'],
                    ['name' => 'Yasa', 'img' => 'yasa.webp', 'role' => 'Fullstack'],
                    ['name' => 'Satya', 'img' => 'satya.webp', 'role' => 'Database'],
                ];
            @endphp

            @foreach($team as $member)
                <div>
                    <div class="mx-auto mb-5 w-40 h-40 rounded-full bg-gradient-to-br from-blue-500 to-teal-400 p-1 transition-transform duration-500 hover:scale-105">
                        <img src="{{ asset('images/' . $member['img']) }}" class="w-full h-full rounded-full object-cover bg-white" alt="{{ $member['name'] }}">
                    </div>
                    <p class="font-semibold text-blue-900">{{ $member['name'] }}</p>
                    <p class="text-sm text-gray-500">{{ $member['role'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<footer class="main-footer py-10 bg-[#0a1d37] text-white text-center">
    <div class="footer-logo text-2xl font-bold mb-2">PrimeLearn</div>
    <div class="opacity-70">&copy; {{ date('Y') }} PrimeLearn. All Rights Reserved.</div>
</footer>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ duration: 900, once: false });

    document.querySelector('.menu-icon').addEventListener('click', () => {
                document.querySelector('.secondary-nav').classList.toggle('show');
            });

    menuBtn.addEventListener('click', (e) => {
        navMenu.classList.toggle('show');
        e.stopPropagation();
    });

    document.addEventListener('click', (e) => {
        if (!menuBtn.contains(e.target) && !navMenu.contains(e.target)) {
            navMenu.classList.remove('show');
        }
    });
</script>

</body>
</html>