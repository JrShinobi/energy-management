<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PuissanceController;
use App\Http\Controllers\TensionController;
use App\Http\Controllers\EnergieController;
use App\Http\Controllers\FrequenceController;
use App\Http\Controllers\FacteurDePuissanceController;
use App\Http\Controllers\RapportController;
//admin
use App\Http\Controllers\Admin\CourantController as AdminCourantController;
use App\Http\Controllers\Admin\TensionController as AdminTensionController;
use App\Http\Controllers\Admin\EnergieController as AdminEnergieController;
use App\Http\Controllers\Admin\PuissanceController as AdminPuissanceController;
use App\Http\Controllers\Admin\FrequenceController as AdminFrequenceController;
use App\Http\Controllers\Admin\FacteurDePuissanceController as AdminFacteurDePuissanceController;
use App\Http\Controllers\Admin\RapportController as AdminRapportController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminAlarmController;
use App\Http\Controllers\AlarmController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//route
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [AdminProfileController::class, 'destroy'])->name('admin.profile.destroy');
});
require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::resource('courants', CourantController::class);
Route::resource('puissances', PuissanceController::class);
Route::resource('tensions', TensionController::class);
Route::resource('energies', EnergieController::class);
Route::resource('frequences', FrequenceController::class);
Route::resource('facteur_de_puissances', FacteurDePuissanceController::class);

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});


// In your routes file (web.php)
Route::get('/courant', [CourantController::class, 'index'])->name('courant');
Route::get('/tension', [TensionController::class, 'index'])->name('tension');
Route::get('/puissance', [PuissanceController::class, 'index'])->name('puissance');
Route::get('/energie', [EnergieController::class, 'index'])->name('energie');
Route::get('/facteur_puissance', [FacteurDePuissanceController::class, 'index'])->name('facteur_puissance');
Route::get('/frequence', [FrequenceController::class, 'index'])->name('frequence');
Route::get('/rapport',[RapportController::class,'index'])->name('rapport');
Route::get('/filter',[RapportController::class, 'filter']);


// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/courant', [AdminCourantController::class, 'index'])->name('admin.courant');
    Route::get('/admin/tension', [AdminTensionController::class, 'index'])->name('admin.tension');
    Route::get('/admin/energie', [AdminEnergieController::class, 'index'])->name('admin.energie');
    Route::get('/admin/puissance', [AdminPuissanceController::class, 'index'])->name('admin.puissance');
    Route::get('/admin/frequence', [AdminFrequenceController::class, 'index'])->name('admin.frequence');
    Route::get('/admin/facteur-de-puissance', [AdminFacteurDePuissanceController::class, 'index'])->name('admin.facteur_puissance');
    Route::get('/admin/rapport', [AdminRapportController::class, 'index'])->name('admin.rapport');
    Route::get('/admin/filter', [AdminRapportController::class, 'filter']);

});

//route admin historique
Route::get('/admin/historique_alarme', [AdminAlarmController::class, 'index'])->name('admin.historique_alarme');
Route::patch('/admin/historique_alarme/{id}', [AdminAlarmController::class, 'acknowledgeAlarm'])->name('admin.acknowledge_alarm');
Route::get('/admin/check_alarms', [AdminAlarmController::class, 'checkAlarms'])->name('admin.check_alarms');


//route user historique
Route::get('historique_alarme', [AlarmController::class, 'index'])->name('historique_alarme');
Route::patch('historique_alarme/{id}', [AlarmController::class, 'acknowledgeAlarm'])->name('acknowledge_alarm');
Route::get('check_alarms', [AlarmController::class, 'checkAlarms'])->name('check_alarms');



//gestion d'alarme
Route::get('/admin/gestion_alarme', [HomeController::class, 'gestionAlarme'])->name('admin.gestion_alarme');
Route::post('/admin/gestion_alarme', [HomeController::class, 'updateAlarme'])->name('admin.gestion_alarme.update');

//gestion utilisateur
Route::get('/admin/gestion-utilisateur', [AdminUserController::class, 'index'])->name('admin.gestion_utilisateur');
Route::post('/admin/gestion-utilisateur/add', [AdminUserController::class, 'store'])->name('admin.gestion_utilisateur.add');
Route::post('/admin/gestion-utilisateur/edit', [AdminUserController::class, 'update'])->name('admin.gestion_utilisateur.edit');
Route::post('/admin/gestion-utilisateur/delete', [AdminUserController::class, 'destroy'])->name('admin.gestion_utilisateur.delete');


