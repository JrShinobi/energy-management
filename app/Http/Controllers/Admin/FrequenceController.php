<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frequence;
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
        return view('admin.frequence', compact('frequences'));
    }    
}
