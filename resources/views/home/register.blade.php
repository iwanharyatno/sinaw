@extends('layouts.base')

@section('title', 'Register | SINAW')

@section('content')
<div class="bg-gray-800 flex items-center justify-center min-h-screen">
    <div class="bg-gray-900 text-white rounded-lg shadow-lg w-full max-w-4xl flex flex-col-reverse md:flex-row">
        <div class="w-full md:w-1/2 p-8">
            <h1 class="text-3xl font-bold mb-2" style="font-family: 'Nunito', sans-serif;">Selamat Datang</h1>
            <p class="mb-6">Sudah Punya Akun? <a href="{{ route('home.login') }}" class="text-blue-400">Masuk</a></p>
    
            <form method="POST" action="{{ route('home.handle-register') }}">
                @csrf
                <div class="flex flex-col md:flex-row md:space-x-4 mb-4">
                    <div class="w-full md:w-1/2 mb-4 md:mb-0">
                        <input value="{{ old('first_name') }}" type="text" placeholder="Nama Depan*" class="w-full p-2 rounded bg-gray-700 text-white" name="first_name">
                        @error('first_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2">
                        <input value="{{ old('last_name') }}" type="text" placeholder="Nama Belakang" class="w-full p-2 rounded bg-gray-700 text-white" name="last_name">
                        @error('last_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <input value="{{ old('email') }}" type="text" placeholder="Email*" class="w-full p-2 rounded bg-gray-700 text-white" name="email">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <input type="password" placeholder="Kata Sandi*" class="w-full p-2 rounded bg-gray-700 text-white" name="password">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <input type="password" placeholder="Konfirmasi Kata Sandi*" class="w-full p-2 rounded bg-gray-700 text-white" name="password_confirmation">
                    @error('password_confirmation')
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
        <div class="w-full md:w-1/2 bg-white rounded-lg">
            <img src="{{ asset('/asset/login-image.jpg') }}" alt="" class="w-full h-full object-cover rounded-b-lg md:rounded-r-lg">
        </div>
    </div>
</div>
@endsection