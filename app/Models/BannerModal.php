<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerModal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'banner_modals';

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'url_pranala',
        'text_tombol',
        'tipe',
        'urutan',
        'target_situs',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'target_situs' => 'array',
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    /**
     * Scope a query to only include active banners.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by urutan.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('created_at', 'desc');
    }

    /**
     * Scope to filter banners by target site
     */
    public function scopeForSite($query, $siteName)
    {
        return $query->where(function ($q) use ($siteName) {
            $q->whereNull('target_situs')
              ->orWhere('target_situs', '[]')
              ->orWhereJsonContains('target_situs', $siteName);
        });
    }
}