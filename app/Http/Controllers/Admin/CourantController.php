<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courant;
use App\Models\AlarmeSettings;
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

        return view('admin.courant', compact('courants'));
    }

    public function update(Request $request, $id)
    {
        $courant = Courant::findOrFail($id);
        $newCourantValue = $request->input('value');

        // Check if the new courant value exceeds the limit
        $alarmeSettings = AlarmeSettings::first();
        if ($newCourantValue > $alarmeSettings->courant_limit) {
            // Send notification
            // Example: Notification::send($courant->user, new CourantLimitExceeded($courant));
        }

        // Update the courant value
        $courant->value = $newCourantValue;
        $courant->save();

        return redirect()->back()->with('success', 'Courant updated successfully');
    }
}
