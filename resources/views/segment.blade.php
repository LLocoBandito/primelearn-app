<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrimeLearn - Segment</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <style>
        :root {
            --primary: #0b2239;
            --text-muted: #6b7280;
            --bg: #f8fafc;
            --card: #ffffff;
            --border: #e2e8f0;
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }

        .container {
            max-width: 1440px;
            margin: 0 auto;
            padding: 1.5rem 1rem;
        }

        .search-bar {
            margin: 2.5rem 0;
            max-width: 720px;
            margin-left: auto;
            margin-right: auto;
        }

        .search-form-flex {
            display: flex;
            background: var(--card);
            border-radius: 50px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .search-form-flex:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15);
        }

        .search-form-flex input {
            flex: 1;
            padding: 1.1rem 1.6rem;
            border: none;
            font-size: 1.05rem;
            outline: none;
        }

        .search-form-flex button {
            padding: 0 2rem;
            background: var(--primary);
            color: white;
            border: none;
            font-size: 1.3rem;
            cursor: pointer;
        }

        .content-wrapper {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 3rem;
        }

        .main-segment-title {
            font-size: 2.3rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 2rem;
        }

        .main-segment-title span {
            color: var(--primary);
        }

        .recommendation-notif {
            background: #ecfdf5;
            border-left: 5px solid #10b981;
            padding: 1.3rem 1.6rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-sm);
        }

        .search-result-title {
            font-size: 1.65rem;
            font-weight: 600;
            margin: 3rem 0 1.5rem;
            padding-bottom: 0.7rem;
            border-bottom: 3px solid var(--primary);
            display: inline-block;
        }

        .segment-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
        }

        .segment-post-item {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.4s;
            position: relative;
        }

        .segment-post-item:hover {
            transform: translateY(-12px);
            box-shadow: var(--shadow-lg);
        }

        .segment-item-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
        }

        .segment-item-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2rem 1.5rem 1.5rem;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.4) 50%, transparent);
            color: white;
        }

        .small-post-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .small-post-item {
            background: var(--card);
            padding: 1.3rem;
            border-radius: 12px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s;
        }

        .small-post-item:hover {
            border-color: var(--primary);
            transform: translateX(6px);
            box-shadow: var(--shadow-md);
        }

        .small-post-item a {
            color: inherit;
            text-decoration: none;
        }

        .small-post-item strong {
            color: var(--primary);
            font-weight: 600;
        }

        .small-post-item small {
            color: var(--text-muted);
            font-size: 0.9rem;
            display: block;
            margin-top: 0.4rem;
        }

        /* Style untuk langkah terkunci */
        .step-locked {
            background: #f1f5f9;
            border-left: 4px solid #94a3b8;
            opacity: 0.8;
            cursor: not-allowed;
        }

        .step-locked strong {
            color: #64748b !important;
        }

        .sidebar {
            background: var(--card);
            padding: 2rem;
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 120px;
        }

        .sidebar-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .read-more-link {
            display: inline-block;
            margin-top: 1.5rem;
            color: #ffffff;
            font-weight: 600;
            text-decoration: none;
        }

        .read-more-link:hover {
            color: var(--text-muted);
            transform: translateX(8px);
        }

        .no-result-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 2rem;
            border-radius: 12px;
            margin-top: 2rem;
            text-align: center;
            font-size: 1.1rem;
            box-shadow: var(--shadow-sm);
        }

        .main-footer {
            margin-top: 5rem;
            padding: 2.5rem 0;
            color: white;
            text-align: center;
        }

        .footer-logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
        }

        .footer-copyright {
            opacity: 0.9;
            margin-top: 0.5rem;
        }

        @media (max-width: 1024px) {
            .content-wrapper {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
                margin-top: 3rem;
            }
        }

        @media (max-width: 768px) {
            .segment-cards-grid {
                grid-template-columns: 1fr;
            }

            .main-segment-title {
                font-size: 1.9rem;
            }
        }
    </style>
</head>

<body>

    <header class="main-header">
        <div class="site-title">PrimeLearn</div>
        <div class="menu-icon">☰</div>
    </header>

    <nav class="secondary-nav">
        <a href="{{ route('segments.index') }}"
            class="nav-item {{ request()->routeIs('segments.index') ? 'active' : '' }}">HOME</a>
        <a href="{{ route('about') }}" class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">ABOUT US</a>
        <a href="{{ route('faq') }}" class="nav-item {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
    </nav>

    <main class="container">
        <div class="search-bar">
            <form action="{{ route('segments.index') }}" method="GET" class="search-form-flex">
                <input type="text" name="query" placeholder="Cari segmen, fase, materi, atau langkah..."
                    value="{{ request('query') }}">
                <button type="submit">🔍</button>
            </form>
        </div>

        <div class="content-wrapper">
            <section class="main-segment-area">

                <h2 class="main-segment-title">
                    @if ($query)
                        Hasil Pencarian: <span>"{{ $query }}"</span>
                    @elseif (isset($isFilteredByRecommendation) && $isFilteredByRecommendation)
                        Rekomendasi Terbaik Untuk Anda
                    @else
                        Jelajahi Segmen Pembelajaran
                    @endif
                </h2>

                @if (isset($recommendation) && !$query)
                    <div class="recommendation-notif">
                        <strong>Rekomendasi:</strong> {{ $recommendation }}! Segmen di bawah ini paling cocok dengan minat
                        Anda.
                    </div>
                @endif

                @if ($segments->isNotEmpty())
                    @if ($query)
                    <h3 class="search-result-title">Segmen Ditemukan ({{ $segments->count() }})</h3>@endif
                    <div class="segment-cards-grid">
                        @foreach ($segments as $segment)
                            <a href="{{ route('course.show', ['segment' => $segment->name]) }}" class="segment-post-item">
                                <img src="{{ asset('storage/' . $segment->image_path) }}" alt="{{ $segment->name }}"
                                    class="segment-item-image" loading="lazy">
                                <div class="segment-item-overlay">
                                    <span class="category-tag">Category</span>
                                    <h3 class="segment-item-title-small">{{ $segment->name }}</h3>
                                    <div class="segment-item-description-small">{{ Str::limit($segment->description, 100) }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

                @if ($query && isset($fases) && $fases->isNotEmpty())
                    <h3 class="search-result-title">Fase Ditemukan ({{ $fases->count() }})</h3>
                    <div class="small-post-list">
                        @foreach ($fases as $fase)
                            <div class="small-post-item">
                                <a href="{{ route('fase.show', $fase->id) }}">
                                    <p><strong>[FASE] {{ $fase->title }}</strong></p>
                                </a>
                                <small>Segmen: {{ $fase->segment->name ?? 'N/A' }}</small>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if ($query && isset($materis) && $materis->isNotEmpty())
                    <h3 class="search-result-title">Materi Ditemukan ({{ $materis->count() }})</h3>
                    <div class="small-post-list">
                        @foreach ($materis as $materi)
                            <div class="small-post-item">
                                <a href="{{ route('materi.show', $materi->id) }}">
                                    <p><strong>[MATERI] {{ $materi->title }}</strong></p>
                                </a>
                                <small>
                                    Fase: {{ $materi->fase->title ?? 'N/A' }} |
                                    Segmen: {{ $materi->fase->segment->name ?? 'N/A' }}
                                </small>
                                <small>{{ Str::limit($materi->description, 80) }}</small>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if ($query && isset($steps) && $steps->isNotEmpty())
                    <h3 class="search-result-title">Langkah Pembelajaran Ditemukan ({{ $steps->count() }})</h3>
                    <div class="small-post-list">
                        @foreach ($steps as $step)
                            @php $isUnlocked = $step->isUnlocked(); @endphp
                            <div class="small-post-item {{ !$isUnlocked ? 'step-locked' : '' }}">
                                @if($isUnlocked)
                                    <a href="{{ route('materi.show', $step->materi->id) }}">
                                        <p><strong>[LANGKAH] {{ $step->title }}</strong></p>
                                        <small style="color: var(--primary); font-weight: 500;">
                                            Dari Materi → {{ $step->materi->title }}
                                        </small>
                                    </a>
                                @else
                                    <div>
                                        <p><strong>[TERKUNCI] {{ $step->title }}</strong></p>
                                        <small style="color: #ef4444; font-weight: 500;">
                                            Selesaikan langkah sebelumnya di materi: {{ $step->materi->title }}
                                        </small>
                                    </div>
                                @endif
                                <small>{{ Str::limit(strip_tags($step->content), 90) }}</small>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if ($query && $segments->isEmpty() && (!isset($fases) || $fases->isEmpty()) && (!isset($materis) || $materis->isEmpty()) && (!isset($steps) || $steps->isEmpty()))
                    <div class="no-result-box">
                        Maaf, tidak ditemukan hasil untuk "<strong>{{ $query }}</strong>".<br>
                        Coba gunakan kata kunci lain seperti "perangkat lunak", "hardware", atau "setup".
                    </div>
                @endif

            </section>

            <aside class="sidebar">
                <h3 class="sidebar-title">Materi Menarik Lainnya</h3>
                <div class="small-post-list">
                    @forelse ($sidebarCourses as $course)
                        <div class="small-post-item">
                            <a href="{{ route('materi.show', $course->id) }}">
                                <p><strong>{{ $course->title }}</strong></p>
                            </a>
                            <small>{{ Str::limit($course->description, 70) }}</small>
                        </div>
                    @empty
                        <div class="small-post-item">
                            <p>Belum ada materi terbaru.</p>
                        </div>
                    @endforelse
                </div>
                <a href="#" class="read-more-link">Selengkapnya →</a>
            </aside>
        </div>
    </main>

    <footer class="main-footer">
        <div class="container">
            <div class="footer-logo">PrimeLearn</div>
            <div class="footer-copyright">&copy; {{ date('Y') }} PrimeLearn. All Rights Reserved.</div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector('.menu-icon').addEventListener('click', () => {
                document.querySelector('.secondary-nav').classList.toggle('show');
            });

            const loadMoreBtn = document.querySelector(".read-more-link");
            const smallPostList = document.querySelector(".sidebar .small-post-list");
            let currentPage = 1;

            if (loadMoreBtn && smallPostList) {
                loadMoreBtn.style.cursor = 'pointer';
                loadMoreBtn.addEventListener("click", function (e) {
                    e.preventDefault();
                    if (loadMoreBtn.disabled) return;

                    const originalText = loadMoreBtn.textContent;
                    loadMoreBtn.textContent = 'Memuat...';
                    loadMoreBtn.classList.add('loading');
                    currentPage++;

                    fetch(`{{ route('ajax.load_more_sidebar') }}?page=${currentPage}`)
                        .then(response => response.ok ? response.json() : Promise.reject())
                        .then(data => {
                            smallPostList.insertAdjacentHTML('beforeend', data.html);
                            loadMoreBtn.classList.remove('loading');
                            loadMoreBtn.textContent = data.hasMore ? originalText : 'Semua Materi Dimuat';
                            if (!data.hasMore) { loadMoreBtn.disabled = true; loadMoreBtn.style.opacity = '0.7'; }
                        })
                        .catch(() => {
                            loadMoreBtn.textContent = 'Gagal Memuat';
                            loadMoreBtn.classList.remove('loading');
                        });
                });
            }
        });
    </script>
</body>

</html>