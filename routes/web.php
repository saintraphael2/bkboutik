<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('password/update', [App\Http\Controllers\Auth\UpdatePasswordController::class, 'showUpdateForm'])->name('password.my_edit');
    Route::post('password/update', [App\Http\Controllers\Auth\UpdatePasswordController::class, 'update'])->name('password.my_update');
    //Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
    //Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
    Route::resource('typepieces', App\Http\Controllers\TypepieceController::class);
    Route::resource('versements', App\Http\Controllers\VersementController::class);
    //Route::post('versements/batch/store', App\Http\Controllers\VersementController::class);
    Route::get('versements/facture/{id}', ['as' => 'versements.facture' , 'uses' => 'VersementController@facture']);
    Route::resource('vidanges', App\Http\Controllers\VidangeController::class);
    Route::resource('cautions', App\Http\Controllers\CautionController::class);
    Route::resource('compagnieassurances', App\Http\Controllers\CompagnieAssuranceController::class);
    Route::resource('conducteurs', App\Http\Controllers\ConducteurController::class);
    Route::get('contrats/state/{id}',['as' => 'contrats.state' , 'uses' => 'ContratController@state'] );
    Route::resource('contrats', App\Http\Controllers\ContratController::class);
    Route::resource('contratAssurances', App\Http\Controllers\ContratAssuranceController::class);
    Route::resource('motos', App\Http\Controllers\MotoController::class);
    Route::resource('typeContrats', App\Http\Controllers\TypeContratController::class);
    Route::resource('cautions_conduteurs', App\Http\Controllers\Cautions_conduteurController::class);
    Route::resource('tableau_armortissements', App\Http\Controllers\Tableau_armortissementController::class);
    Route::resource('users', App\Http\Controllers\UsersController::class);
    Route::get('addVidande/{IdMoto}',['as' => 'addVidande' , 'uses' => 'VidangeController@create'] );
    Route::get('disponibleMotor',['as' => 'disponibleMotor' , 'uses' => 'MotoController@disponibleMotor'] );
    Route::get('stockMotor',['as' => 'stockMotor' , 'uses' => 'MotoController@stockMotor'] );
    Route::resource('liens', App\Http\Controllers\LiensController::class);
    Route::resource('user_liens', App\Http\Controllers\User_liensController::class);
    Route::get('addAssurance/{IdMoto}',['as' => 'addAssurance' , 'uses' => 'ContratAssuranceController@create'] );
    Route::get('contratsAssurance/{IdMoto}',['as' => 'contratsAssurance' , 'uses' => 'MotoController@listeAssurance'] );
    Route::get('listeVersement/{IdContrat}/{IdVersement}',['as' => 'listeVersement' , 'uses' => 'VersementController@listeVersement'] );
    Route::get('cheminVersement',['as' => 'cheminVersement' , 'uses' => 'VersementController@cheminVersement'] );
    Route::get('majtam/{IdContrat}',['as' => 'majtam' , 'uses' => 'ContratController@majtam'] );
    Route::get('motar/{IdContrat}',['as' => 'motar' , 'uses' => 'ContratController@motar'] );
    Route::get('etats/arrieres', ['as' => 'etats.arrieres' , 'uses' => 'EtatController@arrieres']);
    Route::get('etats/encaissements', ['as' => 'etats.encaissements' , 'uses' => 'EtatController@encaissements']);
    Route::get('etats/reglements', ['as' => 'etats.reglements' , 'uses' => 'EtatController@reglements']);
    Route::get('etats/partenaires', ['as' => 'etats.partenaires' , 'uses' => 'EtatController@partenaires']);
    Route::post('edittam/{IdContrat}',['as' => 'edittam' , 'uses' => 'ContratController@edittam'] );
    Route::post('editmotif/{IdContrat}',['as' => 'editmotif' , 'uses' => 'ContratController@editmotif'] );
    Route::post('majPartenaire',['as' => 'majPartenaire' , 'uses' => 'MotoController@majPartenaire'] );
   // Route::post('password.update', App\Http\Controllers\Auth\ResetPasswordController::class)->name('password.update');
   Route::resource('motif_arrieres', App\Http\Controllers\Motif_arriereController::class);
   Route::resource('partenaires', App\Http\Controllers\PartenairesController::class);
   Route::get('partenaires/{partenaire}', ['as' => 'partenaires.show' , 'uses' => 'PartenairesController@show']);
   Route::get('listeImmatriculation',['as' => 'listeImmatriculation' , 'uses' => 'MotoController@listeImmatriculation'] ); 
});

Route::resource('offres', App\Http\Controllers\OffreController::class);