<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Peminatan IT | PRIME LEARN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6; /* Warna latar belakang yang lebih netral */
        }
        .main-card {
            background-color: #ffffff;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 0 10px rgba(0, 0, 0, 0.04);
        }
        .recommendation-box {
            background-color: #e0f2fe; /* light blue */
            border-radius: 0.75rem;
            border-left: 6px solid #06b6d4; /* Cyan border */
        }
        .highlight-row {
            background-color: #fef3c7 !important; /* light yellow for highlight */
            font-weight: 600;
        }
    </style>
</head>
<body class="text-gray-900 min-h-screen pt-24">
    <nav class="flex items-center justify-between px-8 py-4 bg-white shadow-md fixed top-0 left-0 w-full z-50">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" alt="Primakara University" class="h-10">
            <span class="font-bold text-blue-700 text-lg">PRIME LEARN</span>
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
                📊 Detail Skor Peminatan (Skala 3 - 12)
            </h2>
            
            <div class="overflow-x-auto shadow-lg rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold uppercase tracking-wider rounded-tl-lg">Kategori Peminatan</th>
                            <th class="px-6 py-3 text-left text-sm font-bold uppercase tracking-wider rounded-tr-lg">Skor Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($scores as $category => $score)
                        {{-- Menambahkan kelas highlight-row jika kategori adalah rekomendasi --}}
                        <tr class="{{ $category === $recommendation ? 'highlight-row' : 'hover:bg-gray-50' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-base text-gray-900">{{ $category }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-base font-extrabold text-blue-700">{{ $score }} / 12</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <p class="text-sm text-gray-500 mt-4">
                Skor dihitung dari total 3 pernyataan per kategori. Semakin tinggi skor, semakin kuat minat Anda.
            </p>
        </section>

        <div class="mt-12 text-center space-y-4 md:space-y-0 md:space-x-4">
            
            <a href="{{ route('segment.index') }}" 
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