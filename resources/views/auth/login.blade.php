<!DOCTYPE html>
<html lang="id" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DSS SSB Sumberharjo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4 sm:p-8 theme-{{ $app_settings->theme_color ?? 'orange' }}">

    <div class="flex w-full max-w-5xl bg-white rounded-2xl shadow-xl overflow-hidden min-h-[600px]">
        
        <div class="w-full lg:w-1/2 flex flex-col p-8 sm:p-12 lg:p-16 justify-center relative">
            
            <div class="lg:hidden flex items-center mb-8">
                @if(isset($app_settings) && $app_settings->app_logo)
                    <img src="{{ Storage::url($app_settings->app_logo) }}" alt="Logo" class="h-8 object-contain mr-3">
                @else
                    <div class="w-8 h-8 bg-orange-600 rounded-lg flex items-center justify-center font-bold text-white text-xl mr-3 shadow-sm">S</div>
                @endif
                <span class="text-lg font-bold text-gray-900 tracking-tight">{{ $app_settings->app_name ?? 'DSS Sumberharjo' }}</span>
            </div>

            <div class="max-w-md w-full mx-auto space-y-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Selamat Datang</h2>
                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">Silakan masuk menggunakan akun pelatih atau administrator Anda untuk mengakses sistem.</p>
                </div>

                @if (session('status'))
                    <div class="p-4 rounded-lg bg-green-50 border border-green-100 text-sm font-medium text-green-700">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-4 rounded-lg bg-red-50 border border-red-100">
                        <div class="flex items-center text-red-800 text-sm font-bold mb-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Gagal masuk
                        </div>
                        <ul class="text-xs text-red-600 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Alamat Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="contoh@sumberharjo.com" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-semibold text-orange-600 hover:text-orange-700 transition-colors">Lupa sandi?</a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                    </div>

                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-orange-600 bg-gray-100 border-gray-300 rounded focus:ring-orange-500 cursor-pointer">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-600 cursor-pointer">
                            Ingat sesi saya
                        </label>
                    </div>

                    <button type="submit" class="w-full flex items-center justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors mt-2">
                        Masuk ke Dashboard
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </form>

                <p class="text-center text-xs text-gray-400 font-medium pt-6">
                    &copy; {{ date('Y') }} SSB Sumberharjo.
                </p>
            </div>
        </div>

        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-orange-600 to-orange-900 relative items-center justify-center p-12 overflow-hidden">
            
            <div class="absolute inset-0 bg-pattern opacity-30"></div>
            
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-orange-400 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-orange-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>

            <div class="relative z-10 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 mb-8 shadow-2xl">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h1 class="text-4xl font-bold text-white mb-4 tracking-tight leading-tight">
                    Optimasi Seleksi<br>Bakat Pemain
                </h1>
                <p class="text-orange-100 text-base max-w-md mx-auto leading-relaxed">
                    Sistem yang memadukan keahlian pelatih dengan presisi algoritma MOORA & Profile Matching untuk menentukan formasi tim terbaik.
                </p>
                
                <div class="mt-10 flex items-center justify-center space-x-4 text-sm font-medium text-white/80">
                    <span class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-orange-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Cepat</span>
                    <span class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-orange-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Objektif</span>
                    <span class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-orange-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Terukur</span>
                </div>
            </div>
        </div>
    </div>

</body>
</html>