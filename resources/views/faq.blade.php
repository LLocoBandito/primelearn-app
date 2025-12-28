<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - PrimeLearn</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Palette Warna Berdasarkan Gambar Anda */
            --primary-dark: #062743;
            --secondary-blue: #3b5d7c;
            
            /* Gradasi Identik untuk Header & Footer (Toska ke Biru Laut) */
            --grad-toska-marine: linear-gradient(135deg, #27ae60 0%, #1abc9c 20%, #00406aff 100%);
            
            /* Gradasi Tombol Aktif / Hover */
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

        /* ================= HEADER (GRADASI TOSKA BIRU LAUT) ================= */
        .main-header {
            background: var(--grad-toska-marine);
            color: white;
            padding: 1.2rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .site-title {
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #ffffff; /* Putih bersih agar mudah dibaca */
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        /* Hamburger Button */
        #menu-toggle span {
            background: white; /* Diubah ke putih agar terlihat di gradasi gelap */
            height: 3px;
            width: 28px;
            border-radius: 3px;
            transition: 0.3s;
        }

        /* ================= NAVBAR ================= */
        #top-nav {
            position: fixed;
            top: 72px;
            left: 0;
            right: 0;
            background: var(--secondary-blue);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            padding: 12px 0;
            transform: translateY(-200%);
            transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 50;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 83, 138, 0.2);
        }

        #top-nav.show { transform: translateY(0); }

        #top-nav a {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            padding: 10px 24px;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-transform: uppercase;
        }

        #top-nav a:hover,
        #top-nav a.active-link {
            background: rgba(4, 196, 128, 0.2); /* Efek glass di atas navbar biru */
            backdrop-filter: blur(5px);
            color: white;
            box-shadow: inset 0 0 0 2px rgba(2, 255, 213, 0.3);
        }

        /* ================= ACCORDION ================= */
        .accordion-item {
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 16px;
            overflow: hidden;
            background: white;
            transition: all 0.3s ease;
            margin-bottom: 1.2rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }

        .accordion-toggle {
            background: white;
            color: var(--primary-dark);
            padding: 1.25rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        /* Accordion dibuka menggunakan gradasi yang sama agar konsisten */
        .accordion-toggle.active-toggle {
            background: var(--grad-toska-marine);
            color: white;
        }

        .accordion-content {
            max-height: 0;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0, 1, 0, 1);
            background: #ffffff;
        }

        .accordion-content.open {
            max-height: 1000px;
            opacity: 1;
            padding: 1.5rem;
            border-top: 1px solid #edf2f7;
        }

        .arrow-icon { 
            color: #1abc9c;
            transition: transform 0.4s ease; 
        }
        .active-toggle .arrow-icon { color: white; transform: rotate(90deg); }

        /* ================= FOOTER (GRADASI TOSKA BIRU LAUT) ================= */
        footer {
            margin-top: auto;
            background: var(--grad-toska-marine);
            color: white;
            padding: 2.5rem 1rem;
            text-align: center;
            font-size: 0.9rem;
            box-shadow: 0 -4px 15px rgba(0,0,0,0.1);
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

    <button id="menu-toggle" class="flex flex-col gap-1.5">
        <span></span>
        <span></span>
        <span></span>
    </button>
</header>

<nav id="top-nav">
    <a href="{{ route('segments.index') }}" class="{{ request()->routeIs('segments.index') ? 'active-link' : '' }}">Home</a>
    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active-link' : '' }}">About Us</a>
    <a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'active-link' : '' }}">FAQ</a>
</nav>

<section class="container mx-auto max-w-5xl px-6 py-20">
    <div class="text-center mb-16">
        <h2 class="text-4xl font-extrabold text-[#062743] mb-4">
            Pertanyaan Umum <span style="background: var(--grad-button); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">(FAQ)</span>
        </h2>
        <p class="text-slate-500">Menyediakan jawaban lengkap untuk kenyamanan belajar Anda di PrimeLearn.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-x-8">
        <div>
            <div class="accordion-item">
                <div class="accordion-toggle flex justify-between items-center">
                    <p>Bagaimana cara mendaftar kursus di PrimeLearn?</p>
                    <span class="arrow-icon">&#10095;</span>
                </div>
                <div class="accordion-content">
                    <p class="text-slate-600 leading-relaxed">Anda cukup membuat akun melalui tombol daftar, memilih katalog kursus, dan menyelesaikan pembayaran secara aman.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-toggle flex justify-between items-center">
                    <p>Apakah PrimeLearn menyediakan sertifikat?</p>
                    <span class="arrow-icon">&#10095;</span>
                </div>
                <div class="accordion-content">
                    <p class="text-slate-600 leading-relaxed">Ya, sertifikat digital eksklusif diberikan otomatis setelah Anda menyelesaikan seluruh materi kursus.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-toggle flex justify-between items-center">
                    <p>Berapa lama akses materi kursus?</p>
                    <span class="arrow-icon">&#10095;</span>
                </div>
                <div class="accordion-content">
                    <p class="text-slate-600 leading-relaxed">Kami memberikan Akses Seumur Hidup agar Anda bisa belajar kapan saja tanpa batasan waktu.</p>
                </div>
            </div>
        </div>

        <div>
            <div class="accordion-item">
                <div class="accordion-toggle flex justify-between items-center">
                    <p>Metode pembayaran apa saja yang tersedia?</p>
                    <span class="arrow-icon">&#10095;</span>
                </div>
                <div class="accordion-content">
                    <p class="text-slate-600 leading-relaxed">Kami mendukung VA Bank, Kartu Kredit, hingga E-Wallet seperti GoPay, OVO, dan Dana.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-toggle flex justify-between items-center">
                    <p>Apakah ada batas waktu penyelesaian?</p>
                    <span class="arrow-icon">&#10095;</span>
                </div>
                <div class="accordion-content">
                    <p class="text-slate-600 leading-relaxed">Tidak ada. Anda bebas menentukan kecepatan belajar Anda sendiri (Self-paced).</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-toggle flex justify-between items-center">
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
    <p class="opacity-90">&copy; 2024 PrimeLearn Academy. Seluruh Hak Cipta Dilindungi.</p>
</footer>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const toggleMenu = document.getElementById("menu-toggle");
    const nav = document.getElementById("top-nav");

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