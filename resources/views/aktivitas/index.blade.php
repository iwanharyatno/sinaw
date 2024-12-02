@extends('layouts.home')

@section('title', 'aktivitas | SinaW')

@section('Home_content')
<body class="bg-gray-900 text-white min-h-screen">

  <!-- Navbar -->
  

  <!-- Main Content -->
  <div class="p-8">
  <div class="flex mb-6">
  <!-- Button "Berjalan" -->
  <button
    class="px-6 py-2 text-white bg-blue-500 rounded-l-full border-2 border-blue-600 hover:bg-blue-600 transition-all">
    Berjalan
  </button>
  
  <!-- Button "Selesai" -->
  <button
    class="px-6 py-2 text-white bg-purple-500 border-2 border-purple-600 -ml-px hover:bg-purple-600 transition-all">
    Selesai
  </button>
  
  <!-- Button "Dibuat" -->
  <button
    class="px-6 py-2 text-white bg-orange-500 rounded-r-full border-2 border-orange-600 -ml-px hover:bg-orange-600 transition-all">
    Dibuat
  </button>
</div>

    <!-- Card Grid -->
    <div class="grid grid-cols-3 gap-6">
      <!-- Card -->
      <div class="bg-purple-700 p-4 rounded-lg shadow-md">
        <div class="mb-4 text-sm text-purple-300 font-bold">50 Soal</div>
        <h3 class="text-lg font-bold text-white mb-2">
          Kuis Bahasa Inggris: Materi Pronouns Sentences
        </h3>
        <p class="text-sm text-purple-300 mb-6">By : Dini Riananti</p>
        <button class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
          Nilai | 80/100
        </button>
      </div>

      <!-- Duplikasi Card -->
      <div class="bg-purple-700 p-4 rounded-lg shadow-md">
        <div class="mb-4 text-sm text-purple-300 font-bold">50 Soal</div>
        <h3 class="text-lg font-bold text-white mb-2">
          Kuis Bahasa Inggris: Materi Pronouns Sentences
        </h3>
        <p class="text-sm text-purple-300 mb-6">By : Dini Riananti</p>
        <button class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
          Nilai | 80/100
        </button>
      </div>

      <div class="bg-purple-700 p-4 rounded-lg shadow-md">
        <div class="mb-4 text-sm text-purple-300 font-bold">50 Soal</div>
        <h3 class="text-lg font-bold text-white mb-2">
          Kuis Bahasa Inggris: Materi Pronouns Sentences
        </h3>
        <p class="text-sm text-purple-300 mb-6">By : Dini Riananti</p>
        <button class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
          Nilai | 80/100
        </button>
      </div>
    </div>
  </div>

</body>
@endsection