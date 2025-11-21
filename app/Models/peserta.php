<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\lomba;

class peserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'penanggung_jawab',
        'nama_sekolah',
        'id_lomba',
        'no_hp',
        'uuid',
        'image',
    ];

    public function lomba()
    {
        return $this->belongsTo(lomba::class, 'id_lomba', 'id');
    }
}
