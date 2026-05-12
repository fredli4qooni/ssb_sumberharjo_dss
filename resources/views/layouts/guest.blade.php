<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SSB Sumberharjo DSS') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-[#FAFAFA] flex flex-col min-h-screen">
        
        <div class="flex-grow flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] overflow-hidden sm:rounded-2xl border border-gray-100">
                
                <div class="flex flex-col items-center mb-8">
                    <div class="w-12 h-12 bg-ssb-black rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"></path></svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">SSB Sumberharjo</h2>
                    <p class="text-xs text-gray-500 mt-1">Elite Performance Analytics</p>
                </div>

                {{ $slot }}
            </div>
        </div>

        <footer class="w-full bg-white border-t border-gray-200 py-4 px-6 md:px-12 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500">
            <div class="flex items-center space-x-2">
                <span class="font-bold text-gray-800 tracking-wider">SSB<br>SUMBERHARJO</span>
                <span class="border-l border-gray-300 pl-2">&copy; {{ date('Y') }} SSB Sumberharjo Performance Analytics. All rights reserved.</span>
            </div>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-gray-800">Kebijakan Privasi</a>
                <a href="#" class="hover:text-gray-800">Syarat & Ketentuan</a>
                <a href="#" class="hover:text-gray-800">Kontak</a>
                <a href="#" class="hover:text-gray-800 font-semibold flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Bantuan
                </a>
            </div>
        </footer>
    </body>
</html>