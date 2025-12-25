
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>About Us - PrimeLearn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts & AOS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-white text-gray-800">

<!-- ================= HEADER ================= -->
<header class="w-full border-b bg-white/80 backdrop-blur sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-900">PrimeLearn</h1>
        <nav class="space-x-6 hidden md:block">
            <a href="{{ route('segments.index') }}" class="hover:text-teal-600">Home</a>
            <a href="{{ route('about') }}" class="font-semibold text-teal-600">About</a>
            <a href="{{ route('faq') }}" class="hover:text-teal-600">FAQ</a>
        </nav>
    </div>
</header>

<!-- ================= HERO ================= -->
<section class="relative bg-gradient-to-br from-blue-900 to-teal-600 text-white">
    <!-- Shadow Atas -->
    <div class="pointer-events-none absolute top-0 left-0 w-full h-14
                bg-gradient-to-b from-black/10 to-transparent"></div>

    <!-- Shadow Bawah -->
    <div class="pointer-events-none absolute bottom-0 left-0 w-full h-14
                bg-gradient-to-t from-black/10 to-transparent"></div>
    <div class="max-w-7xl mx-auto px-6 py-24 text-center">

        <h2 class="text-4xl md:text-5xl font-bold mb-6" data-aos="fade-down">
            Belajar dengan Cara yang Lebih Bermakna
        </h2>

        <p class="max-w-3xl mx-auto text-lg text-white/90 mb-10" data-aos="fade-up">
            PrimeLearn menjembatani teori akademik dan praktik nyata untuk menciptakan
            pengalaman belajar yang relevan dengan kebutuhan industri modern.
        </p>

        <!-- CTA -->
        <div class="flex justify-center gap-4"
            data-aos="fade-up"
            data-aos-duration="1200"
            data-aos-easing="ease-out-cubic"
            data-aos-delay="200">

            <a href="{{ route('segments.index') }}"
            class="group px-8 py-4 rounded-full
                    bg-white text-blue-900 font-semibold
                    shadow-md
                    transition-all duration-500 ease-out
                    hover:shadow-xl
                    hover:-translate-y-0.5
                    focus:outline-none focus:ring-4 focus:ring-white/40">
                <span class="inline-flex items-center gap-2">
                    Mulai Belajar Sekarang
                    <span class="transform transition-transform duration-500 group-hover:translate-x-1">
                        →
                    </span>
                </span>
            </a>

        </div>


    </div>
</section>

<!-- ================= STORY ================= -->
<section class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-16 items-center">
    
    <div >
        <h3 class="text-3xl font-bold text-blue-900 mb-6"data-aos="fade-right ">
            Mengapa PrimeLearn Dibangun?
        </h3>
        <p class="text-gray-600 leading-relaxed mb-4"data-aos="fade-right ">
            Banyak platform pembelajaran masih berfokus pada teori tanpa memberikan konteks
            penerapan di dunia nyata. Hal ini membuat pembelajar kesulitan beradaptasi
            dengan kebutuhan industri.
        </p>
        <p class="text-gray-600 leading-relaxed"data-aos="fade-right ">
            PrimeLearn hadir sebagai solusi dengan pendekatan pembelajaran terstruktur,
            kontekstual, dan berbasis pemecahan masalah nyata.
        </p>
    </div>

    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=900&q=80"
     alt="Diskusi Tim PrimeLearn"
     data-aos="fade-left"
     class="w-full max-w-md mx-auto
            aspect-[4/3] object-cover
            rounded-3xl shadow-2xl">

</section>

<!-- ================= VISION & MISSION ================= -->
<section class="relative bg-gradient-to-b from-gray-50 to-white py-24 overflow-hidden">

    <!-- Decorative Blur -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-teal-200/40 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-blue-200/40 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-6">
        <h3 class="text-3xl md:text-4xl font-bold text-center text-blue-900 mb-4" data-aos="fade-up">
            Visi & <span class=" text-teal-600">Misi </span>
        </h3>
        <p class="text-center text-gray-600 max-w-2xl mx-auto mb-16" data-aos="fade-up">
            Arah dan tujuan PrimeLearn dalam membangun pengalaman belajar
            yang relevan dan berdampak.
        </p>

        <div class="grid md:grid-cols-2 gap-12">

            <!-- Visi -->
            <div class="bg-white p-12 rounded-3xl shadow-xl 
                        hover:-translate-y-2 hover:shadow-2xl transition"
                 data-aos="zoom-in">

                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 flex items-center justify-center 
                                rounded-xl bg-teal-100 text-teal-600 text-2xl">
                        🎯
                    </div>
                    <h4 class="text-2xl font-semibold text-blue-900">Visi</h4>
                </div>

                <p class="text-gray-600 leading-relaxed text-lg">
                    Menjadi platform pembelajaran digital yang unggul dalam membentuk
                    pembelajar yang kritis, adaptif, dan siap menghadapi tantangan
                    industri global.
                </p>
            </div>

            <!-- Misi -->
            <div class="bg-white p-12 rounded-3xl shadow-xl 
                        hover:-translate-y-2 hover:shadow-2xl transition"
                 data-aos="zoom-in" data-aos-delay="150">

                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 flex items-center justify-center 
                                rounded-xl bg-blue-100 text-blue-600 text-2xl">
                        🚀
                    </div>
                    <h4 class="text-2xl font-semibold  text-teal-600">Misi</h4>
                </div>

                <ul class="space-y-4 text-gray-600 text-lg">
                    <li class="flex gap-3">
                        <span class="text-teal-600 font-bold">✓</span>
                        Menyediakan materi pembelajaran yang terstruktur dan aplikatif
                    </li>
                    <li class="flex gap-3">
                        <span class="text-teal-600 font-bold">✓</span>
                        Menghubungkan teori dengan studi kasus dan praktik nyata
                    </li>
                    <li class="flex gap-3">
                        <span class="text-teal-600 font-bold">✓</span>
                        Mendorong pembelajar untuk berpikir kritis dan mandiri
                    </li>
                    <li class="flex gap-3">
                        <span class="text-teal-600 font-bold">✓</span>
                        Menyediakan akses pendidikan berkualitas untuk semua
                    </li>
                </ul>
            </div>

        </div>
    </div>
</section>


<!-- ================= VALUES ================= -->
<section class="relative py-20 overflow-hidden bg-white">


    <div class="relative max-w-7xl mx-auto px-6">
        <h3 class="text-3xl font-bold text-center text-blue-900 mb-14"
            data-aos="fade-up">
            Nilai yang Kami Pegang
        </h3>

        <div class="grid md:grid-cols-3 gap-10">

            <!-- CARD 1 -->
            <div class="bg-gradient-to-br from-blue-500 to-teal-400 p-[1.5px] rounded-3xl shadow-lg"
                 data-aos="fade-up">
                <div class="bg-white p-8 rounded-3xl shadow-md
                            hover:-translate-y-2 transition-all duration-500 ease-out">
                    <div class="text-4xl mb-4">💡</div>
                    <h4 class="font-semibold text-xl mb-2">Inovasi</h4>
                    <p class="text-gray-600">
                        Terus mengembangkan metode belajar yang relevan.
                    </p>
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="bg-gradient-to-br from-blue-500 to-teal-400 p-[1.5px] rounded-3xl shadow-lg"
                 data-aos="fade-up" data-aos-delay="100">
                <div class="bg-white p-8 rounded-3xl shadow-md
                            hover:-translate-y-2 transition-all duration-500 ease-out">
                    <div class="text-4xl mb-4">🏅</div>
                    <h4 class="font-semibold text-xl mb-2">Kualitas</h4>
                    <p class="text-gray-600">
                        Materi terbaik dengan pendekatan yang mudah dipahami.
                    </p>
                </div>
            </div>

            <!-- CARD 3 -->
            <div class="bg-gradient-to-br from-blue-500 to-teal-400 p-[1.5px] rounded-3xl shadow-lg"
                 data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white p-8 rounded-3xl shadow-md
                            hover:-translate-y-2 transition-all duration-500 ease-out">
                    <div class="text-4xl mb-4">🌍</div>
                    <h4 class="font-semibold text-xl mb-2">Aksesibilitas</h4>
                    <p class="text-gray-600">
                        Pendidikan berkualitas untuk semua kalangan.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ================= TEAM ================= -->
<section class="relative bg-gray-50 py-24 overflow-hidden">

    <!-- Decorative Blur -->
    <div class="absolute -top-32 left-1/2 -translate-x-1/2
                w-[28rem] h-[28rem]
                bg-teal-300/30 rounded-full blur-3xl"></div>

    <div class="absolute top-1/3 -left-32
                w-72 h-72
                bg-blue-300/20 rounded-full blur-3xl"></div>

    <div class="absolute -bottom-32 -right-32
                w-96 h-96
                bg-teal-200/30 rounded-full blur-3xl"></div>

    <div class="relative max-w-6xl mx-auto px-6">

        <h3 class="text-3xl font-bold text-center text-blue-900 mb-4"
            data-aos="fade-up">
            Tim di Balik PrimeLearn
        </h3>

        <p class="text-center text-gray-600 max-w-xl mx-auto mb-16"
           data-aos="fade-up">
            Tim inti yang berperan dalam pengembangan dan perancangan PrimeLearn.
        </p>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-10 justify-center">

            @php
                $team = [
                    ['name' => 'Mas Heri', 'img' => 'heri.webp', 'role' => 'Mentor'],
                    ['name' => 'Nyoman Bagus', 'img' => 'william.webp', 'role' => 'Backend'],
                    ['name' => 'Dinda Dev', 'img' => 'dinda.webp', 'role' => 'UI/UX'],
                    ['name' => 'Yasa', 'img' => 'yasa.webp', 'role' => 'Fullstack'],
                ];
            @endphp

            @foreach($team as $member)
                <div class="text-center" data-aos="fade-up">

                    <!-- Avatar -->
                    <div class="mx-auto mb-5 w-40 h-40 rounded-full
                                bg-gradient-to-br from-blue-500 to-teal-400 p-1
                                transition-transform duration-500 hover:scale-105">
                        <img src="{{ asset('images/' . $member['img']) }}"
                             class="w-full h-full rounded-full object-cover bg-white"
                             alt="{{ $member['name'] }}">
                    </div>

                    <!-- Name -->
                    <p class="font-semibold text-blue-900">
                        {{ $member['name'] }}
                    </p>

                    <!-- Role -->
                    <p class="text-sm text-gray-500">
                        {{ $member['role'] }}
                    </p>

                </div>
            @endforeach

        </div>
    </div>
</section>


<!-- ================= FOOTER ================= -->
<footer class="bg-gradient-to-br from-blue-900 to-teal-600 py-8 text-center text-sm text-white/80">
    © {{ date('Y') }} PrimeLearn. All rights reserved.
</footer>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ duration: 900, easing: 'ease-out-cubic', once: false });
</script>

</body>
</html>
```
