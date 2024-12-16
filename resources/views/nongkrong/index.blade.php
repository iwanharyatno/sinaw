@extends('layouts.home')

@section('title', 'Nongkrong | SinaW')

@section('content')

    <nav class="bg-gray-900 p-4 flex justify-between items-center text-white font-poppins">
        <!-- Logo -->
        <img src="{{ asset('asset/sinaw-logo.png') }}" alt="SinaW Logo" class="h-10">

        <!-- Tombol Menu untuk Mobile -->
        <button id="menu-toggle" class="text-white focus:outline-none lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>

        <!-- Navigasi -->
        <ul class="hidden lg:flex gap-10 items-center">
            <li><a href="{{ route('home.index') }}" class="hover:text-blue-400">Beranda</a></li>
            <li><a href="{{ route('aktivitas.index') }}" class="hover:text-blue-400">Aktivitas Saya</a></li>
            <li><a href="{{ route('nongkrong.index') }}" class="hover:text-blue-400">Nongkrong</a></li>
            <li><a href="{{ route('quiz.index') }}" class="hover:text-blue-400">Kuis</a></li>
        </ul>

        <!-- Tombol Aksi -->
        @auth
            <div class="hidden lg:flex items-center gap-4">
                <a href="{{ route('nongkrong.create') }}"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                    + Tuliskan
                </a>
                <a href="{{ route('nongkrong.mine') }}"
                    class="bg-transparent text-green-500 px-4 py-2 rounded-lg hover:bg-green-500 hover:text-white transition">
                    Tulisan Saya
                </a>

                <div class="relative rounded-full group p-2 text-black">
                    <img src="{{ auth()->user()->avatar ? '/image/' . auth()->user()->avatar : 'https://via.placeholder.com/64' }}"
                        alt="Profile" class="w-10 h-10 rounded-full">
                    <div class="absolute divide-y top-full right-0 w-44 bg-white rounded-md -mt-1 hidden group-hover:block">
                        <ul>
                            <li class="px-4 py-2 border-b-2"><strong>Account</strong></li>
                            <li><a href="{{ route('user.profile') }}"
                                    class="block w-full text-left px-4 py-2 hover:bg-slate-300 rounded-b-md">Edit
                                    Profile</a></li>
                            <li>
                                <form class="block" method="POST" action="{{ route('home.logout') }}">
                                    @csrf
                                    <button
                                        class="block w-full text-left px-4 py-2 hover:bg-slate-300 rounded-b-md">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @else
            <div class="flex gap-4">
                <a href="{{ route('home.register') }}"
                    class="bg-pink-500 text-white px-4 py-2 rounded-full hover:bg-pink-600">Daftar</a>
                <a href="{{ route('home.login') }}"
                    class="bg-pink-500 text-white px-4 py-2 rounded-full hover:bg-pink-600">Masuk</a>
            </div>
        @endauth
    </nav>

    <!-- Sidebar -->
    <div id="sidebar"
        class="fixed top-0 left-0 bg-gray-900 text-white w-64 h-full transform -translate-x-full transition-transform duration-300 z-50">
        <div class="p-4">
            <!-- Tombol Tutup -->
            <button id="sidebar-close" class="text-white focus:outline-none mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Menu Sidebar -->
            <ul class="p-4">
                <li><a href="{{ route('home.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded-md">Beranda</a>
                </li>
                <li><a href="{{ route('aktivitas.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded-md">Aktivitas
                        Saya</a></li>
                <li><a href="{{ route('nongkrong.index') }}"
                        class="block py-2 px-4 hover:bg-gray-700 rounded-md">Nongkrong</a></li>
                <li><a href="{{ route('quiz.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded-md">Kuis</a></li>
            </ul>
            <hr class="my-4 border-gray-700">
            <a href="{{ route('nongkrong.create') }}"
                class="block bg-green-500 text-center text-white px-4 py-2 rounded-lg hover:bg-green-600 transition mb-4">
                + Tuliskan
            </a>
            <a href="{{ route('nongkrong.mine') }}"
                class="block bg-transparent text-center text-white px-4 py-2 rounded-lg hover:bg-green-500  transition">
                Tulisan Saya
            </a>
            <form method="POST" action="{{ route('home.logout') }}">
                @csrf
                <button class="block w-full bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 mt-4">
                    Logout
                </button>
            </form>
        </div>
    </div>


    <div class="bg-gray-800 min-h-screen">
        <!-- Main Content -->
        <div class="p-8 grid gap-8 container mx-auto md:grid-cols-3">
            <!-- Left Column -->
            <div class="md:col-span-2">
                <!-- Input untuk Postingan -->
                <div class="bg-white text-black p-4 rounded-lg mb-6">
                    <a href="{{ route('nongkrong.create') }}" class="w-full">
                        <input type="text" placeholder="Bagaimana update hari ini?"
                            class="w-full bg-slate-50 border-2 px-4 py-2 rounded-lg focus:outline-none" readonly />
                    </a>
                </div>

                <!-- Tambahkan Postingan Lagi -->
                @foreach ($threads as $thread)
                    <div class="bg-white p-6 rounded-lg mb-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class=" rounded-full bg-red-500">
                                <img src="{{ $thread->user->avatar ? '/image/' . $thread->user->avatar : 'https://via.placeholder.com/64' }}"
                                    alt="Profile" class="w-10 h-10 rounded-full">
                            </div>
                            <div>
                                <h3 class="font-bold text-black">
                                    {{ $thread->user->first_name . ' ' . $thread->user->last_name }}</h3>
                                <p class="text-black text-sm">
                                    {{ Carbon\Carbon::parse($thread->created_at)->format('d M Y') }}</p>
                            </div>
                            <a href="{{ route('nongkrong.index', ['category' => $thread->category]) }}"
                                class="ml-auto text-sm bg-indigo-900 text-white py-1 px-4 rounded-full">{{ $thread->category }}</a>
                        </div>
                        <h4 class="font-bold text-lg mb-2 text-black">
                            {{ $thread->title }}
                        </h4>
                        <p class="text-black mb-4">
                            {{ $thread->replies[0]->content }}
                        </p>
                        <div class="flex items-center gap-4">
                            <button
                                class="flex items-center gap-2 text-gray-400 hover:text-purple-300 @auth {{ $thread->likes->where('id', auth()->user()->id)->first() ? 'text-indigo-900 font-bold liked' : '' }} @endauth"
                                @auth onclick="handleLikeClick(this, '{{ route('nongkrong.update-like', $thread->id) }}')" @endauth>
                                👍 <span class="thread-like-count">{{ $thread->likes_count }}</span>
                            </button>
                            <a href="{{ route('nongkrong.reply', $thread->id) }}"
                                class="flex items-center gap-2 text-gray-400 hover:text-purple-300">
                                💬 {{ $thread->replies->count() - 1 }}
                            </a>
                        </div>
                    </div>
                @endforeach

                <div class="mt-8 w-full bg-white rounded-lg pl-4">
                    {!! $threads->links() !!}
                </div>
            </div>

            <!-- Right Column -->
            <div class="w-full md:w-auto bg-white p-6 rounded-lg">
                <h4 class="font-bold text-lg mb-4 text-black">Eksplor Topik</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('nongkrong.index', ['category' => 'Matematika']) }}"
                            class="block border-2 px-4 py-2 rounded-lg hover:bg-slate-300 {{ request('category') == 'Matematika' ? 'bg-indigo-900 hover:bg-indigo-950 text-white' : 'bg-white' }}">Matematika</a>
                    </li>
                    <li><a href="{{ route('nongkrong.index', ['category' => 'Sains']) }}"
                            class="block border-2 px-4 py-2 rounded-lg hover:bg-slate-300 {{ request('category') == 'Sains' ? 'bg-indigo-900 hover:bg-indigo-950 text-white' : 'bg-white' }}">Sains</a>
                    </li>
                    <li><a href="{{ route('nongkrong.index', ['category' => 'Teknologi']) }}"
                            class="block border-2 px-4 py-2 rounded-lg hover:bg-slate-300 {{ request('category') == 'Teknologi' ? 'bg-indigo-900 hover:bg-indigo-950 text-white' : 'bg-white' }}">Teknologi</a>
                    </li>
                    <li><a href="{{ route('nongkrong.index', ['category' => 'Komputer']) }}"
                            class="block border-2 px-4 py-2 rounded-lg hover:bg-slate-300 {{ request('category') == 'Komputer' ? 'bg-indigo-900 hover:bg-indigo-950 text-white' : 'bg-white' }}">Komputer</a>
                    </li>
                    <li><a href="{{ route('nongkrong.index', ['category' => 'Filosofi']) }}"
                            class="block border-2 px-4 py-2 rounded-lg hover:bg-slate-300 {{ request('category') == 'Filosofi' ? 'bg-indigo-900 hover:bg-indigo-950 text-white' : 'bg-white' }}">Filosofi</a>
                    </li>
                    <li><a href="{{ route('nongkrong.index', ['category' => 'Lainnya']) }}"
                            class="block border-2 px-4 py-2 rounded-lg hover:bg-slate-300 {{ request('category') == 'Lainnya' ? 'bg-indigo-900 hover:bg-indigo-950 text-white' : 'bg-white' }}">Lainnya</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Elemen-elemen DOM
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarClose = document.getElementById('sidebar-close');

        // Event Listener untuk membuka sidebar
        menuToggle.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
        });

        // Event Listener untuk menutup sidebar
        sidebarClose.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });
    </script>

    @auth
        <script>
            function handleLikeClick(button, path) {
                const likeCount = button.querySelector('.thread-like-count');

                const liked = button.classList.contains('liked');

                const addLikeEffect = () => {
                    likeCount.innerText = Number(likeCount.innerText) + 1;
                    button.classList.remove('text-gray-400');
                    button.classList.add(...('text-indigo-900 font-bold liked'.split(' ')));
                };

                const removeLikeEffect = () => {
                    likeCount.innerText = Number(likeCount.innerText) - 1;
                    button.classList.add('text-gray-400');
                    button.classList.remove(...('text-indigo-900 font-bold liked'.split(' ')));
                }

                if (!liked) {
                    addLikeEffect();
                } else {
                    removeLikeEffect();
                }

                fetch(path, {
                        method: 'POST',
                        headers: {
                            'Content-type': 'application/json'
                        },
                        body: JSON.stringify({
                            _token: '{{ csrf_token() }}',
                        })
                    })
                    .then(res => {
                        if (res.ok) {
                            return res.json();
                        }
                        return null;
                    })
                    .then(res => {
                        if (!res) {
                            Swal.fire({
                                icon: 'error',
                                text: 'Gagal menambahkan like, coba lagi nanti'
                            });
                            removeLikeEffect();
                        }
                    })
                    .catch(e => {
                        Swal.fire({
                            icon: 'error',
                            text: 'Gagal menambahkan like, coba lagi nanti'
                        });
                        removeLikeEffect();
                    });
            }
        </script>
    @endauth
@endpush
