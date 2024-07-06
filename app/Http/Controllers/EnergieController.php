<?php

namespace App\Http\Controllers;

use App\Models\Energie;
use Illuminate\Http\Request;

class EnergieController extends Controller
{
    public function index(Request $request)
{
    // Fetch all energie data initially
    $energies = Energie::all();

    // Check if fromDate and toDate are specified in the request
    if ($request->has(['fromDatee', 'toDatee'])) {
        // Filter energie data based on specified dates
        $fromDatee = $request->input('fromDatee');
        $toDatee = $request->input('toDatee');
        $energies = Energie::whereBetween('created_at', [$fromDatee, $toDatee])->get();
    }

    return view('energie', compact('energies'));
}

    public function create()
    {
        return view('energies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'energie_atelie' => 'required|numeric',
            'energie_admin' => 'required|numeric',
            'usine' => 'required|numeric',
            'magasin' => 'required|numeric',
        ]);

        Energie::create($validated);
        return redirect()->route('energies.index');
    }

    public function show(Energie $energie)
    {
        return view('energies.show', compact('energie'));
    }

    public function edit(Energie $energie)
    {
        return view('energies.edit', compact('energie'));
    }

    public function update(Request $request, Energie $energie)
    {
        $validated = $request->validate([
            'energie_atelie' => 'required|numeric',
            'energie_admin' => 'required|numeric',
            'usine' => 'required|numeric',
            'magasin' => 'required|numeric',
        ]);

        $energie->update($validated);
        return redirect()->route('energies.index');
    }

    public function destroy(Energie $energie)
    {
        $energie->delete();
        return redirect()->route('energies.index');
    }
}
;
