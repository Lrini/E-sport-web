<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\acara;

class lomba extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function acara()
    {
        return $this->hasMany(acara::class, 'id_lomba', 'id');
    }
}
