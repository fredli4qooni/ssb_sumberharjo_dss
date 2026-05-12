@extends('layouts.app')

@section('header_title', 'Database Laporan Performa')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h3 class="text-base font-semibold text-gray-900">Laporan Statistik Pemain</h3>
            <p class="text-sm text-gray-500 mt-1">Pilih pemain untuk melihat tren performa grafik dan mencetak PDF.</p>
        </div>
        
        <form action="{{ route('pelatih.analytics.index') }}" method="GET" class="w-full md:w-auto flex">
            <div class="relative w-full md:w-72">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pemain..." class="w-full pl-10 pr-4 py-2 bg-white border border-gray-300 border-r-0 rounded-l-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none transition-all">
            </div>
            <button type="submit" class="bg-orange-600 text-white px-5 py-2 rounded-r-lg text-sm font-medium hover:bg-orange-700 transition-colors border border-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-1">
                Cari
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($players as $player)
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow p-5 flex flex-col h-full">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-red-50 border border-red-100 rounded-full flex items-center justify-center font-bold text-red-700">
                        {{ substr($player->name, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">{{ $player->name }}</h4>
                        <p class="text-xs text-gray-500 font-mono mt-0.5">#SH-{{ str_pad($player->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
                <div class="flex flex-col items-end gap-1.5">
                    <span class="px-2 py-0.5 bg-gray-100 text-gray-700 text-[11px] font-medium rounded">{{ $player->age_group }}</span>
                    <span class="px-2 py-0.5 bg-orange-50 text-orange-700 text-[11px] font-medium rounded">{{ $player->position }}</span>
                </div>
            </div>

            <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500">Total Asesmen</p>
                    <p class="text-sm font-semibold {{ $player->assessments_count > 0 ? 'text-gray-900' : 'text-gray-400' }} mt-0.5">
                        {{ $player->assessments_count }} Data
                    </p>
                </div>
                
                <a href="{{ route('pelatih.analytics.show', $player->id) }}" class="{{ $player->assessments_count > 0 ? 'bg-white text-orange-600 border border-orange-200 hover:bg-orange-50' : 'bg-gray-50 text-gray-400 border border-gray-200 cursor-not-allowed pointer-events-none' }} px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center">
                    Lihat Grafik
                    <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-xl border border-gray-200 shadow-sm p-12 text-center">
            <p class="text-gray-500 text-sm font-medium">Tidak ada pemain yang ditemukan.</p>
        </div>
        @endforelse
    </div>

    @if($players->hasPages())
    <div class="mt-6">
        {{ $players->appends(['search' => request('search')])->links() }}
    </div>
    @endif
</div>
@endsection