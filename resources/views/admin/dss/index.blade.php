@extends('layouts.app')

@section('header_title', 'Konfigurasi Parameter DSS (PM-MOORA)')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">Pengaturan Algoritma Utama</h2>
            <p class="text-sm text-gray-500 mt-1">Sesuaikan bobot kriteria MOORA dan persentase GAP Profile Matching.</p>
        </div>
        @if(session('success'))
        <div class="flex items-center bg-green-50 text-green-700 px-4 py-2 rounded-lg border border-green-200 text-sm animate-pulse">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
        @endif
    </div>

    <form action="{{ route('admin.dss.update') }}" method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
                    <h3 class="text-base font-semibold text-gray-900">Bobot Optimasi MOORA</h3>
                    <p class="text-xs text-gray-500 mt-1">Tentukan prioritas dari setiap aspek penilaian (0.01 - 1.00).</p>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fisik (Benefit)</label>
                            <input type="number" name="weight_physical" step="0.01" min="0" max="1" value="{{ old('weight_physical', $settings->weight_physical ?? 0.25) }}" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Teknis (Benefit)</label>
                            <input type="number" name="weight_technical" step="0.01" min="0" max="1" value="{{ old('weight_technical', $settings->weight_technical ?? 0.30) }}" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Taktis (Benefit)</label>
                            <input type="number" name="weight_tactical" step="0.01" min="0" max="1" value="{{ old('weight_tactical', $settings->weight_tactical ?? 0.20) }}" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mental (Benefit)</label>
                            <input type="number" name="weight_mental" step="0.01" min="0" max="1" value="{{ old('weight_mental', $settings->weight_mental ?? 0.15) }}" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                        </div>
                    </div>
                    <hr class="border-gray-100 my-2">
                    <div>
                        <label class="block text-sm font-medium text-red-700 mb-2">Ketidakhadiran (Cost)</label>
                        <input type="number" name="weight_ketidakhadiran" step="0.01" min="0" max="1" value="{{ old('weight_ketidakhadiran', $settings->weight_ketidakhadiran ?? 0.10) }}" class="w-full px-4 py-2 bg-red-50 border border-red-300 rounded-lg text-sm focus:ring-2 focus:ring-red-500 outline-none">
                        <p class="text-[10px] text-gray-500 mt-1">Bobot pengurang skor (Cost) dalam perhitungan akhir.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
                    <h3 class="text-base font-semibold text-gray-900">Analisis Kesenjangan (GAP PM)</h3>
                    <p class="text-xs text-gray-500 mt-1">Atur persentase Core dan Secondary Factor Profile Matching.</p>
                </div>
                <div class="p-6 space-y-8">
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <label class="text-sm font-medium text-gray-700">Core Factor (Utama)</label>
                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs font-bold">{{ ($settings->core_factor_pct ?? 0.60) * 100 }}%</span>
                        </div>
                        <input type="range" name="core_factor_pct" min="0" max="1" step="0.05" value="{{ old('core_factor_pct', $settings->core_factor_pct ?? 0.60) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-red-600">
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <label class="text-sm font-medium text-gray-700">Secondary Factor (Pendukung)</label>
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs font-bold">{{ ($settings->secondary_factor_pct ?? 0.40) * 100 }}%</span>
                        </div>
                        <input type="range" name="secondary_factor_pct" min="0" max="1" step="0.05" value="{{ old('secondary_factor_pct', $settings->secondary_factor_pct ?? 0.40) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-gray-600">
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full py-3 text-sm font-bold text-white bg-orange-600 border border-transparent rounded-xl hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-xl transition-all duration-200">
                            Simpan Parameter DSS
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="mt-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Target Profil Posisi (Profile Matching)</h2>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Posisi</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider" title="Endurance, Speed, Kelincahan">Rata Fisik</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider" title="Passing, Controlling, Dribbling">Rata Teknik</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider" title="Positioning, Pemahaman Taktik">Rata Taktik</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Mental</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($profiles as $profile)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-700 text-xs mr-3">
                                        {{ substr($profile->position_name, 0, 2) }}
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900">{{ $profile->position_name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-mono text-gray-600">
                                {{ number_format(($profile->target_endurance + $profile->target_speed + $profile->target_kelincahan) / 3, 1) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-mono text-gray-600">
                                {{ number_format(($profile->target_passing + $profile->target_controlling + $profile->target_dribbling) / 3, 1) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-mono text-gray-600">
                                {{ number_format(($profile->target_positioning + $profile->target_pemahaman_taktik) / 2, 1) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-mono text-gray-600">
                                {{ $profile->target_mental_bertanding }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <button type="button"
                                    data-id="{{ $profile->id }}"
                                    data-name="{{ $profile->position_name }}"
                                    data-endurance="{{ $profile->target_endurance }}"
                                    data-speed="{{ $profile->target_speed }}"
                                    data-kelincahan="{{ $profile->target_kelincahan }}"
                                    data-passing="{{ $profile->target_passing }}"
                                    data-controlling="{{ $profile->target_controlling }}"
                                    data-dribbling="{{ $profile->target_dribbling }}"
                                    data-positioning="{{ $profile->target_positioning }}"
                                    data-taktik="{{ $profile->target_pemahaman_taktik }}"
                                    data-mental="{{ $profile->target_mental_bertanding }}"
                                    onclick="openProfileModal(this)"
                                    class="inline-flex items-center px-3 py-1.5 bg-gray-900 text-white rounded-lg text-xs font-semibold hover:bg-gray-800 transition-colors shadow-sm">
                                    Set Target
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="profileEditModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-50 p-4 transition-all duration-300">
    <div class="bg-white rounded-2xl max-w-2xl w-full border border-gray-100 shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300">

        <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h3 class="text-lg font-bold text-gray-900" id="modalTitle">Edit Target Posisi</h3>
            <button onclick="closeProfileModal()" class="text-gray-400 hover:text-gray-600 transition-colors outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="profileEditForm" method="POST" action="">
            @csrf
            @method('PUT')

            <div class="p-6 max-h-[70vh] overflow-y-auto space-y-6">
                <p class="text-xs text-gray-500 mb-4">Pilih target nilai ideal (Skala 1 - 5) untuk posisi ini. Nilai ini akan menjadi acuan perhitungan Gap Profile Matching.</p>

                <div class="space-y-3">
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 pb-2">Kriteria Fisik</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-700 mb-1">Endurance (CF)</label>
                            <input type="number" id="target_endurance" name="target_endurance" min="1" max="5" class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded text-sm focus:ring-1 focus:ring-orange-500">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-700 mb-1">Speed (SF)</label>
                            <input type="number" id="target_speed" name="target_speed" min="1" max="5" class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded text-sm focus:ring-1 focus:ring-orange-500">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-700 mb-1">Kelincahan (SF)</label>
                            <input type="number" id="target_kelincahan" name="target_kelincahan" min="1" max="5" class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded text-sm focus:ring-1 focus:ring-orange-500">
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 pb-2">Kriteria Teknik</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-700 mb-1">Passing (CF)</label>
                            <input type="number" id="target_passing" name="target_passing" min="1" max="5" class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded text-sm focus:ring-1 focus:ring-orange-500">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-700 mb-1">Controlling (CF)</label>
                            <input type="number" id="target_controlling" name="target_controlling" min="1" max="5" class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded text-sm focus:ring-1 focus:ring-orange-500">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-700 mb-1">Dribbling (CF)</label>
                            <input type="number" id="target_dribbling" name="target_dribbling" min="1" max="5" class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded text-sm focus:ring-1 focus:ring-orange-500">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 pb-2">Taktik</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[11px] font-semibold text-gray-700 mb-1">Positioning (CF)</label>
                                <input type="number" id="target_positioning" name="target_positioning" min="1" max="5" class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded text-sm focus:ring-1 focus:ring-orange-500">
                            </div>
                            <div>
                                <label class="block text-[11px] font-semibold text-gray-700 mb-1">Paham Taktik (CF)</label>
                                <input type="number" id="target_pemahaman_taktik" name="target_pemahaman_taktik" min="1" max="5" class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded text-sm focus:ring-1 focus:ring-orange-500">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 pb-2">Mental</h4>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-700 mb-1">Mental Bertanding (CF)</label>
                            <input type="number" id="target_mental_bertanding" name="target_mental_bertanding" min="1" max="5" class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded text-sm focus:ring-1 focus:ring-orange-500">
                        </div>
                    </div>
                </div>

            </div>

            <div class="p-5 border-t border-gray-100 flex justify-end gap-3 bg-gray-50/50">
                <button type="button" onclick="closeProfileModal()" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded-lg text-sm font-semibold hover:bg-orange-700 shadow-sm transition-colors">Simpan Target</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openProfileModal(btn) {
        const id = btn.getAttribute('data-id');
        const name = btn.getAttribute('data-name');

        const form = document.getElementById('profileEditForm');
        form.action = `/admin/dss-settings/profile/${id}`;

        document.getElementById('modalTitle').innerText = 'Set Target Posisi: ' + name;

        document.getElementById('target_endurance').value = btn.getAttribute('data-endurance');
        document.getElementById('target_speed').value = btn.getAttribute('data-speed');
        document.getElementById('target_kelincahan').value = btn.getAttribute('data-kelincahan');

        document.getElementById('target_passing').value = btn.getAttribute('data-passing');
        document.getElementById('target_controlling').value = btn.getAttribute('data-controlling');
        document.getElementById('target_dribbling').value = btn.getAttribute('data-dribbling');

        document.getElementById('target_positioning').value = btn.getAttribute('data-positioning');
        document.getElementById('target_pemahaman_taktik').value = btn.getAttribute('data-taktik');

        document.getElementById('target_mental_bertanding').value = btn.getAttribute('data-mental');

        const modal = document.getElementById('profileEditModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeProfileModal() {
        const modal = document.getElementById('profileEditModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection