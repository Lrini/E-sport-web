<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\lomba;

class acara extends Model
{
    use HasFactory;
    // guarded digunakan untuk melindungi field id agar tidak bisa diisi secara massal
     protected $guarded = ['id'];
    // Cast tanggal_acara to date
    protected $casts = [
        'tanggal_acara' => 'date',
    ];
    // relasi many to one antara acara dan lomba
    public function lomba()
    {
        return $this->belongsTo(lomba::class, 'id_lomba', 'id');
    }
}
