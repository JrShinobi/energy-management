<?php

namespace App\Http\Controllers;

use App\Models\Frequence;
use Illuminate\Http\Request;

class FrequenceController extends Controller
{
    public function index(Request $request)
{
    // Fetch all frequence data initially
    $frequences = Frequence::all();

    // Check if fromDate and toDate are specified in the request
    if ($request->has(['fromDatef', 'toDatef'])) {
        // Filter frequence data based on specified dates
        $fromDatef = $request->input('fromDatef');
        $toDatef = $request->input('toDatef');
        $frequences = Frequence::whereBetween('created_at', [$fromDatef, $toDatef])->get();
    }

    return view('frequence', compact('frequences'));
}

    public function create()
    {
        return view('frequences.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'frequence_atelie' => 'required|numeric',
            'frequence_admin' => 'required|numeric',
            'usine' => 'required|numeric',
            'magasin' => 'required|numeric',
        ]);

        Frequence::create($validated);
        return redirect()->route('frequences.index');
    }

    public function show(Frequence $frequence)
    {
        return view('frequences.show', compact('frequence'));
    }

    public function edit(Frequence $frequence)
    {
        return view('frequences.edit', compact('frequence'));
    }

    public function update(Request $request, Frequence $frequence)
    {
        $validated = $request->validate([
            'frequence_atelie' => 'required|numeric',
            'frequence_admin' => 'required|numeric',
            'usine' => 'required|numeric',
            'magasin' => 'required|numeric',
        ]);

        $frequence->update($validated);
        return redirect()->route('frequences.index');
    }

    public function destroy(Frequence $frequence)
    {
        $frequence->delete();
        return redirect()->route('frequences.index');
    }
}
;
