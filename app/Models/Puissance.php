<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puissance extends Model
{
    use HasFactory;
    protected $fillable = [
        'puissance_atelie',
        'puissance_admin',
        'usine',
        'magasin',
    ];
    public function alarmeSettings()
    {
        return $this->belongsTo(AlarmeSettings::class);
    }
}
