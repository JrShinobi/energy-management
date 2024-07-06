<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacteurDePuissance extends Model
{
    use HasFactory;
    protected $fillable = [
        'facteur_atelie',
        'facteur_admin',
        'usine',
        'magasin',
    ];

    public function alarmeSettings()
    {
        return $this->belongsTo(AlarmeSettings::class);
    }
}
