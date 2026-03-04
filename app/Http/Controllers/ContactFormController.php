<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactFormController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            $response = Http::timeout(10)->post(
                env('DASHBOARD_API_URL') . '/api/v1/contact/situs-kebudayaan',
                [
                    'name'    => $validated['name'],
                    'email'   => $validated['email'] ?? null,
                    'phone'   => $validated['phone'],
                    'message' => $validated['message'],
                ]
            );

            if ($response->successful() && $response->json('success')) {
                return back()->with('success', 'Terima kasih! Pesan Anda telah berhasil dikirim.');
            }

            return back()->with('error', $response->json('message') ?? 'Maaf, terjadi kesalahan. Silakan coba lagi.');

        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());
            return back()->with('error', 'Maaf, terjadi kesalahan koneksi.');
        }
    }
}