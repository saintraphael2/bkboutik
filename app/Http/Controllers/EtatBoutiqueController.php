<?php

namespace App\Http\Controllers;

use App\DataTables\EtatBoutiqueDataTable;
use App\Http\Requests\CreateBoutiqueRequest;
use App\Http\Requests\UpdateBoutiqueRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\BoutiqueRepository;
use Illuminate\Http\Request;
use Flash;
use Auth;
use App\Repositories\StockRepository;
use App\Models\DetailBoutique;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Repositories\ParametreRepository;
use App\Models\User;
use App\Models\Boutique;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class EtatBoutiqueController extends AppBaseController
{
    /** @var BoutiqueRepository $boutiqueRepository*/
    private $boutiqueRepository;
    private $stockRepository;
    private $parametreRepository;
    public function __construct(StockRepository $stockRepo,BoutiqueRepository $boutiqueRepo, ParametreRepository $parametreRepo)
    {
        $this->boutiqueRepository = $boutiqueRepo;
        $this->stockRepository = $stockRepo;
        $this->parametreRepository = $parametreRepo;
    }

    /**
     * Display a listing of the Boutique.
     */
    public function index(EtatBoutiqueDataTable $etatBoutiqueDataTable, Request $request)
    {
        $caissiers = User::get();

        $query = Boutique::orderby('id','desc');
        $etatBoutiqueDataTable->comptable=Auth::user()->comptable;
        if($request->caissier){
            $etatBoutiqueDataTable->caissier = $request->caissier;
            $query->where('caissier', $request->caissier);
        }

        if($request->fromDate && $request->toDate){

            $fromDate = Carbon::parse($request->fromDate);
            $toDate = Carbon::parse($request->toDate);

            $etatBoutiqueDataTable->fromDate = $fromDate;
            $etatBoutiqueDataTable->toDate = $toDate;

            $query->whereBetween('created_at', [$fromDate, $toDate]);
        }else{
			$query->where('created_at',Carbon::today());
		}

        $caisse = $query->sum('montant_verse');

        $etatBoutiqueDataTable->comptable=Auth::user()->comptable;
    return $etatBoutiqueDataTable->render('etatBoutiques.index',[
            'caisse' => number_format($caisse, 0," ", " "),
            'caissiers' => $caissiers,
        ]);
    }


    /**
     * Show the form for creating a new Boutique.
     */
    public function create()
    {
        return view('boutiques.create')->with(['readonly'=>'']);
    }
    public function cheminFactures(Request $request)
    {
        $boutique = $this->boutiqueRepository->find($request->versement);
        
  
        return response()->json(['chemin' => $boutique->code.'.pdf']);
    }
    /**
     * Store a newly created Boutique in storage.
     */
    public function store(CreateBoutiqueRequest $request)
    {
       // dd($request->input('produits'));
        $request->request->add(['caissier' => Auth::user()->id]);
        $input = $request->all();

        $boutique = $this->boutiqueRepository->create($input);

        if(count($request->input('produits'))>0){
            for($i=0;$i<count($request->input('produits')); $i++){
                $detailBoutique = new DetailBoutique();
                
                $stock = $this->stockRepository->find($request->input('produits')[$i]);
                $stock->quantite=$stock->quantite-$request->input('quantite')[$i];
                $stock->qte_payee=$stock->qte_payee+$request->input('quantite')[$i];
                $stock->save();

                $detailBoutique->boutique =$boutique->id;
                $detailBoutique->stock =$request->input('produits')[$i];
                $detailBoutique->quantite =$request->input('quantite')[$i];
                $detailBoutique->prix =$request->input('prix')[$i];
                $detailBoutique->ttc =$request->input('quantite')[$i]*$request->input('prix')[$i];
                $detailBoutique->produit_boutique=$stock->produit_boutique;
                $detailBoutique->save();
            }
            
        }

        Flash::success('Boutique enregistré(e) avec succès.');

        $this::print($boutique->id);
        return redirect(route('boutique',$boutique->id));
        //return redirect(route('boutiques.index',$boutique->id));
    }
    public function print($id)
    {
        //dd($id);
       // $demande = $this->demandeRepository->find($id);
       $parametre=$this->parametreRepository->find(1);
      $produits=DetailBoutique::where('boutique',$id)->get();
      $boutique=$this->boutiqueRepository->find($id);
      
       $data = [
        'facture' => $boutique,
        'parametre' => $parametre,
        'produits' => $produits 
    ];

    //$pdf = Pdf::loadView('boutiques.caisse', $data);

   // return $pdf->stream('recu.pdf');
   $pdfRecu = PDF::loadView('boutiques.caisse', $data)->setPaper('a4', 'portrait')->setWarnings(false);  
        
  
   $filename=$boutique->code.'.pdf';
   //Storage::put('public/recus/'.$contrat->numero.'/'.$filename, $pdfRecu->output());
   Storage::disk('uploads')->put('caisse/'.$filename, $pdfRecu->output());
    }

    /**
     * Display the specified Boutique.
     */
    public function show($id)
    {
        $boutique = $this->boutiqueRepository->find($id);

        if (empty($boutique)) {
            Flash::error('Boutique not found');

            return redirect(route('boutiques.index'));
        }

        return view('boutiques.show')->with('boutique', $boutique);
    }

    /**
     * Show the form for editing the specified Boutique.
     */
    public function edit($id)
    {
        $boutique = $this->boutiqueRepository->find($id);

        if (empty($boutique)) {
            Flash::error('Boutique not found');

            return redirect(route('boutiques.index'));
        }

        return view('boutiques.edit')->with('boutique', $boutique);
    }

    /**
     * Update the specified Boutique in storage.
     */
    public function update($id, UpdateBoutiqueRequest $request)
    {
        $boutique = $this->boutiqueRepository->find($id);

        if (empty($boutique)) {
            Flash::error('Boutique not found');

            return redirect(route('boutiques.index'));
        }

        $boutique = $this->boutiqueRepository->update($request->all(), $id);

        Flash::success('Boutique mis à jour avec succès.');

        return redirect(route('boutiques.index'));
    }

    /**
     * Remove the specified Boutique from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $boutique = $this->boutiqueRepository->find($id);

        if (empty($boutique)) {
            Flash::error('Boutique not found');

            return redirect(route('boutiques.index'));
        }

        $this->boutiqueRepository->delete($id);

        Flash::success('Boutique supprimé(e) avec succès. ');

        return redirect(route('boutiques.index'));
    }
}
