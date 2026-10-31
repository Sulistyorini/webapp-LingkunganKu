<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'user_id',
        'nama_pelapor',
        'email_pelapor',
        'judul',
        'kategori',
        'deskripsi',
        'lokasi',
        'foto',
        'status',
        'catatan_admin',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function riwayatPenanganan(): HasMany
    {
        return $this->hasMany(RiwayatPenanganan::class, 'laporan_id');
    }

    /**
     * URL foto yang aman dipakai dari perangkat lain (tanpa APP_URL).
     * - 'assets/...'  -> file di folder public
     * - lainnya       -> file di storage/app/public (lewat /storage)
     */
    public function getFotoUrlAttribute(): ?string
    {
        if (!$this->foto) {
            return null;
        }
        if (str_starts_with($this->foto, 'data:')) {
            return $this->foto;
        }
        if (preg_match('#^(https?:)?//#', $this->foto)) {
            return $this->foto;
        }
        if (str_starts_with($this->foto, 'assets/')) {
            return '/' . $this->foto;
        }
        return '/storage/' . ltrim($this->foto, '/');
    }
}