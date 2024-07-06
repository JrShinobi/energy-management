<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Puissance;
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
        return view('admin.puissance', compact('puissances'));
    }
}