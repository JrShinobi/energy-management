<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Energie extends Model
{
    use HasFactory;
    protected $fillable = [
        'energie_atelie',
        'energie_admin',
        'usine',
        'magasin',
    ];
    public function alarmeSettings()
    {
        return $this->belongsTo(AlarmeSettings::class);
    }
}
