@extends('layouts.home')

@section('title', 'Join Quiz | SINAW')

@section('Home_content')

    <div
        class="flex items-center justify-center min-h-screen bg-gradient-to-r from-gray-700 via-gray-700 to-gray-800 px-4">
        <div class="text-center w-full max-w-lg">
            <!-- Header -->
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-6">SinaW</h1>

            <!-- Card -->
            <div
                class="bg-purple-700  backdrop-blur-lg rounded-xl p-6 shadow-lg w-full h-auto md:w-[500px] md:h-[200px]">
                <div class="flex flex-wrap md:flex-nowrap justify-between items-center gap-4">
                    <!-- Profil -->
                    <div class="text-left w-full md:w-auto">
                        <p class="text-lg font-semibold text-white">
                            {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</p>
                        <p class="flex items-center text-sm text-white">
                            <span class="w-4 h-4 bg-yellow-500 rounded-full mr-2"></span>
                            {{ auth()->user()->points }} poin
                        </p>
                    </div>
                    <!-- Avatar -->
                    <div>
                    <img src="{{ auth()->user()->avatar ? '/image/' . auth()->user()->avatar : 'https://via.placeholder.com/64' }}"
                    alt="Profile" class="w-10 h-10 rounded-full">
                    </div>
                </div>

                <!-- Quiz Info -->
                <div class="mt-4 text-left">
                    <p class="text-lg font-bold text-white">{{ $quiz->quiz_name }}</p>
                    <p class="inline-block bg-pink-600 text-white text-sm font-bold px-3 py-1 rounded-full mt-2">
                        {{ $quiz->questions->count() }} Soal
                    </p>
                    <p class="text-xs mt-2 text-white">Pembuat: {{ $quiz->user->first_name . ' ' . $quiz->user->last_name }}
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <p class="mt-6 italic text-white text-6xl md:text-8xl" id="countDown">5</p>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const countDown = document.getElementById('countDown');
        let count = Number(countDown.innerText);

        function counting() {
            count--;
            countDown.innerText = count;
            if (count > 0) setTimeout(counting, 1000);
            else window.location.href = "{{ route('quiz.play', $quiz->id) }}"
        }

        setTimeout(counting, 1000);
    </script>
@endpush
