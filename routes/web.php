<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserAuctionController;
use App\Http\Controllers\HistoryController;

// Admin Controllers
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminAuctionController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminBidController;
use App\Http\Controllers\Admin\AdminReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route aplikasi web didefinisikan di sini.
| Route dikelompokkan berdasarkan fungsinya (User / Admin / Profile).
|--------------------------------------------------------------------------
*/

// Daftar semua lelang
Route::get('/auctions', [AuctionController::class, 'index'])->name('auctions.index');

// ====================== HALAMAN DEPAN ======================
Route::get('/', function () {
    // Jika sudah login → dashboard, kalau belum → login
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
})->name('home');

// ====================== USER ======================
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard User
    Route::get('/dashboard', [AuctionController::class, 'dashboard'])->name('dashboard');

    // CRUD Lelang oleh User
    Route::get('/auctions/create', [AuctionController::class, 'create'])->name('auctions.create');
    Route::post('/auctions', [AuctionController::class, 'store'])->name('auctions.store');
    Route::get('/auctions/{auction}', [AuctionController::class, 'show'])->name('auctions.show');

    // Penawaran (Bid)
    Route::post('/auctions/{auction}/bid', [BidController::class, 'store'])->name('bids.store');

    // Notifikasi
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.readAll');

    // Riwayat dan Data Lelang Pribadi
    Route::get('/my-bids', [UserAuctionController::class, 'bids'])->name('user.bids.index');
    Route::get('/my-auctions/bidded', [UserAuctionController::class, 'bidded'])->name('user.auctions.bidded');
    Route::get('/my-auctions/won', [UserAuctionController::class, 'won'])->name('user.auctions.won');
    Route::get('/won-auctions/{id}', [UserAuctionController::class, 'showWon'])->name('user.auctions.showWon');

    // Riwayat Aktivitas
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
});

// ====================== ADMIN ======================
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('auctions', AdminAuctionController::class);
        Route::post('/auctions/{id}/close', [AdminAuctionController::class, 'close'])->name('auctions.close');

        Route::resource('users', AdminUserController::class);
        Route::resource('bids', AdminBidController::class)->only(['index', 'destroy']);

        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/export-excel', [AdminReportController::class, 'exportExcel'])->name('reports.exportExcel');
        Route::get('/reports/export-pdf', [AdminReportController::class, 'exportPdf'])->name('reports.exportPdf');
    });


// ====================== PROFILE ======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// ====================== AUTH ======================
require __DIR__ . '/auth.php';
