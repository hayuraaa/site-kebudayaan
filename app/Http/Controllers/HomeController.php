<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Models\BannerModal;
use App\Models\Slider;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil banner aktif
        $banners = BannerModal::active()
            ->forSite('kebudayaan')
            ->ordered()
            ->get()
            ->map(function($banner) {
                return [
                    'id' => $banner->id,
                    'judul' => $banner->judul,
                    'deskripsi' => $banner->deskripsi,
                    'gambar' => $banner->gambar,
                    'url_pranala' => $banner->url_pranala,
                    'text_tombol' => $banner->text_tombol,
                ];
            });

        $sliders = Slider::where('slider_category_id', 2) //2 = kebudyaaan
            ->where('is_active', true)
            ->orderBy('urutan')
            ->get();

        return Inertia::render('Home', [
            'banners' => $banners,
            'sliders' => $sliders
        ]);
    }
}
