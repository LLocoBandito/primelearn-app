<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Path: {{ $segmentData->name }} | PrimeLearn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        .course-layout-grid {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            gap: 30px;
        }

        @media (max-width: 1024px) {
            .course-layout-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
        
        .fase-sidebar-item {
            transition: all 0.2s ease-in-out;
            border-left: 3px solid transparent;
        }

        .fase-sidebar-item.active {
            background-color: #d1fae5;
            border-left-color: #059669;
            font-weight: 700;
            color: #059669;
        }

        .lg\:h-fit {
            height: fit-content;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

@include('components.navbar', ['segmentData' => $segmentData])

<main class="max-w-7xl mx-auto p-6 md:p-10">
    <h1 class="text-3xl md:text-4xl font-extrabold text-blue-800 mb-2">
        🎯 {{ $segmentData->name }}
    </h1>
    <p class="text-gray-600 mb-8">{{ $segmentData->description }}</p>

    <div class="course-layout-grid">
        
        <aside class="bg-white p-5 rounded-lg shadow-xl lg:sticky lg:top-4 lg:h-fit">
            <h2 class="text-xl font-bold text-gray-700 mb-4 border-b pb-2">Peta Jalan Pembelajaran</h2>
            
            @foreach ($segmentData->fases as $index => $fase)
                <a href="#fase-{{ $loop->index + 1 }}" 
                class="fase-sidebar-item block p-3 mb-2 rounded cursor-pointer 
                        @if($loop->first) active @endif 
                        hover:bg-gray-50 text-gray-800 transition">
                    {{ $fase->name }}
                </a>
            @endforeach
        </aside>

        <section class="main-content-area lg:col-span-1">
            
            @foreach ($segmentData->fases as $fase)
                <div id="fase-{{ $loop->index + 1 }}" class="mb-12 pt-1">
                    <h3 class="text-2xl font-bold text-teal-700 mb-4 border-b pb-2">
                        <span class="text-3xl mr-2">🌟</span> {{ $fase->name }}
                    </h3>
                    
                    <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-teal-500">
                        
                        <!-- FOTO FEATURED IMAGE DARI DATABASE -->
                        <div class="h-60 bg-gray-200 rounded-lg mb-6 overflow-hidden">

                            @if ($fase->featured_image)
                                <img 
                                    src="{{ asset('storage/' . $fase->featured_image) }}"
                                    alt="Featured Image for {{ $fase->name }}"
                                    class="w-full h-full object-cover"
                                >
                            @else
                                <img 
                                    src="https://picsum.photos/seed/{{ $fase->id }}/800/600"
                                    alt="Placeholder Image"
                                    class="w-full h-full object-cover"
                                >
                            @endif

                        </div>
                        <!-- END FOTO -->

                        <p class="font-semibold text-xl text-gray-800 mb-4">
                            Materi Inti dalam Fase Ini: (Klik untuk Detail)
                        </p>
                        
                        <ul class="list-none ml-0 space-y-3 text-gray-700">
                            @foreach ($fase->materis as $materi)
                                <li class="flex items-start p-2 rounded transition hover:bg-gray-50 border-b border-gray-50">
                                    <svg class="w-5 h-5 mr-3 mt-1 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    
                                    <a href="{{ route('materi.show', $materi->id) }}"
                                    class="text-gray-800 font-medium hover:text-teal-700 cursor-pointer">
                                        {{ $materi->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        
                    </div>
                </div>
            @endforeach

        </section>
        
    </div>
</main>

<footer class="text-center py-6 text-gray-500 text-sm mt-10 border-t">
    &copy; {{ date('Y') }} PrimeLearn. All Rights Reserved.
</footer>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebarLinks = document.querySelectorAll('.fase-sidebar-item');
        const sections = Array.from(sidebarLinks).map(link => document.querySelector(link.getAttribute('href')));

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {

                    sidebarLinks.forEach(link => link.classList.remove('active'));

                    const activeLink = document.querySelector(`a[href="#${entry.target.id}"]`);
                    if (activeLink) {
                        activeLink.classList.add('active');
                    }
                }
            });
        }, { 
            rootMargin: "-20% 0px -80% 0px", 
            threshold: 0 
        });

        sections.forEach(section => {
            if(section) observer.observe(section);
        });
    });
</script>

</body>
</html>
