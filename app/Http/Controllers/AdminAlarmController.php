<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlarmeSettings;
use App\Models\HistoriqueAlarme;
use App\Models\Courant;
use App\Models\Tension;
use App\Models\Puissance;
use App\Models\Energie;
use App\Models\Frequence;
use App\Models\FacteurDePuissance;

class AdminAlarmController extends Controller
{
    public function index()
    {
        $this->checkAlarms();

        // Fetch all entries from historique_alarme
        $historique = HistoriqueAlarme::all();
        return view('admin.historique_alarme', compact('historique'));
    }

    private function checkAlarms()
    {
        $alarmeSettings = AlarmeSettings::first();
    
        // Check for Courant table
        $courant = Courant::latest()->first();
        if ($courant->courant_atelie > $alarmeSettings->courant || 
            $courant->courant_admin > $alarmeSettings->courant || 
            $courant->usine > $alarmeSettings->courant || 
            $courant->magasin > $alarmeSettings->courant) {
            $this->logAlarm('Alarme dépassement de limite de courant');
        }

        // Repeat the same process for other tables (Tension, Energie, Puissance, Frequence, FacteurDePuissance)
        $tension = Tension::latest()->first();
        if ($tension->tension_atelie > $alarmeSettings->tension || 
            $tension->tension_admin > $alarmeSettings->tension || 
            $tension->usine > $alarmeSettings->tension || 
            $tension->magasin > $alarmeSettings->tension) {
            $this->logAlarm('Alarme dépassement de limite de tension');
        }

        // Add checks for other tables similarly
        $puissance = Puissance::latest()->first();
        if ($puissance->puissance_atelie > $alarmeSettings->puissance || 
            $puissance->puissance_admin > $alarmeSettings->puissance || 
            $puissance->usine > $alarmeSettings->puissance || 
            $puissance->magasin > $alarmeSettings->puissance) {
            $this->logAlarm('Alarme dépassement de limite de puissance');
        }

        $energie = Energie::latest()->first();
        if ($energie->energie_atelie > $alarmeSettings->energie || 
            $energie->energie_admin > $alarmeSettings->energie || 
            $energie->usine > $alarmeSettings->energie || 
            $energie->magasin > $alarmeSettings->energie) {
            $this->logAlarm('Alarme dépassement de limite de energie');
        }

        $frequence = Frequence::latest()->first();
        if ($frequence->frequence_atelie > $alarmeSettings->frequence || 
            $frequence->frequence_admin > $alarmeSettings->frequence || 
            $frequence->usine > $alarmeSettings->frequence || 
            $frequence->magasin > $alarmeSettings->frequence) {
            $this->logAlarm('Alarme dépassement de limite de frequence');
        }

        $facteurDePuissance = FacteurDePuissance::latest()->first();
        if ($facteurDePuissance->facteur_atelie > $alarmeSettings->facteur_puissance || 
            $facteurDePuissance->facteur_admin > $alarmeSettings->facteur_puissance || 
            $facteurDePuissance->usine > $alarmeSettings->facteur_puissance || 
            $facteurDePuissance->magasin > $alarmeSettings->facteur_puissance) {
            $this->logAlarm('Alarme dépassement de limite de facteur de puissance');
        }
    }

    private function logAlarm($designation)
    {
        // Check if there's already an unacknowledged alarm with the same designation
        $existingAlarm = HistoriqueAlarme::where('designation', $designation)->where('etat', 0)->first();

        if (!$existingAlarm) {
            HistoriqueAlarme::create([
                'designation' => $designation,
                'etat' => 0
            ]);
        }
    }

    public function acknowledgeAlarm($id)
    {
        // Find the alarm by ID and acknowledge it
        $alarm = HistoriqueAlarme::find($id);

        if (!$alarm) {
            return redirect()->back()->with('error', 'Alarm not found.');
        }

        $alarm->etat = 1;
        $alarm->save();

        return redirect()->back()->with('status', 'Alarm acknowledged.');
    }
}
