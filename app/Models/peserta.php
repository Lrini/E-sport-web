<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\lomba;

class Peserta extends Model
{
    use HasFactory;

    // guarded digunakan untuk melindungi field id agar tidak bisa diisi secara massal
    protected $fillable = [
        'penanggung_jawab',
        'nama_sekolah',
        'id_lomba',
        'no_hp',
        'uuid',
        'image',
        'id_grade',
        'status_pembayaran',
        'gdrive_url',
    ];

    // relasi many to one antara peserta dan lomba
    public function lomba()
    {
        return $this->belongsTo(lomba::class, 'id_lomba', 'id');
    }

    // relasi many to one antara peserta dan grade
    public function grade()
    {
        return $this->belongsTo(grade::class, 'id_grade', 'id');
    }
}
