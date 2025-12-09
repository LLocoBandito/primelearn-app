<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminatan IT | PRIME LEARN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Tambahan gaya navbar dari halaman Home */
        .navbar-dark {
            background-color: #06192A; /* Biru tua navbar utama */
        }

        /* Gaya tambahan untuk responsif dan tampilan skala Likert */
        .likert-option {
            width: 15%; /* Atur lebar opsi agar terlihat rapi */
            text-align: center;
        }
        .likert-row {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .likert-row:last-child {
            border-bottom: none; /* Hilangkan garis di baris terakhir */
        }
        .likert-label {
            width: 70%;
            font-weight: 500;
        }
        /* Responsif untuk likert-label */
        @media (max-width: 768px) {
            .likert-row {
                flex-direction: column;
                align-items: flex-start;
            }
            .likert-label {
                width: 100%;
                margin-bottom: 10px;
            }
            .likert-option-container {
                display: flex;
                justify-content: space-between;
                width: 100%;
            }
            .likert-option {
                width: 25%;
            }
        }
    </style>
</head>
<body class="bg-blue-50 text-gray-800 font-sans min-h-screen">

    <nav class="flex items-center justify-between px-8 py-4 navbar-dark fixed top-0 left-0 w-full z-50 shadow-xl">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo_putih.png') }}" alt="PrimeLearn Logo" class="h-8" />
            <span class="font-bold text-white text-2xl tracking-wide md:hidden">PrimeLearn</span>
        </div>

        <div class="absolute left-1/2 transform -translate-x-1/2 hidden md:block">
            <span class="font-bold text-white text-2xl tracking-wide">PrimeLearn</span>
        </div>
    </nav>
    
    <section class="pt-24 pb-12 px-6 md:px-20">
        <div class="max-w-6xl mx-auto bg-white p-8 md:p-12 rounded-xl shadow-2xl">

            <h1 class="text-3xl font-bold text-blue-700 mb-2 text-center">
                Tes Minat dan Bakat Bidang IT (Skala Likert)
            </h1>
            <p class="text-gray-600 mb-8 text-center border-b pb-4">
                Pilih tingkat persetujuan Anda untuk setiap pernyataan: **Sangat Setuju (SS), Setuju (S), Cukup Setuju (CS), atau Tidak Setuju (TS).**
            </p>

            <form id="peminatanForm" action="{{ route('peminatan.store') }}" method="POST" class="space-y-8">
                @csrf 
                
                <div class="space-y-4 mb-8 p-4 border border-gray-200 rounded-lg">
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-2">Informasi Dasar</h2>
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Lengkap
                        </label>
                        <input type="text" id="nama" name="nama" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Masukkan nama Anda">
                    </div>
                </div>

                <div class="flex font-bold text-sm text-gray-700 bg-gray-100 p-3 rounded-t-lg hidden md:flex">
                    <div class="likert-label">Pernyataan</div>
                    <div class="likert-option">SS</div>
                    <div class="likert-option">S</div>
                    <div class="likert-option">CS</div>
                    <div class="likert-option">TS</div>
                </div>
                
                <div class="flex font-bold text-xs text-gray-700 bg-gray-100 p-3 rounded-t-lg md:hidden justify-end">
                    <div class="likert-option w-1/4">SS</div>
                    <div class="likert-option w-1/4">S</div>
                    <div class="likert-option w-1/4">CS</div>
                    <div class="likert-option w-1/4">TS</div>
                </div>

                <div id="likertQuestions" class="space-y-1 border border-gray-200 p-4 rounded-lg">

                    <div class="text-blue-700 font-bold pt-4 pb-2 border-b-2 border-blue-100">I. Logika dan Pemrograman (Software Development)</div>
                    
                    <div class="likert-row">
                        <label for="q1" class="likert-label">1. Saya menikmati proses menerjemahkan ide abstrak menjadi instruksi langkah demi langkah yang sangat spesifik (algoritma).</label>
                        <div class="likert-option-container flex-grow flex justify-end md:justify-start">
                            <div class="likert-option"><input type="radio" name="q1" value="4" required class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q1" value="3" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q1" value="2" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q1" value="1" class="form-radio text-blue-600 h-5 w-5"></div>
                        </div>
                    </div>
                    <div class="likert-row">
                        <label for="q2" class="likert-label">2. Mencari dan memperbaiki kesalahan (*bug*) dalam kode atau sistem adalah kegiatan yang menantang dan memuaskan bagi saya.</label>
                        <div class="likert-option-container flex-grow flex justify-end md:justify-start">
                            <div class="likert-option"><input type="radio" name="q2" value="4" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q2" value="3" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q2" value="2" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q2" value="1" class="form-radio text-blue-600 h-5 w-5"></div>
                        </div>
                    </div>
                    <div class="likert-row">
                        <label for="q3" class="likert-label">3. Saya tertarik untuk menciptakan sesuatu yang fungsional, seperti aplikasi web atau perangkat lunak yang bisa digunakan orang lain.</label>
                        <div class="likert-option-container flex-grow flex justify-end md:justify-start">
                            <div class="likert-option"><input type="radio" name="q3" value="4" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q3" value="3" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q3" value="2" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q3" value="1" class="form-radio text-blue-600 h-5 w-5"></div>
                        </div>
                    </div>

                    <div class="text-blue-700 font-bold pt-6 pb-2 border-b-2 border-blue-100">II. Jaringan dan Infrastruktur</div>
                    <div class="likert-row">
                        <label for="q4" class="likert-label">4. Saya tertarik pada cara kerja koneksi internet, server, dan bagaimana data bergerak melalui jaringan.</label>
                        <div class="likert-option-container flex-grow flex justify-end md:justify-start">
                            <div class="likert-option"><input type="radio" name="q4" value="4" required class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q4" value="3" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q4" value="2" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q4" value="1" class="form-radio text-blue-600 h-5 w-5"></div>
                        </div>
                    </div>
                    <div class="likert-row">
                        <label for="q5" class="likert-label">5. Saya menyukai tugas yang melibatkan pengaturan, konfigurasi, dan pemeliharaan perangkat keras dan sistem operasi (*server*).</label>
                        <div class="likert-option-container flex-grow flex justify-end md:justify-start">
                            <div class="likert-option"><input type="radio" name="q5" value="4" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q5" value="3" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q5" value="2" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q5" value="1" class="form-radio text-blue-600 h-5 w-5"></div>
                        </div>
                    </div>
                    <div class="likert-row">
                        <label for="q6" class="likert-label">6. Saya memiliki perhatian tinggi pada stabilitas sistem dan memastikan bahwa layanan teknologi terus berjalan tanpa gangguan (*uptime*).</label>
                        <div class="likert-option-container flex-grow flex justify-end md:justify-start">
                            <div class="likert-option"><input type="radio" name="q6" value="4" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q6" value="3" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q6" value="2" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q6" value="1" class="form-radio text-blue-600 h-5 w-5"></div>
                        </div>
                    </div>

                    <div class="text-blue-700 font-bold pt-6 pb-2 border-b-2 border-blue-100">III. Keamanan Siber</div>
                    <div class="likert-row">
                        <label for="q7" class="likert-label">7. Saya penasaran dan tertarik untuk mengetahui titik lemah atau celah keamanan dalam sebuah sistem atau aplikasi.</label>
                        <div class="likert-option-container flex-grow flex justify-end md:justify-start">
                            <div class="likert-option"><input type="radio" name="q7" value="4" required class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q7" value="3" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q7" value="2" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q7" value="1" class="form-radio text-blue-600 h-5 w-5"></div>
                        </div>
                    </div>
                    <div class="likert-row">
                        <label for="q8" class="likert-label">8. Saya tertarik pada konsep enkripsi, firewall, dan teknik-teknik yang digunakan untuk melindungi informasi rahasia.</label>
                        <div class="likert-option-container flex-grow flex justify-end md:justify-start">
                            <div class="likert-option"><input type="radio" name="q8" value="4" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q8" value="3" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q8" value="2" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q8" value="1" class="form-radio text-blue-600 h-5 w-5"></div>
                        </div>
                    </div>
                    <div class="likert-row">
                        <label for="q9" class="likert-label">9. Saya siap untuk terus belajar tentang taktik peretasan terbaru agar saya dapat merancang pertahanan yang lebih baik.</label>
                        <div class="likert-option-container flex-grow flex justify-end md:justify-start">
                            <div class="likert-option"><input type="radio" name="q9" value="4" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q9" value="3" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q9" value="2" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q9" value="1" class="form-radio text-blue-600 h-5 w-5"></div>
                        </div>
                    </div>

                    <div class="text-blue-700 font-bold pt-6 pb-2 border-b-2 border-blue-100">IV. Analisis Data dan AI</div>
                    <div class="likert-row">
                        <label for="q10" class="likert-label">10. Saya suka bekerja dengan angka dan data yang besar untuk menemukan pola, tren, atau anomali yang tersembunyi.</label>
                        <div class="likert-option-container flex-grow flex justify-end md:justify-start">
                            <div class="likert-option"><input type="radio" name="q10" value="4" required class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q10" value="3" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q10" value="2" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q10" value="1" class="form-radio text-blue-600 h-5 w-5"></div>
                        </div>
                    </div>
                    <div class="likert-row">
                        <label for="q11" class="likert-label">11. Saya tertarik menggunakan matematika dan statistik untuk membuat prediksi atau memberikan wawasan yang mendukung keputusan bisnis.</label>
                        <div class="likert-option-container flex-grow flex justify-end md:justify-start">
                            <div class="likert-option"><input type="radio" name="q11" value="4" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q11" value="3" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q11" value="2" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q11" value="1" class="form-radio text-blue-600 h-5 w-5"></div>
                        </div>
                    </div>
                    <div class="likert-row">
                        <label for="q12" class="likert-label">12. Saya memiliki kesabaran yang tinggi dalam membersihkan dan menganalisis *dataset* yang kompleks dan berantakan.</label>
                        <div class="likert-option-container flex-grow flex justify-end md:justify-start">
                            <div class="likert-option"><input type="radio" name="q12" value="4" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q12" value="3" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q12" value="2" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q12" value="1" class="form-radio text-blue-600 h-5 w-5"></div>
                        </div>
                    </div>

                    <div class="text-blue-700 font-bold pt-6 pb-2 border-b-2 border-blue-100">V. Desain Pengalaman Pengguna (UX/UI)</div>
                    <div class="likert-row">
                        <label for="q13" class="likert-label">13. Saya sangat memperhatikan apakah sebuah aplikasi mudah, intuitif, dan nyaman digunakan oleh orang lain.</label>
                        <div class="likert-option-container flex-grow flex justify-end md:justify-start">
                            <div class="likert-option"><input type="radio" name="q13" value="4" required class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q13" value="3" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q13" value="2" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q13" value="1" class="form-radio text-blue-600 h-5 w-5"></div>
                        </div>
                    </div>
                    <div class="likert-row">
                        <label for="q14" class="likert-label">14. Saya memiliki ketertarikan pada estetika visual, tata letak (*layout*), dan bagaimana warna memengaruhi interaksi pengguna.</label>
                        <div class="likert-option-container flex-grow flex justify-end md:justify-start">
                            <div class="likert-option"><input type="radio" name="q14" value="4" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q14" value="3" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q14" value="2" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q14" value="1" class="form-radio text-blue-600 h-5 w-5"></div>
                        </div>
                    </div>
                    <div class="likert-row">
                        <label for="q15" class="likert-label">15. Saya suka mengamati dan memahami perilaku pengguna untuk merancang solusi teknologi yang benar-benar mereka butuhkan.</label>
                        <div class="likert-option-container flex-grow flex justify-end md:justify-start">
                            <div class="likert-option"><input type="radio" name="q15" value="4" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q15" value="3" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q15" value="2" class="form-radio text-blue-600 h-5 w-5"></div>
                            <div class="likert-option"><input type="radio" name="q15" value="1" class="form-radio text-blue-600 h-5 w-5"></div>
                        </div>
                    </div>

                </div>
                
                <div class="pt-8">
                    <button type="submit"
                        class="w-full px-6 py-3 bg-blue-700 text-white rounded-lg font-semibold shadow-lg hover:bg-blue-800 transition transform hover:scale-[1.01]">
                        Lihat Hasil Rekomendasi Peminatan
                    </button>
                </div>

                <div class="pt-4">
                    <a href="{{ route('peminatan.skip') }}"
                        class="w-full block text-center px-6 py-3 bg-gray-300 text-gray-700 rounded-lg font-semibold shadow hover:bg-gray-400 transition">
                        Lewati Tes (Skip)
                    </a>
                </div>

            </form>
        </div>
    </section>

    <footer class="py-6 text-center text-gray-500 border-t border-blue-100 mt-8">
        © {{ date('Y') }} Primakara University | IT Learning Path Project
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            console.log("Formulir Skala Likert siap.");
            
            const form = document.getElementById('peminatanForm');
            form.addEventListener('submit', function(e) {
                // Periksa input Nama Lengkap
                const namaInput = document.getElementById('nama');
                if (!namaInput.value.trim()) {
                    e.preventDefault();
                    alert('Mohon masukkan Nama Lengkap Anda.');
                    return;
                }
                
                // Periksa semua pertanyaan Likert
                const requiredNames = ['q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11', 'q12', 'q13', 'q14', 'q15'];
                let allAnswered = true;
                
                requiredNames.forEach(name => {
                    const radios = document.getElementsByName(name);
                    let isChecked = false;
                    for (let i = 0; i < radios.length; i++) {
                        if (radios[i].checked) {
                            isChecked = true;
                            break;
                        }
                    }
                    if (!isChecked) {
                        allAnswered = false;
                    }
                });

                if (!allAnswered) {
                    e.preventDefault();
                    alert('Mohon lengkapi semua 15 pernyataan sebelum melihat hasil.');
                }
            });
        });
    </script>
</body>
</html>