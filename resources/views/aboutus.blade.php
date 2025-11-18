<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Diperbaiki: Menggunakan standar penamaan "About Us" -->
    <title>PrimeLearn - About Us</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <header class="main-header">
        <div class="logo">LOGO</div>
        <div class="site-title">PrimeLearn</div>
        <div class="menu-icon">☰</div>
    </header>

    <nav class="secondary-nav">
        <a href="{{ route('home') }}" class="nav-item">HOME</a> 
        <a href="{{ route('aboutus') }}" class="nav-item active">ABOUT US</a>
        <!-- Diperbaiki: Menggunakan route FAQ yang sudah didefinisikan -->
        <a href="{{ route('faq') }}" class="nav-item">FAQ</a>
    </nav>
    
    <main class="container" style="padding-top: 50px;">
        <div style="background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            <h1 class="main-segment-title" style="font-size: 2rem; color: #0b2239; text-align: center;">Tentang PrimeLearn</h1>
            
            <p style="margin-top: 30px; line-height: 1.7; font-size: 1.1rem; color: #333;">
                PrimeLearn didirikan pada tahun 2024 dengan visi yang kuat: untuk menjembatani kesenjangan keterampilan di era digital. 
                Kami percaya bahwa akses terhadap pendidikan teknologi berkualitas tinggi harus tersedia untuk semua orang, 
                terlepas dari latar belakang geografis atau finansial mereka. Platform kami menyediakan kursus yang selalu diperbarui 
                di bidang-bidang seperti **Software Development**, **Data Science**, dan **UX/UI Design**.
            </p>

            <h2 style="color: #0b2239; margin-top: 40px; margin-bottom: 15px;">Filosofi dan Nilai Kami</h2>
            <ul style="margin-left: 20px; font-size: 1rem; color: #555;">
                <li style="margin-bottom: 10px;">**Kualitas:** Materi diajarkan oleh praktisi industri yang berpengalaman.</li>
                <li style="margin-bottom: 10px;">**Aksesibilitas:** Harga terjangkau dan platform mudah digunakan.</li>
                <li style="margin-bottom: 10px;">**Komunitas:** Kami mendukung pertumbuhan melalui forum dan sesi mentoring.</li>
            </ul>

            <div style="text-align: center; margin-top: 50px;">
                <a href="{{ route('home') }}" style="display: inline-block; padding: 10px 25px; background-color: #1aaeae; color: white; text-decoration: none; border-radius: 5px; font-weight: 600;">
                    Mulai Belajar Sekarang →
                </a>
            </div>
        </div>
     </main>
    
    <footer class="main-footer">
        <div class="container footer-content">
            <div class="footer-logo">PrimeLearn</div>
            <div class="footer-links">
                <a href="#">Privacy Policy</a> | 
                <a href="#">Terms of Use</a> | 
                <a href="#">Contact</a>
            </div>
             <!-- Diperbaiki: Penutupan div yang benar untuk footer-copyright -->
             <div class="footer-copyright"> 
                 &copy; {{ date('Y') }} PrimeLearn. All Rights Reserved.
             </div>
        </div> <!-- Diperbaiki: Penutupan div yang benar untuk container footer-content -->
    </footer>
    
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const menuBtn = document.querySelector(".menu-icon");
        const nav = document.querySelector(".secondary-nav");
        
        // Fungsi ini hanya akan bekerja di halaman ini karena scriptnya diletakkan di sini.
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
    });
    </script>
</body>
</html>