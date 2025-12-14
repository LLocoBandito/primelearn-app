<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Langkah {{ $step->order ?? '1' }} dari {{ $step->total_steps ?? '...' }}: {{ $step->title }} | PrimeLearn</title>

    {{-- Menggunakan CDN Tailwind (Pastikan Anda menggunakan skrip yang sama) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {},
            },
            plugins: [
                require('@tailwindcss/typography'),
            ],
        }
    </script>
    <style>
        .self-start {
            align-self: flex-start;
        }
        /* Tambahan styling kustom untuk Prose jika menggunakan CDN */
        .prose h1, .prose h2, .prose h3 {
            font-weight: bold;
            margin-top: 1.5em;
            margin-bottom: 0.5em;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- @include('components.navbar') --}}

    @php
        use Illuminate\Support\Facades\Storage;

        $currentOrder = $step->order ?? 1;
        $totalSteps   = $step->total_steps ?? 1;
        // Menggunakan $materi->id yang lebih aman daripada $step->materi_id
        $materiId     = $materi->id ?? 'default'; 

        $progress = ($totalSteps > 0) ? ($currentOrder / $totalSteps) * 100 : 0;

        // PERBAIKAN: Mengganti steps.show menjadi course.showStep
        $prevLink = $currentOrder > 1 ? route('course.showStep', ['materi' => $materiId, 'order' => $currentOrder - 1]) : '#';
        $nextLink = $currentOrder < $totalSteps ? route('course.showStep', ['materi' => $materiId, 'order' => $currentOrder + 1]) : '#';
        
        // PERBAIKAN: Mengganti materi.complete menjadi course.showMateriDetail
        $completeLink = route('course.showMateriDetail', ['materiId' => $materiId]);
    @endphp

    <main class="max-w-7xl mx-auto p-6 md:p-10 md:flex md:space-x-8">

        {{-- Sidebar/Daftar Isi --}}
        <aside class="md:w-1/4 mb-6 md:mb-0 hidden md:block sticky top-6 self-start">
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">
                    Daftar Isi 📖
                </h3>
                <nav>
                    {{-- Navigasi Langkah Sidebar Dinamis --}}
                    @if ($materi->steps->count())
                        <ul class="space-y-2 text-sm">
                            @foreach($materi->steps->sortBy('order') as $listStep)
                                @php
                                    $isActive = $listStep->order == $currentOrder;
                                    $url = route('course.showStep', ['materi' => $materiId, 'order' => $listStep->order]);
                                @endphp
                                <li class="{{ $isActive ? 'font-bold text-blue-600' : 'text-gray-700' }}">
                                    @if($isActive)
                                        Langkah {{ $listStep->order }}: {{ $listStep->title }}
                                    @else
                                        <a href="{{ $url }}" class="hover:text-blue-600 transition duration-150">
                                            Langkah {{ $listStep->order }}: {{ $listStep->title }}
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-500">Daftar langkah belum tersedia.</p>
                    @endif
                    
                    {{-- TOC Dinamis Konten Utama (JS akan mengisi #tocList di bawah) --}}
                    <ul id="tocList" class="space-y-2 text-sm mt-4 border-t pt-2">
                        {{-- Diisi oleh JavaScript --}}
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="w-full md:w-3/4">

            {{-- Progress Bar dan Navigasi ATAS --}}
            <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border border-blue-200">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-sm font-semibold text-gray-600">
                        Progress: Langkah {{ $currentOrder }} dari {{ $totalSteps }}
                    </span>
                    {{-- Navigasi Mobile --}}
                    <div class="text-sm flex items-center space-x-2 md:hidden">
                        @if ($currentOrder > 1)
                            <a href="{{ $prevLink }}" class="text-blue-500 hover:text-blue-700">&lsaquo; Sebelumnya</a>
                            <span class="text-gray-300">|</span>
                        @endif
                        @if ($currentOrder < $totalSteps)
                            <a href="{{ $nextLink }}" class="text-blue-500 hover:text-blue-700">Berikutnya &rsaquo;</a>
                        @endif
                        @if ($currentOrder == $totalSteps)
                            <a href="{{ $completeLink }}" class="text-green-500 hover:text-green-700">Selesai</a>
                        @endif
                    </div>
                </div>

                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                    <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
                </div>

                {{-- Navigasi Desktop --}}
                <div class="hidden md:flex justify-between">
                    <a href="{{ $prevLink }}"
                       class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg font-semibold transition {{ $currentOrder <= 1 ? 'opacity-50 cursor-not-allowed pointer-events-none' : 'hover:bg-gray-400' }}"
                       aria-disabled="{{ $currentOrder <= 1 }}">
                        &larr; Langkah Sebelumnya
                    </a>

                    @if ($currentOrder < $totalSteps)
                        <a href="{{ $nextLink }}"
                           class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                            Langkah Berikutnya &rarr;
                        </a>
                    @else
                        <a href="{{ $completeLink }}"
                           class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">
                            Selesaikan Materi 🎉
                        </a>
                    @endif
                </div>
            </div>

            <article id="mainContentArticle" class="bg-white p-8 rounded-xl shadow-2xl">

                <h1 class="text-4xl font-extrabold text-blue-800 mb-3">
                    {{ $step->title }}
                </h1>
                <p class="text-xl text-gray-500 mb-6">Langkah {{ $currentOrder }}</p>

                <hr class="my-6">

                @if ($step->video_url)
                    <h2 id="video-tutorial" class="text-2xl font-bold text-gray-700 mb-4">Video Tutorial 🎬</h2>
                    <div class="mb-10 aspect-video w-full rounded-lg overflow-hidden shadow-xl border-4 border-blue-100">
                        <iframe class="w-full h-full"
                                src="{{ $step->video_url }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                    <hr class="my-6">
                @endif

                {{-- Slider Gambar --}}
                @if ($step->images && $step->images->count() > 0)
                    <div class="relative mb-10 w-full overflow-hidden rounded-lg">
                        <div id="sliderWrapper"
                             class="flex transition-transform duration-500"
                             data-count="{{ $step->images->count() }}">
                            @foreach ($step->images as $img)
                                @if ($img->image_path && Storage::disk('public')->exists($img->image_path))
                                    <div class="w-full flex-shrink-0 flex justify-center p-4">
                                        <img src="{{ asset('storage/' . $img->image_path) }}"
                                             alt="Gambar Langkah {{ $currentOrder }}"
                                             class="object-contain max-h-96 rounded-lg shadow-lg border border-gray-200">
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <button id="prevBtn" class="absolute top-1/2 left-4 -translate-y-1/2 bg-white/90 p-3 rounded-full shadow-xl text-2xl hover:bg-white z-10">&lsaquo;</button>
                        <button id="nextBtn" class="absolute top-1/2 right-4 -translate-y-1/2 bg-white/90 p-3 rounded-full shadow-xl text-2xl hover:bg-white z-10">&rsaquo;</button>
                    </div>
                    <hr class="my-6">
                @endif

                {{-- Konten Utama dengan Styling Typography --}}
                <div class="prose prose-lg max-w-none text-gray-800">
                    {!! $step->content !!}
                </div>

                {{-- Kuis Interaktif --}}
                @if (is_array($step->quiz_data) && count($step->quiz_data) > 0)
                    <hr class="my-8">
                    <h2 id="uji-pemahaman" class="text-3xl font-extrabold text-red-700 mb-6 border-b-2 border-red-200 pb-2">
                        Uji Pemahaman Anda! 🤔
                    </h2>

                    <form id="quizForm" class="space-y-8" data-quiz-data="{{ json_encode($step->quiz_data) }}">
                        @foreach ($step->quiz_data as $index => $quiz)
                            <div class="bg-red-50 p-6 rounded-xl shadow-md border border-red-200 quiz-question" data-index="{{ $index }}">
                                <p class="text-lg font-semibold text-gray-800 mb-4">
                                    {{-- PERBAIKAN: Memastikan indeks pertanyaan dimulai dari 1 --}}
                                    {{ (int)$index + 1 }}. {{ $quiz['question'] ?? 'Pertanyaan tidak tersedia.' }}
                                </p>

                                <div class="space-y-3">
                                    @foreach ($quiz['options'] ?? [] as $optionIndex => $optionWrapper)
                                        @php
                                            $optionText = is_array($optionWrapper)
                                                ? ($optionWrapper['option'] ?? 'Pilihan tidak valid')
                                                : $optionWrapper;
                                        @endphp
                                        <label class="flex items-center p-4 bg-white rounded-lg border-2 border-gray-200 cursor-pointer hover:border-red-400 hover:bg-red-50 transition-all option-label">
                                            <input type="radio"
                                                            name="quiz_q_{{ $index }}"
                                                            value="{{ $optionIndex }}"
                                                            class="form-radio h-5 w-5 text-red-600 focus:ring-red-500">
                                            <span class="ml-4 text-gray-700 font-medium">{{ $optionText }}</span>
                                        </label>
                                    @endforeach
                                </div>

                                <div class="mt-4 p-4 rounded-lg hidden feedback-area font-medium"></div>
                            </div>
                        @endforeach

                        <div class="text-center">
                            <button type="button" id="submitQuizBtn"
                                    class="px-10 py-4 bg-red-600 text-white text-xl font-bold rounded-full shadow-xl hover:bg-red-700 transition">
                                Periksa Jawaban
                            </button>
                        </div>

                        <div id="overallResult" class="mt-10 p-8 bg-gradient-to-r from-blue-100 to-blue-200 rounded-2xl shadow-inner text-center text-2xl font-bold hidden"></div>
                    </form>
                @endif

            </article>

            {{-- Navigasi BAWAH (Desktop Only) --}}
            <div class="mt-8 bg-white p-6 rounded-xl shadow-lg border border-blue-200 hidden md:block">
                <div class="flex justify-between">
                    <a href="{{ $prevLink }}"
                       class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg font-semibold transition {{ $currentOrder <= 1 ? 'opacity-50 cursor-not-allowed pointer-events-none' : 'hover:bg-gray-400' }}">
                        &larr; Langkah Sebelumnya
                    </a>

                    @if ($currentOrder < $totalSteps)
                        <a href="{{ $nextLink }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                            Langkah Berikutnya &rarr;
                        </a>
                    @else
                        <a href="{{ $completeLink }}" class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">
                            Selesaikan Materi 🎉
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // === Slider Gambar ===
            const wrapper = document.getElementById('sliderWrapper');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            let index = 0;
            const totalSlides = wrapper ? Number(wrapper.dataset.count) : 0;

            const updateSlide = () => {
                if (wrapper) wrapper.style.transform = `translateX(-${index * 100}%)`;
            };

            if (totalSlides > 1) {
                nextBtn?.addEventListener('click', () => {
                    if (index < totalSlides - 1) { index++; updateSlide(); }
                });
                prevBtn?.addEventListener('click', () => {
                    if (index > 0) { index--; updateSlide(); }
                });
            } else {
                if (prevBtn) prevBtn.style.display = 'none';
                if (nextBtn) nextBtn.style.display = 'none';
            }

            // === TOC Dinamis ===
            const contentContainer = document.querySelector('.prose');
            const tocList = document.getElementById('tocList');

            if (contentContainer && tocList) {
                const staticHeadings = [
                    document.getElementById('video-tutorial'),
                    document.getElementById('uji-pemahaman')
                ].filter(Boolean);

                const dynamicHeadings = contentContainer.querySelectorAll('h2, h3');
                const allHeadings = [...staticHeadings, ...Array.from(dynamicHeadings)];
                
                // Sortir berdasarkan posisi di halaman
                allHeadings.sort((a, b) => a.offsetTop - b.offsetTop);


                allHeadings.forEach(heading => {
                    let id = heading.id || heading.textContent.toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .trim()
                        .replace(/\s+/g, '-');

                    let originalId = id;
                    let counter = 1;
                    // Pastikan ID unik. Cek juga static headings
                    while (document.getElementById(id) && document.getElementById(id) !== heading) {
                        id = originalId + '-' + counter++;
                    }
                    heading.id = id;

                    const li = document.createElement('li');
                    const a = document.createElement('a');
                    a.href = `#${id}`;
                    a.textContent = heading.textContent;
                    a.className = 'text-gray-600 hover:text-blue-600 transition block truncate';

                    if (heading.tagName === 'H3') {
                        a.classList.add('ml-4', 'text-sm', 'font-normal');
                    } else {
                        a.classList.add('font-medium');
                    }

                    li.appendChild(a);
                    tocList.appendChild(li);
                });
            }

            // === Kuis Interaktif (Diperbaiki) ===
            const quizForm = document.getElementById('quizForm');
            const submitBtn = document.getElementById('submitQuizBtn');
            const overallResultDiv = document.getElementById('overallResult');

            if (quizForm && submitBtn) {
                const quizData = JSON.parse(quizForm.dataset.quizData);

                submitBtn.addEventListener('click', () => {
                    let correctCount = 0;
                    const totalQuestions = quizData.length;

                    quizData.forEach((quiz, index) => {
                        const questionEl = document.querySelector(`.quiz-question[data-index="${index}"]`);
                        const feedbackEl = questionEl.querySelector('.feedback-area');
                        const selected = quizForm.querySelector(`input[name="quiz_q_${index}"]:checked`);

                        // PERBAIKAN: Memastikan correct_option di-parse sebagai integer
                        const correctIndex = parseInt(quiz.correct_option, 10); 

                        // Reset styling
                        feedbackEl.classList.add('hidden');
                        questionEl.querySelectorAll('.option-label').forEach(l => {
                            l.classList.remove('bg-green-200', 'bg-red-200', 'border-green-500', 'border-red-500', 'border-red-400', 'hover:border-red-400', 'hover:bg-red-50');
                            l.classList.add('border-gray-200');
                        });
                        questionEl.querySelectorAll('input[type="radio"]').forEach(i => i.disabled = false); // Biarkan tetap bisa klik sampai submit

                        if (!selected) {
                            feedbackEl.textContent = 'Silakan pilih salah satu jawaban.';
                            feedbackEl.className = 'feedback-area bg-yellow-100 text-yellow-800 p-4 rounded';
                            feedbackEl.classList.remove('hidden');
                            return;
                        }

                        const selectedIdx = parseInt(selected.value, 10);
                        const isCorrect = selectedIdx === correctIndex;

                        const allLabels = questionEl.querySelectorAll('.option-label');
                        const correctLabel = allLabels[correctIndex];
                        const selectedLabel = selected.closest('.option-label');
                        
                        
                        if (isCorrect) {
                            correctCount++;
                            selectedLabel.classList.add('bg-green-200', 'border-green-500');
                            selectedLabel.classList.remove('border-gray-200');
                            feedbackEl.textContent = '✅ Benar sekali!';
                            feedbackEl.className = 'feedback-area bg-green-100 text-green-800 p-4 rounded';
                        } else {
                            selectedLabel.classList.add('bg-red-200', 'border-red-500');
                            selectedLabel.classList.remove('border-gray-200');
                            
                            if (correctLabel) {
                                correctLabel.classList.add('bg-green-200', 'border-green-500');
                                correctLabel.classList.remove('border-gray-200');
                            }
                            const correctText = correctLabel ? correctLabel.querySelector('span').textContent.trim() : 'Jawaban tidak diketahui';
                            feedbackEl.textContent = `❌ Salah. Jawaban benar: ${correctText}`;
                            feedbackEl.className = 'feedback-area bg-red-100 text-red-800 p-4 rounded';
                        }

                        feedbackEl.classList.remove('hidden');

                        // Disable input setelah dijawab
                        questionEl.querySelectorAll('input[type="radio"]').forEach(i => i.disabled = true);
                    });

                    // Hasil keseluruhan
                    const percentage = totalQuestions > 0 ? (correctCount / totalQuestions) * 100 : 0;
                    let message = `Skor Anda: ${correctCount}/${totalQuestions} (${percentage.toFixed(0)}%)`;

                    overallResultDiv.classList.remove('hidden', 'bg-yellow-100', 'bg-blue-100', 'bg-red-100', 'text-yellow-800', 'text-blue-800', 'text-red-800');
                    overallResultDiv.classList.add('text-gray-800');

                    if (percentage === 100) {
                        message += ' 🎉 Luar biasa! Anda menguasai materi ini!';
                        overallResultDiv.classList.add('bg-yellow-100', 'text-yellow-800');
                    } else if (percentage >= 70) {
                        message += ' 👍 Bagus sekali!';
                        overallResultDiv.classList.add('bg-blue-100', 'text-blue-800');
                    } else {
                        message += ' 📚 Silakan pelajari lagi materi di atas.';
                        overallResultDiv.classList.add('bg-red-100', 'text-red-800');
                    }

                    overallResultDiv.textContent = message;

                    // Nonaktifkan tombol submit
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Sudah Diperiksa ✓';
                });
            }
        });
    </script>
</body>
</html>