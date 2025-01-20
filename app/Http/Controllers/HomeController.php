<?php

namespace App\Http\Controllers;

use App\Models\Conducteur;
use App\Models\Contrat;
use App\Models\Moto;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;

use Ichtrojan\Otp\Otp;


use Session;

use App\Models\Connexion;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
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
        $connexion = Connexion::where(['identifier'=>Auth::user()->email])->first();

        if($connexion!=null && $connexion->validity==1){
            

        $nbConducteurs = Conducteur::join('contrat', 'contrat.conducteur', '=', 'conducteur.id')
        ->where('contrat.actif', 1)->where('conducteur.actif', 0)->count();
		if(Auth::user()->comptable==1){
			$nbMotos = Moto::wherenull("hors_stock")->orwhere("hors_stock",false)->count();
		}else{
			$nbMotos = Moto::wherenull("hors_stock")->orwhere("hors_stock",false)->where("disponible",1)->count();
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
            'contrat.id', 
'contrat.conducteur', 
 'contrat.moto',
 'contrat.journalier',
 'contrat.created_at',
            DB::raw('SUM(tableau_armortissement.montant) as arrieres'),
            DB::raw('COUNT(etat) as retard')
        )
        ->groupBy('contrat.id', 
'contrat.conducteur', 
 'contrat.moto',
 'contrat.journalier',
 'contrat.created_at');

        $query_arrieres = Contrat::join('tableau_armortissement', 'contrat.id', '=', 'tableau_armortissement.contrat')
        ->where([
            ['contrat.actif', 1],
            ['tableau_armortissement.etat', 'NON PAYE'],
            ['tableau_armortissement.datprev','<', Carbon::now()]
        ])
        ->select(
            'contrat.id', 
'contrat.conducteur', 
 'contrat.moto',
 'contrat.journalier',
 'contrat.created_at',
            DB::raw('SUM(tableau_armortissement.montant) as arrieres'),
            DB::raw('COUNT(etat) as retard')
        )
        ->groupBy('contrat.id', 
'contrat.conducteur', 
 'contrat.moto',
 'contrat.journalier',
 'contrat.created_at');
        //->get();
        
        
        $nbArrieres = count($query_arrieres->get()->toArray());
        $arrieres = $query->latest()->take(5)->get();

        return view('home')->with([
            'nbContrats' => $nbContrats,
            'nbConducteurs' => $nbConducteurs,
            'nbMotos' => $nbMotos,
            'nbArrieres' => $nbArrieres,

            'contrats' => $contrats,
            'arrieres' => $arrieres
        ]);


       
           
        }else{
            Auth::logout();
            return redirect('/login');
        }
    }

    public function otp()
    {
        
        return view('auth.otp')->with('email',Session::get('email'))->with('emailc',Session::get('emailc'));
    }

    public function validationOtp(Request $request){
        // dd($request->otp);
         $result=(new Otp)->validate('dg.bkzed@gmail.com', $request->otp);
        
         if($result->status==true){
             $connexion = Connexion::where(['identifier'=>Auth::user()->email])->first();
             $connexion->validity=1;
                 $connexion->save();
              return redirect("/");
         }
            
         elseif(trim($result->status)==false)  {
            // $errors = new MessageBag; 
             //$errors = new MessageBag(['password' => ['Code Invalide ou expiré.']]);
             Auth::logout();
             return redirect('/login')->withErrors(['email' => 'Code Invalide ou expiré. Veuillez vous reconnecter!'])->with( ['message' => 'test code'] );
         }
       
     }
}
