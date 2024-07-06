<?php

namespace App\Http\Controllers;

use App\Models\Tension;
use Illuminate\Http\Request;

class TensionController extends Controller
{
    public function index(Request $request)
{
    // Fetch all tension data initially
    $tensions = Tension::all();

    // Check if fromDate and toDate are specified in the request
    if ($request->has(['fromDatet', 'toDatet'])) {
        // Filter tension data based on specified dates
        $fromDatet = $request->input('fromDatet');
        $toDatet = $request->input('toDatet');
        $tensions = Tension::whereBetween('created_at', [$fromDatet, $toDatet])->get();
    }

    return view('tension', compact('tensions'));
}

    public function create()
    {
        return view('tensions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tension_atelie' => 'required|numeric',
            'tension_admin' => 'required|numeric',
            'usine' => 'required|numeric',
            'magasin' => 'required|numeric',
        ]);

        Tension::create($validated);
        return redirect()->route('tensions.index');
    }

    public function show(Tension $tension)
    {
        return view('tensions.show', compact('tensions'));
    }

    public function edit(Tension $tension)
    {
        return view('tensions.edit', compact('tensions'));
    }

    public function update(Request $request, Tension $tension)
    {
        $validated = $request->validate([
            'tension_atelie' => 'required|numeric',
            'tension_admin' => 'required|numeric',
            'usine' => 'required|numeric',
            'magasin' => 'required|numeric',
        ]);

        $tension->update($validated);
        return redirect()->route('tensions.index');
    }

    public function destroy(Tension $tension)
    {
        $tension->delete();
        return redirect()->route('tensions.index');
    }
}

