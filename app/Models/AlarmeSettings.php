<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlarmeSettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'courant',
        'tension',
        'puissance',
        'energie',
        'frequence',
        'facteur_puissance',
    ];

    public function courant()
    {
        return $this->hasOne(Courant::class);
    }

    public function tension()
    {
        return $this->hasOne(Tension::class);
    }
    public function puissance()
    {
        return $this->hasOne(Puissance::class);
    }

    public function energie()
    {
        return $this->hasOne(Energie::class);
    }
    public function frequence()
    {
        return $this->hasOne(Frequence::class);
    }

    public function facteur_puissance()
    {
        return $this->hasOne(FacteurDePuissance::class);
    }
}
