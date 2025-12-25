<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Langkah {{ $step->order }}: {{ $step->title }} | PrimeLearn</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    typography: {
                        DEFAULT: {
                            css: {
                                maxWidth: 'none',
                                p: { marginBottom: '1.25rem', lineHeight: '1.75' },
                                li: { marginTop: '0.25rem', marginBottom: '0.25rem' },
                            },
                        },
                    },
                },
            },
        }
    </script>

    <style>
        /* Memastikan baris baru dari editor tampil sesuai */
        .step-content-wrapper { white-space: pre-line; }
        .prose ul { list-style-type: disc !important; padding-left: 1.625rem !important; }
        .prose ol { list-style-type: decimal !important; padding-left: 1.625rem !important; }
        
        /* Video Container Responsive */
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 0.75rem;
        }
        .video-container iframe {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen">

@php 
    use Illuminate\Support\Facades\Storage;
    
    $materi = $step->materi;
    $fase = $materi->fase;
    $segment = $fase->segment;
    
    // Fitur: Ambil External Links (mendukung deskripsi)
    $externalLinks = $step->external_links ?? ($materi->external_links ?? []); 
    
    // Fitur: Quiz
    $quizData = $step->quiz_data ?? []; 
    $isQuizRequired = !empty($quizData);

    // Fitur: Auto-Fix Video URL
    $videoUrl = $step->video_url;
    if ($videoUrl) {
        if (str_contains($videoUrl, 'watch?v=')) {
            $videoUrl = str_replace('watch?v=', 'embed/', $videoUrl);
        } elseif (str_contains($videoUrl, 'youtu.be/')) {
            $videoUrl = str_replace('youtu.be/', 'youtube.com/embed/', $videoUrl);
        }
    }

    $nextRoute = $nextStep ? route('step.show', ['stepId' => $nextStep->id]) : '#';
    $defaultNextHref = $isQuizRequired ? '#' : $nextRoute;
@endphp

    <main class="max-w-7xl mx-auto p-4 md:p-10 md:flex md:space-x-8">

        {{-- KOLOM KIRI: SIDEBAR --}}
        <aside class="md:w-1/4 mb-6 md:mb-0 hidden md:block sticky top-6 self-start">
            {{-- DAFTAR ISI --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 mb-6">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4 border-b pb-2">Daftar Isi 📖</h3>
                <nav><ul id="tocList" class="space-y-3 text-sm text-slate-600"></ul></nav>
            </div>

            {{-- EXTERNAL LINKS DENGAN DESKRIPSI --}}
            @if (!empty($externalLinks))
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4 border-b pb-2">Materi Luar 🔗</h3>
                    <div class="space-y-5">
                        @foreach ($externalLinks as $link)
                            <div class="group">
                                <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" 
                                   class="block text-blue-600 font-semibold hover:text-blue-800 transition-colors leading-tight mb-1">
                                    {{ $link['title'] }} 
                                    <span class="inline-block transition-transform group-hover:translate-x-1">→</span>
                                </a>
                                {{-- Menampilkan Deskripsi Singkat jika ada --}}
                                @if(!empty($link['description']))
                                    <p class="text-xs text-slate-500 leading-relaxed italic">
                                        {{ $link['description'] }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </aside>

        {{-- KOLOM KANAN: KONTEN UTAMA --}}
        <div class="w-full md:w-3/4">

            {{-- Breadcrumb --}}
            <nav class="text-xs mb-4 text-slate-400 flex items-center space-x-2">
                <a href="{{ route('segments.index') }}" class="hover:text-blue-600">{{ $segment->name }}</a>
                <span>/</span>
                <a href="{{ route('course.show', $segment->name) }}" class="hover:text-blue-600">{{ $fase->title }}</a>
                <span>/</span>
                <span class="text-slate-600 font-medium">{{ $step->title }}</span>
            </nav>

            <article class="bg-white p-6 md:p-12 rounded-3xl shadow-sm border border-slate-200">
                <h1 class="text-3xl md:text-5xl font-black text-slate-900 mb-6 leading-tight">{{ $step->title }}</h1>
                
                {{-- VIDEO --}}
                @if ($videoUrl)
                    <div class="mb-10 shadow-2xl shadow-blue-100 bg-black rounded-2xl overflow-hidden">
                        <div class="video-container">
                            <iframe src="{{ $videoUrl }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                @endif

                {{-- SLIDER GAMBAR --}}
                @if ($step->images && $step->images->count() > 0)
                    <div class="relative mb-12 overflow-hidden bg-slate-50 rounded-2xl border border-slate-100">
                        <div id="sliderWrapper" class="flex transition-transform duration-700 ease-in-out" data-count="{{ $step->images->count() }}">
                            @foreach ($step->images as $img)
                                <div class="w-full flex-shrink-0 flex justify-center p-4">
                                    <img src="{{ asset('storage/' . $img->path) }}" class="max-h-[550px] object-contain rounded-lg shadow-sm">
                                </div>
                            @endforeach
                        </div>
                        @if ($step->images->count() > 1)
                            <button id="prevBtnSlider" class="absolute top-1/2 left-4 -translate-y-1/2 bg-white/80 backdrop-blur-sm p-4 rounded-full shadow-lg hover:bg-white transition-all text-xl">&lsaquo;</button>
                            <button id="nextBtnSlider" class="absolute top-1/2 right-4 -translate-y-1/2 bg-white/80 backdrop-blur-sm p-4 rounded-full shadow-lg hover:bg-white transition-all text-xl">&rsaquo;</button>
                        @endif
                    </div>
                @endif

                {{-- ISI KONTEN UTAMA --}}
                <div class="prose prose-slate prose-lg max-w-none text-slate-800 step-content-wrapper mb-16">
                    {!! $step->content !!}
                </div>

                {{-- SISTEM QUIZ --}}
                @if ($isQuizRequired)
                    <div class="mt-16 p-8 bg-slate-900 rounded-3xl text-white" id="quiz-section">
                        <div class="flex items-center space-x-3 mb-8">
                            <div class="bg-blue-500 p-2 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            </div>
                            <h2 class="text-2xl font-bold">Uji Pemahaman Anda</h2>
                        </div>

                        <form id="quiz-form" data-step-id="{{ $step->id }}">
                            @csrf
                            @foreach ($quizData as $index => $quiz)
                                <div class="mb-8 last:mb-0">
                                    <p class="text-lg font-medium text-slate-300 mb-4">{{ $index + 1 }}. {{ $quiz['question'] }}</p>
                                    <div class="grid gap-3">
                                        @foreach ($quiz['options'] as $opt)
                                            <label class="flex items-center space-x-4 p-4 rounded-xl border border-slate-700 cursor-pointer hover:bg-slate-800 transition-all group">
                                                <input type="radio" name="answers[{{ $index }}]" value="{{ $opt['option'] }}" class="w-5 h-5 text-blue-500 bg-slate-700 border-slate-600">
                                                <span class="text-slate-400 group-hover:text-white transition-colors">{{ $opt['option'] }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            
                            <div class="mt-10 flex flex-col items-center">
                                <button type="submit" class="w-full md:w-auto bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 px-12 rounded-2xl shadow-xl shadow-blue-900/20 transition-all active:scale-95">
                                    Kirim & Periksa Jawaban
                                </button>
                                <div id="quiz-result" class="mt-6 p-4 rounded-xl hidden w-full text-center font-bold"></div>
                            </div>
                        </form>
                    </div>
                @endif
            </article>

            {{-- NAVIGASI FOOTER --}}
            <div class="flex flex-col md:flex-row justify-between items-center mt-12 gap-6">
                @if ($prevStep)
                    <a href="{{ route('step.show', ['stepId' => $prevStep->id]) }}" class="text-slate-500 font-semibold hover:text-blue-600 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="15 19l-7-7 7-7"></path></svg>
                        Langkah Sebelumnya
                    </a>
                @else
                    <div class="w-32"></div>
                @endif

                @if ($nextStep)
                    <a href="{{ $defaultNextHref }}" id="nextStepBtn" data-next-id="{{ $nextStep->id }}" 
                       class="w-full md:w-auto text-center bg-emerald-500 hover:bg-emerald-400 text-white font-black py-5 px-16 rounded-2xl transition-all shadow-lg shadow-emerald-200 active:scale-95 @if ($isQuizRequired) opacity-30 cursor-not-allowed @endif">
                        LANJUTKAN SEKARANG
                    </a>
                @else
                    <form action="{{ route('materi.complete', ['stepId' => $step->id]) }}" method="POST" class="w-full md:w-auto">
                        @csrf
                        <button class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-5 px-16 rounded-2xl shadow-lg transition-all">
                            SELESAIKAN MATERI 🎉
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Slider Logic
            const wrapper = document.getElementById('sliderWrapper');
            const total = wrapper ? Number(wrapper.dataset.count) : 0;
            let idx = 0;
            if (total > 1) {
                const update = () => { wrapper.style.transform = `translateX(-${idx * 100}%)`; };
                document.getElementById('nextBtnSlider').onclick = () => { idx = (idx + 1) % total; update(); };
                document.getElementById('prevBtnSlider').onclick = () => { idx = (idx - 1 + total) % total; update(); };
            }

            // Table of Contents (TOC)
            const prose = document.querySelector('.prose');
            const toc = document.getElementById('tocList');
            if (prose && toc) {
                prose.querySelectorAll('h2, h3').forEach((h, i) => {
                    const id = `point-${i}`; h.id = id;
                    const li = document.createElement('li');
                    li.className = h.tagName === 'H3' ? 'ml-4 text-xs opacity-70' : 'font-medium';
                    li.innerHTML = `<a href="#${id}" class="hover:text-blue-600 transition-colors block py-1">${h.textContent}</a>`;
                    toc.appendChild(li);
                });
            }

            // Quiz Handler
            const quizForm = document.getElementById('quiz-form');
            if (quizForm) {
                quizForm.onsubmit = async (e) => {
                    e.preventDefault();
                    const formData = new FormData(quizForm);
                    const answers = {};
                    formData.forEach((v, k) => { if(k.includes('answers')) answers[k.match(/\d+/)[0]] = v; });

                    try {
                        const res = await fetch(`/step/${quizForm.dataset.stepId}/quiz`, {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                            body: JSON.stringify({ answers })
                        });
                        const data = await res.json();
                        const resDiv = document.getElementById('quiz-result');
                        resDiv.classList.remove('hidden');

                        if (data.score / data.total >= 0.8) {
                            resDiv.className = "mt-6 p-4 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 rounded-xl block";
                            resDiv.innerHTML = `🌟 Hebat! Skor: ${data.score}/${data.total}. Kamu Lulus!`;
                            const nxt = document.getElementById('nextStepBtn');
                            if(nxt) { nxt.classList.remove('opacity-30', 'cursor-not-allowed'); nxt.href = `/step/${nxt.dataset.nextId}`; }
                        } else {
                            resDiv.className = "mt-6 p-4 bg-rose-500/10 text-rose-400 border border-rose-500/20 rounded-xl block";
                            resDiv.innerHTML = `🧐 Skor: ${data.score}/${data.total}. Yuk coba pelajari lagi materinya!`;
                        }
                    } catch (err) { console.error("Quiz Error:", err); }
                };
            }
        });
    </script>
</body>
</html>