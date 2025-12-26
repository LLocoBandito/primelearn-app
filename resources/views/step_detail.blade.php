<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Langkah {{ $step->order }}: {{ $step->title }} | PrimeLearn</title>
    {{-- Asumsi Anda menggunakan asset() untuk memuat CSS Tailwind Anda --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Konfigurasi Tailwind CSS untuk mengaktifkan typography
        tailwind.config = {
            theme: {
                extend: {},
            },
            // Tambahkan plugin typography jika Anda menggunakannya (memerlukan instalasi jika tidak via CDN)
            // plugins: [
            //     require('@tailwindcss/typography'), 
            // ],
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Anda perlu memastikan komponen ini ada atau ganti dengan HTML navbar statis Anda --}}
    {{-- @include('components.navbar') --}} 

@php  
    // Tentukan apakah tombol next harus dinonaktifkan (karena ada kuis)
    $quizData = $quizData ?? [];
    $externalLinks = $externalLinks ?? [];
    $isQuizRequired = !empty($quizData);

    // Tentukan rute default. Jika ada kuis, default-nya ke '#'.
    $nextRoute = $nextStep ? route('step.show', ['stepId' => $nextStep->id]) : '#';
    $defaultNextHref = $isQuizRequired ? '#' : $nextRoute;
@endphp

    <main class="max-w-7xl mx-auto p-6 md:p-10 md:flex md:space-x-8">

        {{-- KOLOM KIRI: DAFTAR ISI (TOC) & EXTERNAL LINKS --}}
        <aside class="md:w-1/4 mb-6 md:mb-0 hidden md:block sticky top-6 self-start">
            
            {{-- Bagian Daftar Isi (TOC) --}}
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">
                    Daftar Isi 📖
                </h3>
                <nav>
                    <ul id="tocList" class="space-y-2 text-sm">
                        {{-- Diisi secara dinamis oleh JavaScript --}}
                    </ul>
                </nav>
            </div>

            {{-- Bagian External Links --}}
            @if (!empty($externalLinks))
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 mt-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">
                        Sumber Daya Eksternal 🔗
                    </h3>
                    <ul class="space-y-2 text-sm">
                        @foreach ($externalLinks as $link)
                            <li>
                                <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" 
                                class="text-blue-500 hover:text-blue-700 block transition-colors leading-tight">
                                    {{ $link['title'] }}
                                </a>
                                @if (isset($link['description']))
                                   {{ \Illuminate\Support\Str::limit($link['description'], 50) }}
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </aside>

        {{-- KOLOM KANAN: KONTEN UTAMA --}}
        <div class="w-full md:w-3/4">

            {{-- Breadcrumb Navigasi --}}
<nav class="text-sm mb-4 text-gray-600">
    <ol class="list-none p-0 inline-flex">
        <li class="flex items-center">
            @if($step->materi?->fase?->segment)
                <a href="{{ route('segments.index') }}"
                   class="text-blue-600 hover:text-blue-800">
                    {{ $step->materi->fase->segment->name }}
                </a>
                <span class="mx-2">/</span>
            @endif
        </li>

        <li class="flex items-center">
            @if($step->materi?->fase)
                <a href="{{ route('course.show', $step->materi->fase->segment->name) }}">
                   class="text-blue-600 hover:text-blue-800">
                    {{ $step->materi->fase->title }}
                </a>
                <span class="mx-2">/</span>
            @endif
        </li>

        <li class="flex items-center">
            @if($step->materi)
                <a href="{{ route('materi.show', $step->materi->id) }}"
                   class="text-blue-600 hover:text-blue-800">
                    {{ $step->materi->title }}
                </a>
                <span class="mx-2">/</span>
            @endif
        </li>

        <li class="text-gray-500">
            {{ $step->title }}
        </li>
    </ol>
</nav>


            <article id="mainContentArticle" class="bg-white p-8 rounded-xl shadow-2xl">

                <h1 class="text-4xl font-extrabold text-blue-800 mb-3">
                    {{ $step->title }}
                </h1>

                <hr class="my-6">
                
                {{-- BAGIAN SLIDER GAMBAR (Galeri) --}}
                @if ($step->images && $step->images->count() > 0)
                    <div class="relative mb-10 w-full overflow-hidden">
                        <div id="sliderWrapper"
                            class="flex transition-transform duration-500"
                            data-count="{{ $step->images->count() }}">

                            @foreach ($step->images as $img)
                                {{-- Pengecekan Kunci Gambar (sesuai path Filament) --}}
                                @if ($img->path && \Illuminate\Support\Facades\Storage::disk('public')->exists($img->path))
                                    <div class="w-full flex-shrink-0 flex justify-center">
                                        {{-- Path ke gambar: 'storage/' + path di DB --}}
                                        <img src="{{ asset('storage/' . $img->path) }}"
                                            alt="Gambar Langkah {{ $step->order }}"
                                            class="object-contain max-h-[400px] rounded-lg shadow-lg">
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        {{-- Tombol Navigasi Slider --}}
                        @if ($step->images->count() > 1)
                            <button id="prevBtnSlider"
                                            class="absolute top-1/2 left-2 -translate-y-1/2 bg-white p-3 rounded-full shadow-lg text-xl hover:bg-gray-200 transition-colors"
                                            aria-label="Gambar Sebelumnya">
                                &lsaquo;
                            </button>
                            <button id="nextBtnSlider"
                                            class="absolute top-1/2 right-2 -translate-y-1/2 bg-white p-3 rounded-full shadow-lg text-xl hover:bg-gray-200 transition-colors"
                                            aria-label="Gambar Berikutnya">
                                &rsaquo;
                            </button>
                        @endif
                    </div>
                @endif
                
                {{-- BAGIAN VIDEO URL --}}
                @if ($step->video_url)
                    <div class="mb-8 overflow-hidden rounded-lg shadow-xl aspect-w-16 aspect-h-9">
                        {{-- Asumsi video_url adalah embed link (misalnya YouTube /embed/...) --}}
                        <iframe width="100%" height="450" 
                                src="{{ $step->video_url }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                                class="w-full h-[400px] md:h-[500px]">
                        </iframe>
                    </div>
                @endif

                <hr class="my-6">

                {{-- Konten Utama Langkah --}}
                <div class="prose prose-lg max-w-none text-gray-800">
                    {!! $step->content !!}
                </div>

                {{-- **QUIZ INTERAKTIF** --}}
                @if ($isQuizRequired)
                    <div class="mt-10 p-6 bg-yellow-50 border-2 border-yellow-300 rounded-lg shadow-inner" id="quiz-section">
                        <h2 class="text-2xl font-bold text-yellow-800 mb-4">
                            ❓ Uji Pemahaman: {{ $step->title }}
                        </h2>
                        {{-- Form ini akan mengirim jawaban ke endpoint AJAX Anda --}}
                        <form id="quiz-form" data-step-id="{{ $step->id }}">
                            @csrf
                            @foreach ($quizData as $index => $quiz)
                                <div class="mb-4 p-4 bg-white rounded-lg shadow-sm border border-gray-200">
                                    <p class="font-semibold text-gray-700 mb-2">P{{ $index + 1 }}. {{ $quiz['question'] }}</p>
                                    <div class="space-y-1">
                                        @foreach ($quiz['options'] as $optionKey => $option)
                                            <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-1 rounded">
                                                <input type="radio" 
                                                    name="answers[{{ $index }}]" 
                                                    value="{{ $option['option'] }}" 
                                                    class="form-radio text-blue-600">
                                                <span>{{ $option['option'] }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" id="submitQuizBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150">
                                Kirim Jawaban
                            </button>
                            <div id="quiz-result" class="mt-4 text-center p-3 rounded-lg hidden"></div>
                        </form>
                    </div>
                @endif

            </article>

            <hr class="my-10 border-gray-300">

            {{-- **NAVIGASI NEXT/PREV** --}}
            <div class="flex justify-between items-center p-4 bg-white rounded-xl shadow-lg">

                @if ($prevStep)
                    <a href="{{ route('step.show', ['stepId' => $prevStep->id]) }}" 
                    class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path></svg>
                        <span class="font-semibold">Sebelumnya:</span> {{ \Illuminate\Support\Str::limit($prevStep->title, 35) }}
                    </a>
                @else
                    <span class="text-gray-400">← Ini adalah Langkah Pertama</span>
                @endif

                @if ($nextStep)
    <a href="{{ $defaultNextHref }}"
       id="nextStepBtn"
       data-next-id="{{ $nextStep->id }}"
       class="flex items-center bg-green-500 text-white font-bold py-3 px-6 rounded-xl hover:bg-green-600 transition-colors
       @if ($isQuizRequired) opacity-50 cursor-not-allowed @endif">

        <span class="mr-2">
            Selanjutnya: {{ \Illuminate\Support\Str::limit($nextStep->title, 35) }}
        </span>

        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
        </svg>
    </a>
@else
          {{-- Tombol 'Materi Selesai' di Langkah Terakhir --}}
                     @php
                     $completionRoute = route('materi.complete', ['stepId' => $step->id]);
                @endphp

                     <a href="{{ $completionRoute }}"
                    class="bg-blue-600 text-white font-bold py-3 px-6 rounded-xl hover:bg-blue-700 transition-colors flex items-center">
                     Materi Selesai
                  </a>   
                    {{-- Form tersembunyi untuk POST request --}}
                    <form id="complete-form" action="{{ $completionRoute }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endif
            </div>

        </div>
    </main>

    {{-- SCRIPT JAVASCRIPT: Slider, TOC, dan Quiz Interaktif --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // ===================================
            // 1. Script Fungsionalitas Slider
            // ===================================
            const wrapper = document.getElementById('sliderWrapper');
            const nextBtnSlider = document.getElementById('nextBtnSlider');
            const prevBtnSlider = document.getElementById('prevBtnSlider');

            let index = 0;
            const totalSlides = wrapper ? Number(wrapper.dataset.count) : 0;

            function updateSlide() {
                if (wrapper) {
                    wrapper.style.transform = `translateX(-${index * 100}%)`;
                }
            }

            if (nextBtnSlider) {
                nextBtnSlider.addEventListener('click', () => {
                    if (index < totalSlides - 1) {
                        index++;
                        updateSlide();
                    } else {
                        // Kembali ke slide pertama
                        index = 0;
                        updateSlide();
                    }
                });
            }

            if (prevBtnSlider) {
                prevBtnSlider.addEventListener('click', () => {
                    if (index > 0) {
                        index--;
                        updateSlide();
                    } else {
                         // Kembali ke slide terakhir
                        index = totalSlides - 1;
                        updateSlide();
                    }
                });
            }

            // Tombol sembunyi jika hanya ada satu slide
            if (totalSlides <= 1) {
                if (nextBtnSlider) nextBtnSlider.style.display = 'none';
                if (prevBtnSlider) prevBtnSlider.style.display = 'none';
            }


            // ===================================
            // 2. Script Fungsionalitas TOC Dinamis
            // ===================================
            const contentContainer = document.querySelector('.prose'); 
            const tocList = document.getElementById('tocList');
            
            if (contentContainer && tocList) {
                // Mencari semua heading H2 dan H3 di dalam konten
                const headings = contentContainer.querySelectorAll('h2, h3');
                
                headings.forEach((heading) => {
                    // Buat ID unik dari teks heading jika belum ada
                    let id = heading.id || heading.textContent
                        .toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '') // Hapus karakter non-alfanumerik
                        .trim()
                        .replace(/\s+/g, '-'); // Ganti spasi dengan dash
                    
                    let originalId = id;
                    let counter = 1;
                    // Pastikan ID unik
                    while (document.getElementById(id)) {
                        id = originalId + '-' + counter++;
                    }

                    heading.id = id;
                    
                    const listItem = document.createElement('li');
                    const link = document.createElement('a');
                    
                    link.href = `#${id}`;
                    link.textContent = heading.textContent;
                    link.classList.add('text-gray-600', 'hover:text-blue-600', 'transition-colors', 'block', 'leading-tight', 'truncate');

                    if (heading.tagName === 'H3') {
                        link.classList.add('ml-4', 'text-sm', 'font-normal');
                    } else {
                        link.classList.add('font-medium');
                    }
                    
                    listItem.appendChild(link);
                    tocList.appendChild(listItem);
                });
            }


            // ===================================
            // 3. Script Fungsionalitas Quiz Interaktif
            // ===================================
            const quizForm = document.getElementById('quiz-form');
            const resultDiv = document.getElementById('quiz-result');
            const nextBtn = document.getElementById('nextStepBtn'); 
            
            const stepId = quizForm ? quizForm.getAttribute('data-step-id') : null;
            const nextStepId = nextBtn ? nextBtn.getAttribute('data-next-id') : null;

            // Variabel untuk menyimpan fungsi prevent click agar bisa dihapus
            let preventNextClickFunction;
            
            if (quizForm) {
                
                // Tambahkan event listener untuk memblokir tombol NEXT jika kuis belum diselesaikan
                if (nextBtn && nextBtn.getAttribute('href') === '#') {
                    preventNextClickFunction = function(e) {
                        e.preventDefault();
                        
                        // Tampilkan pesan peringatan
                        resultDiv.classList.remove('hidden', 'bg-green-100', 'text-green-700');
                        resultDiv.className = 'mt-4 text-center p-3 rounded-lg bg-red-100 text-red-700';
                        resultDiv.innerHTML = '<strong>PERINGATAN:</strong> Harap selesaikan dan LULUS kuis ini terlebih dahulu untuk melanjutkan.';
                        
                        // Gulir ke bagian kuis
                        document.getElementById('quiz-section').scrollIntoView({ behavior: 'smooth' });
                    };
                    nextBtn.addEventListener('click', preventNextClickFunction);
                }

                quizForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(quizForm);
                    const answers = {};

                    // Kumpulkan jawaban yang dipilih
                    formData.forEach((value, key) => {
                        if (key.startsWith('answers[')) {
                            const indexMatch = key.match(/\[(\d+)\]/);
                            if (indexMatch) {
                                answers[indexMatch[1]] = value;
                            }
                        }
                    });

                    // Kirim Jawaban ke endpoint yang Anda tentukan (misal: StepController@submitQuiz)
                    // Anda harus membuat route POST /step/{stepId}/quiz di web.php
                    fetch(`/step/${stepId}/quiz`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({ answers: answers })
                    })
                    .then(response => response.json())
                    .then(data => {
                        resultDiv.classList.remove('hidden');
                        
                        if (data.success) {
                            const minScorePercentage = 0.8; 
                            const scorePercentage = data.score / data.total;

                            if (scorePercentage >= minScorePercentage) {
                                resultDiv.className = 'mt-4 text-center p-3 rounded-lg bg-green-100 text-green-700';
                                resultDiv.innerHTML = `<strong>Selamat!</strong> ${data.message} (${data.percentage}%). Anda LULUS.<br>Silakan tekan tombol **Selanjutnya** di bawah untuk melanjutkan.`;
                                
                                // Menonaktifkan form kuis setelah lulus
                                document.getElementById('submitQuizBtn').disabled = true;
                                const radios = quizForm.querySelectorAll('input[type="radio"]');
                                radios.forEach(radio => radio.disabled = true);
                                
                                if (nextBtn && nextStepId) { 
                                    // AKTIFKAN TOMBOL NEXT
                                    nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                                    nextBtn.setAttribute('href', `/step/${nextStepId}`); 

                                    // Hapus event listener pencegah klik
                                    if(preventNextClickFunction) {
                                        nextBtn.removeEventListener('click', preventNextClickFunction);
                                    }
                                } 

                            } else {
                                resultDiv.className = 'mt-4 text-center p-3 rounded-lg bg-red-100 text-red-700';
                                resultDiv.innerHTML = `<strong>Coba Lagi.</strong> ${data.message} (${data.percentage}%). Anda belum lulus.`;
                                
                                // Pastikan tombol NEXT dinonaktifkan jika gagal
                                if (nextBtn) {
                                    nextBtn.classList.add('opacity-50', 'cursor-not-allowed');
                                    nextBtn.setAttribute('href', '#'); 
                                }
                            }
                        } else {
                            resultDiv.className = 'mt-4 text-center p-3 rounded-lg bg-gray-100 text-gray-700';
                            resultDiv.innerHTML = 'Gagal memproses kuis.';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        resultDiv.className = 'mt-4 text-center p-3 rounded-lg bg-red-100 text-red-700';
                        resultDiv.innerHTML = 'Terjadi kesalahan jaringan atau server.';
                    });
                });
            }
        });
    </script>
</body>
</html>