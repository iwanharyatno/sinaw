@extends('layouts.home')

@section('title', 'Kuis Saya | SINAW')

@section('Home_content')

    <div class="bg-gray-800 text-white min-h-screen">
        <!-- Konten -->
        <div class="p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-white">Kuis Saya</h2>
            </div>

            <!-- Grid Kartu Kuis -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($quizes as $quiz)
                    @php
                        $difficulty = 'Mudah';

                        if ($quiz->difficulty == 'medium') {
                            $difficulty = 'Medium';
                        } elseif ($quiz->difficulty == 'hard') {
                            $difficulty = 'Sulit';
                        }
                    @endphp
                    <!-- Kartu Kuis -->
                    <div class="bg-gray-900 text-white p-4 rounded-lg shadow-md">
                        <a href="{{ route('quiz.show', $quiz->id) }}">
                            <img src="/image/{{ $quiz->header_path }}" alt="Thumbnail"
                                class="w-full h-24 object-cover rounded-lg mb-4" />
                            <h3 class="text-lg font-bold">{{ $quiz->quiz_name }} (Code: {{ $quiz->id }})</h3>
                            <p class="text-sm text-white">{{ $difficulty }} • {{ $quiz->questions->count() }} Soal</p>
                            <p class="text-sm text-white mb-4">
                                {{ Carbon\Carbon::parse($quiz->created_at)->locale('id')->diffForHumans() }}</p>
                        </a>
                        <div class="flex items-center justify-stretch gap-2">
                            <a href="{{ route('quiz.edit', $quiz->id) }}"
                                class="flex-1 inline-block bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition text-center"><i
                                    class="fa fa-edit" style="font-size:24px"></i></a>
                            <form action="{{ route('quiz.delete', $quiz->id) }}" method="post"
                                onsubmit="return handleQuizAction(event, 'Hapus', 'Ingin Menghapus kuis ini?')"
                                class="inline flex-1">
                                @csrf
                                <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-red-700 transition"><i
                                        class="fa fa-trash" style="font-size:24px"></i></button>
                            </form>
                            @if ($quiz->is_public)
                                <form class="flex-1"
                                    action="{{ route('quiz.change-visibility', ['id' => $quiz->id, 'is_public' => false]) }}"
                                    method="post"
                                    onsubmit="return handleQuizAction(event, 'Akhiri', 'Mengakhiri kuis ini?')"
                                    class="inline">
                                    @csrf
                                    <button
                                        class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">Akhiri
                                        Kuis </button>
                                </form>
                            @else
                                <form class="flex-1"
                                    action="{{ route('quiz.change-visibility', ['id' => $quiz->id, 'is_public' => true]) }}"
                                    method="post"
                                    onsubmit="return handleQuizAction(event, 'Mulai', 'Memulai kuis ini?')"class="inline">
                                    @csrf
                                    <button
                                        class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">Buka
                                        kuis </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <!-- Salin kartu di atas untuk mengisi grid -->
                @endforeach
            </div>
            <div class="mt-8 bg-white pl-4 rounded-full">
                {{ $quizes->links() }}
            </div>
        </div>

        <script>
            function handleQuizAction(event, action, message) {
                event.preventDefault(); // Mencegah submit form langsung

                const form = event.target; // Ambil referensi form yang di-submit
                Swal.fire({
                    title: `${action} Kuis?`,
                    text: `Apakah Anda yakin ingin ${message}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Lanjutkan',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit form jika konfirmasi diterima
                    }
                });
            }
        </script>

    </div>

@endsection
