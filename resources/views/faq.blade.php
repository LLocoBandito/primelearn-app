<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrimeLearn - FAQ (Pertanyaan Umum)</title>
    <!-- Pastikan Anda memiliki file css/styles.css untuk tata letak utama -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Gaya spesifik untuk Halaman FAQ */
        .faq-container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
        }
        .accordion-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .accordion-question {
            background-color: #f8f8f8;
            padding: 18px 25px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            color: #0b2239; /* Warna teks pertanyaan */
            transition: background-color 0.3s;
        }
        .accordion-question:hover {
            background-color: #eee;
        }
        .accordion-icon {
            font-size: 1.5rem;
            color: #1aaeae; /* Warna ikon panah (biru kehijauan) */
            transition: transform 0.3s;
        }
        .accordion-content {
            padding: 0 25px;
            max-height: 0;
            overflow: hidden;
            /* Transisi untuk efek buka tutup yang halus */
            transition: max-height 0.3s ease-out, padding 0.3s ease-out; 
            background-color: white;
            color: #555;
            line-height: 1.6;
        }
        .accordion-content p {
            padding-bottom: 18px;
            margin: 0;
        }
        /* Style saat accordion aktif */
        .accordion-item.active .accordion-content {
            max-height: 300px; /* Nilai harus cukup besar */
            padding-top: 10px;
            padding-bottom: 18px;
        }
        .accordion-item.active .accordion-icon {
            transform: rotate(180deg); /* Ikon panah berbalik saat aktif */
        }
    </style>
</head>
<body>

    <!-- HEADER / NAVBAR -->
    <header class="main-header">
        <div class="logo">LOGO</div>
        <div class="site-title">PrimeLearn</div>
        <div class="menu-icon">☰</div>
    </header>

    <nav class="secondary-nav">
        <!-- Menggunakan route yang sudah didefinisikan di routes/web.php -->
        <a href="{{ route('home') }}" class="nav-item">HOME</a> 
        <a href="{{ route('aboutus') }}" class="nav-item">ABOUT US</a>
        <!-- Tautan FAQ ditandai sebagai aktif -->
        <a href="{{ route('faq') }}" class="nav-item active">FAQ</a>
    </nav>
    
    <!-- KONTEN UTAMA FAQ -->
    <main class="container">
        <div class="faq-container">
            <h1 style="font-size: 2.5rem; color: #0b2239; text-align: center; margin-bottom: 40px;">
                Pertanyaan yang Sering Diajukan (FAQ)
            </h1>

            <div class="accordion-list">
                
                <!-- ITEM 1: Pertanyaan Pendaftaran -->
                <div class="accordion-item">
                    <div class="accordion-question">
                        <span>Bagaimana cara mendaftar di PrimeLearn?</span>
                        <span class="accordion-icon">▼</span>
                    </div>
                    <div class="accordion-content">
                        <p>Anda bisa mendaftar dengan mengklik tombol "Daftar" di sudut kanan atas halaman utama. Anda dapat mendaftar menggunakan email atau akun media sosial Anda. Prosesnya cepat dan mudah!</p>
                    </div>
                </div>

                <!-- ITEM 2: Pertanyaan Biaya Kursus -->
                <div class="accordion-item">
                    <div class="accordion-question">
                        <span>Apakah kursus di PrimeLearn berbayar?</span>
                        <span class="accordion-icon">▼</span>
                    </div>
                    <div class="accordion-content">
                        <p>Kami menawarkan campuran kursus gratis dan berbayar. Kursus berbayar menyediakan sertifikat penyelesaian, akses ke mentor, dan proyek akhir yang dinilai. Anda bisa melihat detail harga di halaman masing-masing kursus.</p>
                    </div>
                </div>

                <!-- ITEM 3: Pertanyaan Durasi Belajar -->
                <div class="accordion-item">
                    <div class="accordion-question">
                        <span>Berapa lama waktu yang dibutuhkan untuk menyelesaikan satu segmen?</span>
                        <span class="accordion-icon">▼</span>
                    </div>
                    <div class="accordion-content">
                        <p>Setiap segmen dirancang untuk diselesaikan sesuai kecepatan Anda sendiri (self-paced). Rata-rata, satu segmen penuh membutuhkan waktu 4 hingga 8 minggu, tergantung kompleksitas materi dan waktu belajar harian Anda.</p>
                    </div>
                </div>
                
                <!-- ITEM 4: Pertanyaan Sertifikat -->
                <div class="accordion-item">
                    <div class="accordion-question">
                        <span>Apakah saya akan mendapatkan sertifikat?</span>
                        <span class="accordion-icon">▼</span>
                    </div>
                    <div class="accordion-content">
                        <p>Ya, untuk semua kursus berbayar, Anda akan menerima sertifikat digital yang dapat Anda bagikan di profil profesional Anda setelah berhasil menyelesaikan semua modul dan proyek yang disyaratkan.</p>
                    </div>
                </div>

            </div>
            
            <!-- Kontak Dukungan -->
            <div style="text-align: center; margin-top: 50px; padding: 20px; background-color: #f0f8ff; border-radius: 8px;">
                <p style="font-size: 1.1rem; color: #0b2239; font-weight: 500;">
                    Tidak menemukan jawaban yang Anda cari? 
                    <a href="#" style="color: #1aaeae; text-decoration: underline;">Hubungi tim dukungan kami.</a>
                </p>
            </div>
            
        </div>
    </main>
    
    <!-- FOOTER -->
    <footer class="main-footer">
        <div class="container footer-content">
            <div class="footer-logo">PrimeLearn</div>
            <div class="footer-links">
                <a href="#">Privacy Policy</a> | 
                <a href="#">Terms of Use</a> | 
                <a href="#">Contact</a>
            </div>
            <div class="footer-copyright">
                &copy; {{ date('Y') }} PrimeLearn. All Rights Reserved.
            </div>
        </div>
    </footer>
    
    <!-- JAVASCRIPT untuk Toggle Navbar dan Accordion FAQ -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Logika Toggle Navbar 
        const menuBtn = document.querySelector(".menu-icon");
        const nav = document.querySelector(".secondary-nav");
        
        menuBtn.addEventListener("click", () => {
            nav.classList.toggle("show");
            
            // Toggle ikon '☰' menjadi 'X'
            if (nav.classList.contains("show")) {
                menuBtn.innerHTML = "&times;"; // Ikon X
                menuBtn.style.fontSize = "2.5rem"; 
            } else {
                menuBtn.innerHTML = "&#9776;"; // Ikon Hamburger
                menuBtn.style.fontSize = "2rem"; 
            }
        });

        // Logika Accordion untuk FAQ
        const faqItems = document.querySelectorAll('.accordion-item');

        faqItems.forEach(item => {
            const question = item.querySelector('.accordion-question');
            question.addEventListener('click', () => {
                // Tutup semua item yang aktif selain yang diklik
                faqItems.forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                    }
                });

                // Toggle item yang sedang diklik
                item.classList.toggle('active');
            });
        });
    });
    </script>
</body>
</html>