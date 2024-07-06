<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacteurDePuissance;

class FacteurDePuissanceController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve all FacteurDePuissance records
        $facteurs = FacteurDePuissance::all();
        
        // Check if fromDatefc and toDatefc are specified in the request
        if ($request->has(['fromDatefc', 'toDatefc'])) {
            // Filter facteurDePuissances data based on specified dates
            $fromDatefc = $request->input('fromDatefc');
            $toDatefc = $request->input('toDatefc');
            $facteurs = FacteurDePuissance::whereBetween('created_at', [$fromDatefc, $toDatefc])->get();
        }
return view('admin.facteur_puissance', compact('facteurs'));
    }
}
