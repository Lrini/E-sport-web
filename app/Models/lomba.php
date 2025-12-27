<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\acara;

class lomba extends Model
{
    use HasFactory;
    // guarded digunakan untuk melindungi field id agar tidak bisa diisi secara massal
    protected $guarded = ['id'];

    // relasi one to many antara lomba dan acara
    public function acara()
    {
        return $this->hasMany(acara::class, 'id_lomba', 'id');
    }

    // relasi belongs to antara lomba dan grade
    public function grade()
    {
        return $this->belongsTo(grade::class, 'id_grade', 'id');
    }
}
