@extends('layouts.app')

@section('header_title', 'Laporan Performa Pemain')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex justify-between items-center">
        <div class="flex items-center space-x-6">
            <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center font-bold text-2xl text-ssb-black border border-gray-200">
                {{ substr($player->name, 0, 1) }}
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">{{ $player->name }}</h2>
                <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                    <span class="flex items-center font-mono text-xs">#SH-{{ str_pad($player->id, 4, '0', STR_PAD_LEFT) }}</span>
                    <span class="flex items-center"><span class="w-2 h-2 rounded-full bg-ssb-orange mr-2"></span>{{ $player->age_group }}</span>
                    <span class="flex items-center"><span class="w-2 h-2 rounded-full bg-orange-500 mr-2"></span>{{ $player->position }}</span>
                </div>
            </div>
        </div>
        <div>
            <a href="{{ route('pelatih.analytics.index') }}" class="px-4 py-2 border border-gray-200 rounded-lg text-xs font-bold text-gray-500 hover:bg-gray-50 uppercase tracking-widest">Kembali</a>
            <a href="{{ route('pelatih.analytics.pdf', $player->id) }}" class="ml-2 px-4 py-2 bg-ssb-black text-white rounded-lg text-xs font-bold uppercase tracking-widest hover:bg-gray-800 shadow-lg inline-block">
                Cetak PDF
            </a>
        </div>
    </div>

    @if($assessments->count() > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h4 class="text-xs font-bold text-gray-900 uppercase tracking-widest mb-4">Tren Performa (Histori Penilaian)</h4>
            <div class="relative h-72 w-full">
                <canvas id="trendChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h4 class="text-xs font-bold text-gray-900 uppercase tracking-widest mb-4">Pemetaan Atribut (Sesi Terakhir)</h4>
            <div class="relative h-64 w-full flex justify-center">
                <canvas id="radarChart"></canvas>
            </div>
            <p class="text-center text-[10px] font-bold text-gray-400 uppercase mt-4">Berdasarkan Sesi: {{ $latest->session_name }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mt-6">
        <div class="p-4 border-b border-gray-50 bg-gray-50/50">
            <h4 class="text-xs font-bold text-gray-900 uppercase tracking-widest">Riwayat Asesmen Lengkap</h4>
        </div>
        <table class="w-full text-left">
            <thead>
                <tr class="text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-50 bg-white">
                    <th class="px-6 py-4">Sesi Penilaian</th>
                    <th class="px-6 py-4">Tgl Penilaian</th>
                    <th class="px-6 py-4 text-center">Fisik</th>
                    <th class="px-6 py-4 text-center">Teknis</th>
                    <th class="px-6 py-4 text-center">Taktis</th>
                    <th class="px-6 py-4">Catatan Pelatih</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($assessments as $item)
                <tr class="hover:bg-gray-50/50 transition-colors text-xs">
                    <td class="px-6 py-4 font-bold text-gray-900">{{ $item->session_name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $item->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-center font-mono font-bold text-ssb-orange">{{ $item->physical_score }}</td>
                    <td class="px-6 py-4 text-center font-mono font-bold text-orange-500">{{ $item->technical_score }}</td>
                    <td class="px-6 py-4 text-center font-mono font-bold text-green-500">{{ $item->tactical_score }}</td>
                    <td class="px-6 py-4 text-gray-500 italic max-w-xs truncate" title="{{ $item->coach_notes }}">
                        {{ $item->coach_notes ?? '-' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
        <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
        </svg>
        <p class="text-gray-500 text-sm font-medium">Belum ada data analitik untuk pemain ini.</p>
        <p class="text-xs text-gray-400 mt-1">Pemain ini belum pernah mengikuti sesi penilaian apapun.</p>
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@if($assessments->count() > 0)

<div id="analytics-data" class="hidden" data-payload="{{ json_encode([
    'labels' => $labels,
    'physicalTrend' => $physicalTrend,
    'technicalTrend' => $technicalTrend,
    'tacticalTrend' => $tacticalTrend,
    'radarData' => $radarData
]) }}"></div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const rawData = document.getElementById('analytics-data').getAttribute('data-payload');
        const data = JSON.parse(rawData);

        const ctxTrend = document.getElementById('trendChart').getContext('2d');
        new Chart(ctxTrend, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [
                    {
                        label: 'Fisik',
                        data: data.physicalTrend,
                        borderColor: '#F97316',
                        backgroundColor: 'rgba(249, 115, 22, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Teknis',
                        data: data.technicalTrend,
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Taktis',
                        data: data.tacticalTrend,
                        borderColor: '#22C55E',
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, max: 5 }
                },
                plugins: { legend: { position: 'top' } }
            }
        });

        const ctxRadar = document.getElementById('radarChart').getContext('2d');
        new Chart(ctxRadar, {
            type: 'radar',
            data: {
                labels: ['Kecepatan', 'Stamina', 'Kekuatan', 'Passing', 'Dribbling', 'Shooting', 'Positioning', 'Visi', 'Kerjasama'],
                datasets: [{
                    label: 'Atribut Pemain',
                    data: data.radarData,
                    backgroundColor: 'rgba(26, 26, 26, 0.2)',
                    borderColor: '#1A1A1A',
                    pointBackgroundColor: '#F97316',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: '#F97316'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        angleLines: { display: true },
                        suggestedMin: 0,
                        suggestedMax: 5
                    }
                },
                plugins: { legend: { display: false } }
            }
        });
    });
</script>
@endif

@endsection