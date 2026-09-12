<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExcelExportController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MonitoringStokController;
use App\Http\Controllers\PdfExportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokKeluarController;
use App\Http\Controllers\StokMasukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //  Kategori: semua role bisa melihat, hanya admin yang mengelola 
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::middleware('role:admin')->group(function () {
        Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });
    Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

    //  Barang: semua role bisa kelola, hanya admin yang bisa menghapus 
    Route::get('barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('barang/{barang}', [BarangController::class, 'show'])->name('barang.show');
    Route::get('barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('barang/{barang}', [BarangController::class, 'destroy'])
        ->middleware('role:admin')->name('barang.destroy');

    //  Supplier: semua role bisa lihat, hanya admin yang mengelola 
    Route::get('supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('supplier/create', [SupplierController::class, 'create'])
        ->middleware('role:admin')->name('supplier.create');
    Route::post('supplier', [SupplierController::class, 'store'])
        ->middleware('role:admin')->name('supplier.store');
    Route::get('supplier/{supplier}', [SupplierController::class, 'show'])->name('supplier.show');
    Route::get('supplier/{supplier}/edit', [SupplierController::class, 'edit'])
        ->middleware('role:admin')->name('supplier.edit');
    Route::put('supplier/{supplier}', [SupplierController::class, 'update'])
        ->middleware('role:admin')->name('supplier.update');
    Route::delete('supplier/{supplier}', [SupplierController::class, 'destroy'])
        ->middleware('role:admin')->name('supplier.destroy');

    //  Stok Masuk & Stok Keluar: semua role 
    Route::get('stok-masuk', [StokMasukController::class, 'index'])->name('stok.masuk.index');
    Route::get('stok-masuk/create', [StokMasukController::class, 'create'])->name('stok.masuk.create');
    Route::post('stok-masuk', [StokMasukController::class, 'store'])->name('stok.masuk.store');

    Route::get('stok-keluar', [StokKeluarController::class, 'index'])->name('stok.keluar.index');
    Route::get('stok-keluar/create', [StokKeluarController::class, 'create'])->name('stok.keluar.create');
    Route::post('stok-keluar', [StokKeluarController::class, 'store'])->name('stok.keluar.store');

    //  Area Khusus Admin 
    Route::middleware('role:admin')->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');

        Route::get('stok/monitoring', [MonitoringStokController::class, 'index'])->name('stok.monitoring.index');

        Route::get('export-excel/{jenis}', [ExcelExportController::class, 'export'])->name('export.excel');
        Route::get('export-pdf/{jenis}', [PdfExportController::class, 'export'])->name('export.pdf');
    });
});

require __DIR__.'/auth.php';