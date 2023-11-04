<?php

namespace App\Http\Controllers;

use App\DataTables\EtatArriereDataTable;
use App\DataTables\Tableau_armortissementDataTable;
use App\Http\Requests\CreateTableau_armortissementRequest;
use App\Http\Requests\UpdateTableau_armortissementRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Tableau_armortissementRepository;
use App\Repositories\ContratRepository;
use Illuminate\Http\Request;
use Flash;
//use DB;

use App\DataTables\ContratDataTable;
use App\DataTables\EtatEncaissementDataTable;
use App\Http\Requests\CreateContratRequest;
use App\Http\Requests\UpdateContratRequest;
use App\Repositories\ConducteurRepository;
use App\Repositories\TypepieceRepository;
use App\Repositories\TypeContratRepository;
use App\Repositories\MotoRepository;
use App\Models\TypeContrat;
use App\Models\Moto;
use App\Models\Conducteur;
use App\Models\Contrat;
use App\Models\Tableau_armortissement;
use App\Models\User;
use App\Models\Versement;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;

class EtatController extends AppBaseController
{
    /** @var Tableau_armortissementRepository $tableauArmortissementRepository*/
    private $tableauArmortissementRepository;
    private $contratRepository;

    public function __construct(Tableau_armortissementRepository $tableauArmortissementRepo, ContratRepository $contratRepo)
    {
        $this->tableauArmortissementRepository = $tableauArmortissementRepo;
        $this->contratRepository = $contratRepo;
    }



    /**
     * Display a listing of the Contrat.
     */
    public function arrieres(EtatArriereDataTable $etatArriereDataTable)
    {

        /*$query = Contrat::with([
            'typecontrats',
            'motos',
            'conducteurs'
        ]);//->orderby('numero','desc');


        $query->join('tableau_armortissement', 'contrat.id', '=', 'tableau_armortissement.contrat')
        //->join('orders', 'users.id', '=', 'orders.user_id')
        ->where([
            ['contrat.solde', '>', 0],
            ['tableau_armortissement.etat', 'NON PAYE'],
            ['tableau_armortissement.datprev','<', Carbon::now()]
        ])
        ->select(
            'contrat.*',
            //'tableau_armortissement.datprev', 
            //'tableau_armortissement.etat', 
            //'tableau_armortissement.montant as tableau_montant', 
            DB::raw('SUM(tableau_armortissement.montant) as arrieres'),
            DB::raw('COUNT(etat) as retard'),
            //'orders.price'
        )
        ->groupBy('contrat.id')
        ;

        dd($query->get());*/

        return $etatArriereDataTable->render('etats.arrieres');
    }


    /**
     * Display a listing of the Versement.
     */
    public function encaissements(EtatEncaissementDataTable $etatEncaissementDataTable, Request $request) 
    {
        $caissiers = User::get();
        //var_dump(Auth::user()->comptable);exit;
        $query = Versement::orderby('id','desc');
        $etatEncaissementDataTable->comptable=Auth::user()->comptable;
        if($request->caissier){
            $etatEncaissementDataTable->caissier = $request->caissier;
            $query->where('caissier', $request->caissier);
        }

        if($request->fromDate && $request->toDate){

            $fromDate = Carbon::parse($request->fromDate);
            $toDate = Carbon::parse($request->toDate);

            $etatEncaissementDataTable->fromDate = $fromDate;
            $etatEncaissementDataTable->toDate = $toDate;

            $query->whereBetween('date', [$fromDate, $toDate]);
        }else{
			$query->where('date',Carbon::today());
		}
       

        $caisse = $query->sum('montant');

        return $etatEncaissementDataTable->render('etats.encaissements',[
            'caisse' => number_format($caisse, 0," ", " "),
            'caissiers' => $caissiers,
        ]);
    }

    public function contratDesactives(ContratDataTable $contratDataTable)
    {    
        $contratDataTable->actif = 0;
        return $contratDataTable->render('contrats.index');
    
    }

}
