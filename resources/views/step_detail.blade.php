@php 
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    // Inisialisasi data relasi
    $materi = $step->materi;
    $fase = $materi->fase;
    $segment = $fase->segment;

    // Ambil data untuk breadcrumb
    $segmentName = $segment->name ?? 'Course';

    $faseTitleRaw = $fase->title ?? 'Fase';
    $displayFase = Str::contains(strtolower($faseTitleRaw), 'fase')
        ? $faseTitleRaw
        : 'Fase ' . $faseTitleRaw;

    $materiTitle = $materi->title ?? 'Materi';

    // Ambil data external links & kuis
    $externalLinks = $step->external_links ?? ($step->materi->externalLinks ?? []);
    $quizData = $step->quiz_data ?? [];

    // === LOGIKA TRANSFORMASI VIDEO YOUTUBE ===
    $videoEmbedUrl = $step->video_url;
    if ($videoEmbedUrl) {
        if (Str::contains($videoEmbedUrl, 'youtube.com/watch?v=')) {
            $videoEmbedUrl = Str::replace('watch?v=', 'embed/', $videoEmbedUrl);
        } elseif (Str::contains($videoEmbedUrl, 'youtu.be/')) {
            $videoEmbedUrl = 'https://www.youtube.com/embed/' . Str::afterLast($videoEmbedUrl, '/');
        }
    }

    // Logika Navigasi
    $isQuizRequired = !empty($quizData);
    $nextRoute = $nextStep ? route('step.show', ['stepId' => $nextStep->id]) : '#';
    $defaultNextHref = $isQuizRequired ? '#' : $nextRoute;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Langkah {{ $step->order }}: {{ $step->title }} | {{ $segmentName }}</title>

    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#1e3a8a',
                    }
                },
            },
        }
    </script>
    
    <style>
        .prose p { margin-bottom: 1.5em !important; }
        .prose ul { list-style-type: disc; }
        .prose ol { list-style-type: decimal; }
        html { scroll-behavior: smooth; }

        /* Custom Scrollbar untuk slider jika user swipe manual */
        #sliderWrapper {
            scroll-snap-type: x mandatory;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        #sliderWrapper::-webkit-scrollbar { display: none; }
        .slide-item { scroll-snap-align: start; }
    </style>
</head>

<body class="bg-gray-100 min-h-screen font-sans antialiased text-gray-900">

    <main class="max-w-7xl mx-auto p-4 md:p-10 md:flex md:space-x-8">

        {{-- KOLOM KIRI: DAFTAR ISI --}}
        <aside class="md:w-1/4 mb-6 md:mb-0 hidden md:block sticky top-10 self-start">
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2 flex items-center">
                    <span class="mr-2">📖</span> Daftar Isi
                </h3>
                <nav>
                    <ul id="tocList" class="space-y-2 text-sm text-gray-600"></ul>
                </nav>
            </div>
        </aside>

        {{-- KOLOM KANAN: KONTEN UTAMA --}}
        <div class="w-full md:w-3/4">

            {{-- BREADCRUMB --}}
            <nav class="flex items-center text-xs md:text-sm text-gray-500 mb-6 space-x-2 overflow-x-auto whitespace-nowrap pb-2">
                <a href="#" class="text-blue-600 hover:underline">{{ Str::limit($segmentName, 20) }}</a>
                <span class="text-gray-400">/</span>
                <a href="#" class="text-blue-600 hover:underline">{{ Str::limit($displayFase, 20) }}</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('materi.show', $materi->id) }}" class="text-blue-600 hover:underline">{{ Str::limit($materiTitle, 25) }}</a>
                <span class="text-gray-400">/</span>
                <span class="text-gray-700 font-semibold italic">{{ Str::limit($step->title, 25) }}</span>
            </nav>

            <article class="bg-white p-6 md:p-10 rounded-2xl shadow-xl border border-gray-100">
                <h1 class="text-3xl md:text-4xl font-extrabold text-blue-900 mb-4 leading-tight">
                    {{ $step->title }}
                </h1>
                <div class="w-20 h-1 bg-blue-600 rounded-full mb-8"></div>

                {{-- SLIDER GAMBAR DENGAN TOMBOL NAVIGASI --}}
                @if ($step->images && $step->images->count() > 0)
                    <div class="relative mb-10 group">
                        <div class="relative w-full overflow-hidden bg-gray-900 rounded-xl border border-gray-200 shadow-lg">
                            {{-- Wrapper Slides --}}
                            <div id="sliderWrapper" class="flex transition-transform duration-500 ease-in-out">
                                @foreach ($step->images as $img)
                                    <div class="w-full flex-shrink-0 flex justify-center items-center bg-black slide-item">
                                        <img src="{{ asset('storage/' . $img->path) }}"
                                             class="object-contain max-h-[500px] w-full"
                                             alt="Gambar Langkah">
                                    </div>
                                @endforeach
                            </div>

                            {{-- Tombol Navigasi (Hanya muncul jika gambar > 1) --}}
                            @if($step->images->count() > 1)
                                <button id="prevBtn" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/50 text-white p-3 rounded-full backdrop-blur-md transition-all opacity-0 group-hover:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <button id="nextBtn" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/50 text-white p-3 rounded-full backdrop-blur-md transition-all opacity-0 group-hover:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>

                                {{-- Indikator (Dots) --}}
                                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
                                    @foreach ($step->images as $index => $img)
                                        <div class="dot w-2 h-2 rounded-full bg-white/50 transition-all" data-index="{{ $index }}"></div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- VIDEO YOUTUBE --}}
                @if ($videoEmbedUrl)
                    <div class="mb-10 overflow-hidden rounded-xl shadow-lg aspect-video bg-black border-4 border-white">
                        <iframe width="100%" height="100%" src="{{ $videoEmbedUrl }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                                class="w-full">
                        </iframe>
                    </div>
                @endif

                {{-- KONTEN RICH EDITOR --}}
                <div class="prose prose-blue prose-lg max-w-none text-gray-800">
                    {!! $step->content !!}
                </div>

                {{-- KUIS --}}
                @if ($isQuizRequired)
                    <div class="mt-16 p-6 md:p-8 bg-gradient-to-br from-yellow-50 to-orange-50 border-2 border-yellow-200 rounded-2xl shadow-inner" id="quiz-section">
                        <h2 class="text-2xl font-bold text-yellow-900 mb-6 flex items-center">
                            <span class="mr-3 p-2 bg-yellow-200 rounded-lg">❓</span> Uji Pemahaman Anda
                        </h2>
                        <form id="quiz-form" data-step-id="{{ $step->id }}">
                            @csrf
                            @foreach ($quizData as $index => $quiz)
                                <div class="mb-8 p-5 bg-white rounded-xl shadow-sm border border-yellow-100">
                                    <p class="text-sm font-bold text-orange-600 uppercase mb-2">Pertanyaan {{ $index + 1 }}</p>
                                    <p class="text-lg font-medium text-gray-800 mb-5">{{ $quiz['question'] }}</p>
                                    <div class="grid gap-3">
                                        @foreach ($quiz['options'] as $option)
                                            <label class="flex items-center p-4 rounded-xl border border-gray-200 cursor-pointer hover:bg-blue-50 hover:border-blue-300 transition-all group">
                                                <input type="radio" name="answers[{{ $index }}]" value="{{ $option['option'] }}" class="w-5 h-5 text-blue-600">
                                                <span class="ml-4 text-gray-700 group-hover:text-blue-900 font-medium">{{ $option['option'] }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <div class="flex flex-col items-center">
                                <button type="submit" id="submitQuizBtn" class="w-full md:w-64 bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-xl shadow-xl transition-all transform hover:-translate-y-1">
                                    Periksa Jawaban
                                </button>
                                <div id="quiz-result" class="mt-6 w-full text-center p-4 rounded-xl font-bold hidden"></div>
                            </div>
                        </form>
                    </div>
                @endif
            </article>

            {{-- NAVIGASI STEPS --}}
            <div class="flex flex-col md:flex-row justify-between items-center mt-12 p-6 bg-white rounded-2xl shadow-lg border border-gray-100 gap-4">
                @if ($prevStep)
                    <a href="{{ route('step.show', $prevStep->id) }}" class="flex items-center px-6 py-3 text-blue-600 font-bold hover:bg-blue-50 rounded-xl transition">
                        <span class="mr-2 text-xl">←</span> {{ Str::limit($prevStep->title, 15) }}
                    </a>
                @else
                    <span class="text-gray-400 italic text-sm">Awal Materi</span>
                @endif

                @if ($nextStep)
                    <a href="{{ $defaultNextHref }}" id="nextStepBtn" data-next-id="{{ $nextStep->id }}"
                       class="w-full md:w-auto text-center bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-12 rounded-xl shadow-lg transition {{ $isQuizRequired ? 'opacity-50 cursor-not-allowed' : 'hover:scale-105' }}">
                        Lanjut →
                    </a>
                @else
                    <form action="{{ route('materi.complete', ['stepId' => $step->id]) }}" method="POST" class="w-full md:w-auto">
                        @csrf
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-12 rounded-xl shadow-lg transition transform hover:scale-105">
                            Selesai 🎉
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- LOGIKA SLIDER GAMBAR ---
            const wrapper = document.getElementById('sliderWrapper');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const dots = document.querySelectorAll('.dot');
            let currentIndex = 0;
            const totalSlides = {{ $step->images ? $step->images->count() : 0 }};

            function updateSlider() {
                wrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
                // Update dots
                dots.forEach((dot, i) => {
                    dot.classList.toggle('bg-white', i === currentIndex);
                    dot.classList.toggle('w-4', i === currentIndex);
                    dot.classList.toggle('bg-white/50', i !== currentIndex);
                    dot.classList.toggle('w-2', i !== currentIndex);
                });
            }

            if(nextBtn) {
                nextBtn.addEventListener('click', () => {
                    currentIndex = (currentIndex + 1) % totalSlides;
                    updateSlider();
                });
            }

            if(prevBtn) {
                prevBtn.addEventListener('click', () => {
                    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                    updateSlider();
                });
            }

            // Inisialisasi posisi dot pertama
            if(totalSlides > 0) updateSlider();


            // --- LOGIKA TOC ---
            const contentContainer = document.querySelector('.prose');
            const tocList = document.getElementById('tocList');
            if (contentContainer && tocList) {
                const headings = contentContainer.querySelectorAll('h2, h3');
                headings.forEach((heading) => {
                    let id = heading.textContent.toLowerCase().trim().replace(/\s+/g, '-').replace(/[^\w-]/g, '');
                    heading.id = id;
                    const li = document.createElement('li');
                    li.innerHTML = `<a href="#${id}" class="hover:text-blue-600 block truncate py-1 border-l-2 border-transparent hover:border-blue-400 pl-2 transition-all">${heading.textContent}</a>`;
                    if (heading.tagName === 'H3') li.classList.add('ml-4', 'text-xs');
                    tocList.appendChild(li);
                });
            }

            // --- LOGIKA KUIS AJAX ---
            const quizForm = document.getElementById('quiz-form');
            if (quizForm) {
                quizForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const resultDiv = document.getElementById('quiz-result');
                    const submitBtn = document.getElementById('submitQuizBtn');
                    const formData = new FormData(this);
                    const answers = {};
                    formData.forEach((value, key) => {
                        if (key.includes('answers')) {
                            const match = key.match(/\[(\d+)\]/);
                            if (match) answers[match[1]] = value;
                        }
                    });

                    if (Object.keys(answers).length < {{ count($quizData) }}) {
                        alert('Harap jawab semua pertanyaan!');
                        return;
                    }

                    submitBtn.disabled = true;
                    submitBtn.innerHTML = "🌀 Mengecek...";

                    fetch(`/step/${this.dataset.stepId}/quiz`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ answers })
                    })
                    .then(res => res.json())
                    .then(data => {
                        resultDiv.classList.remove('hidden');
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = "Periksa Jawaban";
                        if (data.success && (data.score / data.total >= 0.8)) {
                            resultDiv.className = 'mt-6 text-center p-4 rounded-xl bg-green-100 text-green-800 border-2 border-green-300';
                            resultDiv.innerHTML = `🌟 Lulus! Skor: ${data.percentage}%`;
                            const nextBtn = document.getElementById('nextStepBtn');
                            if (nextBtn) {
                                nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                                nextBtn.setAttribute('href', `/step/${nextBtn.dataset.nextId}`);
                            }
                        } else {
                            resultDiv.className = 'mt-6 text-center p-4 rounded-xl bg-red-100 text-red-800 border-2 border-red-300';
                            resultDiv.innerHTML = `❌ Gagal. Skor: ${data.percentage}%. Coba lagi.`;
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>