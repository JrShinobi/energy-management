<?php

namespace App\Http\Controllers;

use App\Models\Courant;
use Illuminate\Http\Request;

class CourantController extends Controller
{
    public function index(Request $request)
{
    // Fetch all courant data initially
    $courants = Courant::all();

    // Check if fromDate and toDate are specified in the request
    if ($request->has(['fromDate', 'toDate'])) {
        // Filter courant data based on specified dates
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $courants = Courant::whereBetween('created_at', [$fromDate, $toDate])->get();
    }

    return view('courant', compact('courants'));
}

    public function create()
    {
        return view('courant.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'courant_atelie' => 'required|numeric',
            'courant_admin' => 'required|numeric',
            'usine' => 'required|numeric',
            'magasin' => 'required|numeric',
        ]);

        Courant::create($validated);
        return redirect()->route('courants.index');
    }

    public function show(Courant $courant)
    {
        return view('courant.show', compact('courant'));
    }

    public function edit(Courant $courant)
    {
        return view('courant.edit', compact('courant'));
    }

    public function update(Request $request, Courant $courant)
    {
        $validated = $request->validate([
            'courant_atelie' => 'required|numeric',
            'courant_admin' => 'required|numeric',
            'usine' => 'required|numeric',
            'magasin' => 'required|numeric',
        ]);

        $courant->update($validated);
        return redirect()->route('courant');
    }

    public function destroy(Courant $courant)
    {
        $courant->delete();
        return redirect()->route('courant');
    }
};

