<!DOCTYPE html>
<html>
<head>
    <title>Laporan Performa Pemain</title>
    <style>
        body { font-family: sans-serif; color: #333; line-height: 1.5; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .player-info { margin-bottom: 30px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px; }
        .table th { background-color: #f2f2f2; font-weight: bold; }
        .score-box { padding: 10px; background: #f9f9f9; border: 1px solid #eee; margin-bottom: 10px; }
        .footer { margin-top: 50px; text-align: right; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN PERFORMA ATLET</h2>
        <p>SSB SUMBERHARJO - SISTEM PENDUKUNG KEPUTUSAN</p>
    </div>

    <div class="player-info">
        <table style="width: 100%">
            <tr>
                <td width="20%"><strong>Nama Pemain</strong></td><td>: {{ $player->name }}</td>
                <td width="20%"><strong>ID Pemain</strong></td><td>: #SH-{{ str_pad($player->id, 4, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td><strong>Posisi</strong></td><td>: {{ $player->position }}</td>
                <td><strong>Kelompok Usia</strong></td><td>: {{ $player->age_group }}</td>
            </tr>
        </table>
    </div>

    <h4>Riwayat Penilaian Detil (PM-MOORA)</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Sesi</th>
                <th>Tanggal</th>
                <th>Fisik</th>
                <th>Teknis</th>
                <th>Taktis</th>
                <th>Mental</th>
                <th>Absen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assessments as $item)
            <tr>
                <td>{{ $item->session_name }}</td>
                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                <td style="text-align: center">{{ $item->physical_score }}</td>
                <td style="text-align: center">{{ $item->technical_score }}</td>
                <td style="text-align: center">{{ $item->tactical_score }}</td>
                <td style="text-align: center">{{ $item->mental_score ?? '-' }}</td>
                <td style="text-align: center">{{ $item->ketidakhadiran }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d M Y H:i') }}</p>
        <br><br><br>
        <p>( __________________________ )<br>Kepala Pelatih SSB Sumberharjo</p>
    </div>
</body>
</html>