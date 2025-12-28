<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $fase->title }} - PrimeLearn</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --text: #111827;
            --text-muted: #6b7280;
            --bg: #f8fafc;
            --card: #ffffff;
            --border: #e2e8f0;
            --shadow-sm: 0 4px 6px -1px rgba(0,0,0,0.1);
            --shadow-md: 0 10px 15px -3px rgba(0,0,0,0.1);
            --shadow-lg: 0 20px 25px -5px rgba(0,0,0,0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: var(--bg); color: var(--text); line-height: 1.6; }

        .container { max-width: 1440px; margin: 0 auto; padding: 1.5rem 1rem; }

        .content-wrapper { display: grid; grid-template-columns: 1fr 340px; gap: 3rem; }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin: 2rem 0;
            color: var(--text);
        }
        .page-title span { color: var(--primary); }

        .segment-info {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--text-muted);
            font-size: 1.1rem;
        }

        .materi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .materi-card {
            background: var(--card);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.4s ease;
            text-decoration: none;
            color: inherit;
        }

        .materi-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .materi-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .materi-content {
            padding: 1.5rem;
        }

        .materi-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.8rem;
            color: var(--primary-dark);
        }

        .materi-desc {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .small-post-list { display: flex; flex-direction: column; gap: 1rem; }
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
        }
        .small-post-item a { color: inherit; text-decoration: none; }
        .small-post-item strong { color: var(--primary-dark); }

        .sidebar {
            background: var(--card);
            padding: 2rem;
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            height: fit-content;
            position: sticky;
            top: 120px;
        }
        .sidebar-title { font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem; }

        .read-more-link {
            display: inline-block;
            margin-top: 1.5rem;
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }
        .read-more-link:hover { color: var(--primary-dark); transform: translateX(8px); }

        .main-footer {
            margin-top: 5rem;
            padding: 2.5rem 0;
            background-color: var(--primary);
            color: white;
            text-align: center;
        }
        .footer-logo { font-size: 1.8rem; font-weight: 700; color: white; }
        .footer-copyright { opacity: 0.9; margin-top: 0.5rem; }

        @media (max-width: 1024px) {
            .content-wrapper { grid-template-columns: 1fr; }
            .sidebar { position: static; margin-top: 3rem; }
        }
        @media (max-width: 768px) {
            .materi-grid { grid-template-columns: 1fr; }
            .page-title { font-size: 2rem; }
        }
    </style>
</head>
<body>

    <!-- HEADER & NAV (SAMA PERSIS) -->
    <header class="main-header">
        <div class="site-title">PrimeLearn</div>
        <div class="menu-icon">☰</div>
    </header>

    <nav class="secondary-nav">
        <a href="{{ route('segments.index') }}" class="nav-item">HOME</a>
        <a href="{{ route('about') }}" class="nav-item">ABOUT US</a>
        <a href="{{ route('faq') }}" class="nav-item">FAQ</a>
    </nav>

    <main class="container">
        <div class="content-wrapper">

            <!-- KONTEN UTAMA -->
            <section>
                <h1 class="page-title">
                    Fase: <span>{{ $fase->title }}</span>
                </h1>

                <div class="segment-info">
                    Bagian dari Segmen: <strong>{{ $segment->name }}</strong>
                </div>

                @if($fase->description)
                    <p style="text-align:center; max-width:800px; margin:0 auto 3rem; font-size:1.1rem; color:var(--text-muted);">
                        {{ $fase->description }}
                    </p>
                @endif

                @if($fase->materis->isEmpty())
                    <p style="text-align:center; padding:2rem; background:#fef2f2; border-radius:12px; color:#991b1b;">
                        Belum ada materi di fase ini.
                    </p>
                @else
                    <div class="materi-grid">
                        @foreach($fase->materis as $materi)
                            <a href="{{ route('materi.show', $materi->id) }}" class="materi-card">
                                @if($materi->image_path)
                                    <img src="{{ asset('storage/' . $materi->image_path) }}" alt="{{ $materi->title }}" class="materi-image">
                                @else
                                    <div style="height:200px; background:linear-gradient(135deg, #6366f1, #8b5cf6);"></div>
                                @endif
                                <div class="materi-content">
                                    <h3 class="materi-title">{{ $materi->title }}</h3>
                                    <p class="materi-desc">
                                        {{ Str::limit($materi->description, 100) }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </section>

            <!-- SIDEBAR -->
            <aside class="sidebar">
                <h3 class="sidebar-title">Materi Menarik Lainnya</h3>
                <div class="small-post-list">
                    @forelse($sidebarCourses as $course)
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

    <!-- FOOTER SAMA DENGAN SEBELUMNYA -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-logo">PrimeLearn</div>
            <div class="footer-copyright">
                &copy; {{ date('Y') }} PrimeLearn. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script>
        // Menu toggle (sama seperti sebelumnya)
        document.querySelector('.menu-icon').addEventListener('click', () => {
            document.querySelector('.secondary-nav').classList.toggle('show');
        });
    </script>
</body>
</html>