<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrimeLearn - Segment</title>

    {{-- Pastikan styles.css ada di public/css/ --}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Gaya untuk efek loading */
        .read-more-link.loading {
            opacity: 0.6;
            pointer-events: none;
        }
        /* Tambahan gaya untuk memisahkan hasil pencarian non-segment (opsional) */
        .search-result-title {
            margin-top: 40px;
            font-size: 1.5em;
            border-bottom: 2px solid var(--primary-color, #007bff); /* Sesuaikan dengan warna tema Anda */
            padding-bottom: 5px;
            margin-bottom: 20px;
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
        <a href="{{ route('segments.index') }}" class="nav-item {{ request()->routeIs('segments.index') ? 'active' : '' }}">HOME</a>
        <a href="{{ route('about') }}" class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">ABOUT US</a>
        <a href="{{ route('faq') }}" class="nav-item {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
    </nav>

    {{-- KONTEN UTAMA DAN SIDEBAR --}}
    <main class="container">
        <div class="search-bar">
            {{-- Form Pencarian Global: Mengarah ke segments.index dengan query --}}
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
            
            {{-- AREA SEGMENT UTAMA DAN HASIL PENCARIAN --}}
            <section class="main-segment-area">
                
                {{-- JUDUL DINAMIS --}}
                <h2 class="main-segment-title">
                    @if ($query)
                        Hasil Pencarian untuk: <strong>"{{ $query }}"</strong>
                    @elseif (isset($isFilteredByRecommendation) && $isFilteredByRecommendation)
                        Rekomendasi Segmen Terbaik untuk Anda
                    @else
                        Jelajahi Segmen Pembelajaran
                    @endif
                </h2>
                
                {{-- NOTIFIKASI REKOMENDASI (Opsional, berdasarkan logic controller Anda) --}}
                @if (isset($recommendation) && !$query)
                    <div style="padding: 10px; background-color: #e6ffe6; border-left: 5px solid #00c700; margin-bottom: 20px;">
                        <p><strong>Rekomendasi:</strong> {{ $recommendation }}! Segmen di bawah ini paling cocok dengan minat Anda.</p>
                    </div>
                @endif


                {{-- 1. HASIL SEGMENT (Main Content Area) --}}
                @if ($segments->isNotEmpty())
                    @if ($query)
                        <h3 class="search-result-title">Segmen Ditemukan ({{ $segments->count() }})</h3>
                    @endif
                    <div class="segment-cards-grid-new">

                        @foreach ($segments as $segment)
                            <a href="{{ route('course.show', ['segment' => $segment->name]) }}" class="segment-post-item">
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
                        @endforeach

                    </div>
                @endif
                
                {{-- 2. HASIL PENCARIAN FASE --}}
                @if ($query && isset($fases) && $fases->isNotEmpty())
                    <h3 class="search-result-title">Fase Ditemukan ({{ $fases->count() }})</h3>
                    <div class="small-post-list">
                        @foreach ($fases as $fase)
                            <div class="small-post-item">
                                <div class="small-post-text">
                                    <a href="{{ route('fase.show', $fase->id) }}">
                                        <p><strong>[FASE] {{ $fase->title }}</strong></p>
                                    </a>
                                    <small>Berada di Segmen: {{ $fase->segment->name ?? 'N/A' }}</small> 
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- 3. HASIL PENCARIAN LANGKAH/STEP --}}
                @if ($query && isset($steps) && $steps->isNotEmpty())
                    <h3 class="search-result-title">Langkah/Materi Ditemukan ({{ $steps->count() }})</h3>
                    <div class="small-post-list">
                        @foreach ($steps as $step)
                            <div class="small-post-item">
                                <div class="small-post-text">
                                    <a href="{{ route('step.show', $step->id) }}">
                                        <p><strong>[LANGKAH] {{ $step->title }}</strong></p>
                                    </a>
                                    <small>
                                        Konten: {{ Str::limit(strip_tags($step->content), 100) }}
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                
                {{-- JIKA TIDAK ADA HASIL SAMA SEKALI SAAT PENCARIAN --}}
                @if ($query && $segments->isEmpty() && (!isset($fases) || $fases->isEmpty()) && (!isset($steps) || $steps->isEmpty()))
                    <p style="margin-top: 20px; padding: 15px; background: #ffe6e6; border: 1px solid #ff9999;">
                        Maaf, tidak ditemukan hasil yang cocok untuk kata kunci <strong>"{{ $query }}"</strong> di Segmen, Fase, maupun Langkah/Materi.
                    </p>
                @endif
                
            </section>
            
            {{-- SIDEBAR --}}
            <aside class="sidebar">
                <h3 class="sidebar-title">Materi Menarik Lainnya</h3>
                <div class="small-post-list">

                    @forelse ($sidebarCourses as $course)
                        <div class="small-post-item">
                            <div class="small-post-text">
                                <a href="{{ route('materi.show', $course->id) }}">
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