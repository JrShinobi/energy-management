<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tension;

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

return view('admin.tension', compact('tensions'));
    }
}
