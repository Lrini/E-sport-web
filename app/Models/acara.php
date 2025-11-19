<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class acara extends Model
{
    use HasFactory;

     protected $guarded = ['id'];

    public function lomba()
    {
        return $this->belongsTo(lomba::class, 'id_lomba', 'id');
    }
}
