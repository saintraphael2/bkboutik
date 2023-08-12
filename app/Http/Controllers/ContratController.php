<?php

namespace App\Http\Controllers;

use App\DataTables\ContratDataTable;
use App\Http\Requests\CreateContratRequest;
use App\Http\Requests\UpdateContratRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ContratRepository;
use App\Repositories\ConducteurRepository;
use App\Repositories\TypepieceRepository;
use App\Repositories\TypeContratRepository;
use App\Repositories\MotoRepository;
use App\Repositories\Tableau_armortissementRepository;
use App\Models\TypeContrat;
use App\Models\Moto;
use App\Models\Conducteur;
use App\Models\Tableau_armortissement;
use Illuminate\Http\Request;
use Flash;
use DB;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Exception;
use Auth;

class ContratController extends AppBaseController
{
    /** @var ContratRepository $contratRepository*/
    private $contratRepository;
    private $typepieceRepository;
    private $conducteurRepository;
    private $typeContratRepository;
    private $motoRepository;
    private $tableauArmortissementRepository;


    public function __construct(ContratRepository $contratRepo, 
    ConducteurRepository $conducteurRepo, 
    TypepieceRepository $typepieceRepo,
    TypeContratRepository $typeContratRepo,
    MotoRepository $motoRepo,
    Tableau_armortissementRepository $tableauArmortissementRepo)
    {
        $this->contratRepository = $contratRepo;
        $this->conducteurRepository = $conducteurRepo;
        $this->typepieceRepository = $typepieceRepo;
        $this->typeContratRepository = $typeContratRepo;
        $this->motoRepository = $motoRepo;
        $this->tableauArmortissementRepository = $tableauArmortissementRepo;

    }

    /**
     * Display a listing of the Contrat.
     */
    public function index(ContratDataTable $contratDataTable)
    {
        //dd($contratDataTable);
        //$this->createTableauArmortissement(7);
        return $contratDataTable->render('contrats.index');
    }


    /**
     * Show the form for creating a new Contrat.
     */
    public function create(Request $request)
    {
        $conducteur = ($request->conducteur) ? $this->conducteurRepository->find($request->conducteur) : null;
        $conducteurs = $this->conducteurRepository->all();
        $typepieces = $this->typepieceRepository->all();
        $typecontrats = $this->typeContratRepository->all();
        $motos = Moto::where([
            'disponible' => 1
        ])->orderby('immatriculation')->get();
        //$motos = $this->motoRepository->all(['disponible'=>1]);
        //$motos = $this->motoRepository->all();
        //dd($conducteur);
        return view('contrats.create')->with([
            'conducteur' => $conducteur,
            'conducteurs' => $conducteurs,
            'typepieces' => $typepieces,
            'typecontrats' => $typecontrats,
            'motos' => $motos
        ]);
    }

    /**
     * Store a newly created Contrat in storage.
     */
    public function store(CreateContratRequest $request)
    {
        $request->request->add(['solde' => $request->input('montant_total')]);
        $request->request->add(['agent' => Auth::user()->id]);
        $input = $request->all();
        
        $moto = $this->motoRepository->find($request->moto);
        if(!$moto->disponible){
            // Retour négatif si la moto n'est pas disponible
            throw new Exception("Moto non disponible");
            //throw new ValidationException()
        }
        
        if(!$request->control){
            $contrat = $this->contratRepository->create($input);
            
            $moto->update(['disponible' => 0]);
            
            $this->createTableauArmortissement($contrat->id);
        }

        if($request->ajax && $request->control){
            // simple requet ajax pour le control des paramètres
            return true;
        } else if($request->ajax){
            return $contrat;
        }

        Flash::success('Contrat enregistré(e) avec succès.');

        return redirect(route('contrats.index'));
    }

    
    /**
     * Display the specified Contrat.
     */
    public function show($id)
    {
        $contrat = $this->contratRepository->find($id);

        if (empty($contrat)) {
            Flash::error('Contrat not found');

            return redirect(route('contrats.index'));
        }

        return view('contrats.show')->with('contrat', $contrat);
    }

    /**
     * Show the form for editing the specified Contrat.
     */
    public function edit($id)
    {
        $contrat = $this->contratRepository->find($id);
        $typecontrats=TypeContrat::orderby('libelle')->pluck('libelle','id');
        $motos=Moto::orderby('immatriculation')->pluck('immatriculation','id');
        $conducteurs=Conducteur::select(
            DB::raw("CONCAT(nom,' ',prenom) AS nom"),'id')->orderby('nom')->pluck('nom','id');
        if (empty($contrat)) {
            Flash::error('Contrat not found');

            return redirect(route('contrats.index'));
        }

        return view('contrats.edit')->with([
            'contrat'=> $contrat,
            'typecontrats'=>$typecontrats,
            'typecontrat'=>$contrat->typecontrat,
            'motos'=>$motos,
            'moto'=>$contrat->moto,
            'conducteurs'=>$conducteurs,
            'conducteur'=>$contrat->conducteur,
            'date_debut_fr'=>date("d-m-Y", strtotime($contrat->date_debut)),
            'date_fin_fr'=>date("d-m-Y", strtotime($contrat->date_fin)),
            'date_signature_fr'=>date("d-m-Y", strtotime($contrat->date_signature)),
            'datprm_fr'=>date("d-m-Y", strtotime($contrat->datprm))

        ]);
    }

    /**
     * Update the specified Contrat in storage.
     */
    public function update($id, UpdateContratRequest $request)
    {
        $request->request->add(['solde' => $request->input('montant_total')]);
        $contrat = $this->contratRepository->find($id);

        if (empty($contrat)) {
            Flash::error('Contrat not found');

            return redirect(route('contrats.index'));
        }
        $moto = $this->motoRepository->find($request->moto);
        if($moto && $moto->id != $contrat->moto && !$moto->disponible){
            // Retour négatif si la moto n'est pas disponible
            Flash::error("Moto non disponible");
            return redirect(route('contrats.index'));
        }
        
        $contrat = $this->contratRepository->update($request->all(), $id);
        Tableau_armortissement::where('contrat',$id)->delete();
        $this->createTableauArmortissement($contrat->id);
        Flash::success('Contrat mis à jour avec succès.');

        return redirect(route('contrats.index'));
    }

    /**
     * Remove the specified Contrat from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $contrat = $this->contratRepository->find($id);

        if (empty($contrat)) {
            Flash::error('Contrat not found');

            return redirect(route('contrats.index'));
        }

        $this->contratRepository->delete($id);

        Flash::success('Contrat supprimé avec succès. ');

        return redirect(route('contrats.index'));
    }

    public function state($id)
    {
        $contrat = $this->contratRepository->find($id);
        if (empty($contrat)) {
            Flash::error('Contrat not found');

            return redirect(route('contrats.index'));
        }
        $moto = $this->motoRepository->find($contrat->moto);

        /*if(!$contrat->actif) {
            Flash::error("Contrat déjà désactivé");

            return redirect(route('contrats.index'));
        }*/

        if($contrat->actif) {
            $etat = 0;
            $message = 'Contrat désactivé avec succès.';
            $moto->update(['disponible' => 1]);
        } else {
            if(!$moto->disponible) {
                Flash::error("La moto (".$moto->immatriculation.") n'est plus disponible.");
    
                return redirect(route('contrats.index'));
            }
            $etat = 1;
            $message = 'Contrat activé avec succès. ';
            $moto->update(['disponible' => 0]);
        }
        

        $contrat = $this->contratRepository->update(['actif' => $etat], $id);

        Flash::success($message);

        return redirect(route('contrats.index'));
    }


    public function createTableauArmortissement($id)
    {
        $contrat = $this->contratRepository->find($id);

        $occurence = 0;
        $montant = 0;
        $cummul = 0;
        //$jrs =  ($contrat->deposit) ? (20000 - $contrat->deposit)/500 : 0;
        $jrs =   (20000 - $contrat->deposit)/500 ;
        $datePrelevement = ($contrat->datprm) ? $contrat->datprm : $contrat->date_debut;
        $solde = $contrat->montant_total+(20000 - $contrat->deposit);

        $parameters = [];

        while($solde > 0){
 
            //dump($datePrelevement, $datePrelevement->addDays(1));
            if($occurence == 0){
                $datePrelevement = $this->calculDatePrelevement($datePrelevement);
            } else {
                $datePrelevement = $this->calculDatePrelevement($datePrelevement->addDay());
            }
            
            //$montant = $this->calculMontant($solde, $occurence, $contrat->bdeposit, $jrs);
            $montant = $this->calculMontant($solde, $occurence, $jrs);
            $cummul += $montant;
            $solde -= $montant;
            $parameters[$occurence] = [
                'ajax' => 1,
                'datprev' => $datePrelevement, //->toDateString(),
                'montant' => $montant,
                'cummul' => $cummul,
                'solde' => $solde,
                'contrat' => $contrat->id,
                'etat' => 'NON PAYE',
                //'datreglement' => '',
                //'versement' => ''
            ];
            $this->tableauArmortissementRepository->create($parameters[$occurence]);
            $occurence++;
        }
        //dd("show parameters", $occurence, $parameters);
    }


    //public function calculMontant($solde, $occurence, $bdeposit, $jrs){
    public function calculMontant($solde, $occurence, $jrs){
        //$montant = (!$bdeposit && $occurence < $jrs) ? 2700 : 2200;
        $montant = ($occurence < $jrs) ? 2700 : 2200;
        return ($solde <= $montant) ? $solde : $montant;
    }


    public function calculDatePrelevement($datePrelevement){
        
        if($datePrelevement->isWeekday() || $datePrelevement->isSaturday()){
            return $datePrelevement;
        }
        return $this->calculDatePrelevement($datePrelevement->addDay());
    }

}
