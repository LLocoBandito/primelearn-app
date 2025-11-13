<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IT Learning Path | Primakara University</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>
<body class="bg-white text-gray-800 font-sans">

  <!-- ===== Navbar ===== -->
  <nav class="flex items-center justify-between px-8 py-4 bg-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="flex items-center space-x-3">
      <img src="{{ asset('images/logo.png') }}" alt="Primakara University" class="h-10">
      <span class="font-bold text-blue-700 text-lg">PRIME LEARN</span>
    </div>

    <div class="space-x-6 text-blue-700 font-medium">
      <a href="#home" class="hover:text-blue-500 transition">Home</a>
      <a href="{{ url('/apply') }}" class="hover:text-blue-500 transition">Apply</a>
    </div>
  </nav>

  <!-- ===== Hero Section ===== -->
  <section id="home" class="pt-32 pb-20 px-6 md:px-20 flex flex-col-reverse md:flex-row items-center justify-between bg-gradient-to-b from-blue-50 to-white">
    <div class="md:w-1/2 mt-10 md:mt-0 text-center md:text-left">
      <h1 class="text-4xl md:text-5xl font-bold text-blue-700 leading-tight mb-6">
        Temukan Jalur Belajarmu di Dunia Teknologi Informasi
      </h1>
      <p class="text-gray-600 mb-8 max-w-md">
        Kami bantu kamu menemukan bidang IT yang paling sesuai dengan minatmu — dari pengembangan software hingga kecerdasan buatan.
      </p>
      <a href="{{ url('/apply') }}" class="px-6 py-3 bg-blue-700 text-white rounded-full font-semibold shadow hover:bg-blue-800 transition">
        Mulai Isi Peminatan
      </a>
    </div>
    <div class="md:w-1/2 flex justify-center">
      <img src="{{ asset('images/it.jpg') }}" alt="Belajar IT" class="w-80 md:w-[420px]">
    </div>
  </section>

  <!-- ===== Bidang IT Section ===== -->
  <section id="fields" class="py-20 bg-white px-6 md:px-20 text-center">
    <h2 class="text-3xl font-bold text-blue-700 mb-10">Bidang IT yang Bisa Kamu Pelajari</h2>
    <div class="grid md:grid-cols-3 gap-8">

      <div class="p-6 border border-blue-100 rounded-2xl shadow-sm hover:shadow-md transition">
        <h3 class="font-semibold text-xl text-blue-700 mb-2">Software Development</h3>
        <p class="text-gray-600 text-sm">
          Belajar membuat website, aplikasi mobile, dan sistem digital yang membantu banyak orang.
        </p>
      </div>

      <div class="p-6 border border-blue-100 rounded-2xl shadow-sm hover:shadow-md transition">
        <h3 class="font-semibold text-xl text-blue-700 mb-2">Data & AI</h3>
        <p class="text-gray-600 text-sm">
          Temukan kekuatan data dan kecerdasan buatan untuk menganalisis dan membuat keputusan pintar.
        </p>
      </div>

      <div class="p-6 border border-blue-100 rounded-2xl shadow-sm hover:shadow-md transition">
        <h3 class="font-semibold text-xl text-blue-700 mb-2">Networking & Cybersecurity</h3>
        <p class="text-gray-600 text-sm">
          Bangun dan amankan jaringan sistem digital agar tetap andal dan terlindungi.
        </p>
      </div>

    </div>
  </section>

  <!-- ===== Tentang Section ===== -->
  <section id="about" class="bg-blue-50 py-20 px-6 md:px-20 text-center">
    <h2 class="text-3xl font-bold text-blue-700 mb-6">Mengapa Belajar Bersama Kami?</h2>
    <p class="text-gray-600 max-w-3xl mx-auto mb-10">
      Website ini dirancang untuk membantu kamu menentukan arah pembelajaran IT berdasarkan minat dan gaya belajarmu.  
      Dapatkan rekomendasi bidang yang cocok, serta panduan belajar langkah demi langkah yang relevan dengan industri digital masa kini.
    </p>
    <a href="{{ url('/apply') }}" class="px-8 py-3 bg-blue-700 text-white rounded-full font-semibold hover:bg-blue-800 transition">
      Temukan Peminatanmu Sekarang
    </a>
  </section>

  <!-- ===== Footer ===== -->
  <footer class="py-6 text-center text-gray-500 border-t border-blue-100">
    © {{ date('Y') }} Primakara University | IT Learning Path Project
  </footer>

</body>
</html>
