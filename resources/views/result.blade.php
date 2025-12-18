<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Peminatan IT | PRIME LEARN</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
        }
        .navbar-dark {
            background-color: #06192A;
        }
    </style>
</head>

<body class="text-gray-900 min-h-screen pt-24">

    {{-- NAVBAR --}}
    <nav class="flex items-center justify-between px-8 py-4 navbar-dark fixed top-0 left-0 w-full z-50 shadow-xl">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo_putih.png') }}" alt="PrimeLearn Logo" class="h-8">
            <span class="font-bold text-white text-2xl tracking-wide md:hidden">
                PrimeLearn
            </span>
        </div>

        <div class="absolute left-1/2 transform -translate-x-1/2 hidden md:block">
            <span class="font-bold text-white text-2xl tracking-wide">
                PrimeLearn
            </span>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="max-w-4xl mx-auto px-6 md:px-10 py-12 bg-white rounded-3xl shadow-2xl my-10">

        {{-- HEADER --}}
        <header class="text-center mb-14">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                Your IT Strength Profile
            </h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Berdasarkan pola jawaban Anda, kami menganalisis kecenderungan minat dan kekuatan utama Anda di bidang Teknologi Informasi.
            </p>
        </header>

        {{-- PRIMARY RECOMMENDATION --}}
        <section class="mb-16">
            <div class="bg-gradient-to-br from-blue-600 to-cyan-500 text-white rounded-3xl p-10 shadow-2xl">
                <p class="uppercase tracking-widest text-sm opacity-90 mb-4">
                    Primary Recommendation
                </p>

                <h2 class="text-4xl md:text-5xl font-extrabold mb-6">
                    {{ $recommendation }}
                </h2>

                <p class="text-blue-100 text-base md:text-lg max-w-xl">
                    Bidang ini menunjukkan skor tertinggi dan konsistensi minat Anda. Sangat direkomendasikan sebagai fokus utama pembelajaran dan pengembangan karier Anda.
                </p>
            </div>
        </section>

        {{-- SECONDARY STRENGTHS --}}
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-gray-800 mb-8">
                Your Strength Areas
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($matchStatus as $category => $isMatch)
                    <div class="p-6 rounded-2xl border transition
                        {{ $isMatch ? 'border-green-400 bg-green-50' : 'border-gray-200 bg-gray-50' }}">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="text-lg font-semibold text-gray-800">
                                {{ $category }}
                            </h4>

                            @if ($isMatch)
                                <span class="text-green-600 text-sm font-semibold">
                                    Strong Match
                                </span>
                            @else
                                <span class="text-gray-400 text-sm">
                                    Less Dominant
                                </span>
                            @endif
                        </div>

                        <p class="text-sm text-gray-600 leading-relaxed">
                            @if ($isMatch)
                                Bidang ini menunjukkan kecocokan yang kuat berdasarkan pola jawaban Anda dan berpotensi dikembangkan lebih lanjut.
                            @else
                                Bidang ini masih bisa dipelajari, namun bukan fokus utama minat Anda saat ini.
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- CTA --}}
        <section class="text-center mt-20 space-y-6">
            <a href="{{ route('segments.index') }}"
               class="inline-flex items-center justify-center px-12 py-4 bg-blue-700 text-white rounded-full text-lg font-bold shadow-xl hover:bg-blue-800 transition transform hover:scale-105">
                Start Learning
            </a>

            <div>
                <a href="{{ route('apply.form')}}"
                   class="text-sm text-gray-500 hover:text-blue-600 underline">
                    Retake assessment
                </a>
            </div>
        </section>

    </main>

</body>
</html>
