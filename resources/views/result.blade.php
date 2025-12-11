<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Peminatan IT | PRIME LEARN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    {{-- Tambahkan ikon Heroicons untuk centang dan silang --}}
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
        }
        .navbar-dark {
            background-color: #06192A;
        }
        .main-card {
            background-color: #ffffff;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 0 10px rgba(0, 0, 0, 0.04);
        }
        .recommendation-box {
            background-color: #e0f2fe;
            border-radius: 0.75rem;
            border-left: 6px solid #06b6d4;
        }
        .highlight-row {
            background-color: #fef3c7 !important;
            font-weight: 600;
        }
    </style>
</head>
<body class="text-gray-900 min-h-screen pt-24">
    <nav class="flex items-center justify-between px-8 py-4 navbar-dark fixed top-0 left-0 w-full z-50 shadow-xl">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo_putih.png') }}" alt="PrimeLearn Logo" class="h-8" />
            <span class="font-bold text-white text-2xl tracking-wide md:hidden">PrimeLearn</span>
        </div>

        <div class="absolute left-1/2 transform -translate-x-1/2 hidden md:block">
            <span class="font-bold text-white text-2xl tracking-wide">PrimeLearn</span>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto p-8 md:p-12 rounded-xl main-card my-10">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-blue-800 mb-2 border-b-2 border-blue-100 pb-3">
                🔬 Analisis Minat & Bakat IT 🚀
            </h1>
            <p class="text-gray-600 text-lg">
                Hasil tes untuk **{{ $result->nama }}**
            </p>
        </header>

        <section class="mb-10">
            <div class="recommendation-box p-6 shadow-md">
                <p class="text-xl font-semibold text-gray-700 mb-2 flex items-center">
                    REKOMENDASI JURUSAN UTAMA
                </p>
                <p class="text-4xl font-bold text-blue-700 mt-2">
                    {{ $recommendation }}
                </p>
                <p class="text-sm mt-3 text-gray-600">
                    Ini adalah bidang yang paling sesuai dengan pola jawaban dan minat yang Anda tunjukkan dalam tes.
                </p>
            </div>
        </section>

        <section>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">
                ✅ Status Kecocokan Minat
            </h2>
            
            <div class="overflow-x-auto shadow-lg rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold uppercase tracking-wider rounded-tl-lg">Kategori Peminatan</th>
                            <th class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider rounded-tr-lg">Status Kecocokan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Iterasi menggunakan $matchStatus --}}
                        @foreach ($matchStatus as $category => $isMatch)
                        {{-- Menambahkan kelas highlight-row jika kategori adalah rekomendasi --}}
                        {{-- Perhatikan bahwa $recommendation bisa mengandung kata 'dan', sehingga kita gunakan str_contains --}}
                        <tr class="{{ str_contains($recommendation, $category) ? 'highlight-row' : 'hover:bg-gray-50' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-base text-gray-900">{{ $category }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-xl">
                                @if ($isMatch)
                                    {{-- Centang Hijau --}}
                                    <span class="text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </span>
                                @else
                                    {{-- Silang Merah --}}
                                    <span class="text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <p class="text-sm text-gray-500 mt-4">
                **Status Kecocokan** ditentukan oleh ambang batas (threshold) skor (Skor >= 9 dianggap cocok). Rekomendasi utama didasarkan pada skor tertinggi.
            </p>
        </section>

        <div class="mt-12 text-center space-y-4 md:space-y-0 md:space-x-4">
            
            <a href="{{ route('segments.index') }}" 
                class="inline-flex items-center px-8 py-3 bg-green-600 text-white rounded-full font-bold shadow-xl hover:bg-green-700 transition transform hover:scale-105 duration-300">
                Masuk Course
            </a>
            
            <a href="{{ route('peminatan.form') }}" 
               class="inline-flex items-center px-8 py-3 bg-blue-700 text-white rounded-full font-bold shadow-xl hover:bg-blue-800 transition transform hover:scale-105 duration-300">
                UJI ULANG PEMINATAN
            </a>

        </div>
    </div>
</body>
</html>