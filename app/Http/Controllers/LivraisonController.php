<?php

namespace App\Http\Controllers;

use App\DataTables\LivraisonDataTable;
use App\Http\Requests\CreateLivraisonRequest;
use App\Http\Requests\UpdateLivraisonRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\LivraisonRepository;
use Illuminate\Http\Request;
use Flash;
use Auth;
use App\Models\DetailBoutique;
use App\Models\DetailLivraison;
use App\Repositories\DetailBoutiqueRepository;
use App\Repositories\StockRepository;
class LivraisonController extends AppBaseController
{
    /** @var LivraisonRepository $livraisonRepository*/
    private $livraisonRepository;
    private $detailBoutiqueRepository;
    private $stockRepository;

    public function __construct(StockRepository $stockRepo,DetailBoutiqueRepository $detailBoutiqueRepo,LivraisonRepository $livraisonRepo)
    {
        $this->livraisonRepository = $livraisonRepo;
        $this->detailBoutiqueRepository = $detailBoutiqueRepo;
        $this->stockRepository = $stockRepo;
    }

    /**
     * Display a listing of the Livraison.
     */
    public function index(LivraisonDataTable $livraisonDataTable)
    {
    return $livraisonDataTable->render('livraisons.index');
    }


    /**
     * Show the form for creating a new Livraison.
     */
    public function create()
    {
        return view('livraisons.create');
    }

    /**
     * Store a newly created Livraison in storage.
     */
    public function store(CreateLivraisonRequest $request)
    {
        $request->request->add(['magasinier' => Auth::user()->id]);
        $input = $request->all();
        //dd($request->input('livraison'));
        
        $livraison = $this->livraisonRepository->create($input);
        $detailBoutiques=DetailBoutique::where('boutique',$livraison->boutique)->get();
        foreach($detailBoutiques as $detailBoutique){ 
                //$detailBoutique=$this->detailBoutiqueRepository->find($request->input('livraison')[$i]);
                
                $detailLivraison=new DetailLivraison();
                $detailLivraison->livraison=$livraison->id;
                $detailLivraison->produit_boutique=$detailBoutique->produit_boutique;
                $detailLivraison->detail_boutique=$detailBoutique->id;
                $detailLivraison->quantite=$detailBoutique->quantite;
                $detailLivraison->save();

                $stock=$this->stockRepository->find($detailBoutique->stock);
                $stock->qte_livree+=$detailBoutique->quantite;
                $stock->save();

            
        }

       
       

        Flash::success('Livraison enregistré(e) avec succès.');

        return redirect(route('livraisons.index'));
    }

    /**
     * Display the specified Livraison.
     */
    public function show($id)
    {
        $livraison = $this->livraisonRepository->find($id);

        if (empty($livraison)) {
            Flash::error('Livraison not found');

            return redirect(route('livraisons.index'));
        }
        $detailBoutiques=DetailBoutique::where('boutique',$livraison->boutique)->get();
        $detailLivraisons=DetailLivraison::where('livraison',$livraison->id)->get();
        return view('livraisons.show')->with(['livraison'=> $livraison,'detailBoutiques'=>$detailBoutiques,'detailLivraisons'=>$detailLivraisons]);
    }

    /**
     * Show the form for editing the specified Livraison.
     */
    public function edit($id)
    {
        $livraison = $this->livraisonRepository->find($id);

        if (empty($livraison)) {
            Flash::error('Livraison not found');

            return redirect(route('livraisons.index'));
        }

        return view('livraisons.edit')->with('livraison', $livraison);
    }

    /**
     * Update the specified Livraison in storage.
     */
    public function update($id, UpdateLivraisonRequest $request)
    {
        $livraison = $this->livraisonRepository->find($id);

        if (empty($livraison)) {
            Flash::error('Livraison not found');

            return redirect(route('livraisons.index'));
        }

        $livraison = $this->livraisonRepository->update($request->all(), $id);

        Flash::success('Livraison mis à jour avec succès.');

        return redirect(route('livraisons.index'));
    }

    /**
     * Remove the specified Livraison from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $livraison = $this->livraisonRepository->find($id);

        if (empty($livraison)) {
            Flash::error('Livraison not found');

            return redirect(route('livraisons.index'));
        }

        $this->livraisonRepository->delete($id);

        Flash::success('Livraison supprimé(e) avec succès. ');

        return redirect(route('livraisons.index'));
    }
}
