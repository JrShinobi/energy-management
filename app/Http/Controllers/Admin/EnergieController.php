<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Energie;

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

        return view('admin.energie', compact('energies'));
    }
}
