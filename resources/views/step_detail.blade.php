@php 
        use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    // Inisialisasi data relasi
    $materi = $step->materi;
    $fase = $materi->fase;
    $segment = $fase->segment;

    // Ambil data untuk breadcrumb
    $segmentName = $segment->name ?? 'Course';

    // Cek jika judul fase sudah mengandung kata "Fase", jika ya gunakan itu saja.
    // Jika tidak, kita tambahkan kata "Fase" di depannya secara manual.
    $faseTitleRaw = $fase->title ?? 'Fase';
    $displayFase = Str::contains(strtolower($faseTitleRaw), 'fase')
        ? $faseTitleRaw
        : 'Fase ' . $faseTitleRaw;

    $materiTitle = $materi->title ?? 'Materi';

    // Ambil data external links & kuis
    $externalLinks = $step->external_links ?? ($step->materi->externalLinks ?? []);
    $quizData = $step->quiz_data ?? [];

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

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {},
            },
        }
    </script>
</head>

<body class="bg-gray-100 min-h-screen font-sans">

    <main class="max-w-7xl mx-auto p-6 md:p-10 md:flex md:space-x-8">

        {{-- KOLOM KIRI: DAFTAR ISI --}}
        <aside class="md:w-1/4 mb-6 md:mb-0 hidden md:block sticky top-6 self-start">
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Daftar Isi 📖</h3>
                <nav>
                    <ul id="tocList" class="space-y-2 text-sm"></ul>
                </nav>
            </div>
        </aside>

        {{-- KOLOM KANAN: KONTEN UTAMA --}}
        <div class="w-full md:w-3/4">

            {{-- BREADCRUMB - DIPERBAIKI (HANYA 1 FASE & RINGKAS) --}}
            <nav
                class="flex items-center text-xs md:text-sm text-gray-500 mb-6 space-x-2 overflow-x-auto whitespace-nowrap pb-2">
                <a href="#" class="text-blue-600 hover:underline">{{ Str::limit($segmentName, 20) }}</a>
                <span class="text-gray-400">/</span>

                <a href="#" class="text-blue-600 hover:underline" title="{{ $displayFase }}">
                    {{ Str::limit($displayFase, 20) }}
                </a>
                <span class="text-gray-400">/</span>

                <a href="{{ route('materi.show', $materi->id) }}" class="text-blue-600 hover:underline"
                    title="{{ $materiTitle }}">
                    {{ Str::limit($materiTitle, 25) }}
                </a>
                <span class="text-gray-400">/</span>

                <span class="text-gray-700 font-semibold italic">{{ Str::limit($step->title, 25) }}</span>
            </nav>

            <article class="bg-white p-8 rounded-xl shadow-2xl border border-gray-100">
                <h1 class="text-3xl md:text-4xl font-extrabold text-blue-900 mb-3 leading-tight">{{ $step->title }}</h1>
                <hr class="my-6">

                {{-- Slider Gambar --}}
                @if ($step->images && $step->images->count() > 0)
                    <div class="relative mb-10 w-full overflow-hidden bg-gray-50 rounded-lg">
                        <div id="sliderWrapper" class="flex transition-transform duration-500"
                            data-count="{{ $step->images->count() }}">
                            @foreach ($step->images as $img)
                                <div class="w-full flex-shrink-0 flex justify-center p-2">
                                    <img src="{{ asset('storage/' . $img->path) }}"
                                        class="object-contain max-h-[400px] rounded-lg shadow-md">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Video --}}
                @if ($step->video_url)
                    <div class="mb-8 overflow-hidden rounded-lg shadow-xl aspect-video bg-black">
                        <iframe width="100%" height="100%" src="{{ $step->video_url }}" frameborder="0" allowfullscreen
                            class="w-full"></iframe>
                    </div>
                @endif

                {{-- Content --}}
                <div class="prose prose-blue prose-lg max-w-none text-gray-800 leading-relaxed">
                    {!! $step->content !!}
                </div>

                {{-- Quiz Section --}}
                @if ($isQuizRequired)
                    <div class="mt-12 p-6 bg-yellow-50 border-2 border-yellow-200 rounded-xl shadow-inner"
                        id="quiz-section">
                        <h2 class="text-2xl font-bold text-yellow-800 mb-4 flex items-center">
                            <span class="mr-2">❓</span> Uji Pemahaman
                        </h2>
                        <form id="quiz-form" data-step-id="{{ $step->id }}">
                            @csrf
                            @foreach ($quizData as $index => $quiz)
                                <div class="mb-6 p-4 bg-white rounded-lg shadow-sm border border-gray-100">
                                    <p class="font-bold text-gray-800 mb-3">Pertanyaan {{ $index + 1 }}</p>
                                    <p class="text-gray-700 mb-4">{{ $quiz['question'] }}</p>
                                    <div class="space-y-2">
                                        @foreach ($quiz['options'] as $option)
                                            <label
                                                class="flex items-start space-x-3 cursor-pointer p-3 rounded-lg border border-gray-100 hover:bg-blue-50 transition-colors">
                                                <input type="radio" name="answers[{{ $index }}]" value="{{ $option['option'] }}"
                                                    class="form-radio text-blue-600 mt-1">
                                                <span class="text-gray-700">{{ $option['option'] }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" id="submitQuizBtn"
                                class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition-transform active:scale-95 shadow-lg">
                                Kirim Jawaban
                            </button>
                            <div id="quiz-result" class="mt-4 text-center p-4 rounded-lg font-bold hidden"></div>
                        </form>
                    </div>
                @endif
            </article>

            {{-- Tombol Navigasi --}}
            <div
                class="flex flex-col md:flex-row justify-between items-center mt-10 p-5 bg-white rounded-xl shadow-lg gap-4">
                @if ($prevStep)
                    <a href="{{ route('step.show', $prevStep->id) }}"
                        class="text-blue-600 font-bold hover:underline flex items-center">
                        <span class="mr-2">←</span> {{ Str::limit($prevStep->title, 15) }}
                    </a>
                @else
                    <span class="text-gray-400 italic text-sm">Awal Materi</span>
                @endif

                @if ($nextStep)
                    <a href="{{ $defaultNextHref }}" id="nextStepBtn" data-next-id="{{ $nextStep->id }}"
                        class="w-full md:w-auto text-center bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-10 rounded-xl transition shadow-md {{ $isQuizRequired ? 'opacity-50 cursor-not-allowed' : '' }}">
                        Lanjut →
                    </a>
                @else
                    <form action="{{ route('materi.complete', ['stepId' => $step->id]) }}" method="POST"
                        class="w-full md:w-auto">
                        @csrf
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-10 rounded-xl shadow-md transition">
                            Selesai Materi 🎉
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Logika TOC Otomatis
            const contentContainer = document.querySelector('.prose');
            const tocList = document.getElementById('tocList');
            if (contentContainer && tocList) {
                const headings = contentContainer.querySelectorAll('h2, h3');
                headings.forEach((heading) => {
                    let id = heading.textContent.toLowerCase().replace(/\s+/g, '-');
                    heading.id = id;
                    const li = document.createElement('li');
                    li.innerHTML = `<a href="#${id}" class="text-gray-600 hover:text-blue-600 block truncate py-1 transition-colors">${heading.textContent}</a>`;
                    if (heading.tagName === 'H3') li.classList.add('ml-4', 'text-xs');
                    tocList.appendChild(li);
                });
            }

            // Logika Quiz AJAX
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

                    submitBtn.disabled = true;
                    submitBtn.innerHTML = "Memproses...";

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
                            submitBtn.innerHTML = "Kirim Jawaban";

                            if (data.success && (data.score / data.total >= 0.8)) {
                                resultDiv.className = 'mt-4 text-center p-4 rounded-lg bg-green-100 text-green-800 border border-green-200';
                                resultDiv.innerHTML = `✅ Lulus! Skor: ${data.percentage}%. Silakan klik "Lanjut".`;
                                const nextBtn = document.getElementById('nextStepBtn');
                                if (nextBtn) {
                                    nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                                    nextBtn.setAttribute('href', `/step/${nextBtn.dataset.nextId}`);
                                }
                            } else {
                                resultDiv.className = 'mt-4 text-center p-4 rounded-lg bg-red-100 text-red-800 border border-red-200';
                                resultDiv.innerHTML = `❌ Skor: ${data.percentage}%. Coba lagi.`;
                            }
                        });
                });
            }
        });
    </script>
</body>

</html>