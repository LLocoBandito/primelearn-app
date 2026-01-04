<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Path: {{ $segmentData->name }} | PrimeLearn</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* GRID KHUSUS HALAMAN (AMAN DARI NAVBAR) */
        .course-layout-grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 32px;
        }

        @media (max-width: 1024px) {
            .course-layout-grid {
                grid-template-columns: 1fr;
            }
        }

        /* SIDEBAR ITEM */
        .fase-sidebar-item {
            transition: all 0.25s ease;
            border-left: 4px solid transparent;
        }

        .fase-sidebar-item.active {
            background-color: #ecfdf5;
            border-left-color: #059669;
            font-weight: 700;
            color: #047857;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">

@include('components.navbar', ['segmentData' => $segmentData])

<main class="max-w-7xl mx-auto px-6 md:px-10 py-10">

    <!-- HEADER -->
    <header class="mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold text-blue-800 mb-3">
            🎯 {{ $segmentData->name }}
        </h1>
        <p class="text-gray-600 max-w-3xl">
            {{ $segmentData->description }}
        </p>
    </header>

    <div class="course-layout-grid">

        <!-- SIDEBAR -->
        <aside class="bg-white p-5 rounded-xl shadow-lg lg:sticky lg:top-6 h-fit">
            <h2 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">
                📍 Peta Jalan Pembelajaran
            </h2>

            @foreach ($segmentData->fases as $fase)
                <a href="#fase-{{ $loop->index + 1 }}"
                   class="fase-sidebar-item block px-4 py-3 mb-2 rounded-lg text-gray-800 hover:bg-gray-50">
                    {{ $fase->name }}
                </a>
            @endforeach
        </aside>

        <!-- MAIN CONTENT -->
        <section class="space-y-14">

            @foreach ($segmentData->fases as $fase)
                <article id="fase-{{ $loop->index + 1 }}" class="scroll-mt-24">

                    <h3 class="text-2xl font-bold text-teal-700 mb-5 flex items-center gap-2">
                        <span class="text-3xl">🌟</span>
                        {{ $fase->name }}
                    </h3>

                    <div class="bg-white p-6 md:p-7 rounded-2xl shadow-lg border-t-4 border-teal-500">

                        <!-- IMAGE -->
                        <div class="h-64 rounded-xl overflow-hidden mb-6 bg-gray-200">
                            @if ($fase->featured_image)
                                <img src="{{ asset('storage/' . $fase->featured_image) }}"
                                     alt="{{ $fase->name }}"
                                     class="w-full h-full object-cover">
                            @else
                                <img src="https://picsum.photos/seed/{{ $fase->id }}/800/600"
                                     alt="Placeholder"
                                     class="w-full h-full object-cover">
                            @endif
                        </div>

                        <!-- MATERI -->
                        <p class="font-semibold text-lg text-gray-800 mb-4">
                            📚 Materi Inti dalam Fase Ini
                        </p>

                        <ul class="space-y-3">
                            @foreach ($fase->materis as $materi)
                                <li class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition border border-gray-100">

                                    <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-1"
                                         fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                              clip-rule="evenodd"/>
                                    </svg>

                                    <a href="{{ route('materi.show', $materi->id) }}"
                                       class="font-medium text-gray-800 hover:text-teal-700">
                                        {{ $materi->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </article>
            @endforeach

        </section>
    </div>
</main>

<footer class="text-center py-6 text-gray-500 text-sm mt-12 border-t">
    &copy; {{ date('Y') }} PrimeLearn. All Rights Reserved.
</footer>

<!-- ACTIVE SIDEBAR SCROLL -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('.fase-sidebar-item');
    const sections = [...links].map(link =>
        document.querySelector(link.getAttribute('href'))
    );

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                links.forEach(l => l.classList.remove('active'));
                const active = document.querySelector(`a[href="#${entry.target.id}"]`);
                active && active.classList.add('active');
            }
        });
    }, {
        rootMargin: "-30% 0px -60% 0px",
        threshold: 0
    });

    sections.forEach(section => section && observer.observe(section));
});
</script>

</body>
</html>
