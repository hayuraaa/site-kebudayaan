<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'slider_category_id',
        'nama',
        'keterangan',
        'gambar',
        'urutan',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    /**
     * Relasi ke SliderCategory
     */
    public function sliderCategory()
    {
        return $this->belongsTo(SliderCategory::class);
    }

    /**
     * Scope untuk slider aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk urutan slider
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }
}