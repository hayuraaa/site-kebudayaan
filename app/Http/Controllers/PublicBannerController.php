<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BannerModal;
use Inertia\Inertia;

class PublicBannerController extends Controller
{
    /**
     * Get active banner for specific site (single banner - method lama)
     */
    public function getBannerForSite($siteName = 'kebudayaan')
    {
        $banner = BannerModal::active()
            ->forSite($siteName)
            ->ordered()
            ->first();

        return $banner;
    }

    /**
     * Get all active banners for specific site (multiple banners - method baru)
     */
    public function getBannersForSite($siteName = 'kebudayaan')
    {
        $banners = BannerModal::active()
            ->forSite($siteName)
            ->ordered()
            ->get();

        return $banners;
    }
}