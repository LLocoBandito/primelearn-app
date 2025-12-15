<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - PrimeLearn</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Gaya untuk item navigasi yang aktif (HOME pada gambar) */
        .active-nav-dropdown-new {
            background-color: #1abc9c; /* Warna hijau tosca */
            color: white;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
        }

        /* Gaya item navigasi default di dropdown (ABOUT US, FAQ) */
        .dropdown-item-new {
            padding: 0.5rem 1rem;
            text-align: center;
            color: white; /* Teks putih */
            font-weight: 600;
            line-height: 1.5;
            transition: background-color 0.2s;
            white-space: nowrap; /* Mencegah teks melipat */
        }

        /* Gaya untuk latar belakang menu dropdown (Biru Gelap) */
        .dropdown-bg-new {
            background-color: #3f688b; 
        }
        
        /* ======== KELAS BARU UNTUK TRANSISI SLIDE ======== */
        .slide-hidden {
            max-height: 0;
            overflow: hidden; 
            opacity: 0;
        }

        .slide-visible {
            max-height: 500px; /* Nilai yang cukup besar */
            opacity: 1;
        }
        /* ============================================== */

        .team-member-photo {
            width: 8rem;
            height: 8rem;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #0a1c33;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body class="bg-gray-100 font-poppins">

    <header class="bg-[#0a1c33] shadow-lg p-5 flex justify-between items-center sticky top-0 z-40 text-white">
        <div class="text-2xl font-bold tracking-wide">PrimeLearn</div>

        <div class="menu-icon text-3xl cursor-pointer">☰</div> 

        <nav class="hidden"></nav>
    </header>

    <nav id="mobile-menu" 
         class="absolute top-[70px] left-1/2 -translate-x-1/2 dropdown-bg-new shadow-2xl 
                flex flex-row items-center justify-center z-30 rounded-lg p-2 gap-2
                slide-hidden transition-all duration-500 ease-in-out" 
         style="width: fit-content;"> 
         

        <a href="{{ route('segments.index') }}" 
           class="
               {{ request()->routeIs('segments.index') 
                  ? 'active-nav-dropdown-new' 
                  : 'dropdown-item-new hover:bg-[#2c4d68] rounded-md' 
               }}
           ">
            HOME
        </a>

        <a href="{{ route('about') }}" 
           class="
               {{ request()->routeIs('about') 
                  ? 'active-nav-dropdown-new' 
                  : 'dropdown-item-new hover:bg-[#2c4d68] rounded-md' 
               }}
           ">
            ABOUT US
        </a>

        <a href="{{ route('faq') }}" 
           class="
               {{ request()->routeIs('faq') 
                  ? 'active-nav-dropdown-new' 
                  : 'dropdown-item-new hover:bg-[#2c4d68] rounded-md' 
               }}
           ">
            FAQ
        </a>
    </nav>


    <main class="container mx-auto p-4 sm:p-10 lg:p-12 space-y-12">

        <section class="bg-[#0a1c33] text-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">

                <div class="p-8 lg:p-12 flex flex-col justify-center">
                    <h2 class="text-4xl font-bold mb-4">Visi & Misi Kami</h2>
                    <p class="leading-relaxed text-gray-200">
                        Menjadi platform digital terdepan dalam penyebaran pengetahuan Informatika dan Teknologi Informasi, menjembatani teori dan praktik serta membentuk generasi unggul di era digital.
                    </p>
                </div>

                <div>
                    <img src="images/team.jpg" alt="Tim Rapat" class="w-full h-80 lg:h-full object-cover">
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-2xl font-bold text-blue-900 mb-4 border-b-2 border-teal-500 pb-2">Nilai Inti</h2>

                <div class="space-y-6">
                    <div class="bg-gray-50 p-6 rounded-xl shadow-sm hover:shadow-lg transition">
                        <span class="text-4xl text-teal-500 mb-2 block">💡</span>
                        <h3 class="font-bold text-lg">Inovasi</h3>
                        <p class="text-sm text-gray-600">Terus mencari cara baru untuk meningkatkan pembelajaran.</p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-xl shadow-sm hover:shadow-lg transition">
                        <span class="text-4xl text-teal-500 mb-2 block">🏅</span>
                        <h3 class="font-bold text-lg">Kualitas</h3>
                        <p class="text-sm text-gray-600">Materi terbaik untuk hasil terbaik.</p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-xl shadow-sm hover:shadow-lg transition">
                        <span class="text-4xl text-teal-500 mb-2 block">🌐</span>
                        <h3 class="font-bold text-lg">Aksesibilitas</h3>
                        <p class="text-sm text-gray-600">Belajar dimana saja, kapan saja untuk semua orang.</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-2xl font-bold text-blue-900 mb-6 pb-2 border-b-4 border-[#0a1c33] inline-block">Tim Kami</h2>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-8 mt-4">

                    <div class="text-center">
                        <img src="{{ asset('images/heri.webp') }}" class="team-member-photo mx-auto" alt="Heri">
                        <p class="text-sm font-semibold mt-2">Mas Heri</p>
                    </div>

                    <div class="text-center">
                        <img src="{{ asset('images/william.webp') }}" class="team-member-photo mx-auto" alt="Nyoman Bagus">
                        <p class="text-sm font-semibold mt-2">Nyoman Bagus</p>
                    </div>

                    <div class="text-center">
                        <img src="{{ asset('images/dinda.webp') }}" class="team-member-photo mx-auto" alt="Dinda">
                        <p class="text-sm font-semibold mt-2">Dinda Dev</p>
                    </div>

                    <div class="text-center">
                        <img src="{{ asset('images/yasa.webp') }}" class="team-member-photo mx-auto" alt="Yasa">
                        <p class="text-sm font-semibold mt-2">Yasa</p>
                    </div>

                    <div class="text-center">
                        <img src="{{ asset('images/satya.webp') }}" class="team-member-photo mx-auto" alt="Bang Sat">
                        <p class="text-sm font-semibold mt-2">Bang Sat</p>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const menuBtn = document.querySelector(".menu-icon");
            const mobileNav = document.querySelector("#mobile-menu");

            menuBtn.addEventListener("click", () => {
                // Men-toggle antara slide-hidden (tersembunyi) dan slide-visible (terbuka)
                mobileNav.classList.toggle("slide-hidden");
                mobileNav.classList.toggle("slide-visible");
            });
        });
    </script>

</body>
</html>