<?php

namespace App\Http\Controllers;

use App\Models\Puissance;
use Illuminate\Http\Request;

class PuissanceController extends Controller
{
    public function index(Request $request)
{
    // Fetch all puissance data initially
    $puissances = Puissance::all();

    // Check if fromDate and toDate are specified in the request
    if ($request->has(['fromDatep', 'toDatep'])) {
        // Filter puissance data based on specified dates
        $fromDatep = $request->input('fromDatep');
        $toDatep = $request->input('toDatep');
        $puissances = Puissance::whereBetween('created_at', [$fromDatep, $toDatep])->get();
    }

    return view('puissance', compact('puissances'));
}    

public function store(Request $request)
    {
        $validated = $request->validate([
            'puissance_atelie' => 'required|numeric',
            'puissance_admin' => 'required|numeric',
            'usine' => 'required|numeric',
            'magasin' => 'required|numeric',
        ]);

        Puissance::create($validated);
        return redirect()->route('puissances.index');
    }

    public function show(Puissance $puissance)
    {
        return view('puissances.show', compact('puissance'));
    }

    public function edit(Puissance $puissance)
    {
        return view('puissances.edit', compact('puissance'));
    }

    public function update(Request $request, Puissance $puissance)
    {
        $validated = $request->validate([
            'puissance_atelie' => 'required|numeric',
            'puissance_admin' => 'required|numeric',
            'usine' => 'required|numeric',
            'magasin' => 'required|numeric',
        ]);

        $puissance->update($validated);
        return redirect()->route('puissances.index');
    }

    public function destroy(Puissance $puissance)
    {
        $puissance->delete();
        return redirect()->route('puissances.index');
    }
};

