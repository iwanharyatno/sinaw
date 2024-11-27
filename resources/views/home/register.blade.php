@extends('layouts.base')

@section('title', 'Register | SINAW')

@section('content')
<div class="bg-gray-800 flex items-center justify-center min-h-screen">
    <div class="bg-gray-900 text-white rounded-lg shadow-lg p-8 w-8/12 flex gap-8">
        <div class="w-8/12">
            <h1 class="text-3xl font-bold mb-2" style="font-family: 'Nunito', sans-serif;">Selamat Datang</h1>
            <p class="mb-6">Sudah Punya Akun? <a href="#" class="text-blue-400">Masuk</a></p>
            <form method="POST" action="{{ route('home.handle-register') }}">
                @csrf
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <input type="text" placeholder="Nama*" class="w-full p-2 rounded bg-gray-700 text-white" name="fullname">
                        @error('fullname')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <input type="text" placeholder="Email*" class="w-full p-2 rounded bg-gray-700 text-white" name="email">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <input type="password" placeholder="Kata Sandi*" class="w-full p-2 rounded bg-gray-700 text-white" name="password">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <input type="password" placeholder="Konfirmasi Kata Sandi*" class="w-full p-2 rounded bg-gray-700 text-white" name="confirm_password">
                    @error('confirm_password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex items-center mb-4">
                    <input type="checkbox" id="remember" class="mr-2">
                    <label for="remember" class="text-sm">Ingat Password?</label>
                </div>
                <button class="w-full bg-blue-600 p-2 rounded text-white mb-4">Buat Akun</button>
                <div class="flex items-center mb-4">
                    <hr class="flex-grow border-gray-600">
                    <span class="mx-2 text-gray-400">atau</span>
                    <hr class="flex-grow border-gray-600">
                </div>
                <button class="w-full bg-gray-800 p-2 rounded text-white border border-gray-600 flex items-center justify-center">
                    <i class="fab fa-google mr-2"></i> Masuk Menggunakan Google
                </button>
            </form>
        </div>
        <div class="w-1/2 bg-white rounded-lg"></div>
    </div>
</div>
@endsection