<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $currentMateri->title }} | {{ $segmentName }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* CSS untuk membatasi teks (diperlukan untuk Str::limit) */
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            -webkit-line-clamp: 3; /* Batasi hingga 3 baris */
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Asumsi komponen navbar ada di path ini --}}
    @include('components.navbar')

    <main class="max-w-7xl mx-auto p-6 md:p-10">
        
        @php
            use Illuminate\Support\Str;
            use Illuminate\Support\Facades\Storage;
        @endphp

        {{-- Breadcrumb --}}
        <div class="text-sm text-gray-500 mb-4">
            {{-- Asumsi $fase memiliki properti 'name' atau 'title' --}}
            <a href="{{ route('course.show', ['segment' => $segmentName]) }}" class="hover:underline">{{ $segmentName }}</a> 
            &gt; {{ $fase->title ?? 'Fase' }} 
            &gt; <span class="text-blue-700 font-semibold">{{ $currentMateri->title }}</span>
        </div>
        
        <h1 class="text-3xl md:text-4xl font-extrabold text-blue-800 mb-2">
            📖 {{ $currentMateri->title }}
        </h1>
        <p class="text-gray-600 mb-8">Detail pembelajaran langkah demi langkah untuk materi ini.</p>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            {{-- KOLOM KIRI: MATERI LAIN --}}
            <aside class="lg:col-span-1 bg-white p-5 rounded-lg shadow-xl lg:sticky lg:top-4 lg:h-fit">
                <h2 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">Materi Lain di {{ $fase->title ?? 'Fase Ini' }}</h2>
                
                <ul class="space-y-2">
                    @foreach ($fase->materis as $materi)
                        <li class="p-2 rounded transition border-l-4 
                            @if($materi->id === $currentMateri->id) bg-teal-100 border-teal-600 font-bold @else hover:bg-gray-50 border-transparent @endif">
                            <a href="{{ route('materi.show', ['materiId' => $materi->id]) }}" 
                                class="@if($materi->id === $currentMateri->id) text-teal-800 @else text-gray-800 @endif block">
                                {{ $materi->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>

            {{-- KOLOM TENGAH: DAFTAR LANGKAH (STEPS) --}}
            <section class="lg:col-span-2 main-content-area">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Langkah-Langkah Pembelajaran:</h2>

                @forelse ($currentMateri->steps as $step)
                    {{-- SETIAP STEP ADALAH LINK KE HALAMAN STEP DETAIL --}}
                    <a href="{{ route('step.show', ['stepId' => $step->id]) }}" 
                        class="block mb-8 p-6 bg-white rounded-xl shadow-lg border-l-4 border-blue-500 hover:shadow-xl transition duration-300 transform hover:scale-[1.01]">
                        
                        <h3 class="text-xl font-bold text-blue-700 mb-3">
                            Langkah {{ $step->order }}: {{ $step->title }}
                        </h3>
                        
                        {{-- **KOREKSI TOTAL UNTUK GAMBAR FILAMENT DARI RELASI 'images'** --}}
                        @php
                            // Ambil objek gambar pertama dari relasi 'images'
                            // Asumsi $step->images di-eager load di Controller
                            $firstImage = $step->images->first(); 
                        @endphp

                        @if ($firstImage && $firstImage->path && Storage::disk('public')->exists($firstImage->path))
                            <div class="h-40 md:h-64 bg-gray-200 rounded-lg mb-4 overflow-hidden">
                                {{-- Kunci: Menggunakan asset('storage/' . path_relatif) --}}
                                <img src="{{ asset('storage/' . $firstImage->path) }}" 
                                    alt="{{ $step->title }} Ilustrasi" 
                                    class="w-full h-full object-cover">
                            </div>
                        @else
                            {{-- Placeholder jika gambar tidak ada/tidak ditemukan --}}
                            <div class="h-40 md:h-64 bg-gray-100 rounded-lg mb-4 flex items-center justify-center border border-dashed border-gray-400">
                                <span class="text-gray-500 italic text-sm">Ilustrasi Tidak Tersedia</span>
                            </div>
                        @endif
                        {{-- **AKHIR KOREKSI GAMBAR** --}}

                        {{-- Menampilkan ringkasan konten (strip_tags untuk menghilangkan HTML Rich Editor) --}}
                        <p class="text-gray-700 leading-relaxed line-clamp-3">
                            {{ Str::limit(strip_tags($step->content), 150) }}
                        </p>
                        <p class="mt-4 text-sm font-semibold text-blue-600">Baca Selengkapnya →</p>
                    </a>
                @empty
                    <div class="p-6 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 rounded">
                        Belum ada langkah-langkah detail yang ditambahkan untuk materi ini.
                    </div>
                @endforelse
            </section>

            {{-- KOLOM KANAN: SUMBER EKSTERNAL --}}
            <aside class="lg:col-span-1 bg-white p-5 rounded-lg shadow-xl lg:sticky lg:top-4 lg:h-fit">
                <h2 class="text-xl font-bold text-gray-700 mb-4 border-b pb-2">🔗 Sumber Eksternal</h2>
                <p class="text-sm text-gray-500 mb-5">
                    Link ke dokumentasi resmi atau video tutorial terkait.
                </p>
                
                @php
                    // Pastikan $currentMateri->externalLinks di-cast sebagai array/Collection di Model Materi
                    $externalLinks = $currentMateri->externalLinks ?? [];
                    $iconStyles = [
                        'doc' => ['bg-pink-100', 'text-pink-600', 'DOC'],
                        'video' => ['bg-red-100', 'text-red-600', 'VID'],
                        'article' => ['bg-blue-100', 'text-blue-600', 'ART'],
                        'other' => ['bg-gray-100', 'text-gray-600', 'LINK'],
                    ];
                @endphp
                
                @forelse ($externalLinks as $link)
                    @php
                        // Asumsi $link adalah array atau objek dengan properti title, url, dan type
                        // Jika 'type' tidak ada, default ke 'other'
                        $type = $link['type'] ?? 'other'; 
                        [$bgColor, $textColor, $iconText] = $iconStyles[$type] ?? $iconStyles['other'];
                    @endphp

                    <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" class="block">
                        <div class="flex space-x-3 mb-4 p-3 border-b hover:bg-gray-50 transition rounded-md">
                            <div class="w-12 h-8 {{ $bgColor }} rounded-md flex-shrink-0 flex items-center justify-center text-sm font-bold {{ $textColor }}">
                                {{ $iconText }}
                            </div>
                            <div class="truncate">
                                <p class="text-sm font-semibold text-gray-700 truncate">{{ $link['title'] }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ $link['url'] }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="p-3 bg-gray-50 text-gray-500 rounded-md border-dashed border">
                        <p class="text-sm italic">Belum ada sumber eksternal yang ditambahkan untuk materi ini.</p>
                    </div>
                @endforelse
            </aside>
            
        </div>
    </main>
</body>
</html>