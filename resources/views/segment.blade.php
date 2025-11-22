<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrimeLearn - Segment</title>

    {{-- Pastikan styles.css ada di public/css/ --}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    {{-- Anda bisa menambahkan CSS untuk efek loading di sini jika diperlukan --}}
    <style>
        .read-more-link.loading {
            opacity: 0.6;
            pointer-events: none; /* Mencegah klik ganda saat loading */
        }
    </style>
</head>
<body>

    {{-- HEADER UTAMA --}}
    <header class="main-header">
        <div class="site-title">PrimeLearn</div>
        <div class="menu-icon">☰</div>
    </header>

    {{-- NAVIGASI SEKUNDER --}}
    <nav class="secondary-nav">
        <a href="#" class="nav-item active">HOME</a>
        <a href="{{ route("about") }}" class="nav-item">ABOUT US</a>
        <a href="#" class="nav-item">FAQ</a>
    </nav>

    {{-- KONTEN UTAMA DAN SIDEBAR --}}
    <main class="container">
        <div class="search-bar">
            {{-- Form Pencarian Segment --}}
            <form action="{{ route('segments.index') }}" method="GET" class="search-form-flex">
                <input
                    type="text"
                    name="query"
                    placeholder="Search for......."
                    value="{{ request('query') }}" 
                >
                <button type="submit" class="search-icon-btn">🔍</button>
            </form>
        </div>

        <div class="content-wrapper">
            
            {{-- AREA SEGMENT UTAMA --}}
            <section class="main-segment-area">
                <h2 class="main-segment-title">Jelajahi Segmen Pembelajaran</h2>
                <div class="segment-cards-grid-new">

                    @forelse ($segments as $segment)
                        <a href="{{ route('course.show', ['segment' => $segment->name]) }}" class="segment-post-item">

                            {{-- GAMBAR SEGMENT --}}
                            <img 
                                src="{{ asset('storage/' . $segment->image_path) }}" 
                                alt="{{ $segment->name }} Image" 
                                class="segment-item-image"
                            >

                            <div class="segment-item-overlay">
                                <span class="category-tag">Category</span>
                                <h3 class="segment-item-title-small">{{ $segment->name }}</h3>
                                <div class="segment-item-description-small">
                                    {{ $segment->description }}
                                </div>
                            </div>

                        </a>
                    @empty
                        <p>Tidak ada segmen pembelajaran ditemukan untuk kata kunci: 
                            <strong>{{ request('query') }}</strong>
                        </p>
                    @endforelse

                </div>
            </section>
            
            {{-- SIDEBAR --}}
            <aside class="sidebar">
                <h3 class="sidebar-title">Materi Terbaru / Populer</h3>
                <div class="small-post-list">

                    @forelse ($sidebarCourses as $course)
                        <div class="small-post-item">
                            <div class="small-post-text">
                                <a href="{{ route('materi.detail', $course->id) }}">
                                    <p><strong>{{ $course->title }}</strong></p>
                                </a>
                                <small>
                                    {{ substr($course->description, 0, 50) }}
                                    {{ strlen($course->description) > 50 ? '...' : '' }}
                                </small>
                            </div>
                        </div>
                    @empty
                        <div class="small-post-item">
                            <div class="small-post-text">
                                <p>Belum ada materi terbaru.</p>
                            </div>
                        </div>
                    @endforelse

                </div>

                {{-- MODIFIKASI: Mengubah DIV menjadi A agar lebih semantik untuk tautan --}}
                <a href="#" class="read-more-link">
                    Selengkapnya →
                </a>
            </aside>

        </div>

    </main>

    {{-- FOOTER --}}
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Logic Menu Toggle
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
        });
    </script>

</body>
</html>