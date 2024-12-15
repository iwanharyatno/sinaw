@extends('layouts.base')

@section('title', 'Login | SINAW')

@section('content')
<div class="min-h-screen bg-gray-800 flex items-center justify-center">
  <div class="bg-gray-900 rounded-lg shadow-lg flex flex-col-reverse md:flex-row w-full max-w-4xl">
    <!-- Bagian Kiri -->
    <div class="w-full md:w-1/2 p-8 text-white">
      <h1 class="text-3xl font-bold mb-2">SinaW</h1>
      <p class="text-sm mb-6">Belum Punya Akun? <a href="{{ route('home.register') }}" class="text-blue-400 underline">Buat Akun</a></p>
      @error('general')
        <div class="my-4 px-4 py-2 border-2 border-slate-500 rounded-lg bg-slate-600 bg-transparent text-white">
          {{ $message }}
        </div>
      @enderror  
      <!-- Form -->
      <form method="POST" action="{{ route('home.handle-login') }}" class="space-y-4">
        @csrf
        <div class="mb-4">
            <input
              type="text"
              placeholder="Email"
              value="{{ old("email") }}"
              name="email"
              class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring focus:ring-blue-500"
            />
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
          <input
            type="password"
            name="password"
            placeholder="Kata Sandi"
            class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring focus:ring-blue-500"
          />
          @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>
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
      <i class="fab fa-google mr-2"></i> Masuk Menggunakan Google
      </button>
    </div>

    <!-- Bagian Kanan -->
    <div class="w-full md:w-1/2 bg-blue-900 rounded-b-lg md:rounded-r-lg">
      <img src="{{ asset('/asset/login-image.jpg') }}" alt="" class="w-full h-full object-cover rounded-b-lg md:rounded-r-lg">
    </div>
  </div>
</div>
@endsection