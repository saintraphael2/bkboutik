<?php

namespace App\Http\Controllers;

use App\Models\Conducteur;
use App\Models\Contrat;
use App\Models\Moto;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $nbConducteurs = Conducteur::join('contrat', 'contrat.conducteur', '=', 'conducteur.id')
        ->where('contrat.actif', 1)->count();
		if(Auth::user()->comptable==1){
			$nbMotos = Moto::count();
		}else{
			$nbMotos = Moto::where("disponible",1)->count();
		}
        $nbContrats = Contrat::where([
            ['contrat.actif', 1]
        ])->count();
        $contrats = Contrat::where([
            ['contrat.actif', 1]
        ])->latest()->take(5)->get();

        $query = Contrat::join('tableau_armortissement', 'contrat.id', '=', 'tableau_armortissement.contrat')
        ->where([
            ['contrat.actif', 1],
            ['tableau_armortissement.etat', 'NON PAYE'],
            ['tableau_armortissement.datprev','<', Carbon::now()]
        ])
        ->select(
            'contrat.*',
            DB::raw('SUM(tableau_armortissement.montant) as arrieres'),
            DB::raw('COUNT(etat) as retard')
        )
        ->groupBy('contrat.id');
        //->get();
        
        
        $nbArrieres = count($query->get()->toArray());
        $arrieres = $query->latest()->take(5)->get();

        return view('home')->with([
            'nbContrats' => $nbContrats,
            'nbConducteurs' => $nbConducteurs,
            'nbMotos' => $nbMotos,
            'nbArrieres' => $nbArrieres,

            'contrats' => $contrats,
            'arrieres' => $arrieres
        ]);;
    }
}
