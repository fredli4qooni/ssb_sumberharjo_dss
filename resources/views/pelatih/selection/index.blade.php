@extends('layouts.app')

@section('header_title', 'Proses Seleksi & Perangkingan (DSS)')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
            <h3 class="text-base font-semibold text-gray-900">Jalankan Algoritma Seleksi</h3>
            <p class="text-sm text-gray-500 mt-1">Pilih sesi penilaian dan posisi target untuk mendapatkan rekomendasi pemain terbaik.</p>
        </div>
        
        <form action="{{ route('pelatih.selection.index') }}" method="GET" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sesi Penilaian</label>
                    <select name="session_name" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none transition-all">
                        <option value="">-- Pilih Sesi Penilaian --</option>
                        @foreach($sessions as $session)
                            <option value="{{ $session }}" {{ $selectedSession == $session ? 'selected' : '' }}>{{ $session }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Posisi Target</label>
                    <select name="position" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none transition-all">
                        <option value="">-- Pilih Posisi --</option>
                        <option value="Forward" {{ $selectedPosition == 'Forward' ? 'selected' : '' }}>Forward (Penyerang)</option>
                        <option value="Midfielder" {{ $selectedPosition == 'Midfielder' ? 'selected' : '' }}>Midfielder (Gelandang)</option>
                        <option value="Defender" {{ $selectedPosition == 'Defender' ? 'selected' : '' }}>Defender (Bertahan)</option>
                        <option value="Goalkeeper" {{ $selectedPosition == 'Goalkeeper' ? 'selected' : '' }}>Goalkeeper (Kiper)</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-orange-600 text-white rounded-lg text-sm font-semibold hover:bg-orange-700 focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-sm transition-colors flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    Proses Ranking
                </button>
            </div>
        </form>
    </div>

    @if(request()->has('session_name') && request()->has('position'))
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50 flex justify-between items-center">
                <h3 class="text-base font-semibold text-gray-900">Hasil Peringkat</h3>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                    {{ $selectedPosition }} | {{ $selectedSession }}
                </span>
            </div>
            
            @if(count($results) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-24">Peringkat</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Pemain</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kelompok Usia</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Skor Akhir (Y)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($results as $index => $result)
                            <tr class="hover:bg-gray-50 transition-colors {{ $index === 0 ? 'bg-yellow-50/50' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($index == 0)
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-yellow-100 text-yellow-800 font-bold text-sm border border-yellow-200">1</span>
                                    @elseif($index == 1)
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-600 font-bold text-sm border border-gray-200">2</span>
                                    @elseif($index == 2)
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-orange-100 text-orange-800 font-bold text-sm border border-orange-200">3</span>
                                    @else
                                        <span class="inline-flex items-center justify-center w-8 h-8 text-gray-500 font-medium text-sm">{{ $index + 1 }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $result['player_name'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $result['age_group'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <span class="text-sm font-mono font-bold {{ $index === 0 ? 'text-yellow-600' : 'text-gray-900' }}">
                                        {{ number_format($result['score'], 4) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-12 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                    </div>
                    <h3 class="text-sm font-medium text-gray-900">Tidak ada data ditemukan</h3>
                    <p class="text-sm text-gray-500 mt-1">Belum ada pemain berposisi <strong>{{ $selectedPosition }}</strong> yang dinilai pada sesi <strong>{{ $selectedSession }}</strong>.</p>
                </div>
            @endif
        </div>
    @endif
</div>
@endsection