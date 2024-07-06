<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Energie;
use App\Models\Courant;
use App\Models\AlarmeSettings;
 use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
   public function index()
   {

      $weekDate = now()->startOfWeek();
      $weekData = Energie::where('created_at', '>=', $weekDate)->get();

      $todayDate = now()->startOfDay();
      $todayData = Energie::where('created_at', '>=', $todayDate)->get();

      $monthData = now()->startOfMonth();
      $monthData = Energie::where('created_at', '>=', $monthData)->get();

      $courants = Courant::all();
    return view('admin.dashboard', compact('monthData', 'weekData', 'todayData','courants')); 
   }

   public function gestionAlarme()
{
    // Fetch current alarm settings from the database
    $alarmeSettings = AlarmeSettings::first();

    return view('admin.gestion_alarme', compact('alarmeSettings'));
}
public function updateAlarme(Request $request)
{
    $request->validate([
        'courant' => 'required|numeric',
        'tension' => 'required|numeric',
        'puissance' => 'required|numeric',
        'energie' => 'required|numeric',
        'frequence' => 'required|numeric',
        'facteur_puissance' => 'required|numeric',
    ]);

    $alarmeSettings = AlarmeSettings::firstOrNew();
    if (!$alarmeSettings) {
        $alarmeSettings = new AlarmeSettings();
    }

    $alarmeSettings->courant = $request->courant;
    $alarmeSettings->tension = $request->tension;
    $alarmeSettings->puissance = $request->puissance;
    $alarmeSettings->energie = $request->energie;
    $alarmeSettings->frequence = $request->frequence;
    $alarmeSettings->facteur_puissance = $request->facteur_puissance;
    $alarmeSettings->save();

    return redirect()->route('admin.gestion_alarme')->with('success', 'Settings updated successfully');
}
   
}
