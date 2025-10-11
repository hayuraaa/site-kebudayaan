<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MediaKebudayaan;
use Inertia\Inertia;


class PublicMateriController extends Controller
{
    public function index()
    {
        $materiList = MediaKebudayaan::where('is_active', true)
            ->where('kategori', 'kebudayaan') // Filter kategori
            ->orderBy('urutan', 'asc')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($materi) {
                return [
                    'id' => $materi->id,
                    'judul' => $materi->judul,
                    'keterangan' => $materi->keterangan,
                    'jenis_media' => $materi->jenis_media,
                    'url_media' => $materi->url_media,
                    'embed_url' => $materi->embed_url,
                    'urutan' => $materi->urutan,
                ];
            });

        return Inertia::render('Media', [
            'medialist' => $materiList
        ]);
    }
}
