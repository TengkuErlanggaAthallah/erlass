<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;

Route::post('/upload-media', [MediaController::class, 'uploadMedia'])->name('upload.media');

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // User management routes
        Route::get('/user', [HomeController::class, 'index'])->name('user.index');
        Route::get('/create', [HomeController::class, 'create'])->name('user.create');
        Route::post('/store', [HomeController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('user.edit');
        Route::put('/update/{id}', [HomeController::class, 'update'])->name('user.update');
        Route::delete('/user/{id}', [HomeController::class, 'destroy'])->name('user.destroy');
        
        // Media management routes
        Route::get('/media', [MediaController::class, 'index'])->name('media.index');
        Route::get('/upload', [MediaController::class, 'showUploadForm'])->name('upload');
        Route::post('/media/upload', [MediaController::class, 'uploadMedia'])->name('media.upload');
        Route::get('/media/{id}/edit', [MediaController::class, 'edit'])->name('media.edit');
        Route::put('/media/{id}', [MediaController::class, 'update'])->name('media.update');
        Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('media.destroy');
    
        // Routes for showing categories
        Route::get('/media/promotion-videos', [MediaController::class, 'showPromotionVideos'])->name('media.promotion_videos');
        Route::get('/media/motivational-quotes', [MediaController::class, 'showMotivationalQuotes'])->name('media.motivational_quotes');
        Route::get('/media/design-corner', [MediaController::class, 'showDesignCorner'])->name('media.design_corner');
        Route::get('/media/alat-promosi-internal', [MediaController::class, 'showAlatPromosiInternal'])->name('media.alat_promosi_internal');
        
        // Profile routes
        Route::get('/profile', [AdminController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [AdminController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [AdminController::class, 'update'])->name('profile.update');
    });
});


// Petugas routes
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('petugas/dashboard', [PetugasController::class, 'dashboard'])->name('petugas.dashboard');
    Route::get('petugas/media/upload', [PetugasController::class, 'showUploadMediaForm'])->name('petugas.media.upload');
    Route::post('petugas/media/upload', [MediaController::class, 'uploadMedia'])->name('petugas.upload.media');
    Route::get('petugas/media', [PetugasController::class, 'index'])->name('petugas.media.index');

    // Rute untuk menampilkan detail media berdasarkan ID
    Route::get('petugas/media/{id}', [MediaController::class, 'show'])->name('petugas.media.show');
    
    // Rute untuk mengupdate media (metode PUT)
    Route::put('petugas/media/{id}', [MediaController::class, 'update'])->name('petugas.media.update');

    // Profile routes
    Route::get('petugas/profile', [PetugasController::class, 'show'])->name('petugas.profile.show');
    Route::get('petugas/profile/edit', [PetugasController::class, 'edit'])->name('petugas.profile.edit');
    Route::put('petugas/profile', [PetugasController::class, 'update'])->name('petugas.profile.update');
    Route::delete('petugas/media/{id}', [MediaController::class, 'destroy'])->name('petugas.media.destroy');
});

// Routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/upload-media', [MediaController::class, 'uploadMedia'])->name('upload.media');
    
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/media', [MediaController::class, 'index'])->name('media.index');
        Route::put('/media/{id}', [MediaController::class, 'update'])->name('media.update');
        Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('media.destroy');
    });
});

// Public routes
Route::get('/dashboard-user', function () {
    return view('user.dashboard-user');
});
Route::get('/promotion-videos', [MediaController::class, 'showPromotionVideos'])->name('promotion.videos');
Route::get('/design-corner', [MediaController::class, 'showDesignCorner'])->name('design.corner');
Route::get('/alat-promosi-internal', [MediaController::class, 'showAlatPromosiInternal'])->name('alat.promosi');
Route::get('/motivational-quotes', [MediaController::class, 'showMotivationalQuotes'])->name('motivational.quotes');
Route::get('/produk', [MediaController::class, 'showProduk'])->name('produk.index');
Route::get('/produk/{title}', [MediaController::class, 'detail'])->name('categories.detail');


Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Route untuk register
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-proses', [LoginController::class, 'register_proses'])->name('register-proses');

// Route untuk lupa password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $response = Password::sendResetLink($request->only('email'));
    return $response == Password::RESET_LINK_SENT
        ? back()->with('status', __($response))
        : back()->withErrors(['email' => __($response)]);
});
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');