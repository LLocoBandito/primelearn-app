<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Langkah {{ $step->order }}: {{ $step->title }} | PrimeLearn</title>
    {{-- Memuat Tailwind CSS melalui CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Konfigurasi Tailwind untuk mengaktifkan plugin Typography --}}
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
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- KOMPONEN: Navbar --}}
    @include('components.navbar')

    @php
        // Import Facades Storage untuk pengecekan path gambar
        use Illuminate\Support\Facades\Storage;
    @endphp

    {{-- MAIN LAYOUT: max-w-7xl, Menggunakan Flexbox pada breakpoint MD ke atas --}}
    <main class="max-w-7xl mx-auto p-6 md:p-10 md:flex md:space-x-8">

        {{-- KOLOM KIRI: DAFTAR ISI (TABLE OF CONTENTS / TOC) --}}
        <aside class="md:w-1/4 mb-6 md:mb-0 hidden md:block sticky top-6 self-start">
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">
                    Daftar Isi 📖
                </h3>
                <nav>
                    {{-- ID: tocList digunakan oleh JavaScript untuk mengisi daftar isi --}}
                    <ul id="tocList" class="space-y-2 text-sm">
                        {{-- Daftar isi akan diisi secara dinamis oleh JavaScript --}}
                    </ul>
                </nav>
            </div>
        </aside>

        {{-- KOLOM KANAN: KONTEN UTAMA --}}
        <div class="w-full md:w-3/4">
            {{-- ID: mainContentArticle untuk memindai konten --}}
            <article id="mainContentArticle" class="bg-white p-8 rounded-xl shadow-2xl">

                {{-- Judul Langkah --}}
                <h1 class="text-4xl font-extrabold text-blue-800 mb-3">
                    {{ $step->title }}
                </h1>

                <hr class="my-6">

                {{-- BAGIAN SLIDER GAMBAR --}}
                @if ($step->images && $step->images->count() > 0)
                    <div class="relative mb-10 w-full overflow-hidden">
                        {{-- Wrapper Slider Utama --}}
                        <div id="sliderWrapper"
                             class="flex transition-transform duration-500"
                             data-count="{{ $step->images->count() }}">

                            @foreach ($step->images as $img)
                                {{-- Pengecekan Ketersediaan Gambar --}}
                                @if ($img->image_path && Storage::disk('public')->exists($img->image_path))
                                    <div class="w-full flex-shrink-0 flex justify-center">
                                        <img src="{{ asset('storage/' . $img->image_path) }}"
                                             alt="Gambar Langkah {{ $step->order }}"
                                             class="object-contain max-h-[400px] rounded-lg shadow-lg">
                                    </div>
                                @endif
                            @endforeach

                        </div>

                        {{-- Tombol Navigasi Slider --}}
                        {{-- Tombol Prev --}}
                        <button id="prevBtn"
                                class="absolute top-1/2 left-2 -translate-y-1/2 bg-white p-3 rounded-full shadow-lg text-xl hover:bg-gray-200 transition-colors"
                                aria-label="Gambar Sebelumnya">
                            &lsaquo;
                        </button>

                        {{-- Tombol Next --}}
                        <button id="nextBtn"
                                class="absolute top-1/2 right-2 -translate-y-1/2 bg-white p-3 rounded-full shadow-lg text-xl hover:bg-gray-200 transition-colors"
                                aria-label="Gambar Berikutnya">
                            &rsaquo;
                        </button>
                    </div>
                @endif
                {{-- AKHIR BAGIAN SLIDER GAMBAR --}}

                <hr class="my-6">

                {{-- Konten Utama Langkah: Menggunakan class prose untuk styling tipografi --}}
                <div class="prose prose-lg max-w-none text-gray-800">
                    {!! $step->content !!}
                </div>

            </article>
        </div>
    </main>

    {{-- SCRIPT JAVASCRIPT: Slider dan TOC Dinamis --}}
    <script>
        // ===================================
        // 1. Script Fungsionalitas Slider
        // ===================================

        const wrapper = document.getElementById('sliderWrapper');
        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');

        let index = 0;
        const totalSlides = wrapper ? Number(wrapper.dataset.count) : 0;

        /**
         * Memperbarui posisi slide menggunakan properti CSS transform.
         */
        function updateSlide() {
            if (wrapper) {
                wrapper.style.transform = `translateX(-${index * 100}%)`;
            }
        }

        // Listener untuk Tombol Next
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                if (index < totalSlides - 1) {
                    index++;
                    updateSlide();
                }
            });
        }

        // Listener untuk Tombol Prev
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                if (index > 0) {
                    index--;
                    updateSlide();
                }
            });
        }

        // Sembunyikan tombol jika hanya ada satu gambar atau tidak ada
        if (totalSlides <= 1) {
            if (nextBtn) nextBtn.style.display = 'none';
            if (prevBtn) prevBtn.style.display = 'none';
        }


        // ===================================
        // 2. Script Fungsionalitas TOC Dinamis
        // ===================================
        document.addEventListener('DOMContentLoaded', () => {
            // Kontainer yang berisi konten langkah (di-render dengan class 'prose')
            const contentContainer = document.querySelector('.prose'); 
            const tocList = document.getElementById('tocList');
            
            if (!contentContainer || !tocList) return;

            // Targetkan heading H2 dan H3 di dalam konten
            const headings = contentContainer.querySelectorAll('h2, h3');
            
            headings.forEach((heading) => {
                // A. Buat ID unik dari teks heading (Slugify)
                let id = heading.id || heading.textContent
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '') // Hapus karakter non-alfanumerik/spasi/dash
                    .trim()
                    .replace(/\s+/g, '-'); // Ganti spasi dengan dash
                
                // B. Pastikan ID unik (hindari duplikasi)
                let originalId = id;
                let counter = 1;
                while (document.getElementById(id)) {
                    id = originalId + '-' + counter++;
                }

                heading.id = id; // Terapkan ID ke heading di konten
                
                // C. Buat elemen Daftar Isi (li dan a)
                const listItem = document.createElement('li');
                const link = document.createElement('a');
                
                link.href = `#${id}`;
                link.textContent = heading.textContent;
                link.classList.add('text-gray-600', 'hover:text-blue-600', 'transition-colors', 'block', 'leading-tight', 'truncate');

                // Tambahkan kelas indentasi berdasarkan level heading
                if (heading.tagName === 'H3') {
                    link.classList.add('ml-4', 'text-sm', 'font-normal');
                } else { // H2
                    link.classList.add('font-medium');
                }
                
                listItem.appendChild(link);
                
                // D. Masukkan ke dalam TOC List
                tocList.appendChild(listItem);
            });
        });
    </script>

</body>
</html>