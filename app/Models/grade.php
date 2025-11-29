<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\lomba;

class grade extends Model
{
    use HasFactory;
    // guarded digunakan untuk melindungi field id agar tidak bisa diisi secara massal
    protected $guarded = ['id'];

    // relasi many to one antara grade dan lomba
    public function lomba()
    {
        return $this->belongsTo(lomba::class, 'id_lomba', 'id');
    }
}
