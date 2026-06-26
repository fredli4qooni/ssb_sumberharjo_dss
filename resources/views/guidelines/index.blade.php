@extends('layouts.app')

@section('header_title', 'Panduan Penilaian')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Panduan Penilaian Pemain (Rubrik 1-5)</h2>
        <p class="text-gray-600">Gunakan panduan ini untuk memastikan objektivitas saat memberikan nilai kepada pemain. Standar ini didasarkan pada Filanesia PSSI (2012), Luxbacher (2014), dan pelatih SSB.</p>
    </div>

    <!-- CSS khusus tabel rubrik -->
    <style>
        .rubric-table th { background-color: #f8fafc; padding: 12px 16px; text-align: left; font-size: 0.875rem; font-weight: 600; color: #475569; border-bottom: 2px solid #e2e8f0; }
        .rubric-table td { padding: 12px 16px; font-size: 0.875rem; color: #334155; border-bottom: 1px solid #e2e8f0; vertical-align: top; }
        .rubric-table tr:last-child td { border-bottom: none; }
        .rubric-table tr:hover { background-color: #fcfcfc; }
        .score-col { font-weight: bold; text-align: center; width: 60px; font-size: 1.125rem; }
        .score-5 { color: #16a34a; } /* Green */
        .score-4 { color: #65a30d; } /* Lime */
        .score-3 { color: #ca8a04; } /* Yellow */
        .score-2 { color: #ea580c; } /* Orange */
        .score-1 { color: #dc2626; } /* Red */
    </style>

    <div class="flex flex-col lg:flex-row gap-6">
        
        <!-- Sidebar Navigation (Vertical Tabs) -->
        <div class="w-full lg:w-64 flex-shrink-0">
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden sticky top-24">
                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori Penilaian</h3>
                </div>
                <nav class="flex flex-col" id="guideline-tabs">
                    <button data-target="tab-teknis" class="tab-btn px-4 py-3.5 text-left text-sm font-semibold flex items-center transition-colors border-l-4 border-blue-600 bg-blue-50 text-blue-700" data-color="blue">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z M15 9a3 3 0 11-6 0 3 3 0 016 0z M9 15h6"/></svg>
                        1. Aspek Teknis
                    </button>
                    <button data-target="tab-fisik" class="tab-btn px-4 py-3.5 text-left text-sm font-semibold flex items-center transition-colors border-l-4 border-transparent text-gray-600 hover:bg-gray-50" data-color="orange">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        2. Aspek Fisik
                    </button>
                    <button data-target="tab-taktik" class="tab-btn px-4 py-3.5 text-left text-sm font-semibold flex items-center transition-colors border-l-4 border-transparent text-gray-600 hover:bg-gray-50" data-color="green">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7l5.447-2.724A1 1 0 0116 5.618v10.764a1 1 0 01-1.447.894L9 20z"/></svg>
                        3. Aspek Taktis
                    </button>
                    <button data-target="tab-mental" class="tab-btn px-4 py-3.5 text-left text-sm font-semibold flex items-center transition-colors border-l-4 border-transparent text-gray-600 hover:bg-gray-50" data-color="purple">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        4. Aspek Mental
                    </button>
                    <button data-target="tab-cost" class="tab-btn px-4 py-3.5 text-left text-sm font-semibold flex items-center transition-colors border-l-4 border-transparent text-gray-600 hover:bg-gray-50" data-color="red">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        5. Indisipliner
                    </button>
                </nav>
            </div>
        </div>

        <!-- Content Area -->
        <div class="flex-1 bg-white rounded-xl border border-gray-200 shadow-sm p-6 lg:p-8 min-h-[500px]">
            
            <!-- 1. Aspek Teknis -->
            <div id="tab-teknis" class="tab-pane animate-fade-in">
                <div class="mb-6 pb-4 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Aspek Teknis</h3>
                        <p class="text-sm text-gray-500 mt-1">Rubrik penilaian teknis disesuaikan dengan posisi pemain.</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z M15 9a3 3 0 11-6 0 3 3 0 016 0z M9 15h6"/></svg>
                    </div>
                </div>

                <div class="space-y-8">
                    <!-- Passing -->
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <div class="bg-gray-50 px-5 py-4 border-b border-gray-200">
                            <h4 class="font-bold text-gray-800 text-lg">1.1 Passing</h4>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full rubric-table">
                                <thead>
                                    <tr>
                                        <th class="score-col">Skor</th>
                                        <th class="w-1/4">Forward</th>
                                        <th class="w-1/4">Midfielder</th>
                                        <th class="w-1/4">Defender</th>
                                        <th class="w-1/4">Goalkeeper</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td class="score-col score-5">5</td><td>Mampu mengoper bola pendek dengan akurasi sangat tinggi (>80%) ke arah yang tepat, konsisten.</td><td>Mampu mengoper bola pendek dan menengah dengan akurasi sangat tinggi (>80%), menjadi penghubung antar lini secara konsisten.</td><td>Mampu mengoper bola ke rekan di lini belakang dan tengah dengan akurasi sangat tinggi (>80%), jarang melakukan kesalahan.</td><td>Mampu mendistribusikan bola dengan tangan dan kaki ke rekan satu tim dengan akurasi sangat tinggi (>80%).</td></tr>
                                    <tr><td class="score-col score-4">4</td><td>Mampu mengoper bola pendek dengan akurasi baik (61-80%), sesekali meleset namun segera dapat diperbaiki.</td><td>Mampu mengoper bola pendek dan menengah dengan akurasi baik (61-80%), cukup konsisten sebagai penghubung antar lini.</td><td>Mampu mengoper bola ke rekan di belakang dan tengah dengan akurasi baik (61-80%), sesekali terjadi kesalahan kecil.</td><td>Mampu mendistribusikan bola dengan akurasi baik (61-80%), distribusi bola cukup terarah.</td></tr>
                                    <tr><td class="score-col score-3">3</td><td>Mampu mengoper bola pendek dengan akurasi cukup (41-60%), sering memerlukan pengulangan untuk operan tepat sasaran.</td><td>Mampu mengoper dengan akurasi cukup (41-60%), masih sering meleset terutama untuk operan jarak menengah.</td><td>Mampu mengoper dengan akurasi cukup (41-60%), masih memerlukan bimbingan dalam memilih arah operan yang tepat.</td><td>Mampu mendistribusikan bola dengan akurasi cukup (41-60%), distribusi bola masih perlu dikembangkan.</td></tr>
                                    <tr><td class="score-col score-2">2</td><td>Akurasi operan masih rendah (21-40%), sering kehilangan bola saat berusaha mengoper ke rekan.</td><td>Akurasi operan rendah (21-40%), kesulitan menjadi penghubung antar lini secara efektif.</td><td>Akurasi operan rendah (21-40%), sering melakukan kesalahan yang berpotensi membahayakan lini pertahanan.</td><td>Distribusi bola kurang akurat (21-40%), sering kesulitan mengarahkan bola ke rekan satu tim.</td></tr>
                                    <tr><td class="score-col score-1">1</td><td>Akurasi operan sangat rendah (<20%), hampir selalu gagal mengoper bola ke arah yang tepat.</td><td>Akurasi operan sangat rendah (<20%), belum mampu berfungsi sebagai penghubung antar lini.</td><td>Akurasi operan sangat rendah (<20%), operan sering berpindah ke lawan dan membahayakan tim.</td><td>Distribusi bola sangat buruk (<20%), hampir selalu gagal mengarahkan bola ke rekan satu tim.</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Controlling -->
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <div class="bg-gray-50 px-5 py-4 border-b border-gray-200">
                            <h4 class="font-bold text-gray-800 text-lg">1.2 Controlling</h4>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full rubric-table">
                                <thead>
                                    <tr>
                                        <th class="score-col">Skor</th>
                                        <th class="w-1/4">Forward</th>
                                        <th class="w-1/4">Midfielder</th>
                                        <th class="w-1/4">Defender</th>
                                        <th class="w-1/4">Goalkeeper</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td class="score-col score-5">5</td><td>Menerima dan menguasai bola dari berbagai arah dengan sangat baik, bola langsung terkontrol dan siap untuk aksi selanjutnya.</td><td>Menerima bola dari berbagai sudut/ketinggian dengan sangat baik, kontrol halus dan efisien dalam tempo permainan.</td><td>Menerima bola di bawah tekanan dengan sangat baik, controlling aman dan tidak mudah direbut lawan.</td><td>Menangkap dan menguasai bola tembakan dari berbagai arah dengan sangat baik, jarang melakukan kesalahan.</td></tr>
                                    <tr><td class="score-col score-4">4</td><td>Menguasai bola dengan baik dari sebagian besar arah, sesekali bola sedikit jauh namun masih terkendali.</td><td>Menerima bola dengan baik dalam berbagai situasi, kontrol bola cukup halus meski sesekali kurang presisi.</td><td>Menerima bola dengan baik di bawah tekanan sedang, controlling cukup aman meski perlu ditingkatkan.</td><td>Menguasai bola dengan baik dari berbagai tembakan, sesekali bola lepas namun masih dalam kendali.</td></tr>
                                    <tr><td class="score-col score-3">3</td><td>Menguasai bola cukup baik, namun masih sering membutuhkan lebih dari satu sentuhan untuk mengontrol bola.</td><td>Menerima bola cukup baik, namun belum efisien mempertahankan tempo permainan setelah menerima bola.</td><td>Menerima bola cukup baik namun masih ragu-ragu saat menerima di bawah tekanan lawan.</td><td>Menguasai sebagian besar bola dengan cukup baik, namun masih perlu bimbingan untuk situasi kompleks.</td></tr>
                                    <tr><td class="score-col score-2">2</td><td>Controlling kurang baik, bola sering lepas kendali dan memerlukan banyak sentuhan sebelum bisa dikuasai.</td><td>Controlling kurang baik, kesulitan mempertahankan penguasaan bola terutama saat menerima dalam tempo cepat.</td><td>Controlling kurang baik, sering kehilangan bola saat menerima terutama di bawah tekanan lawan.</td><td>Sering kesulitan menguasai bola terutama untuk tembakan keras atau bola lambung.</td></tr>
                                    <tr><td class="score-col score-1">1</td><td>Controlling sangat buruk, hampir selalu gagal menguasai bola saat menerima operan.</td><td>Controlling sangat buruk, hampir tidak mampu mempertahankan penguasaan bola saat menerima.</td><td>Controlling sangat buruk, hampir selalu kehilangan bola saat menerima sehingga membahayakan pertahanan.</td><td>Sangat kesulitan menguasai bola, sering terjadi kesalahan fatal dalam penangkapan bola.</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Dribbling -->
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <div class="bg-gray-50 px-5 py-4 border-b border-gray-200">
                            <h4 class="font-bold text-gray-800 text-lg">1.3 Dribbling</h4>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full rubric-table">
                                <thead>
                                    <tr>
                                        <th class="score-col">Skor</th>
                                        <th class="w-1/4">Forward</th>
                                        <th class="w-1/4">Midfielder</th>
                                        <th class="w-1/4">Defender</th>
                                        <th class="w-1/4">Goalkeeper</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td class="score-col score-5">5</td><td>Menggiring bola kecepatan tinggi dengan kontrol sangat baik, sulit direbut lawan saat berlari.</td><td>Menggiring bola kecepatan & kontrol sangat baik, efektif transisi menyerang maupun bertahan.</td><td>Menggiring bola keluar tekanan dengan kecepatan & kontrol sangat baik, efektif membangun serangan dari belakang.</td><td>Menggiring bola keluar area gawang dengan kontrol sangat baik saat dibutuhkan.</td></tr>
                                    <tr><td class="score-col score-4">4</td><td>Menggiring bola kecepatan baik, kontrol bola terjaga meski sesekali sedikit lepas saat berlari kencang.</td><td>Menggiring bola kecepatan & kontrol baik, cukup efektif dalam transisi permainan.</td><td>Menggiring bola keluar tekanan dengan baik, sesekali kurang efisien namun masih terkontrol.</td><td>Menggiring bola dengan kontrol yang baik dalam situasi yang diperlukan.</td></tr>
                                    <tr><td class="score-col score-3">3</td><td>Kecepatan sedang, kontrol bola cukup baik namun masih kesulitan saat berlari kecepatan tinggi.</td><td>Kontrol cukup baik, namun belum efektif saat harus berlari cepat sambil membawa bola.</td><td>Kontrol cukup baik namun masih ragu-ragu dan kurang efisien dalam situasi tertekan.</td><td>Kontrol cukup baik dalam situasi latihan yang sederhana.</td></tr>
                                    <tr><td class="score-col score-2">2</td><td>Kesulitan mengombinasikan kecepatan dan dribble, bola sering lepas saat mencoba berlari lebih cepat.</td><td>Kesulitan menggiring bola dengan kecepatan yang dibutuhkan, kontrol menurun signifikan saat berlari.</td><td>Kesulitan keluar tekanan, sering kehilangan bola saat mencoba bergerak dengan bola.</td><td>Masih kesulitan menggiring bola dengan kontrol yang cukup baik, perlu banyak latihan.</td></tr>
                                    <tr><td class="score-col score-1">1</td><td>Sangat kesulitan menggiring bola sambil berlari, hampir selalu kehilangan kontrol bola.</td><td>Sangat kesulitan mengombinasikan gerak dengan penguasaan bola, hampir tidak mampu dribbling.</td><td>Sangat kesulitan menggiring bola, hampir selalu gagal mempertahankan kontrol bola.</td><td>Sangat kesulitan menggiring bola, membutuhkan banyak bimbingan dasar.</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Aspek Fisik -->
            <div id="tab-fisik" class="tab-pane hidden animate-fade-in">
                <div class="mb-6 pb-4 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Aspek Fisik</h3>
                        <p class="text-sm text-gray-500 mt-1">Standar kebugaran jasmani berlaku secara umum.</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <div class="bg-gray-50 px-5 py-4 border-b border-gray-200"><h4 class="font-bold text-gray-800 text-lg">2.1 Daya Tahan Tubuh (Endurance)</h4></div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full rubric-table">
                                <thead><tr><th class="score-col">Skor</th><th>Deskripsi Performa</th></tr></thead>
                                <tbody>
                                    <tr><td class="score-col score-5">5</td><td>Mampu bermain intensitas tinggi sepanjang laga (2x25 menit) tanpa penurunan stamina berarti. Recovery sangat cepat (5-10 menit).</td></tr>
                                    <tr><td class="score-col score-4">4</td><td>Mempertahankan performa hingga akhir pertandingan, meski sedikit kelelahan di menit akhir. Penurunan teknik sangat minim.</td></tr>
                                    <tr><td class="score-col score-3">3</td><td>Bermain stabil di babak pertama, penurunan drastis di pertengahan babak kedua. Mulai sering meminta jeda napas.</td></tr>
                                    <tr><td class="score-col score-2">2</td><td>Stamina habis di awal babak kedua. Sering berjalan kaki, terlambat menutup lawan, hilang fokus karena lelah.</td></tr>
                                    <tr><td class="score-col score-1">1</td><td>Ketahanan fisik sangat lemah. Baru 10-15 menit sudah kelelahan ekstrem/kram, tidak mampu melanjutkan.</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <div class="bg-gray-50 px-5 py-4 border-b border-gray-200"><h4 class="font-bold text-gray-800 text-lg">2.2 Kecepatan (Speed)</h4></div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full rubric-table">
                                <thead><tr><th class="score-col">Skor</th><th>Deskripsi Performa</th></tr></thead>
                                <tbody>
                                    <tr><td class="score-col score-5">5</td><td>Akselerasi & lari sangat tinggi. Sangat mudah mengungguli lawan dalam duel lari/sprint.</td></tr>
                                    <tr><td class="score-col score-4">4</td><td>Kecepatan baik dan konsisten dalam sprint menyerang/bertahan, meski sesekali diimbangi lawan setara.</td></tr>
                                    <tr><td class="score-col score-3">3</td><td>Kecepatan rata-rata. Mampu akselerasi namun ritme cenderung konstan, kurang daya ledak (explosiveness).</td></tr>
                                    <tr><td class="score-col score-2">2</td><td>Akselerasi lambat, sprint terasa berat. Sering tertinggal lawan atau lambat mengejar bola.</td></tr>
                                    <tr><td class="score-col score-1">1</td><td>Kecepatan sangat rendah. Pergerakan terlihat sangat lambat baik dalam menyerang maupun bertahan.</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <div class="bg-gray-50 px-5 py-4 border-b border-gray-200"><h4 class="font-bold text-gray-800 text-lg">2.3 Kelincahan (Agility)</h4></div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full rubric-table">
                                <thead><tr><th class="score-col">Skor</th><th>Deskripsi Performa</th></tr></thead>
                                <tbody>
                                    <tr><td class="score-col score-5">5</td><td>Sangat cepat mengubah arah & jaga keseimbangan. Sangat responsif terhadap perubahan situasi permainan.</td></tr>
                                    <tr><td class="score-col score-4">4</td><td>Cepat mengubah arah & cukup seimbang. Sesekali hilang keseimbangan ringan tapi tidak fatal.</td></tr>
                                    <tr><td class="score-col score-3">3</td><td>Cukup baik mengubah arah, namun butuh sedikit waktu menyesuaikan posisi tubuh.</td></tr>
                                    <tr><td class="score-col score-2">2</td><td>Kurang lincah, sering terlambat merespons perubahan permainan & beberapa kali jatuh/hilang keseimbangan.</td></tr>
                                    <tr><td class="score-col score-1">1</td><td>Sangat sulit mengubah arah. Gerakan kaku, sangat sering hilang keseimbangan.</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Aspek Taktik -->
            <div id="tab-taktik" class="tab-pane hidden animate-fade-in">
                <div class="mb-6 pb-4 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Aspek Taktis</h3>
                        <p class="text-sm text-gray-500 mt-1">Pemahaman ruang, posisi, dan instruksi tim.</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7l5.447-2.724A1 1 0 0116 5.618v10.764a1 1 0 01-1.447.894L9 20z"/></svg>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <div class="bg-gray-50 px-5 py-4 border-b border-gray-200"><h4 class="font-bold text-gray-800 text-lg">3.1 Positioning</h4></div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full rubric-table">
                                <thead><tr><th class="score-col">Skor</th><th>Deskripsi Performa</th></tr></thead>
                                <tbody>
                                    <tr><td class="score-col score-5">5</td><td>Kesadaran posisi sangat tinggi. Sangat pintar cari ruang kosong & memotong serangan lawan.</td></tr>
                                    <tr><td class="score-col score-4">4</td><td>Menempatkan posisi dengan baik. Sering di posisi benar meski sesekali terlambat transisi.</td></tr>
                                    <tr><td class="score-col score-3">3</td><td>Positioning rata-rata. Masih sering harus diteriaki teman/pelatih untuk bergeser posisi.</td></tr>
                                    <tr><td class="score-col score-2">2</td><td>Sering salah posisi (out of position). Meninggalkan celah kosong yang dimanfaatkan lawan.</td></tr>
                                    <tr><td class="score-col score-1">1</td><td>Hanya berlari mengejar bola tanpa memedulikan formasi (berantakan).</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <div class="bg-gray-50 px-5 py-4 border-b border-gray-200"><h4 class="font-bold text-gray-800 text-lg">3.2 Pemahaman Taktik Dasar</h4></div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full rubric-table">
                                <thead><tr><th class="score-col">Skor</th><th>Deskripsi Performa</th></tr></thead>
                                <tbody>
                                    <tr><td class="score-col score-5">5</td><td>Sangat cepat menangkap instruksi. Tahu persis kapan harus oper dan kapan harus dribble.</td></tr>
                                    <tr><td class="score-col score-4">4</td><td>Mampu memahami & menjalankan instruksi dengan baik meski sesekali lupa jika lelah.</td></tr>
                                    <tr><td class="score-col score-3">3</td><td>Cukup mengerti instruksi, namun aplikasi di lapangan masih ragu dan butuh panduan langsung.</td></tr>
                                    <tr><td class="score-col score-2">2</td><td>Sulit menjalankan instruksi sederhana. Bermain sendiri tanpa arahan tim.</td></tr>
                                    <tr><td class="score-col score-1">1</td><td>Sama sekali tak memahami taktik, bermain asal-asalan.</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Aspek Mental -->
            <div id="tab-mental" class="tab-pane hidden animate-fade-in">
                <div class="mb-6 pb-4 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Aspek Mental</h3>
                        <p class="text-sm text-gray-500 mt-1">Spesifik berdasarkan posisi bertanding.</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-xl overflow-hidden">
                    <div class="bg-gray-50 px-5 py-4 border-b border-gray-200">
                        <h4 class="font-bold text-gray-800 text-lg">4.1 Mental Bertanding</h4>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full rubric-table">
                            <thead>
                                <tr>
                                    <th class="score-col">Skor</th>
                                    <th class="w-1/4">Forward</th>
                                    <th class="w-1/4">Midfielder</th>
                                    <th class="w-1/4">Defender</th>
                                    <th class="w-1/4">Goalkeeper</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td class="score-col score-5">5</td><td>Selalu semangat, aktif cari bola, tidak mudah menyerah meski tertinggal skor.</td><td>Selalu semangat, aktif meminta bola & tidak menyerah saat direbut lawan.</td><td>Kemauan berjuang sangat tinggi. Tidak gentar tekanan lawan, fokus sampai akhir.</td><td>Konsentrasi penuh. Aktif memberi instruksi, tak putus asa meski kebobolan.</td></tr>
                                <tr><td class="score-col score-4">4</td><td>Semangat baik. Sesekali menurun tapi bangkit setelah didorong pelatih.</td><td>Semangat baik. Cukup aktif meski sesekali kurang gairah di pertengahan babak.</td><td>Kemauan berjuang baik. Cukup aktif merebut bola meski kurang agresif di momen tertentu.</td><td>Semangat baik. Cukup aktif instruksi, sesekali hilang fokus setelah kebobolan.</td></tr>
                                <tr><td class="score-col score-3">3</td><td>Motivasi cukup tapi tidak konsisten. Semangat hanya di awal, menurun di babak kedua.</td><td>Motivasi cukup, mulai pasif di pertengahan laga. Butuh diteriaki pelatih.</td><td>Kemauan berjuang cukup. Kurang agresif, butuh instruksi terus menerus.</td><td>Motivasi cukup, konsentrasi tidak konsisten (terutama saat laga monoton).</td></tr>
                                <tr><td class="score-col score-2">2</td><td>Motivasi rendah, pasif. Mudah menyerah dan butuh dorongan intensif.</td><td>Motivasi rendah. Jarang meminta bola, cepat menyerah saat direbut.</td><td>Kurang agresif, mudah menyerah menghadapi serangan lawan.</td><td>Jarang memberi instruksi, sangat mudah hilang fokus (down).</td></tr>
                                <tr><td class="score-col score-1">1</td><td>Sangat pasif, nyaris tanpa perlawanan. Menyerah total di lapangan.</td><td>Sangat pasif, jarang menyentuh bola secara produktif.</td><td>Sangat mudah dikalahkan lawan, nyaris tidak memberi perlawanan berarti.</td><td>Hampir tidak ada instruksi, membahayakan tim karena panik total.</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- 5. Indisipliner -->
            <div id="tab-cost" class="tab-pane hidden animate-fade-in">
                <div class="mb-6 pb-4 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Indisipliner (Cost)</h3>
                        <p class="text-sm text-gray-500 mt-1">Faktor pengurang pada perhitungan akhir.</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-xl overflow-hidden mb-4">
                    <div class="bg-gray-50 px-5 py-4 border-b border-gray-200">
                        <h4 class="font-bold text-gray-800 text-lg">5.1 Ketidakhadiran (Absensi)</h4>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full rubric-table">
                            <thead><tr><th class="px-4 py-3 font-bold text-left">Skor</th><th class="px-4 py-3 font-bold text-left">Kategori</th><th style="width:150px">Persentase</th><th>Deskripsi Performa</th></tr></thead>
                            <tbody>
                                <tr><td class="font-bold text-center">5</td><td class="font-bold text-green-600 px-4">Sangat Baik</td><td>< 10 %</td><td>Tingkat ketidakhadiran sangat minimal atau tidak lebih dari 2 kali absen.</td></tr>
                                <tr><td class="font-bold text-center">4</td><td class="font-bold text-lime-600 px-4">Baik</td><td>10% — 20%</td><td>Jarang absen, masih dalam batas toleransi tim wajar (3–6 kali absen).</td></tr>
                                <tr><td class="font-bold text-center">3</td><td class="font-bold text-yellow-600 px-4">Cukup</td><td>21% — 35%</td><td>Beberapa kali tidak hadir, perkembangan terhambat (7–10 kali absen).</td></tr>
                                <tr><td class="font-bold text-center">2</td><td class="font-bold text-orange-600 px-4">Buruk</td><td>36% — 55%</td><td>Sering absen latihan, kurang komitmen (11–16 kali absen).</td></tr>
                                <tr><td class="font-bold text-center">1</td><td class="font-bold text-red-600 px-4">Sangat Buruk</td><td>> 55%</td><td>Sering mangkir, tidak memenuhi standar tim (> 17 kali absen).</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-red-50 border border-red-200 rounded-xl p-5 flex items-start">
                    <svg class="w-6 h-6 text-red-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div>
                        <h5 class="text-sm font-bold text-red-800">Catatan Penting untuk Pelatih</h5>
                        <p class="text-sm text-red-700 mt-1">
                            Di formulir penilaian aktual, Anda <strong>tidak perlu memasukkan persentase atau skor 1-5 untuk absen</strong>. 
                            Anda hanya cukup memasukkan <strong>Jumlah Hari Absen Aktual</strong> (misalnya: <code>2</code> hari absen, <code>5</code> hari absen). 
                            Algoritma DSS (MOORA) secara otomatis akan memperlakukan angka tersebut sebagai faktor *Cost* (Pengurang) dalam pemeringkatan akhir.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 0.3s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab-btn');
        const panes = document.querySelectorAll('.tab-pane');

        const activeColors = {
            'blue': ['border-blue-600', 'bg-blue-50', 'text-blue-700'],
            'orange': ['border-orange-600', 'bg-orange-50', 'text-orange-700'],
            'green': ['border-green-600', 'bg-green-50', 'text-green-700'],
            'purple': ['border-purple-600', 'bg-purple-50', 'text-purple-700'],
            'red': ['border-red-600', 'bg-red-50', 'text-red-700']
        };

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active classes from all tabs
                tabs.forEach(t => {
                    const color = t.getAttribute('data-color');
                    t.classList.remove(...activeColors[color]);
                    t.classList.add('border-transparent', 'text-gray-600');
                });

                // Add active class to clicked tab
                const color = tab.getAttribute('data-color');
                tab.classList.remove('border-transparent', 'text-gray-600');
                tab.classList.add(...activeColors[color]);

                // Hide all panes
                panes.forEach(p => p.classList.add('hidden'));

                // Show target pane
                const targetId = tab.getAttribute('data-target');
                document.getElementById(targetId).classList.remove('hidden');
            });
        });
    });
</script>
@endsection
