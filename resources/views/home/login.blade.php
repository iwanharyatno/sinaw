@extends('layouts.base')

@section('title', 'Login | SINAW')


@section('content')
<div class="min-h-screen bg-gray-800 flex items-center justify-center">
  <div class="bg-gray-900 rounded-lg shadow-lg flex w-full max-w-4xl">
    <!-- Bagian Kiri -->
    <div class="w-1/2 p-8 text-white">
      <h1 class="text-3xl font-bold mb-2">SinaW</h1>
      <p class="text-sm mb-6">Belum Punya Akun? <a href="#" class="text-blue-400 underline">Buat Akun</a></p>
      
      <!-- Form -->
      <form action="#" class="space-y-4">
        <input
          type="text"
          placeholder="Username"
          class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring focus:ring-blue-500"
        />
        <input
          type="password"
          placeholder="Kata Sandi"
          class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring focus:ring-blue-500"
        />
        <div class="text-right">
          <a href="#" class="text-blue-400 text-sm hover:underline">Lupa Password?</a>
        </div>
        <button
          type="submit"
          class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition"
        >
          Masuk
        </button>
      </form>

      <!-- Divider -->
      <div class="flex items-center my-6">
        <hr class="flex-grow border-gray-700" />
        <span class="px-2 text-gray-500 text-sm">atau</span>
        <hr class="flex-grow border-gray-700" />
      </div>

      <!-- Masuk dengan Google -->
      <button class="w-full flex items-center justify-center gap-2 bg-white text-gray-800 py-2 rounded-lg hover:bg-gray-200">
        <img src="https://via.placeholder.com/20" alt="Google Logo" class="w-5 h-5 " />
        Masuk Menggunakan Google
      </button>
    </div>

    <!-- Bagian Kanan -->
    <div class="w-1/2 bg-white rounded-r-lg">
      <!-- Kosongkan untuk area putih sesuai gambar -->
    </div>
  </div>
</div>

@endsection