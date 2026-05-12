@extends('layouts.app')

@section('header_title', 'Admin Dashboard')

@section('content')
<div class="space-y-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Pemain</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['total_players'] }}</h3>
            <div class="mt-2 text-[10px] text-gray-500">Pemain terdaftar di seluruh kelompok usia</div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm border-l-4 border-l-ssb-orange">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Pelatih Aktif</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['total_coaches'] }}</h3>
            <div class="mt-2 text-[10px] text-gray-500">Staf pelatih yang memiliki akses sistem</div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Asesmen</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['total_assessments'] }}</h3>
            <div class="mt-2 text-[10px] text-gray-500">Laporan penilaian yang telah dikirim</div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
            <h4 class="text-xs font-bold text-gray-900 uppercase tracking-widest">Pemain Baru Ditambahkan</h4>
            <a href="{{ route('admin.players.index') }}" class="text-[10px] font-bold text-ssb-orange hover:underline uppercase">Lihat Semua</a>
        </div>
        <table class="w-full text-left">
            <thead>
                <tr class="text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-50 bg-gray-50/50">
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Posisi</th>
                    <th class="px-6 py-3">Usia</th>
                    <th class="px-6 py-3">Tgl Daftar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($stats['latest_players'] as $player)
                <tr class="text-sm">
                    <td class="px-6 py-4 font-bold text-gray-900">{{ $player->name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $player->position }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $player->age_group }}</td>
                    <td class="px-6 py-4 text-xs text-gray-400">{{ $player->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-400 text-xs uppercase tracking-widest font-medium">Belum ada data pemain</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection