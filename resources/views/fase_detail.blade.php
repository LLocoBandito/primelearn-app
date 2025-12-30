<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $fase->title }} - PrimeLearn</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <style>
        :root {
            --header-bg: #0a1d37; 
            --nav-bg: #32628d;    
            --primary: #4f46e5;
            --primary-light: #818cf8;
            --text: #1e293b;
            --text-muted: #64748b;
            --bg: #f8fafc;
            --card: #ffffff;
            --border: #e2e8f0;
            --shadow-md: 0 10px 15px -3px rgba(0,0,0,0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: var(--bg); 
            color: var(--text); 
            line-height: 1.6;
        }

        /* --- HEADER --- */
        .main-header {
            background-color: var(--header-bg);
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 1001;
        }

        .site-title {
            color: white;
            font-size: 1.8rem;
            font-weight: 800;
        }

        .menu-icon {
            position: absolute;
            right: 30px;
            color: white;
            font-size: 1.8rem;
            cursor: pointer;
        }

        /* --- NAVBAR POP-UP (FIXED POSITIONING) --- */
        .secondary-nav {
            display: none; 
            background-color: var(--nav-bg);
            padding: 18px 0;
            
            /* Gunakan FIXED agar lepas dari kontainer header */
            position: fixed; 
            top: 70px; /* Jarak pas di bawah header */
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
            
            width: 90%;
            max-width: 550px; /* Ukuran kotak biru */
            
            justify-content: center;
            gap: 40px;
            z-index: 9999;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            border-radius: 0 0 15px 15px;
        }

        .secondary-nav.show {
            display: flex;
            animation: slideInCenter 0.3s cubic-bezier(0.18, 0.89, 0.32, 1.28);
        }

        .nav-item {
            color: white;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        @keyframes slideInCenter {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- JUDUL FASE --- */
        .page-header {
            text-align: center;
            margin: 4rem 0 3rem;
        }

        .page-title {
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--header-bg);
            position: relative;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .page-title span {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--nav-bg);
            border-radius: 10px;
        }

        .segment-info {
            font-size: 0.9rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* --- CONTENT --- */
        .container { max-width: 1440px; margin: 0 auto; padding: 0 1.5rem; }
        .content-wrapper { display: grid; grid-template-columns: 1fr 340px; gap: 3rem; margin-bottom: 5rem; }

        /* Card Materi */
        .materi-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem; }
        .materi-card {
            background: #fff;
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            text-decoration: none;
            color: inherit;
            box-shadow: var(--shadow-md);
            transition: 0.3s;
            border: 1px solid transparent;
        }
        .materi-card:hover {
            transform: translateY(-10px);
            border-color: var(--nav-bg);
            background: #f0f7ff;
        }

        /* Sidebar & Buttons */
        .sidebar { background: #fff; padding: 2rem; border-radius: 20px; box-shadow: var(--shadow-md); height: fit-content; }
        .sidebar-title { font-size: 1.2rem; font-weight: 700; margin-bottom: 1.5rem; border-left: 5px solid var(--nav-bg); padding-left: 10px; }
        .small-post-item { background: var(--bg); padding: 1rem; border-radius: 12px; margin-bottom: 1rem; }
        
        .read-more-link {
            display: block;
            text-align: center;
            padding: 12px;
            background-color: #00c853; 
            color: white !important; 
            border-radius: 10px; 
            font-weight: 700;
            text-decoration: none;
            margin-top: 1rem;
        }

        .main-footer { padding: 4rem 0; background-color: var(--header-bg); color: white; text-align: center; }

        @media (max-width: 1024px) {
            .content-wrapper { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <header class="main-header">
        <div class="site-title">PrimeLearn</div>
        <div class="menu-icon" id="menuBtn">☰</div>
    </header>

    <nav class="secondary-nav" id="navMenu">
        <a href="{{ route('segments.index') }}" class="nav-item">HOME</a>
        <a href="{{ route('about') }}" class="nav-item">ABOUT US</a>
        <a href="{{ route('faq') }}" class="nav-item">FAQ</a>
    </nav>

    <main class="container">
        <div class="page-header">
            <h1 class="page-title">Fase: <span>{{ $fase->title }}</span></h1>
            <div class="segment-info">Bagian dari Segmen: <strong>{{ $segment->name }}</strong></div>
        </div>

        <div class="content-wrapper">
            <section>
                <div class="materi-grid">
                    @forelse($fase->materis as $materi)
                        <a href="{{ route('materi.show', $materi->id) }}" class="materi-card">
                            <h3 style="margin-bottom:10px">{{ $materi->title }}</h3>
                            <p style="color:var(--text-muted)">{{ Str::limit($materi->description, 100) }}</p>
                        </a>
                    @empty
                        <p>Belum ada materi.</p>
                    @endforelse
                </div>
            </section>

            <aside class="sidebar">
                <h3 class="sidebar-title">Materi Menarik</h3>
                @foreach($sidebarCourses as $course)
                    <div class="small-post-item">
                        <a href="{{ route('materi.show', $course->id) }}" style="text-decoration:none; color:var(--text); font-weight:700;">{{ $course->title }}</a>
                    </div>
                @endforeach
                <a href="{{ route('segments.index') }}" class="read-more-link">Selengkapnya →</a>
            </aside>
        </div>
    </main>

    <footer class="main-footer">
        <div style="font-size: 1.5rem; font-weight: 800; margin-bottom: 10px;">PrimeLearn</div>
        <div>&copy; {{ date('Y') }} All Rights Reserved.</div>
    </footer>

    <script>
        const menuBtn = document.getElementById('menuBtn');
        const navMenu = document.getElementById('navMenu');

        menuBtn.addEventListener('click', (e) => {
            navMenu.classList.toggle('show');
            e.stopPropagation();
        });

        document.addEventListener('click', (e) => {
            if (!menuBtn.contains(e.target) && !navMenu.contains(e.target)) {
                navMenu.classList.remove('show');
            }
        });
    </script>
</body>
</html>