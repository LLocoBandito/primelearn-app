<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminatan IT | PRIME LEARN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .question-step {
            display: none;
        }
    </style>
</head>
<body class="bg-blue-50 text-gray-800 font-sans min-h-screen">

    <nav class="flex items-center justify-between px-8 py-4 bg-white shadow-md fixed top-0 left-0 w-full z-50">
        <div class="flex items-center space-x-3">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Primakara University" class="h-10">
            </a>
            <span class="font-bold text-blue-700 text-lg">PRIME LEARN</span>
        </div>
        <div class="space-x-6 text-blue-700 font-medium">
            <a href="#home" class="hover:text-blue-500 transition">Home</a>
            <a href="{{ url('/apply') }}" class="hover:text-blue-500 transition">Apply</a>
        </div>
    </nav>

    <section class="pt-24 pb-12 px-6 md:px-20">
        <div class="max-w-4xl mx-auto bg-white p-8 md:p-12 rounded-xl shadow-2xl">

            <h1 class="text-3xl font-bold text-blue-700 mb-2 text-center">
                Tes Minat dan Bakat Bidang IT
            </h1>
            <p class="text-gray-600 mb-8 text-center border-b pb-4">
                Jawab 7 pertanyaan di bawah ini untuk mendapatkan rekomendasi jalur belajar yang paling sesuai dengan passion Anda.
            </p>

            <form id="peminatanForm" action="{{ url('/result') }}" method="GET" class="space-y-8">
                @csrf 
                
                <div id="step-0" class="space-y-4 mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-2">Informasi Dasar</h2>
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Lengkap
                        </label>
                        <input type="text" id="nama" name="nama" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="Masukkan nama Anda">
                    </div>
                    <button type="button" onclick="nextStep(0)" id="startBtn"
                            class="w-full px-6 py-3 bg-green-600 text-white rounded-lg font-semibold shadow-lg hover:bg-green-700 transition">
                        Mulai Kuesioner
                    </button>
                </div>

                <div id="progressContainer" class="hidden">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                        <span id="currentStepDisplay">1</span> dari 7 Pertanyaan
                    </h2>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                        <div id="progressBar" class="bg-blue-600 h-2.5 rounded-full transition-all duration-500" style="width: 0%"></div>
                    </div>
                </div>


                <div id="step-1" class="question-step p-6 border border-blue-200 rounded-xl shadow-lg">
                    <label class="block text-base font-semibold text-gray-800 mb-3">
                        1. Ketika Anda memulai suatu proyek IT, hal apa yang membuat Anda paling puas?
                    </label>
                    <div class="space-y-3" onchange="nextStep(1)">
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                            <input type="radio" name="q1" value="dev" required class="form-radio text-blue-600 h-5 w-5">
                            <span class="ml-3 text-gray-700">Melihat hasil nyata berupa **aplikasi/website** yang dapat digunakan oleh orang banyak.</span>
                        </label>
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                            <input type="radio" name="q1" value="data" class="form-radio text-blue-600 h-5 w-5">
                            <span class="ml-3 text-gray-700">Menemukan **pola atau insight tersembunyi** dari kumpulan data yang besar.</span>
                        </label>
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                            <input type="radio" name="q1" value="net" class="form-radio text-blue-600 h-5 w-5">
                            <span class="ml-3 text-gray-700">Memastikan **sistem berjalan aman, stabil, dan cepat** tanpa gangguan.</span>
                        </label>
                    </div>
                </div>

                <div id="step-2" class="question-step p-6 border border-blue-200 rounded-xl shadow-lg">
                    <label class="block text-base font-semibold text-gray-800 mb-3">
                        2. Anda menemukan sistem yang berjalan lambat. Apa fokus utama Anda?
                    </label>
                    <div class="space-y-3" onchange="nextStep(2)">
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                            <input type="radio" name="q2" value="dev" required class="form-radio text-blue-600 h-5 w-5">
                            <span class="ml-3 text-gray-700">Menulis ulang atau mengoptimalkan **kode program** agar lebih efisien.</span>
                        </label>
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                            <input type="radio" name="q2" value="data_net" class="form-radio text-blue-600 h-5 w-5">
                            <span class="ml-3 text-gray-700">Menganalisis **alur data atau konfigurasi jaringan** untuk mencari *bottleneck*.</span>
                        </label>
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                            <input type="radio" name="q2" value="uiux" class="form-radio text-blue-600 h-5 w-5">
                            <span class="ml-3 text-gray-700">Menanyakan ke pengguna apakah **tampilan** atau navigasi yang mempersulit mereka.</span>
                        </label>
                    </div>
                    <div class="mt-6 flex justify-start">
                        <button type="button" onclick="prevStep(2)" class="px-4 py-2 text-sm font-semibold text-blue-700 border border-blue-300 rounded-lg hover:bg-blue-50 transition">
                            ← Kembali
                        </button>
                    </div>
                </div>

                <div id="step-3" class="question-step p-6 border border-blue-200 rounded-xl shadow-lg">
                    <label class="block text-base font-semibold text-gray-800 mb-3">
                        3. Bagaimana reaksi Anda terhadap ancaman keamanan siber?
                    </label>
                    <div class="space-y-3" onchange="nextStep(3)">
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                            <input type="radio" name="q3" value="security" required class="form-radio text-blue-600 h-5 w-5">
                            <span class="ml-3 text-gray-700">Tertarik mempelajari **cara kerja peretasan** untuk membangun pertahanan yang lebih kuat.</span>
                        </label>
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                            <input type="radio" name="q3" value="other" class="form-radio text-blue-600 h-5 w-5">
                            <span class="ml-3 text-gray-700">Saya tahu itu penting, tapi **fokus saya lebih ke fungsionalitas**.</span>
                        </label>
                    </div>
                    <div class="mt-6 flex justify-start">
                        <button type="button" onclick="prevStep(3)" class="px-4 py-2 text-sm font-semibold text-blue-700 border border-blue-300 rounded-lg hover:bg-blue-50 transition">
                            ← Kembali
                        </button>
                    </div>
                </div>

                <div id="step-4" class="question-step p-6 border border-blue-200 rounded-xl shadow-lg">
                    <label class="block text-base font-semibold text-gray-800 mb-3">
                        4. Seberapa nyaman Anda bekerja dengan statistik, grafik, dan angka-angka besar?
                    </label>
                    <div class="space-y-3" onchange="nextStep(4)">
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                            <input type="radio" name="q4" value="data" required class="form-radio text-blue-600 h-5 w-5">
                            <span class="ml-3 text-gray-700">Sangat nyaman, saya suka menganalisis data untuk **membuat prediksi** atau kesimpulan.</span>
                        </label>
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                            <input type="radio" name="q4" value="dev_net" class="form-radio text-blue-600 h-5 w-5">
                            <span class="ml-3 text-gray-700">Netral, saya menggunakan data seperlunya **untuk membuat atau menjalankan sistem**.</span>
                        </label>
                    </div>
                    <div class="mt-6 flex justify-start">
                        <button type="button" onclick="prevStep(4)" class="px-4 py-2 text-sm font-semibold text-blue-700 border border-blue-300 rounded-lg hover:bg-blue-50 transition">
                            ← Kembali
                        </button>
                    </div>
                </div>

                <div id="step-5" class="question-step p-6 border border-blue-200 rounded-xl shadow-lg">
                    <label class="block text-base font-semibold text-gray-800 mb-3">
                        5. Dalam proyek tim, Anda lebih suka mengambil peran...
                    </label>
                    <div class="space-y-3" onchange="nextStep(5)">
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                            <input type="radio" name="q5" value="frontend" required class="form-radio text-blue-600 h-5 w-5">
                            <span class="ml-3 text-gray-700">Berinteraksi langsung dengan pengguna, membuat **tampilan (UI)** yang menarik dan mudah dipahami.</span>
                        </label>
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                            <input type="radio" name="q5" value="backend" class="form-radio text-blue-600 h-5 w-5">
                            <span class="ml-3 text-gray-700">Bekerja di balik layar, mengurus **logika, database, dan infrastruktur** sistem.</span>
                        </label>
                    </div>
                    <div class="mt-6 flex justify-start">
                        <button type="button" onclick="prevStep(5)" class="px-4 py-2 text-sm font-semibold text-blue-700 border border-blue-300 rounded-lg hover:bg-blue-50 transition">
                            ← Kembali
                        </button>
                    </div>
                </div>
                
                <div id="step-6" class="question-step p-6 border border-blue-200 rounded-xl shadow-lg">
                    <label class="block text-base font-semibold text-gray-800 mb-3">
                        6. Anda menghabiskan waktu berjam-jam mencari satu *error* kecil di sebuah kode atau konfigurasi. Bagaimana perasaan Anda?
                    </label>
                    <div class="space-y-3" onchange="nextStep(6)">
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                            <input type="radio" name="q6" value="positive" required class="form-radio text-blue-600 h-5 w-5">
                            <span class="ml-3 text-gray-700">Puas saat akhirnya menemukan dan menyelesaikan masalah tersebut; saya suka tantangan ini.</span>
                        </label>
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                            <input type="radio" name="q6" value="negative" class="form-radio text-blue-600 h-5 w-5">
                            <span class="ml-3 text-gray-700">Frustrasi dan lebih memilih tugas yang hasilnya lebih cepat terlihat.</span>
                        </label>
                    </div>
                    <div class="mt-6 flex justify-start">
                        <button type="button" onclick="prevStep(6)" class="px-4 py-2 text-sm font-semibold text-blue-700 border border-blue-300 rounded-lg hover:bg-blue-50 transition">
                            ← Kembali
                        </button>
                    </div>
                </div>
                
                <div id="step-7" class="question-step p-6 border border-blue-200 rounded-xl shadow-lg">
                    <label class="block text-base font-semibold text-gray-800 mb-3">
                        7. Anda lebih tertarik untuk memahami cara kerja...
                    </label>
                    <div class="space-y-3" onchange="nextStep(7)">
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                            <input type="radio" name="q7" value="software" required class="form-radio text-blue-600 h-5 w-5">
                            <span class="ml-3 text-gray-700">**Logika dan kode** di dalam sebuah aplikasi.</span>
                        </label>
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                            <input type="radio" name="q7" value="hardware" class="form-radio text-blue-600 h-5 w-5">
                            <span class="ml-3 text-gray-700">**Jaringan, server, dan perangkat keras** komputer.</span>
                        </label>
                    </div>
                    <div class="mt-6 flex justify-start">
                        <button type="button" onclick="prevStep(7)" class="px-4 py-2 text-sm font-semibold text-blue-700 border border-blue-300 rounded-lg hover:bg-blue-50 transition">
                            ← Kembali
                        </button>
                    </div>
                </div>

                <div id="step-8" class="question-step p-6 border border-blue-200 rounded-xl shadow-lg">
                    <h2 class="text-2xl font-bold text-blue-700 mb-4 text-center">🎉 Kuesioner Selesai!</h2>
                    <div class="flex flex-col space-y-4">
                        <button type="submit"
                                class="w-full px-6 py-3 bg-blue-700 text-white rounded-lg font-semibold shadow-lg hover:bg-blue-800 transition transform hover:scale-[1.01]">
                            Lihat Hasil Rekomendasi Peminatan
                        </button>
                        <button type="button" onclick="prevStep(8)"
                                class="w-full px-6 py-3 text-sm font-semibold text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                            ← Periksa Ulang Jawaban Terakhir
                        </button>
                        
                        <a href="{{ url('/') }}"
                           class="w-full text-center px-6 py-3 text-sm font-semibold text-red-600 border border-red-300 rounded-lg hover:bg-red-50 transition">
                            Batalkan & Kembali ke Beranda
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </section>

    <footer class="py-6 text-center text-gray-500 border-t border-blue-100 mt-8">
        © {{ date('Y') }} Primakara University | IT Learning Path Project
    </footer>

    <script>
        const totalSteps = 7;
        let currentStep = 0; 

        function showStep(stepIndex) {
            document.querySelectorAll('.question-step').forEach(step => {
                step.style.display = 'none';
            });
            
            const activeStep = document.getElementById(`step-${stepIndex}`);
            if (activeStep) {
                activeStep.style.display = 'block';
            }

            // Update Progress Bar dan Display
            if (stepIndex > 0 && stepIndex <= totalSteps) {
                const progress = ((stepIndex - 1) / totalSteps) * 100;
                document.getElementById('progressBar').style.width = `${progress}%`;
                document.getElementById('currentStepDisplay').textContent = stepIndex;
            } else if (stepIndex === totalSteps + 1) {
                // Selesai (Step 8)
                document.getElementById('progressBar').style.width = '100%';
            } else if (stepIndex === 1) {
                 // Kembali ke step 1
                document.getElementById('progressBar').style.width = '0%';
                document.getElementById('currentStepDisplay').textContent = 1;
            } else {
                 // Kembali ke Informasi Dasar (progress bar disembunyikan)
                 document.getElementById('progressContainer').classList.add('hidden');
            }
        }

        function nextStep(currentStepIndex) {
            if (currentStepIndex === 0) {
                // Logic Start Button
                const namaInput = document.getElementById('nama');
                if (namaInput.value.trim() === '') {
                    alert('Mohon isi Nama Lengkap Anda terlebih dahulu.');
                    return;
                }
                document.getElementById('step-0').style.display = 'none';
                document.getElementById('progressContainer').classList.remove('hidden');
                currentStep = 1;
                showStep(currentStep);
                return;
            }
            
            // Logic Pindah ke Pertanyaan Berikutnya
            currentStep = currentStepIndex + 1;

            if (currentStep <= totalSteps) {
                setTimeout(() => showStep(currentStep), 300);
            } else {
                // Semua pertanyaan selesai (Tampilkan Step 8/Submit)
                setTimeout(() => showStep(totalSteps + 1), 300);
            }
        }

        function prevStep(currentStepIndex) {
            currentStep = currentStepIndex - 1;
            
            if (currentStep >= 1) {
                // Kembali ke pertanyaan sebelumnya (Step 1 hingga 7)
                showStep(currentStep);
            } else if (currentStep === 0) {
                // Kembali ke Informasi Dasar (Step 0)
                document.getElementById('step-0').style.display = 'block';
                document.getElementById('progressContainer').classList.add('hidden');
                document.getElementById('step-1').style.display = 'none'; 
                currentStep = 0; 
            }
        }

        // Inisialisasi: Tampilkan hanya Informasi Dasar (step 0)
        document.addEventListener('DOMContentLoaded', () => {
            showStep(0);
        });
    </script>
</body>
</html>