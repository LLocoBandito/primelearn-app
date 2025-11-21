<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Langkah {{ $step->order }}: {{ $step->title }} | PrimeLearn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Gaya dasar Tailwind Prose untuk konten yang lebih mudah dibaca */
        .prose h2 { font-size: 1.875rem; font-weight: 700; margin-top: 1.5em; margin-bottom: 0.5em; color: #1e3a8a; } /* text-3xl, font-bold, text-blue-800 */
        .prose h3 { font-size: 1.5rem; font-weight: 600; margin-top: 1.25em; margin-bottom: 0.5em; color: #1f2937; } /* text-2xl, font-semibold, text-gray-800 */
        .prose p { margin-bottom: 1.25em; line-height: 1.75; }
        .prose ul { margin-bottom: 1.25em; padding-left: 1.5em; list-style: disc; }
        .prose img { max-width: 100%; height: auto; border-radius: 0.5rem; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    
    @include('components.navbar')

    <main class="max-w-4xl mx-auto p-6 md:p-10">
        <div class="text-sm text-gray-500 mb-4">
            {{-- Menggunakan 'segment' sebagai kunci parameter sesuai dengan route/web.php Anda --}}
            <a href="{{ route('course.show', ['segment' => $segmentName]) }}" class="hover:underline">{{ $segmentName }}</a> 
            &gt; 
            <a href="{{ route('materi.show', ['materiId' => $materi->id]) }}" class="hover:underline">{{ $materi->title }}</a> 
            &gt; 
            <span class="text-blue-700 font-semibold">Langkah {{ $step->order }}</span>
        </div>
        
        <article class="bg-white p-8 rounded-xl shadow-2xl">
            
            <h1 class="text-4xl font-extrabold text-blue-800 mb-3">
                {{ $step->title }}
            </h1>
            <p class="text-lg text-teal-600 font-semibold mb-6 border-b pb-4">
                {{ $materi->title }} (Langkah {{ $step->order }})
            </p>

            @if ($step->image_path)
                <figure class="mb-8 overflow-hidden rounded-lg shadow-xl">
                    <img src="{{ asset($step->image_path) }}" alt="{{ $step->title }}" class="w-full object-cover max-h-[400px]">
                    <figcaption class="p-3 text-sm text-gray-500 text-center bg-gray-50 border-t">Ilustrasi untuk Langkah {{ $step->order }}: {{ $step->title }}</figcaption>
                </figure>
            @endif

            <div class="prose max-w-none text-gray-700">
                {{-- Konten Utama Langkah: Menggunakan nl2br untuk menampilkan baris baru jika ada di database --}}
                <p><strong>Ringkasan Langkah:</strong></p>
                <p>{!! nl2br(e($step->content)) !!}</p>
                
                {{-- Area Konten Mendalam (simulasi konten blog yang lebih panjang) --}}
                <h2 class="text-blue-800">Detail Implementasi dan Kasus Penggunaan</h2>
                <p>
                    Langkah **"{{ $step->title }}"** adalah fondasi penting. Di sinilah pemahaman teoritis Anda diuji dalam skenario praktis. Misalnya, jika Anda mempelajari Logika Pemrograman, pastikan Anda tidak hanya memahami sintaks **If-Else**, tetapi juga kapan skenario bisnis menuntut penggunaan struktur kondisional yang lebih kompleks seperti *Switch Case* atau *Nested If*.
                </p>
                
                <h3>Kesalahan Umum yang Harus Dihindari</h3>
                <ul>
                    <li>**Kurang Konteks:** Mengimplementasikan kode tanpa memahami mengapa algoritma tertentu lebih efisien daripada yang lain.</li>
                    <li>**Redundansi Kode:** Tidak menggunakan fungsi atau perulangan yang mengakibatkan kode duplikat (melanggar prinsip DRY—*Don't Repeat Yourself*).</li>
                    <li>**Penamaan yang Buruk:** Menggunakan nama variabel yang ambigu, menyulitkan pembacaan kode (dan debugging) di masa depan.</li>
                </ul>

                <h3>Praktik Terbaik</h3>
                <p>
                    Selalu uji langkah ini secara independen. Jika Anda sedang mempelajari Git, pastikan Anda membuat *commit* atomik (hanya berisi satu perubahan logis). Jika Anda mempelajari API, uji *endpoint* GET sebelum mencoba POST.
                </p>
                
            </div>

            <div class="mt-10 pt-4 border-t text-center">
                {{-- Tautan kembali ke halaman detail materi (Level 3) --}}
                <a href="{{ route('materi.show', ['materiId' => $materi->id]) }}" class="text-blue-600 font-semibold hover:underline">
                    ← Kembali ke Daftar Langkah di {{ $materi->title }}
                </a>
            </div>
        </article>
    </main>
</body>
</html>