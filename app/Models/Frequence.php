<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frequence extends Model
{
    use HasFactory;
    protected $fillable = [
        'frequence_atelie',
        'frequence_admin',
        'usine',
        'magasin',
    ];

    public function alarmeSettings()
    {
        return $this->belongsTo(AlarmeSettings::class);
    }
}
