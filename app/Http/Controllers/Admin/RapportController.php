<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courant;
use App\Models\Tension;
use App\Models\Puissance;
use App\Models\Energie;
use App\Models\FacteurDePuissance;
use App\Models\Frequence;

class RapportController extends Controller
{
    public function index()
    {
        $courants = Courant::all();
        $puissances= Puissance::all();
        $tensions = Tension::all();
        $energies = Energie::all();
        $frequences = Frequence::all();
        $facteurs = FacteurDePuissance::all();
        return view('admin.rapport', compact('courants','puissances','tensions','energies','frequences','facteurs'));
    }
    public function filter(Request $request)
    {
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;

        $courants = Courant::whereBetween('created_at', [$dateFrom, $dateTo])->get();
        $puissances = Puissance::whereBetween('created_at', [$dateFrom, $dateTo])->get();
        $tensions = Tension::whereBetween('created_at', [$dateFrom, $dateTo])->get();
        $energies = Energie::whereBetween('created_at', [$dateFrom, $dateTo])->get();
        $frequences = Frequence::whereBetween('created_at', [$dateFrom, $dateTo])->get();
        $facteurs = FacteurDePuissance::whereBetween('created_at', [$dateFrom, $dateTo])->get();

        return view('admin.rapport', compact('courants', 'puissances', 'tensions', 'energies', 'frequences', 'facteurs'));
    }
}
