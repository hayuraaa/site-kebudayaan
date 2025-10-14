<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\GlamController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\PublicMateriController;
use App\Http\Controllers\PublicBannerController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/kegiatan', function () {
    return Inertia::render('Kegiatan');
})->name('kegiatan');

Route::get('/kebijakan-ruang-ramah', function () {
    return Inertia::render('KebijakanRuangRamah');
})->name('kebijakan-ruang-ramah');

Route::get('/mitra', function () {
    return Inertia::render('Mitra');
})->name('mitra');

Route::get('/kontak', function () {
    return Inertia::render('Kontak');
})->name('kontak');
Route::get('/media', [PublicMateriController::class, 'index'])->name('media');


Route::post('/contact-forms/submit', [ContactFormController::class, 'submit'])->name('contact.submit');

Route::get('/glam-terbuka', [GlamController::class, 'index'])->name('glam-terbuka');