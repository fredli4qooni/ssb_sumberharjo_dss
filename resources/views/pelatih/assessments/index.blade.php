@extends('layouts.app')

@section('header_title', 'Manajemen Skuad & Penilaian')

@section('content')
<div class="space-y-6">
    
    <form action="{{ route('pelatih.assessments.index') }}" method="GET" class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex flex-col sm:flex-row justify-between gap-4">
        <div class="flex flex-wrap gap-2 w-full sm:w-auto">
            <select name="age_group" onchange="this.form.submit()" class="w-full sm:w-auto px-4 py-2 pr-10 bg-gray-50 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 focus:ring-2 focus:ring-orange-500 outline-none transition-all">
                <option value="">Semua Kelompok Usia</option>
                <option value="U-13" {{ request('age_group') == 'U-13' ? 'selected' : '' }}>U-13</option>
                <option value="U-15" {{ request('age_group') == 'U-15' ? 'selected' : '' }}>U-15</option>
                <option value="U-17" {{ request('age_group') == 'U-17' ? 'selected' : '' }}>U-17</option>
            </select>
        </div>
        <div class="relative w-full sm:w-80 flex">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pemain..." class="pl-10 pr-4 py-2 w-full bg-white border border-gray-200 border-r-0 rounded-l-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none transition-all">
            <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded-r-lg text-sm font-medium hover:bg-orange-700 transition-colors border border-orange-600">
                Cari
            </button>
        </div>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($players as $player)
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow p-5 flex flex-col h-full">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-orange-50 text-orange-600 rounded-full flex items-center justify-center font-bold text-sm border border-orange-100">
                        {{ substr($player->name, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">{{ $player->name }}</h4>
                        <p class="text-xs font-medium text-gray-500 mt-0.5">{{ $player->position }}</p>
                    </div>
                </div>
                <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded">
                    {{ $player->age_group }}
                </span>
            </div>

            <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500">Status</p>
                    @if($player->assessments_count > 0)
                        <p class="text-sm font-semibold text-green-600 flex items-center mt-0.5">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            {{ $player->assessments_count }}x Dinilai
                        </p>
                    @else
                        <p class="text-sm font-semibold text-gray-400 mt-0.5">Belum Dinilai</p>
                    @endif
                </div>
                <a href="{{ route('pelatih.assessments.create', $player->id) }}" class="bg-orange-50 text-orange-700 hover:bg-orange-100 px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
                    Nilai Form
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-xl border border-gray-200 shadow-sm p-12 text-center">
            <p class="text-gray-500 text-sm font-medium">Tidak ada pemain yang sesuai dengan pencarian atau filter.</p>
        </div>
        @endforelse
    </div>

    @if($players->hasPages())
    <div class="mt-6">
        {{ $players->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection