@extends('layouts.app')

@section('header_title', 'Dashboard Pelatih')

@section('content')
<div class="space-y-6">
    <div class="bg-gradient-to-r from-orange-600 to-red-700 rounded-2xl p-8 text-white shadow-md">
        <div class="max-w-3xl">
            <h2 class="text-2xl font-bold">Selamat Datang, Coach {{ Auth::user()->name }}!</h2>
            <p class="text-orange-100 text-sm mt-2 leading-relaxed">
                Siap untuk sesi penilaian hari ini? Pantau performa pemain Anda, input data asesmen terbaru, dan gunakan sistem pendukung keputusan untuk menentukan strategi tim terbaik.
            </p>
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('pelatih.assessments.index') }}" class="bg-white text-orange-700 px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-orange-50 transition-colors shadow-sm">
                    Mulai Penilaian
                </a>
                <a href="{{ route('pelatih.selection.index') }}" class="bg-orange-800/50 text-white border border-orange-500/30 px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-orange-800/70 transition-colors">
                    Lihat Ranking
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center">
            <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center text-orange-600 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Pemain di Roster</p>
                <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ \App\Models\Player::count() }}</h3>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center">
            <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center text-green-600 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Penilaian Selesai</p>
                <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ \App\Models\Assessment::where('coach_id', Auth::id())->count() }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center">
            <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center text-orange-600 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Sesi Aktif Saat Ini</p>
                <h3 class="text-lg font-bold text-gray-900 mt-1">Musim 2026</h3>
            </div>
        </div>
    </div>
</div>
@endsection