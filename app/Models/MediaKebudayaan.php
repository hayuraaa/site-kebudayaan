<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaKebudayaan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'materi_datatek';

    protected $fillable = [
        'judul',
        'keterangan',
        'jenis_media',
        'kategori',
        'url_media',
        'is_active',
        'urutan',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    protected $appends = ['embed_url'];

    /**
     * Get the user who created the materi.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the materi.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Convert URL to embed URL based on media type
     */
    public function getEmbedUrlAttribute()
    {
        if ($this->jenis_media === 'youtube') {
            $url = $this->url_media;

            if (strpos($url, 'youtube.com/embed/') !== false) {
                return $url;
            }

            if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]+)/', $url, $matches)) {
                return 'https://www.youtube.com/embed/'.$matches[1];
            }
        } elseif ($this->jenis_media === 'google_slides') {
            return str_replace('/edit', '/embed', $this->url_media);
        } elseif ($this->jenis_media === 'google_docs') {
            return str_replace('/edit', '/preview', $this->url_media);
        } elseif ($this->jenis_media === 'wikimedia_commons') {
            // Tambahkan parameter untuk hide sidebar/toolbar PDF
            return $this->url_media . '#toolbar=0&navpanes=0&scrollbar=1';
        }

        return $this->url_media;
    }

    /**
     * Scope a query to only include active materi.
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
}
