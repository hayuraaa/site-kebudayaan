<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class PublicMateriController extends Controller
{
    public function index()
    {
        try {
            $response = Http::timeout(10)->get(
                env('DASHBOARD_API_URL') . '/api/v1/media',
                [
                    'kategori'   => 'situs_kebudayaan',
                    'per_page'   => 'all',
                    'sort_by'    => 'created_at',
                    'sort_order' => 'desc',
                ]
            );

            $medialist = [];

            if ($response->successful() && $response->json('success')) {
                $data  = $response->json('data');
                $items = isset($data['data']) ? $data['data'] : $data;

                $medialist = collect($items)->map(function ($item) {
                    return [
                        'id'          => $item['id'],
                        'judul'       => $item['judul'],
                        'keterangan'  => $item['keterangan'],
                        'jenis_media' => $item['jenis_media'],
                        'url_media'   => $item['url_media'],
                        'embed_url'   => $item['embed_url'] ?? null,
                    ];
                })->values()->toArray();
            }

        } catch (\Exception $e) {
            \Log::error('Media fetch error: ' . $e->getMessage());
            $medialist = [];
        }

        return Inertia::render('Media', [
            'medialist' => $medialist
        ]);
    }
}