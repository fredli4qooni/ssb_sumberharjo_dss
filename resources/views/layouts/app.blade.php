<!DOCTYPE html>
<html lang="id" class="antialiased">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $app_settings->app_name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
    </style>
</head>

<body class="text-gray-800 theme-{{ $app_settings->theme_color ?? 'orange' }}">

    <div class="min-h-screen flex">

        @include('layouts.sidebar')

        <div class="flex-1 ml-64 flex flex-col min-h-screen transition-all duration-300">

            <header class="bg-white border-b border-gray-200 sticky top-0 z-10">
                <div class="px-8 py-4 flex items-center justify-between">
                    <h1 class="text-lg font-bold text-gray-900">@yield('header_title', 'Dashboard')</h1>

                    <div class="flex items-center space-x-4 relative">

                        <div id="notification-wrapper" class="relative">
                            <button id="notification-btn" class="text-gray-400 hover:text-orange-600 transition-colors relative focus:outline-none p-1">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="absolute top-1 right-1 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white animate-pulse"></span>
                                @endif
                            </button>

                            <div id="notification-menu" class="hidden absolute right-0 mt-3 w-80 bg-white rounded-xl border border-gray-200 shadow-lg z-50 overflow-hidden origin-top-right transition-all">
                                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/80 flex justify-between items-center">
                                    <h3 class="text-sm font-bold text-gray-900">Notifikasi</h3>
                                    <span class="bg-orange-100 text-orange-700 text-[10px] font-bold px-2 py-0.5 rounded-full">
                                        {{ auth()->user()->unreadNotifications->count() }} Baru
                                    </span>
                                </div>

                                <div class="max-h-80 overflow-y-auto">
                                    @forelse(auth()->user()->unreadNotifications as $notification)
                                    <a href="{{ $notification->data['url'] }}" class="block px-4 py-3 border-b border-gray-50 hover:bg-orange-50/50 transition-colors bg-orange-50/10">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center mr-3 mt-0.5">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-xs font-semibold text-gray-900">{{ $notification->data['title'] }}</p>
                                                <p class="text-xs text-gray-600 mt-0.5">{{ $notification->data['message'] }}</p>
                                                <p class="text-[10px] text-gray-400 mt-1 font-medium">{{ $notification->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </a>
                                    @empty
                                    <div class="p-8 text-center">
                                        <p class="text-xs text-gray-400">Tidak ada notifikasi baru.</p>
                                    </div>
                                    @endforelse
                                </div>

                                @if(auth()->user()->unreadNotifications->count() > 0)
                                <form action="{{ route('notifications.markAllRead') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full px-4 py-2.5 border-t border-gray-100 text-center bg-gray-50 hover:bg-gray-100 transition-colors text-xs font-semibold text-orange-600 focus:outline-none">
                                        Tandai semua dibaca
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-8 relative">
                @if(session('success'))
                <div id="toast-success" class="fixed bottom-5 right-5 flex items-center w-full max-w-xs p-4 space-x-3 text-gray-500 bg-white rounded-xl shadow-lg border border-green-100 z-50 transform transition-all duration-300" role="alert">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                    </div>
                    <div class="ml-3 text-sm font-semibold text-gray-800">{{ session('success') }}</div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 items-center justify-center" onclick="document.getElementById('toast-success').remove()">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                @endif

                @if(session('error'))
                <div id="toast-error" class="fixed bottom-5 right-5 flex items-center w-full max-w-xs p-4 space-x-3 text-gray-500 bg-white rounded-xl shadow-lg border border-red-100 z-50 transform transition-all duration-300" role="alert">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.5 11.5a1 1 0 0 1-1.414 1.414L10 11.414l-2.086 2.086a1 1 0 0 1-1.414-1.414L8.586 10 6.5 7.914a1 1 0 0 1 1.414-1.414L10 8.586l2.086-2.086a1 1 0 0 1 1.414 1.414L11.414 10l2.086 2.086Z"/>
                        </svg>
                    </div>
                    <div class="ml-3 text-sm font-semibold text-gray-800">{{ session('error') }}</div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 items-center justify-center" onclick="document.getElementById('toast-error').remove()">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                @endif

                @yield('content')
            </main>

            <footer class="bg-white border-t border-gray-200 py-4 px-8 text-center md:text-left">
                <p class="text-xs text-gray-500 font-medium">&copy; {{ date('Y') }} SSB Sumberharjo. Sistem Pendukung Keputusan (DSS).</p>
            </footer>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notifBtn = document.getElementById('notification-btn');
            const notifMenu = document.getElementById('notification-menu');

            notifBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                notifMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function(e) {
                if (!notifBtn.contains(e.target) && !notifMenu.contains(e.target)) {
                    notifMenu.classList.add('hidden');
                }
            });

            // Toast auto-hide
            const toasts = ['toast-success', 'toast-error'];
            toasts.forEach(id => {
                const toast = document.getElementById(id);
                if (toast) {
                    setTimeout(() => {
                        toast.classList.add('opacity-0', 'translate-y-4');
                        setTimeout(() => toast.remove(), 300);
                    }, 4000);
                }
            });
        });
    </script>
</body>
</html>