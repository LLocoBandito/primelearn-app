@php 
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    $materi = $step->materi;
    $segment = $materi->fase->segment; 

    $segmentsUrl = route('segments.index'); 
    $segmentDetailUrl = route('segment.show', $segment->id);
    $materiUrl = route('materi.show', $materi->id);

    $segmentName = $segment->name ?? 'Course';
    $materiTitle = $materi->title ?? 'Materi';

    $externalLinks = $step->external_links ?? ($step->materi->externalLinks ?? []);
    $quizData = $step->quiz_data ?? [];

    $videoEmbedUrl = $step->video_url;
    if ($videoEmbedUrl) {
        if (Str::contains($videoEmbedUrl, 'youtube.com/watch?v=')) {
            $videoEmbedUrl = Str::replace('watch?v=', 'embed/', $videoEmbedUrl);
        } elseif (Str::contains($videoEmbedUrl, 'youtu.be/')) {
            $videoEmbedUrl = 'https://www.youtube.com/embed/' . Str::afterLast($videoEmbedUrl, '/');
        }
    }

    $isQuizRequired = !empty($quizData);
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step {{ $step->order }}: {{ $step->title }} | {{ $segmentName }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { brand: '#1e3a8a' } } },
        }
    </script>
    <style>
        .prose p { margin-bottom: 1.5em !important; }
        html { scroll-behavior: smooth; }
        #sliderWrapper { scroll-snap-type: x mandatory; -ms-overflow-style: none; scrollbar-width: none; }
        #sliderWrapper::-webkit-scrollbar { display: none; }
        .slide-item { scroll-snap-align: start; }
        #scroll-toast { transition: all 0.5s ease; transform: translateY(100px); opacity: 0; }
        #scroll-toast.show { transform: translateY(0); opacity: 1; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>

<body class="bg-gray-100 min-h-screen font-sans antialiased text-gray-900">

    <div id="scroll-toast" class="fixed bottom-10 left-1/2 -translate-x-1/2 z-50 bg-green-600 text-white px-6 py-3 rounded-full shadow-2xl flex items-center space-x-3">
        <span>✅ Progress Disimpan</span>
    </div>

    <main class="max-w-7xl mx-auto p-4 md:p-10 md:flex md:space-x-8">

        {{-- SIDEBAR KIRI (Daftar Isi & Referensi) --}}
        <aside class="md:w-1/4 mb-6 md:mb-0 hidden md:block sticky top-10 self-start space-y-6">
            
            {{-- DAFTAR ISI --}}
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2 flex items-center">
                    <span class="mr-2">📖</span> Daftar Isi
                </h3>
                <nav><ul id="tocList" class="space-y-2 text-sm text-gray-600"></ul></nav>
            </div>

            {{-- REFERENSI (Dipindah ke sini) --}}
            @if(count($externalLinks) > 0)
                <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
                    <h3 class="text-sm font-bold text-blue-900 mb-4 border-b pb-2 flex items-center">
                        <span class="mr-2">🔗</span> Referensi Luar
                    </h3>
                    <div class="space-y-3">
                        @foreach($externalLinks as $link)
                            <a href="{{ is_array($link) ? $link['url'] : $link }}" target="_blank" 
                               class="block p-3 bg-blue-50 border border-blue-100 rounded-lg hover:bg-blue-100 transition-all text-xs">
                                <span class="text-blue-700 font-medium line-clamp-2">
                                    {{ is_array($link) ? $link['title'] : 'Lihat Referensi' }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </aside>

        {{-- KONTEN UTAMA --}}
        <div class="w-full md:w-3/4">

            {{-- BREADCRUMB --}}
            <nav class="flex items-center text-xs md:text-sm text-gray-500 mb-6 space-x-2 overflow-x-auto whitespace-nowrap pb-2 no-scrollbar">
                <div class="flex items-center">
                    <a href="{{ $segmentsUrl }}" class="hover:text-blue-600 transition-colors flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        Segments
                    </a>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg>
                    <a href="{{ $segmentDetailUrl }}" class="ml-1 hover:text-blue-600">{{ Str::limit($segmentName, 20) }}</a>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg>
                    <a href="{{ $materiUrl }}" class="ml-1 hover:text-blue-600">{{ Str::limit($materiTitle, 20) }}</a>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg>
                    <span class="ml-1 text-gray-700 font-bold italic truncate">Step {{ $step->order }}</span>
                </div>
            </nav>

            <article class="bg-white p-6 md:p-10 rounded-2xl shadow-xl border border-gray-100">
                <h1 class="text-3xl md:text-4xl font-extrabold text-blue-900 mb-4">{{ $step->title }}</h1>
                <div class="w-20 h-1 bg-blue-600 rounded-full mb-8"></div>

                {{-- SLIDER --}}
                @if ($step->images && $step->images->count() > 0)
                    <div class="relative mb-10 group overflow-hidden rounded-xl shadow-lg bg-gray-900">
                        <div id="sliderWrapper" class="flex transition-transform duration-500">
                            @foreach ($step->images as $img)
                                <div class="w-full flex-shrink-0 flex justify-center items-center slide-item">
                                    <img src="{{ asset('storage/' . $img->path) }}" class="object-contain max-h-[500px] w-full" alt="Slide">
                                </div>
                            @endforeach
                        </div>
                        @if($step->images->count() > 1)
                            <button id="prevBtn" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/50 text-white p-3 rounded-full opacity-0 group-hover:opacity-100 transition-all">←</button>
                            <button id="nextBtn" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/50 text-white p-3 rounded-full opacity-0 group-hover:opacity-100 transition-all">→</button>
                        @endif
                    </div>
                @endif

                {{-- VIDEO --}}
                @if ($videoEmbedUrl)
                    <div class="mb-10 aspect-video rounded-xl overflow-hidden shadow-lg border-4 border-white">
                        <iframe width="100%" height="100%" src="{{ $videoEmbedUrl }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                @endif

                {{-- CONTENT --}}
                <div class="prose prose-blue prose-lg max-w-none text-gray-800">
                    {!! $step->content !!}
                </div>

                {{-- KUIS --}}
                @if ($isQuizRequired)
                    <div class="mt-16 p-6 md:p-8 bg-gradient-to-br from-yellow-50 to-orange-50 border-2 border-yellow-200 rounded-2xl" id="quiz-section">
                        <h2 class="text-2xl font-bold text-yellow-900 mb-6">❓ Uji Pemahaman</h2>
                        <form id="quiz-form" data-step-id="{{ $step->id }}">
                            @csrf
                            @foreach ($quizData as $idx => $quiz)
                                <div class="mb-8 p-5 bg-white rounded-xl shadow-sm">
                                    <p class="font-medium text-gray-800 mb-4">{{ $quiz['question'] }}</p>
                                    <div class="grid gap-2">
                                        @foreach ($quiz['options'] as $opt)
                                            <label class="flex items-center p-3 rounded-lg border border-gray-100 cursor-pointer hover:bg-blue-50 transition-all">
                                                <input type="radio" name="answers[{{ $idx }}]" value="{{ $opt['option'] }}" class="w-4 h-4 text-blue-600">
                                                <span class="ml-3 text-gray-700">{{ $opt['option'] }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" id="submitQuizBtn" class="w-full bg-blue-600 text-white font-bold py-4 rounded-xl shadow-lg">Periksa Jawaban</button>
                            <div id="quiz-result" class="mt-6 text-center p-4 rounded-xl font-bold hidden"></div>
                        </form>
                    </div>
                @endif
            </article>

            {{-- NAVIGASI BAWAH --}}
            <div class="flex flex-col md:flex-row justify-between items-center mt-12 p-6 bg-white rounded-2xl shadow-lg border border-gray-100 gap-4">
                @if ($prevStep)
                    <a href="{{ route('step.show', $prevStep->id) }}" class="text-blue-600 font-bold px-6 py-3">← Kembali</a>
                @else
                    <span class="text-gray-400 italic">Awal Materi</span>
                @endif

                @if ($nextStep)
                    @if($isQuizRequired)
                        <a href="#" id="nextStepBtn" data-next-id="{{ $nextStep->id }}" class="bg-green-500 text-white font-bold py-4 px-12 rounded-xl opacity-50 cursor-not-allowed">Lanjut →</a>
                    @else
                        <form action="{{ route('step.complete', $step->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="next_step_id" value="{{ $nextStep->id }}">
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-12 rounded-xl transition transform hover:scale-105">Lanjut →</button>
                        </form>
                    @endif
                @else
                    <form action="{{ route('materi.complete', ['stepId' => $step->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-12 rounded-xl">Selesai 🎉</button>
                    </form>
                @endif
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // TOC Logic
            const headings = document.querySelector('.prose').querySelectorAll('h2, h3');
            const tocList = document.getElementById('tocList');
            headings.forEach((h, i) => {
                h.id = `section-${i}`;
                const li = document.createElement('li');
                li.innerHTML = `<a href="#section-${i}" class="hover:text-blue-600 block py-1">${h.innerText}</a>`;
                if(h.tagName === 'H3') li.classList.add('ml-4', 'text-xs');
                tocList.appendChild(li);
            });

            // Slider
            const wrapper = document.getElementById('sliderWrapper');
            const totalSlides = {{ $step->images ? $step->images->count() : 0 }};
            let currentIndex = 0;
            if (wrapper && totalSlides > 1) {
                document.getElementById('nextBtn').onclick = () => { currentIndex = (currentIndex + 1) % totalSlides; wrapper.style.transform = `translateX(-${currentIndex * 100}%)`; };
                document.getElementById('prevBtn').onclick = () => { currentIndex = (currentIndex - 1 + totalSlides) % totalSlides; wrapper.style.transform = `translateX(-${currentIndex * 100}%)`; };
            }
        });
    </script>
</body>
</html>