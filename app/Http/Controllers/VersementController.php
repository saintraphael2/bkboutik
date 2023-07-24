<?php

namespace App\Http\Controllers;

use App\DataTables\VersementDataTable;
use App\DataTables\ContratFactureDataTable;
use App\DataTables\Tableau_armortissementDataTable;
use App\Http\Requests\CreateVersementRequest;
use App\Http\Requests\UpdateVersementRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\VersementRepository;
use App\Repositories\ContratRepository;
use App\Repositories\MotoRepository;
use App\Repositories\Tableau_armortissementRepository;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Flash;
use App\Models\Contrat;
use App\Models\Versement;
use App\Models\Tableau_armortissement;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use \NumberFormatter;

class VersementController extends AppBaseController
{
    /** @var VersementRepository $versementRepository*/
    private $versementRepository;
    private $tableauArmortissementRepository;
    private $contratRepository;
    private $motoRepository;

    public function __construct(
        VersementRepository $versementRepo,
        Tableau_armortissementRepository $tableauArmortissementRepo,
        ContratRepository $contratRepo,
        MotoRepository $motoRepo)
    {
        $this->versementRepository = $versementRepo;
        $this->contratRepository = $contratRepo;
        $this->motoRepository = $motoRepo;
        $this->tableauArmortissementRepository = $tableauArmortissementRepo;
    }

    /**
     * Display a listing of the Versement.
     */
    public function index(ContratFactureDataTable $contratFactureDataTable) {
       
        return $contratFactureDataTable->render('versements.index');
    }
    public function listeVersement ($idContrat, $idVersement)
    {
        $versementDataTable = new VersementDataTable();
        $versementDataTable->idContrat=$idContrat;
        $contrat=Contrat::find($idContrat);
        return $versementDataTable->render('versements.show', [
            'contrat' => $contrat
        ]);
    }

    /**
     * Show the form for creating a new Versement.
     */
    public function create(Request $request)
    {
        $configStepsLimit = 3;
        $currentStep = ($request->currentStep) ? $request->currentStep : 1;
        $contrat = ($request->contrat) ? $request->contrat : 1;
        
        $motos = $this->motoRepository->all(['disponible'=>0]);
        $contrat = $this->contratRepository->find($contrat);

        $tableauArmortissementDataTable =new Tableau_armortissementDataTable();
        $tableauArmortissementDataTable->idContrat = $contrat->id;
        $tableauArmortissementDataTable->payment = true;

        /*$arrieres =$this->tableauArmortissementRepository->all([
            ['datprev', '<=', Carbon::now()]
        ]);*/
        $arrieres = Tableau_armortissement::where([
            ['contrat', $contrat->id],
            ['etat', "NON PAYE"],
            ['datprev', '<=', Carbon::now()]
        ])->sum('montant');
        //dd($arrieres);
        
        $viewParameters = [
            'configStepsLimit' => $configStepsLimit,
            'currentStep' => $currentStep,
            'contrat' => $contrat,
            'arrieres' => $arrieres,
            //'motos' => $motos,
            'motos' => $motos->load('mycontrat')
        ];

        //dd($tableauArmortissementDataTable->render('versements.create', $viewParameters),$viewParameters);
        return $tableauArmortissementDataTable->render('versements.create', $viewParameters);

        /*if($currentStep == 2){   
            return $tableauArmortissementDataTable->render('versements.create', $viewParameters);
        }

        
        //dd($motos);
        return view('versements.create')->with($viewParameters);*/
    }

    /**
     * Store a newly created Versement in storage.
     */
    public function store(CreateVersementRequest $request)
    {
        //$date = date('now');
      //  $request->request->add(['caissier' => Auth::user()->id]);
        $input = $request->all();
       // $idversement=0;
        if(!$request->control && count($request->amortissements) > 0){
            
           
            $versement = $this->versementRepository->create($input);
            $versement->caissier=Auth::user()->id;
            $versement->save();
            $contrat=Contrat::find($versement->contrat);
            $contrat->solde=$versement->reste_payer;
            $contrat->save();
            /*$versement->contrats->update([
                'solde' => $versement->reste_payer
            ]);*/
          //  var_dump($versement->contrats);//exit;
            foreach($request->amortissements as $amortissement){
                $tableauArmortissement = $this->tableauArmortissementRepository->find($amortissement['id']);
                if (!empty($tableauArmortissement)) {
                    $tableauArmortissement->update([
                        'versement' => $versement->id,
                        'etat' => "PAYE",
                        'datreglement' => $versement->date
                    ]);
                }
            }
           
            $this->printPDF($versement->id);
        }

        if($request->ajax && $request->control){
            // simple requet ajax pour le control des paramètres
            return true;
        } else if($request->ajax){
            return $versement;
        }
        
       // Flash::success('Versement enregistré(e) avec succès.');

       //return redirect(route('versements.index'));
       return redirect(route('listeVersement',['IdContrat'=>$versement->contrat,'IdVersement'=>$versement->id] ));
    }

    public function cheminVersement(Request $request)
    {
        $versement=Versement::find($request->versement);
        $contrat=$versement->contrats['numero'].'/';
  
        return response()->json(['chemin' => $contrat.$versement->numero_recu.'.pdf']);
    }
    /**
     * Display the specified Versement.
     */
    public function show($id)
    {
        $versement = $this->versementRepository->find($id);

        if (empty($versement)) {
            Flash::error('Versement not found');

            return redirect(route('versements.index'));
        }

        return view('versements.show')->with('versement', $versement);
    }

    /**
     * Show the form for editing the specified Versement.
     */
    public function edit($id)
    {
        $versement = $this->versementRepository->find($id);

        if (empty($versement)) {
            Flash::error('Versement not found');

            return redirect(route('versements.index'));
        }

        return view('versements.edit')->with('versement', $versement);
    }

    /**
     * Update the specified Versement in storage.
     */
    public function update($id, UpdateVersementRequest $request)
    {
        $versement = $this->versementRepository->find($id);

        if (empty($versement)) {
            Flash::error('Versement not found');

            return redirect(route('versements.index'));
        }

        $versement = $this->versementRepository->update($request->all(), $id);

        Flash::success('Versement mis à jour avec succès.');

        return redirect(route('versements.index'));
    }

    /**
     * Remove the specified Versement from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $versement = $this->versementRepository->find($id);

        if (empty($versement)) {
            Flash::error('Versement not found');

            return redirect(route('versements.index'));
        }

        $this->versementRepository->delete($id);

        Flash::success('Versement supprimé(e) avec succès. ');

        return redirect(route('versements.index'));
    }


    public function facture($idversement){

		//dd(phpinfo());
        $versement=$this->versementRepository->find($idversement);
		$contrat=Contrat::find($versement->contrat);

		$numberFormatter = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
       
        $data=[
            'title' => 'Reçu BKZ','versement'=>$versement,'contrat'=>$contrat, 'montant_total_lettre'=> $numberFormatter->format($versement->montant), 
        ];
               
		return view('versements.recu')->with($data);
		
    }

    public function printPDF($idversement){
        
       $versement=$this->versementRepository->find($idversement);
       $contrat=Contrat::find($versement->contrat);

       
        $data=[
            'title' => 'Reçu BKZ','versement'=>$versement,'contrat'=>$contrat
        ];
               
        $pdfRecu = PDF::loadView('versements.recu', $data)->setPaper('a4', 'landscape')->setWarnings(false);  
        
        $root="storage/recus/".$contrat->numero."/";
        $filename=$versement->numero_recu.'.pdf';
        Storage::put('public/recus/'.$contrat->numero.'/'.$filename, $pdfRecu->output());

    }
    

}
