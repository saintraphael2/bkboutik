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
use App\Repositories\OffreRepository;
use App\Repositories\Tableau_armortissementRepository;
use App\Models\Offre;
use App\Models\TypeContrat;
use App\Models\Moto;
use App\Models\Contrat;
use App\Models\Conducteur;
use App\Models\Tableau_armortissement;
use App\Models\Motif_arriere;
use Illuminate\Http\Request;
use Flash;
use DB;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Exception;
use Auth;
use Illuminate\Support\Carbon;

class ContratController extends AppBaseController
{
    /** @var ContratRepository $contratRepository*/
    private $contratRepository;
    private $typepieceRepository;
    private $conducteurRepository;
    private $typeContratRepository;
    private $motoRepository;
    private $offreRepository;
    private $tableauArmortissementRepository;


    public function __construct(ContratRepository $contratRepo, 
    ConducteurRepository $conducteurRepo, 
    TypepieceRepository $typepieceRepo,
    TypeContratRepository $typeContratRepo,
    MotoRepository $motoRepo,
    OffreRepository $offreRepo,
    Tableau_armortissementRepository $tableauArmortissementRepo)
    {
        $this->contratRepository = $contratRepo;
        $this->conducteurRepository = $conducteurRepo;
        $this->typepieceRepository = $typepieceRepo;
        $this->typeContratRepository = $typeContratRepo;
        $this->motoRepository = $motoRepo;
        $this->tableauArmortissementRepository = $tableauArmortissementRepo;
        $this->offreRepository = $offreRepo;

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
    public function majtam ($idContrat)
    {
       
        $contrat=Contrat::find($idContrat);
        $dateprevnonpaye=Tableau_armortissement::where('contrat',$idContrat)->where('etat','NON PAYE')->where('tableau_armortissement.datprev','<', Carbon::now())->select(DB::raw('MIN(tableau_armortissement.datprev)  as datprev'))->get();
        $montantarriere=Tableau_armortissement::where('contrat',$idContrat)->where('etat','NON PAYE')->where('tableau_armortissement.datprev','<', Carbon::now())->select(DB::raw('SUM(tableau_armortissement.montant) as arrieres'))->get();
        $retards=Tableau_armortissement::where('contrat',$idContrat)->where('etat','NON PAYE')->where('tableau_armortissement.datprev','<', Carbon::now())->select(DB::raw('COUNT(etat) as retard'))->get();
        
        return view('contrats.majtam')->with([
            'contrat' => $contrat,
            'dateprevnonpaye'=> $dateprevnonpaye,
            'montantarriere'=>$montantarriere,
            'retards'=>$retards
        ]);
    }
    public function motar ($idContrat)
    {
       
        $contrat=Contrat::find($idContrat);
        $dateprevnonpaye=Tableau_armortissement::where('contrat',$idContrat)->where('etat','NON PAYE')->where('tableau_armortissement.datprev','<', Carbon::now())->select(DB::raw('MIN(tableau_armortissement.datprev)  as datprev'))->get();
        $montantarriere=Tableau_armortissement::where('contrat',$idContrat)->where('etat','NON PAYE')->where('tableau_armortissement.datprev','<', Carbon::now())->select(DB::raw('SUM(tableau_armortissement.montant) as arrieres'))->get();
        $retards=Tableau_armortissement::where('contrat',$idContrat)->where('etat','NON PAYE')->where('tableau_armortissement.datprev','<', Carbon::now())->select(DB::raw('COUNT(etat) as retard'))->get();
        $motifs=Motif_arriere::pluck('libelle','id');
        return view('contrats.motar')->with([
            'contrat' => $contrat,
            'dateprevnonpaye'=> $dateprevnonpaye,
            'montantarriere'=>$montantarriere,
            'retards'=>$retards,
            'motifs'=>$motifs
        ]);
    }
    public function edittam($id, Request $request){
        $tabnewdate=explode('-',$request->newdate);
        $realdate=$tabnewdate[2].'-'.$tabnewdate[1].'-'.$tabnewdate[0];
        $compteur=0;
        $dt = Carbon::create($tabnewdate[2], $tabnewdate[1], $tabnewdate[0], 0);
       
       
        $tableaux=Tableau_armortissement::where('contrat',$id)->where('etat','NON PAYE')->select(['id','datprev'])->orderby('datprev','asc')->get();
       
       
       foreach($tableaux as $tableau){
            $tabAmm=Tableau_armortissement::find($tableau->id);
            //echo $tabAmm->datprev."-------".$tabAmm->datprev->addYears(10)->addDays(2).'<br>';
            if($tabAmm->datprev->month==02 && $tabAmm->datprev->day==29){
                $newday=$tabAmm->datprev->addYears(20);
            }else{
                $newday=$tabAmm->datprev->addYears(10);
            }
            $tabAmm->update(['datprev'=>$newday]);
            //$tabAmm->datprev=$tabAmm->datprev->addYears(10);
           // $tabAmm->save();
        
       }
       $date_fin=null;
        foreach($tableaux as $tableau){
            if($compteur == 0){
                $dt = $this->calculDatePrelevement($dt);
            } else {
                $dt = $this->calculDatePrelevement($dt->addDay());
            }
          
           
           $tabAmm=Tableau_armortissement::find($tableau->id);
           $tabAmm->datprev=$dt;
           $tabAmm->save();
           $date_fin=$dt;
            $compteur++;
        }
        $contrat=Contrat::find($id);
        $contrat->date_fin=$date_fin;
        $contrat->save();
       // return redirect(route('majtam',$id));
        return redirect(route('etats.arrieres'));
    } 
    public function editmotif($id, Request $request){
      // dd($request->motif_arriere);
        $contrat=Contrat::find($id);
        $contrat->motif_arriere=$request->motif_arriere;
        $contrat->save();
        //$contrat->update(['motif_arriere'=>$request->motif_arriere]);
        return redirect(route('etats.arrieres'));
    } 
    /**
     * Show the form for creating a new Contrat.yyyy
     */
    public function create(Request $request)
    {
        $conducteur = ($request->conducteur) ? $this->conducteurRepository->find($request->conducteur) : null;
        $conducteurs = $this->conducteurRepository->all();
        $typepieces = $this->typepieceRepository->all();
        $typecontrats = $this->typeContratRepository->all();
        $offres = $this->offreRepository->all();

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
            'offres' => $offres,
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
        //$input = $request->all();
        
        $moto = $this->motoRepository->find($request->moto);
        if(!$moto->disponible){
            // Retour négatif si la moto n'est pas disponible
            throw new Exception("Moto non disponible");
            //throw new ValidationException()
        }
        
        if(!$request->control){
            //$input = $request->all();
            $input = $request->except(['ajax','control']);
            //$input->remove(['ajax','control']); //unset
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
        $offres = $this->offreRepository->all();
        $conducteurs=Conducteur::select(
            DB::raw("CONCAT(nom,' ',prenom) AS nom"),'id')->orderby('nom')->pluck('nom','id');
        if (empty($contrat)) {
            Flash::error('Contrat not found');

            return redirect(route('contrats.index'));
        }

        $frequences = [
            (object) ['id' => 1, 'nom' => "Journalier"],
            (object) ['id' => 2, 'nom' => "Hebdomadaire"],
            (object) ['id' => 3, 'nom' => "Semestrielle"]
            
        ];
        return view('contrats.edit')->with([
            'contrat'=> $contrat,
            'typecontrats'=>$typecontrats,
            'typecontrat'=>$contrat->typecontrat,
            'motos'=>$motos,
            'moto'=>$contrat->moto,
            //'offre'=>$contrat->offre,
            'offres' => $offres,
            'frequences' => $frequences,
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
		
		$tableauArmortissement=Tableau_armortissement::where('contrat',$id)->delete();
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
       $conducteur=$this->conducteurRepository->find($contrat->conducteur);
        /*if(!$contrat->actif) {
            Flash::error("Contrat déjà désactivé");

            return redirect(route('contrats.index'));
        }*/

        if($contrat->actif) {
            $etat = 0;
            $message = 'Contrat désactivé avec succès.';
            $moto->update(['disponible' => 1,'hors_stock' => 1]);
            $conducteur->update(['actif' => 1]);
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
        $offre = $contrat->offres;

        $parameters = [];

        while($solde > 0){
 
            //dump($datePrelevement, $datePrelevement->addDays(1));
            if($occurence == 0){
                $datePrelevement = $this->calculDatePrelevement($datePrelevement);
            } else {
                $datePrelevement = $this->calculDatePrelevement($datePrelevement->addDay());
            }
            
            //$montant = $this->calculMontant($solde, $occurence, $contrat->bdeposit, $jrs);
            $montant = $this->calculMontant($solde, $occurence, $jrs, $offre);
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
        $contrat->date_fin=$datePrelevement;
        $contrat->save();
        //dd("show parameters", $occurence, $parameters);
    }


    //public function calculMontant($solde, $occurence, $bdeposit, $jrs){
    public function calculMontant($solde, $occurence, $jrs, $offre){
        //$montant = (!$bdeposit && $occurence < $jrs) ? 2700 : 2200;
        //$montant = ($occurence < $jrs) ? 2700 : 2200;

        //$montant = 2200;
        $montant = $offre->tarif_journalier;

        if($occurence < $jrs) {
            $montant += 500;
        }
    
        return ($solde <= $montant) ? $solde : $montant;
    }


    public function calculDatePrelevement($datePrelevement){
        
        if($datePrelevement->isWeekday() || $datePrelevement->isSaturday()){
            return $datePrelevement;
        }
        return $this->calculDatePrelevement($datePrelevement->addDay());
    }

}
