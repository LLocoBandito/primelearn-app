<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>About Us - PrimeLearn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 

    <style>
        body { font-family: 'Poppins', sans-serif; }
        /* FIX ABOUT PAGE SECTION SPACING */
        section {
            min-height: auto !important;
            height: auto !important;
        }

    </style>

</head>

<body class="bg-white text-gray-800">

<!-- ================= HEADER ================= -->
 <header class="main-header">
        <div class="site-title">PrimeLearn</div>
        <div class="menu-icon">☰</div>
    </header>

    {{-- NAVIGASI SEKUNDER --}}
    <nav class="secondary-nav">
        <a href="{{ route('segments.index') }}" class="nav-item {{ request()->routeIs('segments.index') ? 'active' : '' }}">HOME</a>
        <a href="{{ route('about') }}" class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">ABOUT US</a>
        <a href="{{ route('faq') }}" class="nav-item {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
    </nav>

{{-- <header class="w-full border-b bg-white/80 backdrop-blur sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-900">PrimeLearn</h1>
        <nav class="space-x-6 hidden md:block">
            <a href="{{ route('segments.index') }}" class="hover:text-teal-600">Home</a>
            <a href="{{ route('about') }}" class="font-semibold text-teal-600">About</a>
            <a href="{{ route('faq') }}" class="hover:text-teal-600">FAQ</a>
        </nav>
    </div>
</header> --}}

<nav class="secondary-nav">
    <a href="{{ route('segments.index') }}" class="nav-item {{ request()->routeIs('segments.index') ? 'active' : '' }}">HOME</a>
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
                    Mulai Belajar Sekarang
                    <span class="transform transition-transform duration-500 group-hover:translate-x-1">→</span>
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
     alt="Diskusi Tim PrimeLearn"
     data-aos="fade-left"
     class="w-full max-w-md mx-auto aspect-[4/3] object-cover rounded-3xl shadow-2xl">
</section>

<section class="relative bg-gradient-to-b from-gray-50 to-white py-24 overflow-hidden">
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-teal-200/40 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-blue-200/40 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-6">
        <h3 class="text-3xl md:text-4xl font-bold text-center text-blue-900 mb-4" data-aos="fade-up">
            Visi & <span class=" text-teal-600">Misi </span>
        </h3>
        <p class="text-center text-gray-600 max-w-2xl mx-auto mb-16" data-aos="fade-up">
            Arah dan tujuan PrimeLearn dalam membangun pengalaman belajar yang relevan dan berdampak.
        </p>

        <div class="grid md:grid-cols-2 gap-12">
            <div class="bg-white p-12 rounded-3xl shadow-xl hover:-translate-y-2 transition" data-aos="zoom-in">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-teal-100 text-teal-600 text-2xl">🎯</div>
                    <h4 class="text-2xl font-semibold text-blue-900">Visi</h4>
                </div>
                <p class="text-gray-600 leading-relaxed text-lg">
                    Menjadi platform pembelajaran digital yang unggul dalam membentuk pembelajar yang kritis, adaptif, dan siap menghadapi tantangan industri global.
                </p>
            </div>

            <div class="bg-white p-12 rounded-3xl shadow-xl hover:-translate-y-2 transition" data-aos="zoom-in" data-aos-delay="150">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-blue-100 text-blue-600 text-2xl">🚀</div>
                    <h4 class="text-2xl font-semibold text-teal-600">Misi</h4>
                </div>
                <ul class="space-y-4 text-gray-600 text-lg">
                    <li class="flex gap-3"><span class="text-teal-600 font-bold">✓</span> Menyediakan materi terstruktur</li>
                    <li class="flex gap-3"><span class="text-teal-600 font-bold">✓</span> Menghubungkan teori dengan praktik</li>
                    <li class="flex gap-3"><span class="text-teal-600 font-bold">✓</span> Mendorong berpikir kritis</li>
                    <li class="flex gap-3"><span class="text-teal-600 font-bold">✓</span> Akses pendidikan berkualitas</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h3 class="text-3xl font-bold text-center text-blue-900 mb-14" data-aos="fade-up">Nilai yang Kami Pegang</h3>
        <div class="grid md:grid-cols-3 gap-10">
            <div class="bg-gradient-to-br from-blue-500 to-teal-400 p-[1.5px] rounded-3xl shadow-lg" data-aos="fade-up">
                <div class="bg-white p-8 rounded-3xl h-full hover:-translate-y-2 transition-all duration-500">
                    <div class="text-4xl mb-4">💡</div>
                    <h4 class="font-semibold text-xl mb-2">Inovasi</h4>
                    <p class="text-gray-600">Terus mengembangkan metode belajar yang relevan.</p>
                </div>
            </div>
            <div class="bg-gradient-to-br from-blue-500 to-teal-400 p-[1.5px] rounded-3xl shadow-lg" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-white p-8 rounded-3xl h-full hover:-translate-y-2 transition-all duration-500">
                    <div class="text-4xl mb-4">🏅</div>
                    <h4 class="font-semibold text-xl mb-2">Kualitas</h4>
                    <p class="text-gray-600">Materi terbaik dengan pendekatan mudah dipahami.</p>
                </div>
            </div>
            <div class="bg-gradient-to-br from-blue-500 to-teal-400 p-[1.5px] rounded-3xl shadow-lg" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white p-8 rounded-3xl h-full hover:-translate-y-2 transition-all duration-500">
                    <div class="text-4xl mb-4">🌍</div>
                    <h4 class="font-semibold text-xl mb-2">Aksesibilitas</h4>
                    <p class="text-gray-600">Pendidikan berkualitas untuk semua kalangan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="relative bg-gray-50 py-24 overflow-hidden">
    <div class="relative max-w-6xl mx-auto px-6">

        <h3 class="text-3xl font-bold text-center text-blue-900 mb-4"
            data-aos="fade-up">
            Tim di Balik PrimeLearn
        </h3>

        <p class="text-center text-gray-600 max-w-xl mx-auto mb-16"
           data-aos="fade-up">
            Tim inti yang berperan dalam pengembangan dan perancangan PrimeLearn.
        </p>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-10 justify-center">

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
                <div class="text-center" data-aos="">

                    <!-- Avatar -->
                    <div class="mx-auto mb-5 w-40 h-40 rounded-full
                                bg-gradient-to-br from-blue-500 to-teal-400 p-1
                                transition-transform duration-500 hover:scale-105">
                        <img src="{{ asset('images/' . $member['img']) }}"
                             class="w-full h-full rounded-full object-cover bg-white"
                             alt="{{ $member['name'] }}">
                    </div>
                    <p class="font-semibold text-blue-900">{{ $member['name'] }}</p>
                    <p class="text-sm text-gray-500">{{ $member['role'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ================= FOOTER ================= -->
  <footer class="main-footer">
        <div class="container footer-content">
            <div class="footer-logo">PrimeLearn</div>
            <div class="footer-copyright">
                &copy; {{ date('Y') }} PrimeLearn. All Rights Reserved.
            </div>
        </div>
  </footer>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ duration: 900, easing: 'ease-out-cubic', once: false });

    // Navbar Toggle Logic
    document.addEventListener("DOMContentLoaded", function () {
        const menuBtn = document.querySelector(".menu-icon");
        const nav = document.querySelector(".secondary-nav");
        if (menuBtn && nav) {
            menuBtn.addEventListener("click", () => {
                nav.classList.toggle("show");
            });
        }
    });
</script>
<script>
        document.addEventListener("DOMContentLoaded", function () {

            const menuBtn = document.querySelector(".menu-icon");
            const nav = document.querySelector(".secondary-nav");

            menuBtn.addEventListener("click", () => {
                nav.classList.toggle("show");
            });

            // --- LOGIC AJAX LOAD MORE SIDEBAR ---

            const loadMoreBtn = document.querySelector(".read-more-link"); 
            const smallPostList = document.querySelector(".small-post-list"); 
            
            // Variabel untuk melacak halaman yang sudah dimuat. Asumsi materi awal adalah Halaman 1.
            let currentPage = 1; 

            // Hanya jalankan jika elemen ditemukan
            if (loadMoreBtn && smallPostList) {
                // Pastikan tombol terlihat seperti dapat di-klik
                loadMoreBtn.style.cursor = 'pointer';

                loadMoreBtn.addEventListener("click", function (e) {
                    e.preventDefault(); // Mencegah navigasi default ke '#'
                    
                    // Cek apakah tombol sedang dalam status nonaktif
                    if (loadMoreBtn.disabled) {
                        return;
                    }

                    // 1. Tampilkan status loading
                    const originalText = loadMoreBtn.textContent;
                    loadMoreBtn.textContent = 'Memuat...';
                    loadMoreBtn.classList.add('loading');
                    
                    // Naikkan nomor halaman untuk meminta data berikutnya
                    currentPage++; 

                    // 2. Kirim permintaan Fetch/AJAX
                    // Menggunakan route name yang sudah kita definisikan: 'ajax.load_more_sidebar'
                    fetch(`{{ route('ajax.load_more_sidebar') }}?page=${currentPage}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // 3. Masukkan HTML materi baru
                            smallPostList.insertAdjacentHTML('beforeend', data.html);

                            // Hapus status loading
                            loadMoreBtn.classList.remove('loading');
                            
                            // 4. Periksa apakah masih ada halaman lagi
                            if (data.hasMore) {
                                loadMoreBtn.textContent = originalText; // Kembalikan teks asli
                            } else {
                                // Nonaktifkan tombol jika semua materi sudah dimuat
                                loadMoreBtn.textContent = 'Semua Materi Dimuat';
                                loadMoreBtn.disabled = true; 
                                loadMoreBtn.style.cursor = 'default';
                                loadMoreBtn.style.opacity = '0.7'; 
                            }
                        })
                        .catch(error => {
                            console.error('Error memuat data:', error);
                            loadMoreBtn.textContent = 'Gagal Memuat (Coba lagi)';
                            loadMoreBtn.classList.remove('loading');
                        });
                });
            }
            // --- ACCORDION LOGIC ---
            const toggles = document.querySelectorAll('.accordion-toggle');

            toggles.forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const item = toggle.closest('.accordion-item');
                    const content = item.querySelector('[data-accordion-content]');
                    const icon = item.querySelector('[data-icon]');

                    // Check if the clicked item is already open
                    const isOpen = content.classList.contains('open');

                    // Close all other open accordion items (optional for accordion behavior)
                    document.querySelectorAll('.accordion-content.open').forEach(openContent => {
                        if (openContent !== content) {
                            openContent.classList.remove('open');
                            openContent.closest('.accordion-item').querySelector('[data-icon]').classList.remove('rotated');
                        }
                    });

                    // Toggle the clicked accordion item
                    if (isOpen) {
                        content.classList.remove('open');
                        icon.classList.remove('rotated');
                    } else {
                        content.classList.add('open');
                        icon.classList.add('rotated');
                    }
                });
            });

       
            // --- WHATSAPP POPUP LOGIC (SAFE) ---
                const popup = document.getElementById("wa-popup");
                const waButton = document.getElementById("wa-button");

                if (popup && waButton) {
                    setTimeout(() => {
                        popup.style.opacity = "1";
                        popup.style.transform = "translateY(0)";
                    }, 800);

                    popup.addEventListener("click", () => {
                        waButton.click();
                    });

                    setTimeout(() => {
                        popup.style.opacity = "0";
                        popup.style.transform = "translateY(20px)";
                    }, 8000);
                }
        });
    </script>

</body>
</html>
