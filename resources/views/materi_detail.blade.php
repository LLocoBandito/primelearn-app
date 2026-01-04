<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $currentMateri->title }} | {{ $segmentName }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            -webkit-line-clamp: 3;
        }
        /* Menghilangkan scrollbar tapi fungsi scroll tetap ada */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">

    @include('components.navbar')

    <main class="max-w-7xl mx-auto p-6 md:p-10">

        @php
            use Illuminate\Support\Str;
            use Illuminate\Support\Facades\Storage;
            
            // Inisialisasi data untuk mempermudah pemanggilan
            $segment = $fase->segment;
            $completedSteps = session()->get('completed_steps', []);
            $sortedSteps = $currentMateri->steps->sortBy('order')->values();
        @endphp

        {{-- BREADCRUMB (Gaya disamakan dengan Step Detail) --}}
        <nav class="flex items-center text-xs md:text-sm text-gray-500 mb-6 space-x-2 overflow-x-auto whitespace-nowrap pb-2 no-scrollbar">
            <div class="flex items-center">
                <a href="{{ route('segments.index') }}" class="hover:text-blue-600 transition-colors flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Segments
                </a>
            </div>
            
            <div class="flex items-center">
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                </svg>
                <a href="{{ route('segment.show', $segment->id) }}" class="ml-1 hover:text-blue-600">
                    {{ Str::limit($segmentName, 20) }}
                </a>
            </div>

            <div class="flex items-center">
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                </svg>
                <span class="ml-1 text-gray-700 font-bold italic truncate">
                    {{ $currentMateri->title }}
                </span>
            </div>
        </nav>

        <h1 class="text-3xl md:text-4xl font-extrabold text-blue-800 mb-2">
            📖 {{ $currentMateri->title }}
        </h1>
        <p class="text-gray-600 mb-8">Detail pembelajaran langkah demi langkah untuk materi ini.</p>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- KOLOM KIRI: MATERI LAIN --}}
            <aside class="lg:col-span-1 bg-white p-5 rounded-lg shadow-xl lg:sticky lg:top-4 lg:h-fit">
                <h2 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">Materi Lainnya</h2>

                <ul class="space-y-2">
                    @foreach ($fase->materis as $materi)
                        <li class="p-2 rounded transition border-l-4 
                            @if($materi->id === $currentMateri->id) bg-blue-50 border-blue-600 font-bold @else hover:bg-gray-50 border-transparent @endif">
                            <a href="{{ route('materi.show', ['materiId' => $materi->id]) }}"
                                class="@if($materi->id === $currentMateri->id) text-blue-800 @else text-gray-800 @endif block">
                                {{ $materi->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>

            {{-- KOLOM TENGAH/UTAMA: DAFTAR LANGKAH (STEPS) --}}
            <section class="lg:col-span-2 main-content-area">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Langkah-Langkah Pembelajaran:</h2>

                @forelse ($sortedSteps as $index => $step)
                    @php
                        $isFirstStep = ($index === 0);
                        $prevStepId = !$isFirstStep ? $sortedSteps[$index - 1]->id : null;
                        $isUnlocked = $isFirstStep || in_array($prevStepId, $completedSteps);
                        $isCompleted = in_array($step->id, $completedSteps);
                        $firstImage = $step->images->first(); 
                    @endphp

                    @if($isUnlocked)
                        <a href="{{ route('step.show', ['stepId' => $step->id]) }}"
                            class="block mb-8 p-6 bg-white rounded-xl shadow-lg border-l-4 border-blue-500 hover:shadow-xl transition duration-300 transform hover:scale-[1.01]">
                    @else
                        <div class="block mb-8 p-6 bg-gray-200 opacity-60 rounded-xl shadow border-l-4 border-gray-400 cursor-not-allowed">
                    @endif

                        <h3 class="text-xl font-bold {{ $isUnlocked ? 'text-blue-700' : 'text-gray-500' }} mb-3 flex items-center gap-2">
                            Langkah {{ $step->order }}: {{ $step->title }}
                            @if($isCompleted)
                                <span class="text-green-500 text-sm bg-green-100 px-2 py-1 rounded">✓ Selesai</span>
                            @endif
                            @if(!$isUnlocked)
                                <span class="text-gray-500 text-sm">🔒 Terkunci</span>
                            @endif
                        </h3>

                        @if ($firstImage && $firstImage->path && Storage::disk('public')->exists($firstImage->path))
                            <div class="h-40 md:h-64 bg-gray-200 rounded-lg mb-4 overflow-hidden {{ !$isUnlocked ? 'grayscale' : '' }}">
                                <img src="{{ asset('storage/' . $firstImage->path) }}" alt="{{ $step->title }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="h-40 md:h-64 bg-gray-100 rounded-lg mb-4 flex items-center justify-center border border-dashed border-gray-400">
                                <span class="text-gray-500 italic text-sm">Ilustrasi Tidak Tersedia</span>
                            </div>
                        @endif

                        <p class="text-gray-700 leading-relaxed line-clamp-3">
                            {{ Str::limit(strip_tags($step->content), 150) }}
                        </p>

                        @if($isUnlocked)
                            <p class="mt-4 text-sm font-semibold text-blue-600">Baca Selengkapnya →</p>
                        @else
                            <p class="mt-4 text-sm font-semibold text-gray-500 italic">Selesaikan langkah sebelumnya untuk membuka</p>
                        @endif

                    @if($isUnlocked)
                        </a>
                    @else
                        </div>
                    @endif

                @empty
                    <div class="p-6 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 rounded">
                        Belum ada langkah-langkah detail yang ditambahkan untuk materi ini.
                    </div>
                @endforelse
            </section>
        </div>
    </main>
</body>
</html>