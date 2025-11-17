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
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    
    <header class="bg-blue-900 text-white p-4 shadow-lg">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <p class="text-base hidden sm:block">Fase: {{ $fase->name }}</p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto p-6 md:p-10">
        <div class="text-sm text-gray-500 mb-4">
            {{-- KOREKSI: Menggunakan 'segment' sebagai kunci parameter sesuai route/web.php --}}
            <a href="{{ route('course.show', ['segment' => $segmentName]) }}" class="hover:underline">{{ $segmentName }}</a> 
            &gt; {{ $fase->name }} 
            &gt; <span class="text-blue-700 font-semibold">{{ $currentMateri->title }}</span>
        </div>
        
        <h1 class="text-3xl md:text-4xl font-extrabold text-blue-800 mb-2">
            📖 {{ $currentMateri->title }}
        </h1>
        <p class="text-gray-600 mb-8">Detail pembelajaran langkah demi langkah untuk materi ini.</p>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <aside class="lg:col-span-1 bg-white p-5 rounded-lg shadow-xl lg:sticky lg:top-4 lg:h-fit">
                <h2 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">Materi Lain di {{ $fase->name }}</h2>
                
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

            <section class="lg:col-span-2 main-content-area">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Langkah-Langkah Pembelajaran:</h2>

                {{-- LOOPING UNTUK MENAMPILKAN STEP-BY-STEP --}}
                @forelse ($currentMateri->steps as $step)
                    {{-- SETIAP STEP ADALAH LINK KE HALAMAN STEP DETAIL (LEVEL 4) --}}
                    <a href="{{ route('step.show', ['stepId' => $step->id]) }}" 
                       class="block mb-8 p-6 bg-white rounded-xl shadow-lg border-l-4 border-blue-500 hover:shadow-xl transition duration-300 transform hover:scale-[1.01]">
                        
                        <h3 class="text-xl font-bold text-blue-700 mb-3">
                            Langkah {{ $step->order }}: {{ $step->title }}
                        </h3>
                        
                        @if ($step->image_path)
                            <div class="h-auto max-h-80 bg-gray-200 rounded-lg mb-4 overflow-hidden">
                                <img src="{{ asset($step->image_path) }}" alt="{{ $step->title }} Illustration" class="w-full h-full object-cover">
                            </div>
                        @endif

                        {{-- Menampilkan ringkasan konten --}}
                        <p class="text-gray-700 leading-relaxed line-clamp-3">
                            {{-- Menggunakan Str::limit untuk memotong konten menjadi 150 karakter --}}
                            {{ Str::limit($step->content, 150) }}
                        </p>
                        <p class="mt-4 text-sm font-semibold text-blue-600">Baca Selengkapnya →</p>
                    </a>
                @empty
                    <div class="p-6 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 rounded">
                        Belum ada langkah-langkah detail yang ditambahkan untuk materi ini.
                    </div>
                @endforelse
            </section>

            <aside class="lg:col-span-1 bg-white p-5 rounded-lg shadow-xl lg:sticky lg:top-4 lg:h-fit">
                <h2 class="text-xl font-bold text-gray-700 mb-4 border-b pb-2">🔗 Sumber Eksternal</h2>
                <p class="text-sm text-gray-500 mb-5">
                    Link ke dokumentasi resmi atau video tutorial terkait.
                </p>

                {{-- SIMULASI LINK EKSTERNAL --}}
                @for ($i = 0; $i < 4; $i++)
                    <div class="flex space-x-3 mb-4 p-3 border-b hover:bg-gray-50 cursor-pointer">
                        <div class="w-12 h-8 bg-pink-100 rounded-md flex-shrink-0 flex items-center justify-center text-pink-600">
                            DOC
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-pink-700">Official Docs: Topik X</p>
                            <p class="text-xs text-gray-500">Kebutuhan untuk {{ $currentMateri->title }}.</p>
                        </div>
                    </div>
                @endfor
            </aside>
            
        </div>
        </main>
</body>
</html>