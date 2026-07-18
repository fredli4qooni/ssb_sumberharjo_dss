<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PlayerController;
use App\Http\Controllers\Admin\DssController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Coach\AssessmentController;
use App\Http\Controllers\Coach\SelectionController;
use App\Http\Controllers\Coach\AnalyticsController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('players', PlayerController::class);

    Route::get('/dss-settings', [DssController::class, 'index'])->name('dss.index');
    Route::post('/dss-settings', [DssController::class, 'update'])->name('dss.update');

    Route::put('/dss-settings/profile/{id}', [DssController::class, 'updateProfile'])->name('dss.profile.update');

    Route::get('/panduan-penilaian', [\App\Http\Controllers\GuidelineController::class, 'index'])->name('guidelines.index');

    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

Route::middleware(['auth', 'role:super_admin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'role:pelatih'])->prefix('pelatih')->name('pelatih.')->group(function () {
    Route::get('/dashboard', function () {
        return view('pelatih.dashboard');
    })->name('dashboard');

    Route::get('/assessments', [AssessmentController::class, 'index'])->name('assessments.index');
    Route::get('/assessments/{player}/create', [AssessmentController::class, 'create'])->name('assessments.create');
    Route::post('/assessments/{player}', [AssessmentController::class, 'store'])->name('assessments.store');
    Route::get('/assessments/edit/{assessment}', [AssessmentController::class, 'edit'])->name('assessments.edit');
    Route::put('/assessments/{assessment}', [AssessmentController::class, 'update'])->name('assessments.update');
    Route::delete('/assessments/{assessment}', [AssessmentController::class, 'destroy'])->name('assessments.destroy');
    Route::get('/selection', [SelectionController::class, 'index'])->name('selection.index');
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
    Route::get('/analytics/{player}', [AnalyticsController::class, 'show'])->name('analytics.show');
    Route::get('/analytics/{player}/pdf', [AnalyticsController::class, 'downloadPdf'])->name('analytics.pdf');
    Route::get('/panduan-penilaian', [\App\Http\Controllers\GuidelineController::class, 'index'])->name('guidelines.index');
    
    Route::get('/profile', [\App\Http\Controllers\Coach\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [\App\Http\Controllers\Coach\ProfileController::class, 'update'])->name('profile.update');
});

Route::post('/notifications/mark-all-read', function (\Illuminate\Http\Request $request) {
    /** @var \App\Models\User $user */
    $user = $request->user();

    if ($user) {
        $user->unreadNotifications->markAsRead();
    }

    return back();
})->name('notifications.markAllRead')->middleware('auth');

require __DIR__ . '/auth.php';

// Route rahasia untuk mengosongkan database agar import SQL lokal berhasil
Route::get('/wipe-database-rahasia', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('db:wipe', ['--force' => true]);
        return "BERHASIL KOSONG! Semua tabel telah dihapus. Silakan kembali ke phpMyAdmin dan lakukan Import file SQL Anda sekarang.";
    } catch (\Exception $e) {
        return "GAGAL: " . $e->getMessage();
    }
});

// Route rahasia untuk membuat storage:link di hosting tanpa terminal
Route::get('/link-storage-rahasia', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return "BERHASIL! Storage link telah dibuat. Foto dan berkas sekarang bisa diakses publik.";
    } catch (\Exception $e) {
        return "GAGAL: " . $e->getMessage();
    }
});
