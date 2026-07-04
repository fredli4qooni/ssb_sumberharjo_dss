@extends('layouts.app')

@section('header_title', 'Dashboard Admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">Ringkasan Sistem</h2>
            <p class="text-sm text-gray-500 mt-1">Pantau perkembangan data pemain dan staf akademi.</p>
        </div>
        <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg border border-gray-200 shadow-sm">
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 flex items-center hover:shadow-md transition-shadow duration-200">
            <div class="w-14 h-14 bg-orange-50 rounded-full flex items-center justify-center text-orange-600 mr-4">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Pemain</p>
                <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total_players'] }}</h3>
            </div>
        </div>
        
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 flex items-center hover:shadow-md transition-shadow duration-200">
            <div class="w-14 h-14 bg-orange-50 rounded-full flex items-center justify-center text-ssb-orange mr-4">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Staf Pelatih</p>
                <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total_coaches'] }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 flex items-center hover:shadow-md transition-shadow duration-200">
            <div class="w-14 h-14 bg-green-50 rounded-full flex items-center justify-center text-green-600 mr-4">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Penilaian Selesai</p>
                <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total_assessments'] }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center bg-gray-50/50">
            <h3 class="text-base font-semibold text-gray-900">Pemain Baru Terdaftar</h3>
            <a href="{{ route('admin.players.index') }}" class="text-sm font-medium text-orange-600 hover:text-orange-800 transition-colors">Lihat Semua &rarr;</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 bg-white">
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">Nama Pemain</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">Posisi</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">Kelompok Usia</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($stats['latest_players'] as $player)
                    <tr class="hover:bg-gray-50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-sm font-medium text-gray-600 mr-3 border border-gray-200 overflow-hidden">
                                    @if($player->photo)
                                        <img src="{{ Storage::url($player->photo) }}" alt="{{ $player->name }}" class="w-full h-full object-cover">
                                    @else
                                        {{ substr($player->name, 0, 1) }}
                                    @endif
                                </div>
                                <span class="text-sm font-medium text-gray-900 group-hover:text-orange-600 transition-colors">{{ $player->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $player->position }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                {{ $player->age_group }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $player->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada data pemain terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection