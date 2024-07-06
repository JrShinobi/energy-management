<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courant extends Model
{
    use HasFactory;
    protected $fillable = [
        'courant_atelie',
        'courant_admin',
        'usine',
        'magasin',
    ];

    public function alarmeSettings()
    {
        return $this->belongsTo(AlarmeSettings::class);
    }
}
