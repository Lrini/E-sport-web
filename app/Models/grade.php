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

    // relasi has many dengan model Lomba
    public function lomba()
    {
        return $this->hasMany(lomba::class, 'id_grade', 'id');
    }
}
