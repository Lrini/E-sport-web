<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\lomba;

class acara extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
    // Cast fields to proper types
    protected $casts = [
        'tanggal_acara' => 'date',
        'status_acara' => 'string',
        'biaya' => 'integer',
        'id_lomba' => 'integer',
        'uuid' => 'integer',
    ];
    
    // Ensure these fields are always accessible
    protected $fillable = [
        'uuid',
        'id_lomba',
        'nama_acara',
        'tanggal_acara',
        'keterangan',
        'biaya',
        'status_acara',
    ];
    
    // relasi many to one antara acara dan lomba
    public function lomba()
    {
        return $this->belongsTo(lomba::class, 'id_lomba', 'id');
    }
}
