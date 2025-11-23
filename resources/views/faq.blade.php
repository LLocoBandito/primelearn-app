<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - PrimeLearn</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Custom styles for structure and aesthetics */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f7f7;
            min-height: 100vh; /* Ensure body takes full height for testing footer visibility */
            display: flex;
            flex-direction: column;
        }

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
        
        /* Accordion specific styling */
        .accordion-item {
            border: 1px solid #e5e7eb;
            margin-bottom: 0.75rem;
            border-radius: 0.75rem; /* rounded-xl */
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);
        }

        .accordion-toggle {
            cursor: pointer;
            transition: background-color 0.2s, color 0.2s;
        }

        .accordion-content {
            padding: 1rem;
            background-color: #ffffff;
            color: #374151;
            border-top: 1px solid #3d5870;
            max-height: 0;
            opacity: 0;
            transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out, padding 0.3s;
        }
        .accordion-content.open {
            max-height: 500px;
            opacity: 1;
            padding: 1rem;
        }
        
        .arrow-icon {
            transition: transform 0.3s ease-in-out;
        }
        .arrow-icon.rotated {
            transform: rotate(90deg);
        }

        /* Footer Styling */
        .main-footer {
            margin-top: auto; /* Push footer to the bottom */
            background-color: #062743;
            color: #ffffff;
            padding: 1.5rem 1rem;
            width: 100%;
        }
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }
        .footer-logo {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .footer-links a {
            color: #a0aec0;
            margin: 0 0.5rem;
            text-decoration: none;
        }
        .footer-links a:hover {
            color: #ffffff;
        }
        .footer-copyright {
            margin-top: 1rem;
            font-size: 0.875rem;
            color: #a0aec0;
        }

        /* WhatsApp Fixed Elements Z-Index - CRITICAL CHANGE */
        /* Z-index 1000 ensures it is above the footer and all other content */
        #wa-popup {
            z-index: 1000; 
        }
        #wa-button {
            z-index: 1000; 
        }

        /* Main content area flexibility */
        .faq-container {
            flex-grow: 1;
        }

    </style>
</head>
<body class="bg-gray-100">

    <!-- NAVBAR -->
    <header class="main-header">
        <div class="site-title">PrimeLearn</div>
        <div class="menu-icon">☰</div>
    </header>

     <!-- navbar muncul/hilang -->
    <nav class="secondary-nav">
    <a href="{{ route('segments.index') }}" class="nav-item {{ request()->routeIs('segments.index') ? 'active' : '' }}">HOME</a>
    <a href="{{ route('about') }}" class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">ABOUT US</a>
    <a href="{{ route('faq') }}" class="nav-item {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
</nav>

    <!-- FAQ SECTION -->
    <div class="container mx-auto px-4 pt-20 pb-10 faq-container">
        <h2 class="text-3xl font-bold mb-6 text-[#062743]">Pertanyaan Umum (FAQ)</h2>

        <div class="grid md:grid-cols-2 gap-6">

            <!-- LEFT COLUMN -->
            <div class="space-y-4" id="faq-column-left">
                <!-- ACCORDION ITEM 1 -->
                <div class="accordion-item" data-accordion-item>
                    <div class="bg-[#062743] text-white p-4 rounded-xl flex justify-between items-center accordion-toggle">
                        <p class="font-semibold">Bagaimana cara mendaftar kursus di PrimeLearn?</p>
                        <span class="text-xl ml-4 arrow-icon" data-icon>&#10095;</span>
                    </div>
                    <div class="accordion-content" data-accordion-content>
                        <p>Untuk mendaftar kursus, Anda cukup membuat akun, memilih kursus yang diminati dari katalog kami, dan menyelesaikan proses pembayaran. Anda akan mendapatkan akses instan ke semua materi kursus.</p>
                    </div>
                </div>
                
                <!-- ACCORDION ITEM 2 -->
                <div class="accordion-item" data-accordion-item>
                    <div class="bg-[#062743] text-white p-4 rounded-xl flex justify-between items-center accordion-toggle">
                        <p class="font-semibold">Apakah PrimeLearn menawarkan sertifikat kelulusan?</p>
                        <span class="text-xl ml-4 arrow-icon" data-icon>&#10095;</span>
                    </div>
                    <div class="accordion-content" data-accordion-content>
                        <p>Ya, setelah Anda berhasil menyelesaikan semua modul dan ujian yang ada di dalam kursus, Anda akan menerima sertifikat kelulusan digital yang dapat dibagikan.</p>
                    </div>
                </div>

                <!-- ACCORDION ITEM 3 -->
                <div class="accordion-item" data-accordion-item>
                    <div class="bg-[#062743] text-white p-4 rounded-xl flex justify-between items-center accordion-toggle">
                        <p class="font-semibold">Berapa lama saya bisa mengakses materi kursus?</p>
                        <span class="text-xl ml-4 arrow-icon" data-icon>&#10095;</span>
                    </div>
                    <div class="accordion-content" data-accordion-content>
                        <p>Akses ke materi kursus adalah seumur hidup (lifetime access). Anda dapat belajar kapan saja dan mengulang materi sesuai dengan kebutuhan Anda.</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="space-y-4" id="faq-column-right">
                <!-- ACCORDION ITEM 4 -->
                <div class="accordion-item" data-accordion-item>
                    <div class="bg-[#062743] text-white p-4 rounded-xl flex justify-between items-center accordion-toggle">
                        <p class="font-semibold">Apa saja metode pembayaran yang diterima?</p>
                        <span class="text-xl ml-4 arrow-icon" data-icon>&#10095;</span>
                    </div>
                    <div class="accordion-content" data-accordion-content>
                        <p>Kami menerima berbagai metode pembayaran, termasuk kartu kredit/debit, transfer bank, dan beberapa e-wallet lokal. Detail lengkap dapat dilihat saat checkout.</p>
                    </div>
                </div>

                <!-- ACCORDION ITEM 5 -->
                <div class="accordion-item" data-accordion-item>
                    <div class="bg-[#062743] text-white p-4 rounded-xl flex justify-between items-center accordion-toggle">
                        <p class="font-semibold">Apakah ada batas waktu untuk menyelesaikan kursus?</p>
                        <span class="text-xl ml-4 arrow-icon" data-icon>&#10095;</span>
                    </div>
                    <div class="accordion-content" data-accordion-content>
                        <p>Tidak ada batas waktu. Anda bisa belajar dengan kecepatan Anda sendiri. Kami mendukung pembelajaran mandiri sesuai jadwal yang paling nyaman bagi Anda.</p>
                    </div>
                </div>

                <!-- ACCORDION ITEM 6 -->
                <div class="accordion-item" data-accordion-item>
                    <div class="bg-[#062743] text-white p-4 rounded-xl flex justify-between items-center accordion-toggle">
                        <p class="font-semibold">Bagaimana jika saya memerlukan dukungan teknis?</p>
                        <span class="text-xl ml-4 arrow-icon" data-icon>&#10095;</span>
                    </div>
                    <div class="accordion-content" data-accordion-content>
                        <p>Tim dukungan teknis kami siap membantu 24/7. Anda dapat menghubungi kami melalui email di support@primelearn.com atau melalui fitur chat langsung di halaman utama.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- WhatsApp Popup (High Z-Index) -->
    <div id="wa-popup" class="fixed bottom-24 right-6 bg-white shadow-xl rounded-xl px-4 py-3 flex items-center space-x-3 border-2 border-green-500 opacity-0 translate-y-4 transition-all duration-500" style="z-index: 1000;">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-6 h-6" alt="WA Logo">
        <p class="text-sm text-gray-700 font-medium">Ada pertanyaan lainnya? Chat via WA!</p>
    </div>

    <!-- WhatsApp Button (High Z-Index) -->
    <a id="wa-button" href="https://wa.me/6281234567890?text=Halo%20saya%20ingin%20bertanya%20tentang%20PrimeLearn" 
        target="_blank"
        class="fixed bottom-6 right-6 bg-green-500 hover:bg-green-600 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-xl transition" style="z-index: 1000;">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-8 h-8" alt="WhatsApp">
    </a>

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
                &copy; 2024 PrimeLearn. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const menuBtn = document.querySelector(".menu-icon");
            const nav = document.querySelector(".secondary-nav");

            menuBtn.addEventListener("click", () => {
                nav.classList.toggle("hide");
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

            // --- WHATSAPP POPUP LOGIC ---
            const popup = document.getElementById("wa-popup");
            const waButton = document.getElementById("wa-button");

            // Show popup after a delay
            setTimeout(() => {
                popup.style.opacity = "1";
                popup.style.transform = "translateY(0)";
            }, 800);

            // Click popup opens WA link
            popup.addEventListener("click", () => {
                waButton.click();
            });

            // Popup hides automatically after 8 seconds
            setTimeout(() => {
                popup.style.opacity = "0";
                popup.style.transform = "translateY(20px)";
            }, 8000);
        });
    </script>
</body>
</html>