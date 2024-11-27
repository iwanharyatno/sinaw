@extends('layouts.base')

@section('title', 'Kelas | SINAW')

@section('content')
<nav class="bg-purple-800 p-4 flex justify-between items-center">
    <div class="flex items-center gap-6 flex-grow text-white">
      <h1 class="text-2xl font-bold text-white">Kelas</h1>
      <ul class="flex gap-6 text-sm justify-center  items-center flex-grow">
        <li><a href="#" class="hover:text-blue-300">Beranda</a></li>
        <li><a href="#" class="hover:text-blue-300">Kelas</a></li>
        <li><a href="#" class="hover:text-blue-300">Aktivitas Saya</a></li>
        <li><a href="#" class="hover:text-blue-300">Artikel</a></li>
        <li><a href="#" class="hover:text-blue-300">Kuis</a></li>
      </ul>
    </div>
    <div class="flex items-center gap-4">
      <div class="flex items-center bg-gray-200 rounded-full px-4 py-2">
        <span class="text-gray-800">Dominic Dinand</span>
        <div class="ml-2 w-8 h-8 rounded-full bg-gray-400 flex items-center justify-center"></div>
      </div>
    </div>
  </nav>

  <!-- Konten Utama -->
  <div class="p-8 flex flex-col gap-6">
    <!-- Pencarian dan Tombol -->
    <div class="flex items-center gap-4">
      <input
        type="text"
        placeholder="Temukan Kelas Saya"
        class="w-3/5 bg-gray-100 text-gray-900 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
      />
      <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
        Buat Kelas
      </button>
      <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
        Masuk Kelas
      </button>
    </div>

    <!-- Grid Kelas -->
    <div class="grid grid-cols-3  gap-6">
      <!-- Kartu Kelas -->
      <div class="bg-white rounded-lg p-6 shadow-lg hover:shadow-xl">
        <a href="">
            <img src="https://via.placeholder.com/64" alt="Aktivitas" class="mx-auto mb-4">
        </a>
      </div>
      <div class="bg-white rounded-lg p-6 shadow-lg hover:shadow-xl">
        <a href="">
            <img src="https://via.placeholder.com/64" alt="Aktivitas" class="mx-auto mb-4">
        </a>
      </div>
      <div class="bg-white rounded-lg p-6 shadow-lg hover:shadow-xl">
        <a href="">
            <img src="https://via.placeholder.com/64" alt="Aktivitas" class="mx-auto mb-4">
        </a>
      </div>
    </div>
  </div>
@endsection