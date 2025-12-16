<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - PrimeLearn</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    {{-- Tailwind CSS CDN untuk styling yang cepat dan modern --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        /* CSS Tambahan untuk border aktif sub-navigasi */
        .active-nav {
            background-color: #10b981; /* teal-500 */
            color: white;
            font-weight: 600;
            border-radius: 0.5rem 0.5rem 0 0; /* rounded-t-lg */
        }
        
        /* Style untuk tim kami agar terlihat seperti di desain */
        .team-box {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem; /* Sedikit dilebarkan */
        }
        
        /* --- STYLE BARU UNTUK FOTO ANGGOTA TIM --- */
        .team-member-photo {
            width: 8rem; 
            height: 8rem; 
            object-fit: cover; /* Memastikan foto tidak terdistorsi */
            border-radius: 50%; /* Membuat foto menjadi lingkaran */
            margin-left: auto; /* Untuk menengahkan foto */
            margin-right: auto; /* Untuk menengahkan foto */
            border: 4px solid #0b2239; /* Border teal-500 */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }

        /* Menyembunyikan placeholder yang lama */
        .team-member-placeholder {
            display: none !important;
        }
        /* --- END STYLE BARU --- */
        
    </style>
</head>
<body class="bg-gray-100">

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


    {{-- Konten Utama Halaman --}}
    <main class="container mx-auto p-4 sm:p-8 lg:p-12 pt-24">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Kolom Kiri (lg:col-span-2): Visi & Misi dan Konten Tambahan --}}
            <div class="lg:col-span-2">
                {{-- 1. Visi & Misi Kami --}}
                <div class="bg-white rounded-xl shadow-xl overflow-hidden mb-8">
                    <div class="relative">
                        {{-- GAMBAR BESAR --}}
                        <img src="images/team.jpg" 
                             alt="Tim Sedang Rapat" 
                             class="w-full h-80 object-cover">
                        
                        {{-- Kotak Teks Visi & Misi --}}
                        <div class="absolute bottom-0 left-0 p-6 sm:p-10 text-white bg-black bg-opacity-60 w-full">
                            <h3 class="text-3xl font-bold mb-4">Visi & Misi Kami</h3>
                            <p class="text-sm leading-relaxed">
                                Menjadi platform digital terdepan dalam penyebaran pengetahuan dan keterampilan di bidang Informatika dan Teknologi Informasi, yang mampu menjembatani kesenjangan antara teori akademik dan praktik industri, serta berkontribusi nyata dalam mencetak generasi unggul dan siap bersaing di era digital.
                            </p>
                        </div>
                    </div>
                </div>
                
                {{-- 2. Nilai Inti (Tambahan) --}}
                <div class="mt-4 bg-white p-6 rounded-xl shadow-xl">
                    <h2 class="text-2xl font-bold text-blue-900 mb-6 pb-2 border-b-2 border-teal-500">Nilai Inti Kami</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gray-50 p-6 rounded-lg text-center shadow-sm">
                            <span class="text-4xl text-teal-500 mb-3 block">💡</span>
                            <h3 class="font-bold text-lg mb-1">Inovasi</h3>
                            <p class="text-sm text-gray-600">Terus mencari cara baru dan lebih baik untuk memberikan pengalaman belajar yang optimal.</p>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-lg text-center shadow-sm">
                            <span class="text-4xl text-teal-500 mb-3 block">🏅</span>
                            <h3 class="font-bold text-lg mb-1">Kualitas</h3>
                            <p class="text-sm text-gray-600">Komitmen terhadap materi dan instruktur terbaik untuk mencapai hasil terbaik.</p>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-lg text-center shadow-sm">
                            <span class="text-4xl text-teal-500 mb-3 block">🌐</span>
                            <h3 class="font-bold text-lg mb-1">Aksesibilitas</h3>
                            <p class="text-sm text-gray-600">Memastikan pendidikan berkualitas dapat dijangkau oleh semua orang, di mana pun.</p>
                        </div>
                    </div>
                </div>

                {{-- 3. Garis Abu-abu di bagian bawah (Bisa ditambahkan jika diperlukan styling tambahan) --}}

            </div>

            {{-- Kolom Kanan (1 Kolom): Tim Kami --}}
            <div class="p-0">
                <h2 class="text-xl font-bold text-gray-700 mb-4 pb-2 border-b-4 border-blue-900 inline-block">Tim Kami</h2>
                
                {{-- Grid Anggota Tim --}}
                <div class="team-box">
                    
                    {{-- Anggota Tim Item 1 (Foto: Mas Heri) --}}
                    <div class="text-center">
                        <img src="{{ asset('images/heri.webp') }}" 
                             alt="Foto Mas Heri" 
                             class="team-member-photo">
                        <p class="text-sm font-semibold mt-2">Mas Heri</p>
                    </div>

                    {{-- Anggota Tim Item 2 (Foto: William) --}}
                    <div class="text-center">
                        <img src="{{ asset('images/william.webp') }}" 
                             alt="Foto William" 
                             class="team-member-photo">
                        <p class="text-sm font-semibold mt-2">Nyoman Bagus</p>
                    </div>

                    {{-- Anggota Tim Item 3 (Foto: Dinda Dev) --}}
                    <div class="text-center">
                        <img src="{{ asset('images/dinda.webp') }}" 
                             alt="Foto Dinda Dev" 
                             class="team-member-photo">
                        <p class="text-sm font-semibold mt-2">Dinda Dev</p>
                    </div>

                    {{-- Anggota Tim Item 4 (Foto: Yasa) --}}
                    <div class="text-center">
                         <img src="{{ asset('images/yasa.webp') }}" 
                             alt="Foto Yasa" 
                             class="team-member-photo">
                        <p class="text-sm font-semibold mt-2">Yasa</p>
                    </div>

                    {{-- Anggota Tim Item 5 (Foto: Ananda) --}}
                    <div class="text-center">
                        <img src="{{ asset('images/satya.webp') }}" 
                             alt="Foto Ananda" 
                             class="team-member-photo">
                        <p class="text-sm font-semibold mt-2">Bang Sat</p>
                    </div>
                    
                    {{-- Anggota Tim Item 6 (Kosong sesuai desain asli) --}}
                    <div class="text-center">
                        {{-- Anggota Kosong --}}
                        <div class="w-32 h-32 bg-transparent mx-auto"></div> 
                        <p class="text-sm font-semibold mt-2"></p>
                    </div>
                </div>
            </div>

        </div>
        
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Logic Menu Toggle
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
        });
    </script>
</body>
</html>