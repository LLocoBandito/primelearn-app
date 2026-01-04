<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - PrimeLearn</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <style>
        :root {
            --primary-dark: #062743;
            --secondary-blue: #3b5d7c;
            --grad-toska-marine: linear-gradient(135deg, #27ae60 0%, #1abc9c 20%, #00406aff 100%);
            --grad-button: linear-gradient(to right, #16a085, #1abc9c, #00406aff);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f7f9;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            color: #334155;
        }

        /* ================= HEADER (TIDAK BERUBAH) ================= */
        .main-header {
            background-color: #062743;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .site-title {
            font-size: 1.5rem;
            font-weight: 700;
        }
        .menu-icon {
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* ================= INFO CARDS ================= */
        .info-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
        }
        .info-card:hover { transform: translateY(-5px); }

        /* ================= ACCORDION ELEGAN (DIPERCANTIK) ================= */
        .accordion-item {
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 16px;
            overflow: hidden;
            background: white;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }

        .accordion-toggle {
            background: white;
            color: var(--primary-dark);
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        /* Warna saat ditekan: Lebih Elegan dengan Soft Gradient & Garis Samping */
        .accordion-toggle.active-toggle {
            background: linear-gradient(to right, #f0fdfa, #ffffff);
            color: #0f766e;
            padding-left: 2rem; /* Geser sedikit teks ke kanan */
        }

        /* Menambahkan garis aksen di sisi kiri saat aktif */
        .accordion-toggle.active-toggle::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            background: var(--grad-toska-marine);
        }

        .accordion-content {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.4s ease;
            background: #ffffff;
        }

        .accordion-content.open {
            max-height: 500px;
            opacity: 1;
            padding: 0.5rem 2rem 1.5rem 2rem;
            border-top: 1px solid #f1f5f9;
        }

        /* Lingkaran Ikon Panah */
        .arrow-icon { 
            color: #94a3b8;
            background: #f1f5f9;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 0.75rem;
            transition: all 0.4s ease; 
        }
        .active-toggle .arrow-icon { 
            color: white; 
            background: #1abc9c;
            transform: rotate(90deg); 
            box-shadow: 0 4px 10px rgba(26, 188, 156, 0.3);
        }

        /* ================= FOOTER (TIDAK BERUBAH) ================= */
        footer {
            margin-top: auto;
            background: #06192A; 
            color: white;
            padding: 2.5rem 1rem;
            text-align: center;
            font-size: 0.9rem;
        }

        .footer-brand {
            color: white;
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
            display: block;
        }
    </style>
</head>

<body>

    <header class="main-header">
        <div class="site-title">PrimeLearn</div>
        <div class="menu-icon">☰</div>
    </header>

    <nav class="secondary-nav">
        <a href="{{ route('segments.index') }}" class="nav-item {{ request()->routeIs('segments.index') ? 'active' : '' }}">HOME</a>
        <a href="{{ route('about') }}" class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">ABOUT US</a>
        <a href="{{ route('faq') }}" class="nav-item {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
    </nav>

<section class="container mx-auto max-w-6xl px-6 py-12">
    <div class="text-center mb-12">
        <h2 class="text-4xl font-extrabold text-[#062743] mb-4">
            Pusat Bantuan <span style="background: var(--grad-button); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">PrimeLearn</span>
        </h2>
        <p class="text-slate-500">Kami siap membantu menjawab segala keraguan Anda.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="info-card text-center border-b-4 border-emerald-500">
            <h3 class="text-3xl font-bold text-emerald-500 mb-1">24/7</h3>
            <p class="text-sm text-slate-500 font-medium uppercase tracking-wider">Dukungan Teknis</p>
        </div>
        <div class="info-card text-center border-b-4 border-blue-500">
            <h3 class="text-3xl font-bold text-blue-500 mb-1">500+</h3>
            <p class="text-sm text-slate-500 font-medium uppercase tracking-wider">Artikel Panduan</p>
        </div>
        <div class="info-card text-center border-b-4 border-purple-500">
            <h3 class="text-3xl font-bold text-purple-500 mb-1">100%</h3>
            <p class="text-sm text-slate-500 font-medium uppercase tracking-wider">Akses Seumur Hidup</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-[#062743] text-white p-8 rounded-3xl shadow-xl">
                <h4 class="text-xl font-bold mb-4">Butuh Bantuan Lebih?</h4>
                <p class="text-sm opacity-80 mb-6 leading-relaxed">Jika Anda tidak menemukan jawaban yang dicari, tim kami siap membantu Anda secara langsung melalui WhatsApp.</p>
                
                <a href="https://wa.me/6281936204176?text=Halo%20Admin%20PrimeLearn,%20saya%20ingin%20bertanya%20tentang..." 
                target="_blank" 
                class="block w-full py-3 rounded-xl font-bold text-sm bg-white text-center text-[#062743] hover:bg-emerald-500 hover:text-white transition-all shadow-lg">
                    Hubungi Support
                </a>
            </div>
            
            <div class="info-card">
                <h4 class="font-bold mb-4 text-[#062743]">Tips Belajar</h4>
                <ul class="text-sm space-y-3 text-slate-600">
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Tentukan target harian
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Bergabung di komunitas
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Praktikkan materi segera
                    </li>
                </ul>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-4">
            <div class="accordion-item">
                <div class="accordion-toggle">
                    <p>Bagaimana cara mendaftar kursus di PrimeLearn?</p>
                    <span class="arrow-icon">&#10095;</span>
                </div>
                <div class="accordion-content">
                    <p class="text-slate-600 leading-relaxed">Anda cukup membuat akun melalui tombol daftar, memilih katalog kursus, dan menyelesaikan pembayaran secara aman.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-toggle">
                    <p>Apakah PrimeLearn menyediakan sertifikat?</p>
                    <span class="arrow-icon">&#10095;</span>
                </div>
                <div class="accordion-content">
                    <p class="text-slate-600 leading-relaxed">Ya, sertifikat digital eksklusif diberikan otomatis setelah Anda menyelesaikan seluruh materi kursus.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-toggle">
                    <p>Berapa lama akses materi kursus?</p>
                    <span class="arrow-icon">&#10095;</span>
                </div>
                <div class="accordion-content">
                    <p class="text-slate-600 leading-relaxed">Kami memberikan Akses Seumur Hidup agar Anda bisa belajar kapan saja tanpa batasan waktu.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-toggle">
                    <p>Metode pembayaran apa saja yang tersedia?</p>
                    <span class="arrow-icon">&#10095;</span>
                </div>
                <div class="accordion-content">
                    <p class="text-slate-600 leading-relaxed">Kami mendukung VA Bank, Kartu Kredit, hingga E-Wallet seperti GoPay, OVO, dan Dana.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-toggle">
                    <p>Apakah ada batas waktu penyelesaian?</p>
                    <span class="arrow-icon">&#10095;</span>
                </div>
                <div class="accordion-content">
                    <p class="text-slate-600 leading-relaxed">Tidak ada. Anda bebas menentukan kecepatan belajar Anda sendiri (Self-paced).</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-toggle">
                    <p>Bagaimana jika saya butuh bantuan teknis?</p>
                    <span class="arrow-icon">&#10095;</span>
                </div>
                <div class="accordion-content">
                    <p class="text-slate-600 leading-relaxed">Tim support kami tersedia 24/7 melalui fitur Live Chat atau email bantuan kami.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<footer>
    <span class="footer-brand">PrimeLearn</span>
    <p class="opacity-90">&copy; 2026 PrimeLearn Academy. Seluruh Hak Cipta Dilindungi.</p>
</footer>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const toggleMenu = document.getElementById(".menu-icon");
    const nav = document.getElementById(".secondary-nav");

    toggleMenu.addEventListener("click", () => {
        toggleMenu.classList.toggle("active");
        nav.classList.toggle("show");
    });

    document.querySelectorAll(".accordion-toggle").forEach(button => {
        button.addEventListener("click", () => {
            const content = button.nextElementSibling;
            document.querySelectorAll(".accordion-content.open").forEach(openContent => {
                if (openContent !== content) {
                    openContent.classList.remove("open");
                    openContent.previousElementSibling.classList.remove("active-toggle");
                }
            });
            content.classList.toggle("open");
            button.classList.toggle("active-toggle");
        });
    });
});
</script>

</body>
</html>