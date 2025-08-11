<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BannerArtikelController;
use App\Http\Controllers\KategoriArtikelController;
use App\Http\Controllers\TagArtikelController;
use App\Http\Controllers\SPBEController;

//Jangan Lupa ganti buat Landing Page
Route::get('/', [LandingController::class, 'landing'])->name('landing');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-proses', [LoginController::class, 'register_proses'])->name('register-proses');



// middleware auth
Route::middleware(['auth'])->group(function () {

    //User
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/manajemen-pengguna', [HomeController::class, 'index'])->name('index');
    Route::get('/create/user', [HomeController::class, 'create'])->name('user.create');
    Route::post('/store/user', [HomeController::class, 'store'])->name('user.store');

    Route::get('/edit{id}', [HomeController::class, 'edit'])->name('user.edit');
    Route::put('/update{id}', [HomeController::class, 'update'])->name('user.update');
    Route::delete('/delete{id}', [HomeController::class, 'delete'])->name('user.delete');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');

    //Artikel
    Route::get('/artikel', [ArtikelController::class, 'artikels'])->name('artikels');
    Route::get('/artikel/create', [ArtikelController::class, 'create_artikel'])->name('artikel.create');
    Route::post('/artikel/store', [ArtikelController::class, 'store_artikel'])->name('artikel.store');
    Route::get('/artikel/edit/{id}', [ArtikelController::class, 'edit_artikel'])->name('artikel.edit');
    Route::get('artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');
    Route::put('/artikel/update/{id}', [ArtikelController::class, 'update_artikel'])->name('artikel.update');
    Route::delete('/artikel/destroy/{id}', [ArtikelController::class, 'destroy_artikel'])->name('artikel.destroy');

    //Tag Artikel
    Route::get('/tag', [TagArtikelController::class, 'index_tag'])->name('tag');
    Route::get('/tag/create', [TagArtikelController::class, 'create_tag'])->name('tag.create');
    Route::post('/tag/store', [TagArtikelController::class, 'store_tag'])->name('tag.store');
    Route::get('/tag/edit/{id}', [TagArtikelController::class, 'edit_tag'])->name('tag.edit');
    Route::put('/tag/update/{id}', [TagArtikelController::class, 'update_tag'])->name('tag.update');
    Route::delete('/tag/destroy/{id}', [TagArtikelController::class, 'destroy_tag'])->name('tag.destroy');

    //Kategori
    Route::get('/kategori', [KategoriArtikelController::class, 'category'])->name('kategori');
    Route::get('/kategori/create', [KategoriArtikelController::class, 'create_kategori'])->name('kategori.create');
    Route::post('/kategori/store', [KategoriArtikelController::class, 'store_kategori'])->name('kategori.store');
    Route::get('/kategori/edit/{id}', [KategoriArtikelController::class, 'edit_kategori'])->name('kategori.edit');
    Route::put('/kategori/update/{id}', [KategoriArtikelController::class, 'update_kategori'])->name('kategori.update');
    Route::delete('/kategori/destroy/{id}', [KategoriArtikelController::class, 'destroy_kategori'])->name('kategori.destroy');

    //Banner
    Route::get('/banner', [BannerArtikelController::class, 'banners'])->name('banner');
    Route::get('/banner/create', [BannerArtikelController::class, 'create_banner'])->name('banner.create');
    Route::post('/banner/store', [BannerArtikelController::class, 'store_banner'])->name('banner.store');
    Route::get('/banner/edit/{id}', [BannerArtikelController::class, 'edit_banner'])->name('banner.edit');
    Route::put('/banner/update/{id}', [BannerArtikelController::class, 'update_banner'])->name('banner.update');
    Route::delete('/banner/destroy/{id}', [BannerArtikelController::class, 'destroy_banner'])->name('banner.destroy');

    //Dokumen SPBE
    Route::get('/dokumen/unggah', [SPBEController::class, 'index'])->name('spbe.index');
    Route::get('/dokumen/create', [SPBEController::class, 'create'])->name('spbe.create');
    Route::post('/dokumen/store', [SPBEController::class, 'store'])->name('spbe.store');
    Route::get('/dokumen/{id}', [SPBEController::class, 'show'])->name('spbe.show');
    Route::get('/dokumen/edit/{id}', [SPBEController::class, 'edit'])->name('spbe.edit');
    Route::put('/dokumen/update/{id}', [SPBEController::class, 'update'])->name('spbe.update');
    Route::delete('/dokumen/destroy/{id}', [SPBEController::class, 'destroy'])->name('spbe.destroy');

    //Route::get('/dokumen/kategori', [DokumenController::class, 'kategori'])->name('kategori');

    //Log User
    Route::get('/log-aktifitas', [LogController::class, 'index'])->name('log');


    //Laporan
    Route::get('/laporan', [LaporanController::class, 'laporan'])->name('laporan');

    //search button
    Route::get('/artikel/search', [App\Http\Controllers\ArtikelController::class, 'search'])->name('artikel.search');

});
