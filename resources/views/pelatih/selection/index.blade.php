@extends('layouts.app')

@section('header_title', 'Taktik & Rekomendasi Skuad Inti (PM-MOORA)')

@section('content')
<div class="space-y-6">
    
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
        <div class="border-b border-gray-100 bg-gray-50">
            <nav class="flex -mb-px p-2 gap-2" aria-label="Tabs">
                <button onclick="switchMode('ranking')" id="btn-ranking" class="w-1/2 py-3 px-4 rounded-xl text-center font-bold text-sm transition-all duration-200 flex items-center justify-center gap-2 {{ $mode === 'ranking' ? 'bg-orange-600 text-white shadow-md' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2"></path></svg>
                    Analisis Peringkat Posisi
                </button>
                <button onclick="switchMode('starting_xi')" id="btn-starting" class="w-1/2 py-3 px-4 rounded-xl text-center font-bold text-sm transition-all duration-200 flex items-center justify-center gap-2 {{ $mode === 'starting_xi' ? 'bg-orange-600 text-white shadow-md' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    Visualisasi Lapangan Taktis XI
                </button>
            </nav>
        </div>

        <div class="p-6">
            <form action="{{ route('pelatih.selection.index') }}" method="GET" id="form-ranking" class="{{ $mode === 'ranking' ? 'block' : 'hidden' }}">
                <input type="hidden" name="mode" value="ranking">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sesi Penilaian</label>
                        <select name="session_name" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                            <option value="">-- Pilih Sesi Penilaian --</option>
                            @foreach($sessions as $session)
                                <option value="{{ $session }}" {{ $selectedSession == $session ? 'selected' : '' }}>{{ $session }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Posisi Target</label>
                        <select name="position" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                            <option value="">-- Pilih Posisi --</option>
                            <option value="Forward" {{ $selectedPosition == 'Forward' ? 'selected' : '' }}>Forward (Penyerang)</option>
                            <option value="Midfielder" {{ $selectedPosition == 'Midfielder' ? 'selected' : '' }}>Midfielder (Gelandang)</option>
                            <option value="Defender" {{ $selectedPosition == 'Defender' ? 'selected' : '' }}>Defender (Bertahan)</option>
                            <option value="Goalkeeper" {{ $selectedPosition == 'Goalkeeper' ? 'selected' : '' }}>Goalkeeper (Kiper)</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-orange-600 text-white rounded-xl text-sm font-semibold hover:bg-orange-700 transition-colors shadow-sm flex items-center gap-2">
                        Proses Algoritma PM-MOORA
                    </button>
                </div>
            </form>

            <form action="{{ route('pelatih.selection.index') }}" method="GET" id="form-starting" class="{{ $mode === 'starting_xi' ? 'block' : 'hidden' }}">
                <input type="hidden" name="mode" value="starting_xi">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sesi Penilaian</label>
                        <select name="session_name" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                            <option value="">-- Pilih Sesi Penilaian --</option>
                            @foreach($sessions as $session)
                                <option value="{{ $session }}" {{ $selectedSession == $session ? 'selected' : '' }}>{{ $session }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Formasi Taktis</label>
                        <select name="formation" required class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                            <option value="">-- Pilih Formasi --</option>
                            @foreach($formations as $formation)
                                <option value="{{ $formation }}" {{ $selectedFormation == $formation ? 'selected' : '' }}>Formasi {{ $formation }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-gray-950 text-white rounded-xl text-sm font-semibold hover:bg-gray-800 transition-colors shadow-sm flex items-center gap-2">
                        Racik Skuad Inti Terbaik
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if($mode === 'ranking' && request()->has('session_name') && request()->has('position'))
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                <h3 class="text-base font-bold text-gray-950">Hasil Analisis Skor Akhir</h3>
                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-orange-100 text-orange-800">
                    {{ $selectedPosition }} | {{ $selectedSession }}
                </span>
            </div>
            
            @if(count($results) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead>
                            <tr class="bg-gray-50">
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Rank</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Pemain</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kelompok Usia</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Skor Optimasi (Y)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($results as $index => $result)
                            <tr class="hover:bg-gray-50/50 transition-colors {{ $index === 0 ? 'bg-yellow-50/30' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($index == 0)
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-yellow-100 text-yellow-800 font-bold text-sm border border-yellow-200">1</span>
                                    @elseif($index == 1)
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-gray-100 text-gray-600 font-bold text-sm border border-gray-200">2</span>
                                    @elseif($index == 2)
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-orange-100 text-orange-800 font-bold text-sm border border-orange-200">3</span>
                                    @else
                                        <span class="inline-flex items-center justify-center w-8 h-8 text-gray-500 font-medium text-sm">{{ $index + 1 }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-950">{{ $result['player_name'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="px-2.5 py-1 rounded-lg text-xs font-medium bg-gray-100 text-gray-700">{{ $result['age_group'] }}</span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-mono font-bold {{ $index === 0 ? 'text-yellow-600' : 'text-gray-900' }}">{{ number_format($result['score'], 4) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-12 text-center text-gray-400 text-sm italic">Data penilaian belum mencukupi.</div>
            @endif
        </div>
    @endif

    @if($mode === 'starting_xi' && request()->has('session_name') && request()->has('formation'))
        <div class="relative bg-emerald-800 rounded-3xl border-4 border-white shadow-2xl overflow-hidden aspect-[3/4] md:aspect-[4/3] max-w-4xl mx-auto">
            
            <div class="absolute inset-0 flex flex-col pointer-events-none">
                @for ($i = 0; $i < 10; $i++)
                    <div class="w-full h-[10%] {{ $i % 2 === 0 ? 'bg-emerald-700/90' : 'bg-emerald-800/90' }}"></div>
                @endfor
            </div>

            <div class="absolute inset-4 border-2 border-white/60 pointer-events-none"></div> <div class="absolute inset-x-0 top-1/2 h-0.5 bg-white/60 -translate-y-1/2 pointer-events-none"></div> <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-1/4 aspect-square border-2 border-white/60 rounded-full pointer-events-none"></div> <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-2 h-2 bg-white rounded-full pointer-events-none"></div> <div class="absolute top-4 left-1/2 -translate-x-1/2 w-3/5 h-1/5 border-b-2 border-x-2 border-white/60 pointer-events-none"></div>
            <div class="absolute top-4 left-1/2 -translate-x-1/2 w-1/3 h-[7%] border-b-2 border-x-2 border-white/40 pointer-events-none"></div>

            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 w-3/5 h-1/5 border-t-2 border-x-2 border-white/60 pointer-events-none"></div>
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 w-1/3 h-[7%] border-t-2 border-x-2 border-white/40 pointer-events-none"></div>
            <div class="absolute bottom-[14%] left-1/2 -translate-x-1/2 w-2 h-2 bg-white rounded-full pointer-events-none"></div> <div class="absolute top-6 inset-x-6 p-4 bg-black/40 backdrop-blur-md rounded-2xl border border-white/10 z-30 flex justify-between items-center text-white">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-widest text-orange-400">Rekomendasi Utama Starting XI</h3>
                    <p class="text-[11px] text-gray-300 mt-0.5">Sesi: {{ $selectedSession }}</p>
                </div>
                <div class="px-4 py-1.5 bg-orange-600 text-white rounded-xl font-black text-base shadow-lg border border-orange-500">
                    {{ $selectedFormation }}
                </div>
            </div>

            <div class="absolute inset-x-4 bottom-4 top-[18%] z-20">
                
                @php
                    $positions = ['Forward', 'Midfielder', 'Defender', 'Goalkeeper'];
                    $colorTheme = [
                        'Forward' => 'from-red-500 to-red-700 shadow-red-500/30 border-red-300',
                        'Midfielder' => 'from-blue-500 to-blue-700 shadow-blue-500/30 border-blue-300',
                        'Defender' => 'from-green-500 to-green-700 shadow-green-500/30 border-green-300',
                        'Goalkeeper' => 'from-yellow-500 to-yellow-600 shadow-yellow-500/30 border-yellow-200',
                    ];
                @endphp

                @foreach($positions as $pos)
                    @if(isset($startingXI[$pos]) && count($startingXI[$pos]['players']) > 0)
                        
                        @php
                            $players = $startingXI[$pos]['players'];
                            $count = count($players);
                            
                            // Hitung pembagian baris vertikal (Top) & penyebaran taktis khusus per formasi
                            $topOffset = 'top-[15%]';
                            if ($pos === 'Midfielder') $topOffset = 'top-[42%]';
                            if ($pos === 'Defender') $topOffset = 'top-[70%]';
                            if ($pos === 'Goalkeeper') $topOffset = 'top-[92%]';
                        @endphp

                        <div class="absolute inset-x-0 {{ $topOffset }} -translate-y-1/2 flex justify-around px-4">
                            @foreach($players as $index => $player)
                                @php
                                    // Berikan offset taktis (efek zigzag / sayap melebar) agar formasi terlihat nyata
                                    $yTweak = '';
                                    if ($selectedFormation === '4-3-3') {
                                        if ($pos === 'Forward' && ($index === 0 || $index === 2)) $yTweak = 'translate-y-4'; // Sayap agak turun
                                        if ($pos === 'Midfielder' && $index === 1) $yTweak = 'translate-y-4'; // Gelandang bertahan tenggelam
                                    } elseif ($selectedFormation === '4-2-3-1') {
                                        if ($pos === 'Midfielder' && ($index === 1 || $index === 3)) $yTweak = 'translate-y-12'; // 2 gelandang jangkar (indeks 1 dan 3) ditarik turun membentuk 2 poros
                                    } elseif ($selectedFormation === '3-5-2') {
                                        if ($pos === 'Midfielder' && ($index === 0 || $index === 4)) $yTweak = 'translate-y-3'; // Sayap murni melebar & turun
                                    }
                                @endphp

                                <button type="button" 
                                    onclick="openPlayerModal(this)"
                                    data-id="{{ $player['player_id'] }}"
                                    data-name="{{ $player['player_name'] }}"
                                    data-age="{{ $player['age_group'] }}"
                                    data-pos="{{ $pos }}"
                                    data-score="{{ number_format($player['score'], 4) }}"
                                    data-teknik="{{ $player['stats']['teknik'] }}"
                                    data-fisik="{{ $player['stats']['fisik'] }}"
                                    data-taktik="{{ $player['stats']['taktik'] }}"
                                    data-mental="{{ $player['stats']['mental'] }}"
                                    data-cost="{{ $player['stats']['cost'] }}"
                                    class="draggable-player flex flex-col items-center group cursor-pointer outline-none transition-transform {{ $yTweak }}" style="position: relative; z-index: 10;">
                                    
                                    <div class="relative w-12 h-12 md:w-14 md:h-14 rounded-full bg-gradient-to-b {{ $colorTheme[$pos] }} border-2 shadow-xl flex items-center justify-center text-white group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                        @if(isset($player['photo']) && $player['photo'])
                                            <img src="{{ Storage::url($player['photo']) }}" alt="{{ $player['player_name'] }}" class="w-full h-full object-cover rounded-full">
                                        @else
                                            <svg class="w-8 h-8 opacity-80" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                            </svg>
                                        @endif
                                        <span class="absolute -top-1 -right-1 w-5 h-5 bg-white text-gray-900 rounded-full font-black text-[10px] flex items-center justify-center border border-gray-300 shadow">
                                            {{ $index + 1 }}
                                        </span>
                                    </div>

                                    <div class="mt-2 bg-slate-950/80 backdrop-blur-sm border border-white/20 rounded-lg py-0.5 px-2 text-center max-w-[95px] md:max-w-[110px] shadow-lg transition-colors group-hover:bg-orange-600 group-hover:border-white">
                                        <p class="text-white font-bold text-[9px] md:text-[10px] truncate">{{ $player['player_name'] }}</p>
                                        <p class="text-orange-400 font-mono text-[8px] md:text-[9px] group-hover:text-white transition-colors">Y: {{ number_format($player['score'], 3) }}</p>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="absolute bottom-4 left-6 z-30 text-[10px] text-white/60 font-medium flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5"></path></svg>
                Klik pada avatar pemain untuk membedah rincian skor PM-MOORA
            </div>
        </div>
    @endif
</div>

<div id="playerDetailModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-50 p-4 transition-all duration-300">
    <div class="bg-white rounded-3xl max-w-md w-full border border-gray-100 shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300">
        
        <div id="modalHeaderBg" class="p-6 text-white bg-gradient-to-r from-slate-800 to-slate-950 relative">
            <button onclick="closePlayerModal()" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors text-white outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <span id="modalPlayerPos" class="px-2.5 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-widest bg-white/20">FORWARD</span>
            <h4 id="modalPlayerName" class="text-xl font-black mt-2 tracking-tight">Nama Pemain</h4>
            <p id="modalPlayerAge" class="text-xs text-gray-300 mt-0.5">Kelompok Usia: U-15</p>
        </div>

        <div class="p-6 space-y-5">
            <div class="bg-orange-50 rounded-2xl p-4 border border-orange-100 flex justify-between items-center">
                <div>
                    <h5 class="text-xs font-bold text-orange-800 uppercase tracking-wider">Skor Optimasi Akhir MOORA</h5>
                    <p class="text-[11px] text-gray-500 mt-0.5">Semakin tinggi nilai Y, semakin direkomendasikan.</p>
                </div>
                <div id="modalPlayerScore" class="text-2xl font-black text-orange-600 font-mono">0.4521</div>
            </div>

            <div class="space-y-4">
                <h5 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Variabel Benefit (Agregasi Profile Matching)</h5>
                
                <div>
                    <div class="flex justify-between text-xs font-semibold text-gray-700 mb-1.5">
                        <span class="flex items-center"><span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>Aspek Kebugaran Fisik</span>
                        <span id="txt-fisik" class="font-mono font-bold">0.00</span>
                    </div>
                    <div class="w-full bg-gray-100 h-2.5 rounded-full overflow-hidden">
                        <div id="bar-fisik" class="bg-green-500 h-full rounded-full transition-all duration-500" style="width: 0%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-xs font-semibold text-gray-700 mb-1.5">
                        <span class="flex items-center"><span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span>Aspek Penguasaan Teknis</span>
                        <span id="txt-teknik" class="font-mono font-bold">0.00</span>
                    </div>
                    <div class="w-full bg-gray-100 h-2.5 rounded-full overflow-hidden">
                        <div id="bar-teknik" class="bg-blue-500 h-full rounded-full transition-all duration-500" style="width: 0%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-xs font-semibold text-gray-700 mb-1.5">
                        <span class="flex items-center"><span class="w-2 h-2 rounded-full bg-indigo-500 mr-2"></span>Aspek Pemahaman Taktis</span>
                        <span id="txt-taktik" class="font-mono font-bold">0.00</span>
                    </div>
                    <div class="w-full bg-gray-100 h-2.5 rounded-full overflow-hidden">
                        <div id="bar-taktik" class="bg-indigo-500 h-full rounded-full transition-all duration-500" style="width: 0%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-xs font-semibold text-gray-700 mb-1.5">
                        <span class="flex items-center"><span class="w-2 h-2 rounded-full bg-purple-500 mr-2"></span>Aspek Kesiapan Mental</span>
                        <span id="txt-mental" class="font-mono font-bold">0.00</span>
                    </div>
                    <div class="w-full bg-gray-100 h-2.5 rounded-full overflow-hidden">
                        <div id="bar-mental" class="bg-purple-500 h-full rounded-full transition-all duration-500" style="width: 0%"></div>
                    </div>
                </div>
            </div>

            <div class="pt-2 border-t border-gray-100">
                <div class="bg-red-50 rounded-xl p-3 border border-red-100 flex justify-between items-center">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-xs font-bold text-red-800 uppercase tracking-wide">Ketidakhadiran (Kriteria Cost)</span>
                    </div>
                    <div id="modalPlayerCost" class="text-sm font-black font-mono text-red-600 bg-white px-2.5 py-0.5 rounded-md border border-red-200">Skor Cost: 0</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let isDraggingGlobal = false;

    document.addEventListener('DOMContentLoaded', () => {
        const players = document.querySelectorAll('.draggable-player');
        
        players.forEach(player => {
            let isDragging = false;
            let startPosX = 0, startPosY = 0;
            let currentX = 0, currentY = 0;

            player.addEventListener('mousedown', dragStart);
            player.addEventListener('touchstart', dragStart, {passive: false});

            function dragStart(e) {
                if (e.type === 'mousedown' && e.button !== 0) return;
                
                isDragging = false;
                
                if (e.type === 'touchstart') {
                    startPosX = e.touches[0].clientX - currentX;
                    startPosY = e.touches[0].clientY - currentY;
                } else {
                    startPosX = e.clientX - currentX;
                    startPosY = e.clientY - currentY;
                }

                player.classList.remove('transition-transform');
                
                document.addEventListener('mousemove', drag);
                document.addEventListener('touchmove', drag, {passive: false});
                document.addEventListener('mouseup', dragEnd);
                document.addEventListener('touchend', dragEnd);
            }

            function drag(e) {
                isDragging = true;
                isDraggingGlobal = true;
                if (e.cancelable) e.preventDefault();

                let clientX = e.type === 'touchmove' ? e.touches[0].clientX : e.clientX;
                let clientY = e.type === 'touchmove' ? e.touches[0].clientY : e.clientY;

                currentX = clientX - startPosX;
                currentY = clientY - startPosY;

                player.style.transform = `translate(${currentX}px, ${currentY}px) scale(1.1)`;
                player.style.zIndex = "50";
            }

            function dragEnd(e) {
                document.removeEventListener('mousemove', drag);
                document.removeEventListener('touchmove', drag);
                document.removeEventListener('mouseup', dragEnd);
                document.removeEventListener('touchend', dragEnd);
                
                player.style.transform = `translate(${currentX}px, ${currentY}px) scale(1)`;
                player.style.zIndex = "10";
                player.classList.add('transition-transform');
                
                setTimeout(() => { isDraggingGlobal = false; }, 50);
            }
        });
    });

    function switchMode(mode) {
        const activeClass = "w-1/2 py-3 px-4 rounded-xl text-center font-bold text-sm bg-orange-600 text-white shadow-md flex items-center justify-center gap-2 transition-all duration-200";
        const inactiveClass = "w-1/2 py-3 px-4 rounded-xl text-center font-bold text-sm text-gray-500 hover:text-gray-700 hover:bg-gray-100 flex items-center justify-center gap-2 transition-all duration-200";
        
        const btnRanking = document.getElementById('btn-ranking');
        const btnStarting = document.getElementById('btn-starting');
        const formRanking = document.getElementById('form-ranking');
        const formStarting = document.getElementById('form-starting');

        if (mode === 'ranking') {
            btnRanking.className = activeClass;
            btnStarting.className = inactiveClass;
            formRanking.classList.remove('hidden');
            formStarting.classList.add('hidden');
        } else {
            btnRanking.className = inactiveClass;
            btnStarting.className = activeClass;
            formRanking.classList.add('hidden');
            formStarting.classList.remove('hidden');
        }
    }

    function openPlayerModal(button) {
        if (isDraggingGlobal) return;
        const modal = document.getElementById('playerDetailModal');
        
        const name = button.getAttribute('data-name');
        const age = button.getAttribute('data-age');
        const pos = button.getAttribute('data-pos');
        const score = button.getAttribute('data-score');
        const teknik = parseFloat(button.getAttribute('data-teknik'));
        const fisik = parseFloat(button.getAttribute('data-fisik'));
        const taktik = parseFloat(button.getAttribute('data-taktik'));
        const mental = parseFloat(button.getAttribute('data-mental'));
        const cost = button.getAttribute('data-cost');

        document.getElementById('modalPlayerName').innerText = name;
        document.getElementById('modalPlayerAge').innerText = "Kelompok Usia: " + age;
        document.getElementById('modalPlayerPos').innerText = pos;
        document.getElementById('modalPlayerScore').innerText = score;
        document.getElementById('modalPlayerCost').innerText = "Skor Cost: " + cost;

        document.getElementById('txt-fisik').innerText = fisik.toFixed(2);
        document.getElementById('txt-teknik').innerText = teknik.toFixed(2);
        document.getElementById('txt-taktik').innerText = taktik.toFixed(2);
        document.getElementById('txt-mental').innerText = mental.toFixed(2);

        const headerBg = document.getElementById('modalHeaderBg');
        headerBg.className = "p-6 text-white bg-gradient-to-r relative ";
        if (pos === 'Forward') headerBg.classList.add('from-red-600', 'to-red-800');
        else if (pos === 'Midfielder') headerBg.classList.add('from-blue-600', 'to-blue-800');
        else if (pos === 'Defender') headerBg.classList.add('from-green-600', 'to-green-800');
        else headerBg.classList.add('from-yellow-500', 'to-yellow-600');

        setTimeout(() => {
            document.getElementById('bar-fisik').style.width = Math.min(fisik * 100, 100) + '%';
            document.getElementById('bar-teknik').style.width = Math.min(teknik * 100, 100) + '%';
            document.getElementById('bar-taktik').style.width = Math.min(taktik * 100, 100) + '%';
            document.getElementById('bar-mental').style.width = Math.min(mental * 100, 100) + '%';
        }, 50);

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closePlayerModal() {
        const modal = document.getElementById('playerDetailModal');
        
        document.getElementById('bar-fisik').style.width = '0%';
        document.getElementById('bar-teknik').style.width = '0%';
        document.getElementById('bar-taktik').style.width = '0%';
        document.getElementById('bar-mental').style.width = '0%';

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection