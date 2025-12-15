<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tes Minat & Bakat IT | PRIME LEARN</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Gaya Dasar */
        body {
            background: #f7f9fc;
            font-family: system-ui, -apple-system, sans-serif;
            color: #1f2937; /* Warna teks dasar */
            min-height: 100vh;
        }

        /* Kartu Pertanyaan */
        .question-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            padding: 2.5rem; /* Padding lebih konsisten */
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .question-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Pilihan Jawaban */
        .choice {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px 20px;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #ffffff;
            font-size: 1.125rem; /* text-lg */
        }

        .choice:hover {
            border-color: #3b82f6;
            background: #eff6ff;
            transform: translateX(4px);
        }

        /* Menyembunyikan Radio Button Asli */
        input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* Gaya Pilihan Yang Terpilih */
        input[type="radio"]:checked + .choice {
            border-color: #2563eb;
            background: #dbeafe;
            font-weight: 500;
        }

        /* Progress Bar */
        .progress {
            height: 8px;
            background: #e5e7eb;
            border-radius: 999px;
            overflow: hidden;
            margin-bottom: 3rem;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(to right, #3b82f6, #2563eb);
            width: 0%;
            transition: width 0.4s ease;
        }

        /* Tombol */
        .btn {
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.2s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            /* Menambahkan bayangan kecil pada tombol */
        }

        .btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-prev {
            background: #f3f4f6;
            color: #4b5563;
        }

        .btn-next {
            background: #2563eb;
            color: white;
        }

        .btn-submit {
            background: #16a34a; /* Hijau yang lebih menonjol */
            color: white;
        }
    </style>
</head>
<body class="text-gray-800">

    <section class="max-w-3xl mx-auto py-16 px-6">
        <header class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">Tes Minat & Bakat IT</h1>
            <p class="text-lg text-gray-600">Jawab setiap pertanyaan dengan jujur untuk mengetahui kecenderungan minat Anda di bidang IT</p>
        </header>

        <div class="progress">
            <div id="bar" class="progress-bar"></div>
        </div>

        <form id="form" method="POST" action="{{ route('peminatan.store') }}">
            @csrf
          

            <div class="step">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        1. Saya menikmati proses menyusun logika / algoritma untuk memecahkan masalah.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q1" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q1" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q1" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q1" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        2. Saya lebih suka membangun fungsionalitas di belakang layar (**backend**) daripada tampilan depan (**frontend**) suatu aplikasi.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q7" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q7" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q7" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q7" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        3. Saya tidak keberatan menghabiskan waktu berjam-jam untuk memecahkan satu masalah coding yang sangat sulit.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q11" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q11" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q11" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q11" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        4. Saya tertarik mempelajari Struktur Data (misalnya, *linked list*, *tree*) dan efisiensi algoritma (*Big O notation*).
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q16" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q16" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q16" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q16" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        5. Saya tertarik dengan konsep pemrograman berorientasi objek (OOP) seperti *Class*, *Inheritance*, dan *Polymorphism*.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q20" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q20" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q20" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q20" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        6. Saya tertarik memahami cara kerja jaringan, server, dan infrastruktur.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q2" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q2" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q2" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q2" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        7. Saya penasaran bagaimana cara melindungi sistem dan data dari serangan siber (**hacking**).
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q6" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q6" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q6" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q6" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        8. Saya *enjoy* mengkonfigurasi dan memelihara sistem operasi server (seperti **Linux** atau **Windows Server**).
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q10" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q10" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q10" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q10" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        9. Saya tertarik untuk mempelajari celah keamanan dan melakukan *penetration testing* secara etis.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q12" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q12" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q12" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q12" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        10. Saya tertarik mempelajari protokol jaringan lanjutan (seperti **TCP/IP** mendalam) dan konsep **firewall/VPN**.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q18" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q18" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q18" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q18" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        11. Saya sangat peduli dengan tampilan visual dan kemudahan penggunaan (**user experience**) suatu produk digital.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q5" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q5" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q5" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q5" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        12. Saya suka membuat prototipe, sketsa, atau *wireframe* desain antarmuka pengguna (**UI**).
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q8" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q8" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q8" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q8" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        13. Saya suka menggabungkan kreativitas dengan logika untuk menciptakan solusi digital yang indah dan fungsional.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q13" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q13" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q13" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q13" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        14. Saya suka melakukan riset pengguna (wawancara, survei) untuk mengidentifikasi kebutuhan dan masalah mereka dalam menggunakan aplikasi.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q19" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q19" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q19" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q19" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        15. Saya tertarik dengan **AI**, **Machine Learning**, dan analisis data.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q3" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q3" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q3" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q3" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        16. Saya menikmati menganalisis pola, tren, dan data statistik dari sekumpulan data yang besar.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q4" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q4" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q4" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q4" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        17. Saya tertarik dengan kecerdasan buatan (**AI**), pembelajaran mesin (**Machine Learning**), dan cara kerja model prediktif.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q9" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q9" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q9" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q9" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        18. Saya percaya kemampuan matematika dan statistik saya cukup baik untuk diimplementasikan pada pemecahan masalah.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q14" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q14" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q14" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q14" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        19. Saya *enjoy* menyajikan data kompleks dalam bentuk grafik atau *dashboard* yang mudah dipahami (visualisasi data).
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q17" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q17" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q17" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q17" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        20. Saya tertarik pada teknologi *cloud computing* (seperti **AWS**, **Azure**, **Google Cloud**) dan virtualisasi.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q15" value="4" required><div class="choice">Sangat Setuju</div></label>
                        <label class="block"><input type="radio" name="q15" value="3"><div class="choice">Setuju</div></label>
                        <label class="block"><input type="radio" name="q15" value="2"><div class="choice">Cukup Setuju</div></label>
                        <label class="block"><input type="radio" name="q15" value="1"><div class="choice">Tidak Setuju</div></label>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center mt-12">
                <button type="button" id="prev" class="btn btn-prev hidden">← Kembali</button>
                <div class="flex space-x-4">
                    <button type="button" id="next" class="btn btn-next" disabled>Lanjut →</button>
                    <button type="submit" id="submit" class="btn btn-submit hidden" disabled>Lihat Hasil</button>
                </div>
            </div>

        </form>
    </section>

    <script>
        const steps = document.querySelectorAll('.step');
        const bar = document.getElementById('bar');
        const prevBtn = document.getElementById('prev');
        const nextBtn = document.getElementById('next');
        const submitBtn = document.getElementById('submit');
        const form = document.getElementById('form');

        let currentStep = 0;
        const totalQuestions = steps.length; // Lebih dinamis

        /**
         * Memperbarui tampilan progress bar.
         */
        function updateProgress() {
            // Formula: (Langkah saat ini + 1) / Total pertanyaan * 100
            const progress = ((currentStep + 1) / totalQuestions) * 100;
            bar.style.width = progress + '%';
        }

        /**
         * Menampilkan langkah pertanyaan tertentu.
         * @param {number} n Indeks langkah yang akan ditampilkan.
         */
        function showStep(n) {
            steps.forEach((step, i) => {
                // Tampilkan hanya langkah ke-n, sembunyikan yang lain
                step.classList.toggle('hidden', i !== n);
            });

            // Logika Tombol
            prevBtn.classList.toggle('hidden', n === 0);
            nextBtn.classList.toggle('hidden', n === steps.length - 1);
            submitBtn.classList.toggle('hidden', n !== steps.length - 1);

            updateProgress();
            
            // Periksa jawaban saat berpindah langkah untuk mengatur status tombol
            checkAnswerAndToggleButtons(n);
        }

        /**
         * Memeriksa apakah pertanyaan saat ini sudah dijawab dan mengatur status tombol.
         * @param {number} stepIndex Indeks langkah yang sedang aktif.
         */
        function checkAnswerAndToggleButtons(stepIndex) {
            const hasAnswer = steps[stepIndex].querySelector('input[type=radio]:checked');
            
            if (stepIndex < steps.length - 1) {
                // Untuk langkah 0 sampai n-1, atur tombol 'Lanjut'
                nextBtn.disabled = !hasAnswer;
                submitBtn.disabled = true; // Pastikan submit nonaktif
            } else {
                // Untuk langkah terakhir (n), atur tombol 'Submit'
                nextBtn.disabled = true; // Pastikan lanjut nonaktif
                submitBtn.disabled = !hasAnswer;
            }
        }

        /**
         * Handler untuk tombol Lanjut.
         */
        nextBtn.onclick = () => {
            const selected = steps[currentStep].querySelector('input[type=radio]:checked');
            if (!selected) {
                alert('Silakan pilih salah satu jawaban terlebih dahulu.');
                return;
            }
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        };

        /**
         * Handler untuk tombol Kembali.
         */
        prevBtn.onclick = () => {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        };

        // Event listener untuk mengaktifkan tombol saat jawaban dipilih
        form.addEventListener('change', (e) => {
            // Memastikan event berasal dari radio button di langkah yang sedang aktif
            if (e.target.type === 'radio' && e.target.closest('.step') === steps[currentStep]) {
                checkAnswerAndToggleButtons(currentStep);
            }
        });

        // Inisialisasi tampilan pertama
        showStep(0);
    </script>

</body>
</html>