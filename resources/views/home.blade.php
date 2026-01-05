<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IT Learning Path | Primakara University</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />

    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Poppins', sans-serif;
        }
        .navbar-dark {
            background-color: #06192A; 
        }
        /* Menghilangkan scrollbar agar lebih rapi tapi tetap bisa di-scroll */
        .scroll-container::-webkit-scrollbar {
            display: none;
        }
        .scroll-container {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</head>

<body class="bg-white text-gray-800">

    <nav class="flex items-center justify-between px-8 py-4 navbar-dark fixed top-0 left-0 w-full z-50 shadow-xl">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo_putih.png') }}" alt="PrimeLearn Logo" class="h-8" />
            <span class="font-bold text-white text-2xl tracking-wide md:hidden">PrimeLearn</span>
        </div>

        <div class="absolute left-1/2 transform -translate-x-1/2 hidden md:block">
            <span class="font-bold text-white text-2xl tracking-wide">PrimeLearn</span>
        </div>
    </nav>

    <section id="home" class="pt-32 pb-20 px-6 md:px-20 flex flex-col-reverse md:flex-row items-center justify-between bg-gradient-to-b from-blue-50 to-white">
        <div class="md:w-1/2 mt-10 md:mt-0 text-center md:text-left">
            <h1 class="text-4xl md:text-5xl font-bold text-blue-800 leading-tight mb-6">
                Discover Your Learning Path in the World of IT
            </h1>

            <p class="text-gray-600 mb-8 max-w-md mx-auto md:mx-0">
                We help you find the IT field that best matches your interests — from software development to artificial intelligence.
            </p>

            <a href="{{ url('/apply') }}" class="px-6 py-3 bg-blue-700 text-white rounded-full font-semibold shadow hover:bg-blue-800 transition inline-block">
                Start Interest Survey
            </a>
        </div>

        <div class="md:w-1/2 flex justify-center">
            <img src="{{ asset('images/it.jpg') }}" alt="Learn IT" class="w-80 md:w-[420px] drop-shadow-xl rounded-2xl" />
        </div>
    </section>

    <section id="fields" class="py-20 bg-white px-6 md:px-20">
        <h2 class="text-3xl font-bold text-blue-800 mb-10 text-center tracking-wide">IT Fields You Can Explore</h2>

        <div class="relative max-w-6xl mx-auto">
            <button id="scrollLeftBtn" class="absolute left-0 md:left-[-25px] top-1/2 -translate-y-1/2 bg-white/90 p-2 md:p-3 rounded-full shadow-lg border border-gray-200 text-blue-700 hover:bg-gray-100 transition z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button id="scrollRightBtn" class="absolute right-0 md:right-[-25px] top-1/2 -translate-y-1/2 bg-white/90 p-2 md:p-3 rounded-full shadow-lg border border-gray-200 text-blue-700 hover:bg-gray-100 transition z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div id="cardContainer" class="scroll-container flex overflow-x-scroll pb-10 snap-x snap-mandatory space-x-6 md:space-x-8 px-2">
                
                <div class="flex-shrink-0 w-72 md:w-96 snap-center p-6 border border-blue-100 bg-blue-50 rounded-2xl shadow-xl hover:shadow-2xl transition">
                    <h3 class="font-bold text-xl text-blue-800 mb-2">💻 Software Development</h3>
                    <p class="text-gray-600 text-sm">Learn to write code, build <b>web & mobile applications</b>, and create functional systems from scratch.</p>
                </div>

                <div class="flex-shrink-0 w-72 md:w-96 snap-center p-6 border border-blue-100 bg-blue-50 rounded-2xl shadow-xl hover:shadow-2xl transition">
                    <h3 class="font-bold text-xl text-blue-800 mb-2">📈 Data & AI (Data Science)</h3>
                    <p class="text-gray-600 text-sm">Master <b>data analytics, machine learning, statistics</b>, and learn how to build predictive models.</p>
                </div>

                <div class="flex-shrink-0 w-72 md:w-96 snap-center p-6 border border-blue-100 bg-blue-50 rounded-2xl shadow-xl hover:shadow-2xl transition">
                    <h3 class="font-bold text-xl text-blue-800 mb-2">🔒 Cybersecurity</h3>
                    <p class="text-gray-600 text-sm">Learn about <b>encryption, firewalls, penetration testing</b>, and how to defend against hackers.</p>
                </div>

                <div class="flex-shrink-0 w-72 md:w-96 snap-center p-6 border border-blue-100 bg-blue-50 rounded-2xl shadow-xl hover:shadow-2xl transition">
                    <h3 class="font-bold text-xl text-blue-800 mb-2">🎨 UX/UI Design</h3>
                    <p class="text-gray-600 text-sm">Focus on User Experience (UX) and User Interface (UI). Design intuitive and visually appealing digital interfaces.</p>
                </div>

            </div>
        </div>
    </section>

    <section id="about" class="bg-blue-50 py-20 px-6 md:px-20 text-center">
        <h2 class="text-3xl font-bold text-blue-800 mb-6 tracking-wide">Why Learn With Us?</h2>

        <p class="text-gray-600 max-w-3xl mx-auto mb-10">
            This platform is designed to help you determine your IT learning direction based on your interests and learning style. Get recommendations for fields that suit you, along with step-by-step learning guides.
        </p>

        <a href="{{ url('/apply') }}" class="px-8 py-3 bg-blue-700 text-white rounded-full font-semibold hover:bg-blue-800 transition inline-block">
            Discover Your Interest Now
        </a>
    </section>

    <footer class="py-6 text-center text-gray-500 border-t border-blue-100">
        © {{ date('Y') }} Primakara University | IT Learning Path Project
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('cardContainer');
            const leftBtn = document.getElementById('scrollLeftBtn');
            const rightBtn = document.getElementById('scrollRightBtn');

            // Menentukan jarak scroll (HP lebih pendek, Desktop lebih panjang)
            const getScrollDistance = () => {
                return window.innerWidth < 768 ? 300 : 400;
            };

            leftBtn.addEventListener('click', () => {
                container.scrollBy({ left: -getScrollDistance(), behavior: 'smooth' });
            });

            rightBtn.addEventListener('click', () => {
                container.scrollBy({ left: getScrollDistance(), behavior: 'smooth' });
            });
        });
    </script>

</body>
</html>