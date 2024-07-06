<?php

 namespace App\Http\Controllers;


 use Illuminate\Support\Facades\DB;
 use App\Models\Energie;
 use App\Models\Courant;
use App\Models\Tension;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
        
        // Fetch data from the database energie 
        return view('dashboard', compact('monthData', 'weekData', 'todayData','courants'));
    }
   

 
}
