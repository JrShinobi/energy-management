<?php

namespace App\Http\Controllers;

use App\Models\FacteurDePuissance;
use Illuminate\Http\Request;

class FacteurDePuissanceController extends Controller
{
    public function index(Request $request)
{
    // Retrieve all FacteurDePuissance records
    $facteurDePuissances = FacteurDePuissance::all();
    
    // Check if fromDatefc and toDatefc are specified in the request
    if ($request->has(['fromDatefc', 'toDatefc'])) {
        // Filter facteurDePuissances data based on specified dates
        $fromDatefc = $request->input('fromDatefc');
        $toDatefc = $request->input('toDatefc');
        $facteurDePuissances = FacteurDePuissance::whereBetween('created_at', [$fromDatefc, $toDatefc])->get();
    }
    
    // Pass the facteurDePuissances data to the view
    return view('facteur_puissance', compact('facteurDePuissances'));
}


    public function create()
    {
        return view('facteur_de_puissances.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'facteur_de_puissance_atelie' => 'required|numeric',
            'facteur_de_puissance_admin' => 'required|numeric',
            'usine' => 'required|numeric',
            'magasin' => 'required|numeric',
        ]);

        FacteurDePuissance::create($validated);
        return redirect()->route('facteur_de_puissances.index');
    }

    public function show(FacteurDePuissance $facteurDePuissance)
    {
        return view('facteur_de_puissances.show', compact('facteurDePuissance'));
    }

    public function edit(FacteurDePuissance $facteurDePuissance)
    {
        return view('facteur_de_puissances.edit', compact('facteurDePuissance'));
    }

    public function update(Request $request, FacteurDePuissance $facteurDePuissance)
    {
        $validated = $request->validate([
            'facteur_de_puissance_atelie' => 'required|numeric',
            'facteur_de_puissance_admin' => 'required|numeric',
            'usine' => 'required|numeric',
            'magasin' => 'required|numeric',
        ]);

        $facteurDePuissance->update($validated);
        return redirect()->route('facteur_de_puissances.index');
    }

    public function destroy(FacteurDePuissance $facteurDePuissance)
    {
        $facteurDePuissance->delete();
        return redirect()->route('facteur_de_puissances.index');
    }
}
;
