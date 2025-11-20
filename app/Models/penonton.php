<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\lomba;
use App\Models\acara;

class penonton extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function lomba()
    {
        return $this->belongsTo(lomba::class, 'id_lomba', 'id');
    }

    public function acara()
    {
        return $this->belongsTo(acara::class, 'id_acara', 'id');
    }
}
