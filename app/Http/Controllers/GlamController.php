<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GlamController extends Controller
{
    public function index()
    {
        try {
            // Ambil dari cache (yang di-refresh otomatis oleh cron)
            $glamData = Cache::get('glam_locations', []);
            
            // Jika cache kosong, coba backup
            if (empty($glamData)) {
                $glamData = Cache::get('glam_locations_backup', []);
                Log::warning('Using backup GLAM cache');
            }
            
            return Inertia::render('GlamTerbuka', [
                'glamLocations' => $glamData,
                'totalLocations' => count($glamData),
                'error' => null
            ]);
            
        } catch (\Exception $e) {
            Log::error('GLAM page error: ' . $e->getMessage());
            
            return Inertia::render('GlamTerbuka', [
                'glamLocations' => [],
                'totalLocations' => 0,
                'error' => 'Terjadi kesalahan memuat data'
            ]);
        }
    }
}