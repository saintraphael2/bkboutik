<?php

namespace App\Http\Controllers;

use App\DataTables\FacturationProduitDataTable;
use App\Http\Requests\CreateFacturationProduitRequest;
use App\Http\Requests\UpdateFacturationProduitRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\FacturationProduitRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Repositories\SouscriptionRepository;
use App\Models\Contrat;
use App\Models\Conducteur;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use \NumberFormatter;
use App\Repositories\ParametreRepository;
class FacturationProduitController extends AppBaseController
{
    /** @var FacturationProduitRepository $facturationProduitRepository*/
    private $facturationProduitRepository;
    private $souscriptionRepository;
    private $parametreRepository;

    
    public function __construct(FacturationProduitRepository $facturationProduitRepo, ParametreRepository $parametreRepo,SouscriptionRepository $souscriptionRepo)
    {
        $this->facturationProduitRepository = $facturationProduitRepo;
        $this->souscriptionRepository = $souscriptionRepo;
        $this->parametreRepository = $parametreRepo;
    }

    /**
     * Display a listing of the FacturationProduit.
     */
    public function index(FacturationProduitDataTable $facturationProduitDataTable)
    {
    return $facturationProduitDataTable->render('facturation_produits.index');
    }


    /**
     * Show the form for creating a new FacturationProduit.
     */
    public function create()
    {
        return view('facturation_produits.create');
    }
    public function autoSouscription(Request $request)
    {
        $immatriculation = $request->input('immatriculation');
    
        $sql=" SELECT s.id, immatriculation, co.nom,s.solde,p.modele,t.libelle FROM souscription s inner join contrat c on s.client=c.id 
inner join moto m on m.id=c.moto
inner join produit p on p.id=s.produit
inner join type_produit t on t.id=p.type_produit
inner join conducteur co on co.id=c.conducteur
where immatriculation   like '%".$immatriculation."%'";
             

        $users = DB::connection()->select($sql) ;

        return response()->json($users);
    }
    /**
     * Store a newly created FacturationProduit in storage.
     */

     public function cheminVersement(Request $request)
    {
        $versement=$this->facturationProduitRepository->find($request->versement);
        $contrat=$versement->souscriptions->clients['numero'].'/';
  
        return response()->json(['chemin' => $contrat.$versement->code.'.pdf']);
    }
    public function regenererfacture(Request $request)
    {
        $versement=$this->facturationProduitRepository->find($request->versement);
        $this->printPDF($versement->id);
        $contrat=$versement->souscriptions->clients['numero'].'/';
  
        return response()->json(['chemin' => $contrat.$versement->code.'.pdf']);
    }
    public function store(CreateFacturationProduitRequest $request)
    {
        $request->request->add(['caissier' => Auth::user()->id]);
        $input = $request->all();

       
    //    $prochain_date=
        //$input->souscription;

        $souscription=$this->souscriptionRepository->find($input['souscription']);
        $souscription->solde=$input['reste_paye'];
        $souscription->date_souscription=$input['date_souscription'];
        $souscription->save();
        $facturationProduit = $this->facturationProduitRepository->create($input);

        $this->printPDF($facturationProduit->id);

        Flash::success('Facturation Produit enregistré(e) avec succès.');
      
        return redirect(route('facturation',$facturationProduit->id));
    }
    public function printPDF($idfacture){
        
        $facture=$this->facturationProduitRepository->find($idfacture);
        //dd($facture);
        $contrat = Contrat::find($facture->souscriptions->client);
        $parametre=$this->parametreRepository->find(1);
        $client=Conducteur::find($contrat->conducteur);
        Carbon::setUTF8(true);
        Carbon::setLocale('french.UTF-8', 'fr_FR.UTF-8');
        setlocale(LC_TIME, 'french.UTF-8', 'fr_FR.UTF-8');
        $date_fr=$facture->created_at->format('d-m-Y');
        $lettrage=$this->nombre_en_lettre($facture->montant_paye);
         $data=[
             'title' => 'Facture','facture'=>$facture,'contrat'=>$contrat,'client'=>$client
            
             , 'parametre'=>$parametre, 'date_fr'=>htmlspecialchars($date_fr, ENT_COMPAT,'ISO-8859-1', true),'lettrage'=>$lettrage
         ];
          
         $pdfRecu = PDF::loadView('facturation_produits.facture', $data)->setPaper('a4', 'landscape')->setWarnings(false);  
         
         $root="storage/factures/".$contrat->id."/";
         $filename=$facture->code.'.pdf';
        // Storage::put('public/factures/'.$contrat->id.'/'.$filename, $pdfRecu->output());
         Storage::disk('uploads')->put('facturesProduit/'.$contrat->numero.'/'.$filename, $pdfRecu->output());

 
     }
     function conversion($n,$cpt){
        if(!is_numeric($n)){return false;}
        
        while(strlen($n)<3){$n='0'.$n;} // On rajoute les 0 pour obtenir une chaine de 3 chiffres
        if(preg_match('#^[0-9]{3}$#',$n)){$C=substr($n,0,1); $D=substr($n,1,1); $U=substr($n,2,1);}
        else{return false;}
        //Initialisation
        $valeur='';
        $chiffre=array('', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf', 'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix-sept', 'dix-huit', 'dix-neuf');
        $nombre=array('', 'dix', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'soixante-dix', 'quatre-vingt', 'quatre-vingt-dix');
        //Conversion
        if($D==0){$valeur=$chiffre[$U];} 							// 1 à 10 (ne retourne pas "zéro" pour 0)
        elseif($D==1){$valeur=$chiffre[$U+10];} 					// 11 à 19
        elseif($D>=2 && $D<=6){										// 20 à 69
            if($U==0){$valeur=$nombre[$D];}								// x0
            elseif($U==1){$valeur=$nombre[$D].' et un';}				// x1
            else{$valeur=$nombre[$D].'-'.$chiffre[$U];}					// x2 à x9
        }
        elseif($D==7){$valeur=$nombre[6].'-'.$chiffre[$U+10];}		// 70 à 79
        elseif($D==8){												// 80 à 89
            if($U==0){
                if($cpt!=1){$valeur=$nombre[$D].'s';}				// tous les 80 sauf ...
                else{$valeur=$nombre[$D];}							// 80 000 => quatre-vingt mille (cas particulier)
            }
            else{$valeur=$nombre[$D].'-'.$chiffre[$U];}				// 81 à 89
        }
        elseif($D==9){$valeur=$nombre[8].'-'.$chiffre[$U+10];}		// 90 à 99
        //centaines
        if($C==1){													//1xx
            if(strlen($valeur)==0){$valeur='cent';}						// 100
            else{$valeur='cent'.' '.$valeur;} 							// 101 à 199
        }	// 1xx				
        elseif($C!=0){												// 2xx à 9xx
            if(strlen($valeur)==0){										// [2-9]00
                if($cpt==1){$valeur=$chiffre[$C].' cent';}					// cas particulier (ex: 300 000 : trois cent mille)
                else{$valeur=$chiffre[$C].' cents';}						// [2-9]00 ... le reste (ex: 300 000 000 : trois cents millions)
            }
            else{$valeur=$chiffre[$C].' cent '.$valeur;}				// le reste
        }
        else{}														// 0xx
        //nettoyage
        unset($n,$C,$D,$U,$chiffre,$nombre,$esp);
        //renvoi
        return $valeur;
    }
    
    function nombre_en_lettre($montant)
    {
        if(!preg_match('#^[,.0-9]+$#',$montant)){return false;}
        else{
            // Initialisation
            $retour='';
            // Paramétrage
            $devise=array("S"=>'Francs CFA', "P"=>' Francs CFA');						// devise "entière"
            $ssdevise=array("S"=>'centime', "P"=>'centimes');				// devise "décimales"
            // Préparation
            if(preg_match('#,#',$montant)){$montant=preg_replace('#,#','.',$montant);}//on remplace la virgule potentielle par un point
    
            if(preg_match('#.#',$montant)){$temp=explode('.',$montant);}
            else{$temp=array(0=>$montant,1=>'00');}
    
            $valeur["e"]=$temp[0];											// valeur entière
            //$valeur["d"]=round("0.".$temp[1],2)*100;						// valeur décimale (arrondie à 2 chiffres)
            unset($temp);													// nettoyage
            // Conversion
            if($valeur["e"]==0 || $valeur["e"]==''){
                if($montant==0){ return "zéro ".$devise["S"];}				//pas de décimales => retour : "zéro ..."
                else{$retour='';} 											// il y a des décimales => pas de zéro
            }
            elseif($valeur["e"]==1){$retour="un ".$devise["S"];}
            else{
                //gestion des noms par milliers
                $milliers=array('','mille','million','milliard','billion','billiard','trillion','trilliard','quadrillion','quadrilliard','quintillion','quintilliard','sextillion','sextilliard','septillion','septilliard','octillion','octilliard','nonillion','nonilliard','decillion','decilliard');
                //récupérer des chaines par milliers
                while(strlen($valeur["e"])%3!=0){$valeur["e"]='0'.$valeur["e"];} //d'abord compléter la chaine si besoin (multiple de 3 chiffres)
                $chaine=$valeur["e"];
                $cpt=0;
                while(strlen($chaine)>0){
                    $souschaine=substr($chaine,strlen($chaine)-3,3);
                    if($souschaine!="000")								// pas de traitement si nul
                    {
                        $temp=$this->conversion($souschaine,$cpt);
                        switch($temp){
                            case '': $retour.=' - erreur sur le millier n°'.($cpt+1).' - ';	break;
                            case 'un':	if($cpt==1){$retour=$milliers[$cpt].' '.$retour;} 	// 1xxx : pas de "un mille ..." mais "mille ..."
                                        else{$retour='un '.$milliers[$cpt].' '.$retour;}	// un ... le reste (million, milliard, etc...)
                                break;
                            default:	if($cpt==0){$retour=$temp.' '.$milliers[$cpt].' '.$retour;}		// pas de "millier dans ce cas"
                                        elseif($cpt==1){$retour=$temp.' '.$milliers[$cpt].' '.$retour;}	// "mille" pas "milles"
                                        else{$retour=$temp.' '.$milliers[$cpt].'s '.$retour;} 			// X (millions, milliards, etc...)
                                break;
                        }
                    }
                    //préparation pour la suite
                    $chaine=substr($chaine,0,strlen($chaine)-3);			// on supprime les 3 derniers chiffres
                    $cpt++;													// on passe aux milliers supérieurs
                }
                unset($temp,$cpt,$chaine, $souschaine);						// nettoyage
                $retour=trim($retour).' '.$devise["P"];						// d'office pluriel, car 0 et 1 traités à part
            }
            /* chiffres décimaux 
           if($valeur["d"]==0 || $valeur["d"]==''){}						// rien à rajouter
            elseif($valeur["d"]==01){$retour.=' un '.$ssdevise["S"];}		// ajout du centième
            else{
                $temp=$this->conversion($valeur["d"],-1);
                if(strlen($temp)>0){$retour.=' '.$temp.' '.$ssdevise["P"];}	// ajout des autres possibilités
                unset($temp);
            }*/
            preg_replace('#  #',' ',$retour);								//au cas où
            unset($devise,$ssdevise,$valeur,$milliers);						//un petit nettoyage avant départ
            return trim($retour);											//on renvoi le tout
        }
    }
    /**
     * Display the specified FacturationProduit.
     */
    public function show($id)
    {
        $facturationProduit = $this->facturationProduitRepository->find($id);

        if (empty($facturationProduit)) {
            Flash::error('Facturation Produit not found');

            return redirect(route('facturationProduits.index'));
        }

        return view('facturation_produits.show')->with('facturationProduit', $facturationProduit);
    }

    /**
     * Show the form for editing the specified FacturationProduit.
     */
    public function edit($id)
    {
        $facturationProduit = $this->facturationProduitRepository->find($id);

        if (empty($facturationProduit)) {
            Flash::error('Facturation Produit not found');

            return redirect(route('facturationProduits.index'));
        }

        return view('facturation_produits.edit')->with('facturationProduit', $facturationProduit);
    }

    /**
     * Update the specified FacturationProduit in storage.
     */
    public function update($id, UpdateFacturationProduitRequest $request)
    {
        $facturationProduit = $this->facturationProduitRepository->find($id);

        if (empty($facturationProduit)) {
            Flash::error('Facturation Produit not found');

            return redirect(route('facturationProduits.index'));
        }

        $facturationProduit = $this->facturationProduitRepository->update($request->all(), $id);

        Flash::success('Facturation Produit mis à jour avec succès.');

        return redirect(route('facturationProduits.index'));
    }

    /**
     * Remove the specified FacturationProduit from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $facturationProduit = $this->facturationProduitRepository->find($id);

        if (empty($facturationProduit)) {
            Flash::error('Facturation Produit not found');

            return redirect(route('facturationProduits.index'));
        }

        $this->facturationProduitRepository->delete($id);

        Flash::success('Facturation Produit supprimé(e) avec succès. ');

        return redirect(route('facturationProduits.index'));
    }
}
