@extends('layouts.base')

@section('title', 'Kuis | SINAW')

@section('content')

<body class="bg-gray-800 text-white min-h-screen">
  <!-- Navbar -->
  <nav class="bg-gray-900 p-4 flex justify-between items-center h-16">

  <div class="flex items-center gap-4 h-full flex-grow">
  <h1 class="text-2xl font-bold text-blue-400">SinaW</h1>
  <ul class="flex gap-10 justify-center items-center flex-grow">
    <li><a href="#" class="hover:text-blue-400">Beranda</a></li>
    <li><a href="#" class="hover:text-blue-400">Kelas</a></li>
    <li><a href="#" class="hover:text-blue-400">Aktivitas Saya</a></li>
    <li><a href="#" class="hover:text-blue-400">Nongkrong</a></li>
    <li><a href="#" class="hover:text-blue-400">Kuis</a></li>
  </ul>
</div>

    <div class="flex items-center gap-4">
      <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
        + Buat Kuis
      </button>
      <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center">
        <span class="text-white font-bold">D</span> <!-- Ganti dengan gambar profil -->
      </div>
    </div>
  </nav>

  <!-- Konten -->
  <div class="p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold">Cari atau buat kuis</h2>
    </div>
    
    <!-- Filter dan Pencarian -->
    <div class="flex items-center gap-4 mb-6">
      <select class="bg-gray-900 text-white px-4 py-2 rounded-lg border border-gray-700 focus:ring focus:ring-blue-500">
        <option>Total Pertanyaan 5 atau lebih</option>
      </select>
      <button class="bg-gray-700 text-white px-4 py-2 rounded-lg">Reset</button>
      <button class="bg-gray-700 text-white px-4 py-2 rounded-lg">Tambah Filter</button>
      <input
        type="text"
        placeholder="Cari Kuis Disini..."
        class="flex-grow bg-gray-900 text-white px-4 py-2 rounded-lg border border-gray-700 focus:outline-none focus:ring focus:ring-blue-500"
      />
      <button class="bg-gray-700 px-4 py-2 rounded-lg text-white">Terbaru</button>
    </div>

    <!-- Grid Kartu Kuis -->
    <div class="grid grid-cols-4 gap-6">
      <!-- Kartu Kuis -->
      <div class="bg-yellow-400 text-gray-900 p-4 rounded-lg shadow-md">
        <img src="https://via.placeholder.com/150" alt="Thumbnail" class="w-full h-24 object-cover rounded-lg mb-4" />
        <h3 class="text-lg font-bold">Logika Matematika Dasar</h3>
        <p class="text-sm text-gray-700">Mudah • 16 Soal</p>
        <p class="text-sm text-gray-700 mb-4">Dibuat 1j lalu</p>
        <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Mulai Langsung</button>
      </div>
      <!-- Salin kartu di atas untuk mengisi grid -->
      <!-- Kartu Lainnya -->
      <div class="bg-yellow-400 text-gray-900 p-4 rounded-lg shadow-md">
        <img src="https://via.placeholder.com/150" alt="Thumbnail" class="w-full h-24 object-cover rounded-lg mb-4" />
        <h3 class="text-lg font-bold">Logika Matematika Dasar</h3>
        <p class="text-sm text-gray-700">Mudah • 16 Soal</p>
        <p class="text-sm text-gray-700 mb-4">Dibuat 1j lalu</p>
        <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Mulai Langsung</button>
      </div>
      <!-- Tambah Kartu Lagi -->
    </div>
  </div>

@endsection