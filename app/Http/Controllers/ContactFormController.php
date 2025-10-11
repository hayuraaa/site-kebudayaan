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
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'website_source' => 'required|in:pendidikan,komunitas,kebudayaan,datatek',
        ]);

        try {
            // Kirim ke API Dashboard
            $response = Http::timeout(10)->post(env('DASHBOARD_API_URL') . '/api/contact-forms/submit', $validated);

            if ($response->successful()) {
                return back()->with('success', 'Terima kasih! Pesan Anda telah berhasil dikirim.');
            }
            
            return back()->with('error', 'Maaf, terjadi kesalahan. Silakan coba lagi.');
            
        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());
            return back()->with('error', 'Maaf, terjadi kesalahan koneksi.');
        }
    }
}
