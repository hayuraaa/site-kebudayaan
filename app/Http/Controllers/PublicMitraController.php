<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class PublicMitraController extends Controller
{
    public function index()
    {
        try {
            $response = Http::timeout(10)->get(
                env('DASHBOARD_API_URL') . '/api/v1/mitra'
            );

            \Log::info('Mitra status: ' . $response->status());
            \Log::info('Mitra body: ' . $response->body());

            $regions = [];

            if ($response->successful() && $response->json('success')) {
                $regions = $response->json('data') ?? [];
            }

        } catch (\Exception $e) {
            \Log::error('Mitra fetch error: ' . $e->getMessage());
            $regions = [];
        }

        return Inertia::render('Mitra', [
            'regions' => $regions
        ]);
    }
}