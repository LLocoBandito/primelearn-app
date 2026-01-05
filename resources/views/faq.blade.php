<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - PrimeLearn</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 

    <style>
        :root {
            --primary-dark: #062743;
            --secondary-blue: #3b5d7c;
            --grad-toska-marine: linear-gradient(135deg, #27ae60 0%, #1abc9c 20%, #00406aff 100%);
            --grad-button: linear-gradient(to right, #16a085, #1abc9c, #00406aff);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f7f9;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            color: #334155;
        }

        /* ================= INFO CARDS ================= */
        .info-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
        }
        .info-card:hover { transform: translateY(-5px); }

        /* ================= ELEGANT ACCORDION ================= */
        .accordion-item {
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 16px;
            overflow: hidden;
            background: white;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }

        .accordion-toggle {
            background: white;
            color: var(--primary-dark);
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .accordion-toggle.active-toggle {
            background: linear-gradient(to right, #f0fdfa, #ffffff);
            color: #0f766e;
            padding-left: 2rem;
        }

        .accordion-toggle.active-toggle::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            background: var(--grad-toska-marine);
        }

        .accordion-content {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.4s ease;
            background: #ffffff;
        }

        .accordion-content.open {
            max-height: 500px;
            opacity: 1;
            padding: 0.5rem 2rem 1.5rem 2rem;
            border-top: 1px solid #f1f5f9;
        }

        .arrow-icon { 
            color: #94a3b8;
            background: #f1f5f9;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 0.75rem;
            transition: all 0.4s ease; 
        }
        .active-toggle .arrow-icon { 
            color: white; 
            background: #1abc9c;
            transform: rotate(90deg); 
            box-shadow: 0 4px 10px rgba(26, 188, 156, 0.3);
        }

        footer {
            margin-top: auto;
            background: #06192A; 
            color: white;
            padding: 2.5rem 1rem;
            text-align: center;
            font-size: 0.9rem;
        }

        .footer-brand {
            color: white;
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
            display: block;
        }
    </style>
</head>

<body>

<header class="main-header">
    <div class="site-title">PrimeLearn</div>
    <div class="menu-icon" id="menuBtn">☰</div>
</header>

<nav class="secondary-nav">
    <a href="{{ route('segments.index') }}"
            class="nav-item {{ request()->routeIs('segments.index') ? 'active' : '' }}">HOME</a>
    <a href="{{ route('about') }}" class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">ABOUT US</a>
    <a href="{{ route('faq') }}" class="nav-item {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
</nav>

<section class="container mx-auto max-w-6xl px-6 py-12">
    <div class="text-center mb-12">
        <h2 class="text-4xl font-extrabold text-[#062743] mb-4">
            <span style="background: var(--grad-button); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">PrimeLearn</span> Help Center
        </h2>
        <p class="text-slate-500">We are here to help answer all your questions.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="info-card text-center border-b-4 border-emerald-500">
            <h3 class="text-3xl font-bold text-emerald-500 mb-1">24/7</h3>
            <p class="text-sm text-slate-500 font-medium uppercase tracking-wider">Technical Support</p>
        </div>
        <div class="info-card text-center border-b-4 border-blue-500">
            <h3 class="text-3xl font-bold text-blue-500 mb-1">500+</h3>
            <p class="text-sm text-slate-500 font-medium uppercase tracking-wider">Guide Articles</p>
        </div>
        <div class="info-card text-center border-b-4 border-purple-500">
            <h3 class="text-3xl font-bold text-purple-500 mb-1">100%</h3>
            <p class="text-sm text-slate-500 font-medium uppercase tracking-wider">Lifetime Access</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-[#062743] text-white p-8 rounded-3xl shadow-xl">
                <h4 class="text-xl font-bold mb-4">Need More Help?</h4>
                <p class="text-sm opacity-80 mb-6 leading-relaxed">If you can't find the answer you're looking for, our team is ready to assist you directly via WhatsApp.</p>
                
                <a href="https://wa.me/6281936204176?text=Hello%20PrimeLearn%20Admin,%20I%20have%20a%20question%20about..." 
                target="_blank" 
                class="block w-full py-3 rounded-xl font-bold text-sm bg-white text-center text-[#062743] hover:bg-emerald-500 hover:text-white transition-all shadow-lg">
                    Contact Support
                </a>
            </div>
            
            <div class="info-card">
                <h4 class="font-bold mb-4 text-[#062743]">Learning Tips</h4>
                <ul class="text-sm space-y-3 text-slate-600">
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Set daily targets
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Join the community
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Practice materials immediately
                    </li>
                </ul>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-4">
            <div class="accordion-item">
                <div class="accordion-toggle">
                    <p>How do I enroll in a course at PrimeLearn?</p>
                    <span class="arrow-icon">&#10095;</span>
                </div>
                <div class="accordion-content">
                    <p class="text-slate-600 leading-relaxed">Simply create an account via the sign-up button, choose from our course catalog, and complete the secure payment process.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-toggle">
                    <p>Does PrimeLearn provide certificates?</p>
                    <span class="arrow-icon">&#10095;</span>
                </div>
                <div class="accordion-content">
                    <p class="text-slate-600 leading-relaxed">Yes, exclusive digital certificates are automatically issued after you complete all course materials.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-toggle">
                    <p>How long can I access the course material?</p>
                    <span class="arrow-icon">&#10095;</span>
                </div>
                <div class="accordion-content">
                    <p class="text-slate-600 leading-relaxed">We provide Lifetime Access so you can learn anytime without any time constraints.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-toggle">
                    <p>What payment methods are available?</p>
                    <span class="arrow-icon">&#10095;</span>
                </div>
                <div class="accordion-content">
                    <p class="text-slate-600 leading-relaxed">We support Bank Transfers (VA), Credit Cards, and E-Wallets such as GoPay, OVO, and Dana.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-toggle">
                    <p>Is there a deadline to finish the course?</p>
                    <span class="arrow-icon">&#10095;</span>
                </div>
                <div class="accordion-content">
                    <p class="text-slate-600 leading-relaxed">No, there is no deadline. You are free to determine your own learning speed (Self-paced).</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-toggle">
                    <p>What if I need technical assistance?</p>
                    <span class="arrow-icon">&#10095;</span>
                </div>
                <div class="accordion-content">
                    <p class="text-slate-600 leading-relaxed">Our support team is available 24/7 via the Live Chat feature or our help email.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<footer>
    <span class="footer-brand">PrimeLearn</span>
    <p class="opacity-90">&copy; 2026 PrimeLearn Academy. All Rights Reserved.</p>
</footer>

<script>
document.addEventListener("DOMContentLoaded", () => {
    // 1. Mobile Navigation Fix
    const menuBtn = document.getElementById('menuBtn');
    const secondaryNav = document.querySelector('.secondary-nav');

    if (menuBtn && secondaryNav) {
        menuBtn.addEventListener('click', () => {
            secondaryNav.classList.toggle('show');
            menuBtn.textContent = secondaryNav.classList.contains('show') ? '✕' : '☰';
        });
    }

    // 2. FAQ Accordion Logic
    document.querySelectorAll(".accordion-toggle").forEach(button => {
        button.addEventListener("click", () => {
            const content = button.nextElementSibling;
            
            // Single Open Feature
            document.querySelectorAll(".accordion-content.open").forEach(openContent => {
                if (openContent !== content) {
                    openContent.classList.remove("open");
                    openContent.previousElementSibling.classList.remove("active-toggle");
                }
            });

            // Toggle clicked item
            content.classList.toggle("open");
            button.classList.toggle("active-toggle");
        });
    });
});
</script>

</body>
</html>