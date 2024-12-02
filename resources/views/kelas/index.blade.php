@extends('layouts.home')

@section('title', 'Kelas | SINAW')

@section('Home_content')


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