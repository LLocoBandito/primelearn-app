<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrimeLearn - Segment</title>
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
        <a href="#" class="nav-item active">HOME</a>
        <a href="#" class="nav-item">ABOUT US</a>
        <a href="#" class="nav-item">FAQ</a>
    </nav>

    <main class="container">
        <div class="search-bar">
            <input type="text" placeholder="Search for.......">
            <i class="search-icon">🔍</i>
        </div>

        @php
            $segments = [
                ['title' => 'Software Development', 'image_path' => 'images/dev.jpg', 'category' => 'Code', 'description' => 'Membangun aplikasi web, mobile, dan sistem.'],
                ['title' => 'Data & AI (Data Science)', 'image_path' => 'images/data.jpg', 'category' => 'Analytics', 'description' => 'Menganalisis data, machine learning, dan AI.'],
                ['title' => 'Jaringan & Infrastruktur', 'image_path' => 'images/network.jpg', 'category' => 'IT Ops', 'description' => 'Mengelola server, cloud, dan arsitektur jaringan.'],
                ['title' => 'Keamanan Siber', 'image_path' => 'images/security.jpg', 'category' => 'Hacking', 'description' => 'Melindungi sistem dari ancaman dan serangan siber.'],
                ['title' => 'UX/UI Design', 'image_path' => 'images/design.jpg', 'category' => 'Creative', 'description' => 'Merancang pengalaman dan antarmuka pengguna.'],
            ];
        @endphp
        
        <div class="content-wrapper">
            
            <section class="main-segment-area">
                <h2 class="main-segment-title">Jelajahi Segmen Pembelajaran</h2>
                <div class="segment-cards-grid-new">
                    @foreach ($segments as $segment)
                        <a href="#" class="segment-post-item">
                            <img src="{{ asset($segment['image_path']) }}" alt="{{ $segment['title'] }} Image" class="segment-item-image">
                            <div class="segment-item-overlay">
                                <span class="category-tag">{{ $segment['category'] }}</span>
                                <h3 class="segment-item-title-small">{{ $segment['title'] }}</h3>
                                <div class="segment-item-description-small">
                                    {{ $segment['description'] }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
            
            <aside class="sidebar">
                <div class="small-post-list">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="small-post-item">
                            <img src="{{ asset('images/win_thumb.jpg') }}" alt="Windows Thumbnail" class="small-post-thumbnail">
                            <div class="small-post-text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="read-more-link">
                    Selengkapnya →
                </div>
            </aside>
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
            <div class="footer-copyright">
                &copy; {{ date('Y') }} PrimeLearn. All Rights Reserved.
            </div>
        </div>
    </footer>

</body>
</html>