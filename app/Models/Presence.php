<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presence extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
      'identity_number',
      'tgl_presensi',
      'time_in',
      'time_out',
      'foto_in',
      'foto_out',
      'location_in',
      'location_out',  
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
