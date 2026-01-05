<nav class="bg-[#06192A] text-white py-4 shadow-lg relative">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center relative">

        <div class="text-2xl font-extrabold tracking-wide">
            PrimeLearn
        </div>

        <div class="hidden md:block text-center absolute left-1/2 -translate-x-1/2">
            @isset($segmentData)
                <span class="opacity-90 text-base">You are in </span>
                <span class="font-semibold text-cyan-300 text-base">
                    Learning Path: {{ $segmentData->name }}
                </span>
            @endisset

            @isset($fase)
                <p class="mt-1 text-sm text-gray-300 opacity-90">
                    Phase:
                    <span class="font-semibold text-cyan-300">{{ $fase->name }}</span>
                </p>
            @endisset
        </div>

        <button id="navToggle" class="text-white text-3xl focus:outline-none">
            <span id="navIcon">&#9776;</span>
        </button>
    </div>

    <div id="navMenu"
        class="hidden absolute left-1/2 -translate-x-1/2 top-full
                bg-[#27496d] border border-white/10 backdrop-blur-md
                rounded-b-2xl shadow-xl px-10 py-1
                flex flex-row items-center gap-2 text-sm z-50
                transition-all duration-300">

        <a href="/segments"
           class="text-white font-semibold px-4 py-2 rounded-lg 
                  hover:bg-cyan-400/20 transition-all">
            HOME
        </a>

        <a href="/about" 
           class="text-white font-semibold px-4 py-2 rounded-lg 
                  hover:bg-cyan-400/20 transition-all">
            ABOUT US
        </a>

        <a href="/faq" 
           class="text-white font-semibold px-4 py-2 rounded-lg 
                  hover:bg-cyan-400/20 transition-all">
            FAQ
        </a>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('navToggle');
    const navMenu  = document.getElementById('navMenu');
    const navIcon  = document.getElementById('navIcon');

    // Toggle menu when icon is clicked
    toggleBtn.addEventListener('click', (event) => {
        event.stopPropagation();
        navMenu.classList.toggle('hidden');

        // Change icon
        if (!navMenu.classList.contains('hidden')) {
            navIcon.innerHTML = "&times;";
        } else {
            navIcon.innerHTML = "&#9776;";
        }
    });

    // Clicking outside closes the menu
    document.addEventListener('click', (event) => {
        const isClickInsideMenu  = navMenu.contains(event.target);
        const isClickOnToggleBtn = toggleBtn.contains(event.target);

        if (!isClickInsideMenu && !isClickOnToggleBtn) {
            if (!navMenu.classList.contains('hidden')) {
                navMenu.classList.add('hidden');
                navIcon.innerHTML = "&#9776;";
            }
        }
    });
});
</script>