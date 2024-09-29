<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undian extends Model
{
    use HasFactory;

    protected $fillable = ['subkategori_id', 'peserta_id'];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class)->withTrashed(); // Mengambil peserta yang sudah di soft delete
    }

    public function subkategori()
    {
        return $this->belongsTo(Subkategori::class);
    }
}
