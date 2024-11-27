@extends('layouts.base')

@section('title', 'Detail Kuis | SINAW')

@section('content')
    <html lang="en">
    <div class="bg-gray-800 text-white font-sans min-h-screen">
        <div class="p-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-lg">
                    Detail Kuis
                </h1>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-600 rounded-full mr-2">
                    </div>
                    <span>
                        Dominic Dinand
                    </span>
                </div>
            </div>
            <div class="bg-gray-700 p-6 rounded-lg flex max-w-screen-lg mx-auto">
                <div class="w-2/3">
                    <div class="flex items-center mb-4 gap-4">
                        <a href="{{ route('quiz.index') }}" class="text-white text-2xl mr-4">
                            <i class="fas fa-arrow-left">
                            </i>
                        </a>
                        <h2 class="text-xl">
                            Kuis/Logika Matematika
                        </h2>
                    </div>
                    <div class="bg-yellow-400 p-4 rounded-lg mb-4">
                        <img alt="Illustration of books and a lightbulb" class="w-full h-40 object-cover" height="200"
                            src="https://storage.googleapis.com/a1aa/image/YGz1oJIwcgL2GRXkfb3KTUgChwV6RfZbdHxz62rhEANzPJ1TA.jpg"
                            width="600" />
                    </div>
                    <h3 class="text-2xl mb-2">
                        Logika Matematika
                    </h3>
                    <div class="flex items-center mb-2">
                        <i class="fas fa-tachometer-alt mr-2">
                        </i>
                        <span class="mr-2">
                            Tingkat Kesulitan
                        </span>
                        <span class="bg-gray-600 text-white px-2 py-1 rounded">
                            Sedang
                        </span>
                    </div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-clock mr-2">
                        </i>
                        <span>
                            Durasi Waktu
                        </span>
                        <span class="ml-2">
                            1 Jam
                        </span>
                    </div>
                    <p class="text-gray-300 mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris euismod dignissim sapien ut
                        tincidunt. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus risus erat,
                        fringilla id risus ac, dapibus aliquet quam. Curabitur nec arcu id nisl posuere suscipit. Morbi
                        euismod, mauris et porta tristique, magna sapien cursus odio, eget sagittis nisi urna id libero.
                        Donec lacus sapien, maximus ac volutpat eget, gravida ac elit. Ut varius efficitur dui, et viverra
                        dolor convallis a.
                    </p>
                </div>
                <div class="w-1/3 pl-6">
                    <div class="bg-gray-600 p-4 rounded-lg mb-4">
                        <h4 class="text-lg mb-2">
                            Link Undangan
                        </h4>
                        <button class="bg-gray-700 text-white px-4 py-2 rounded">
                            Link Undangan
                        </button>
                    </div>
                    <div class="bg-gray-600 p-4 rounded-lg mb-4">
                        <h4 class="text-lg mb-2">
                            Peserta
                        </h4>
                        <ul>
                            <li class="flex items-center mb-2">
                                <div class="w-4 h-4 bg-gray-400 rounded-full mr-2">
                                </div>
                                <span>
                                    Dominic Dinand Aristo
                                </span>
                            </li>
                            <li class="flex items-center mb-2">
                                <div class="w-4 h-4 bg-gray-400 rounded-full mr-2">
                                </div>
                                <span>
                                    Bintang Fadilah Ramadhan
                                </span>
                            </li>
                            <li class="flex items-center mb-2">
                                <div class="w-4 h-4 bg-gray-400 rounded-full mr-2">
                                </div>
                                <span>
                                    Iwan Haryatno
                                </span>
                            </li>
                        </ul>
                    </div>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">
                        Masuk Kuis
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
