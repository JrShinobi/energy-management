<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tension extends Model
{
    use HasFactory;
    protected $fillable = [
        'tension_atelie',
        'tension_admin',
        'usine',
        'magasin',
    ];
    public function alarmeSettings()
    {
        return $this->belongsTo(AlarmeSettings::class);
    }
}
