<?php

namespace App\Http\Controllers;

use App\DataTables\StockDataTable;
use App\Http\Requests\CreateStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\StockRepository;
use App\Repositories\ProduitBoutiqueRepository;
use Illuminate\Http\Request;
use Flash;
use Auth;
use App\Models\ProduitBoutique;
use Illuminate\Support\Facades\DB;

class StockController extends AppBaseController
{
    /** @var StockRepository $stockRepository*/
    private $stockRepository;
    private $produitBoutiqueRepository;

    public function __construct(StockRepository $stockRepo,ProduitBoutiqueRepository $produitBoutiqueRepo)
    {
        $this->stockRepository = $stockRepo;
        $this->produitBoutiqueRepository = $produitBoutiqueRepo;
    }

    /**
     * Display a listing of the Stock.
     */
    public function index(StockDataTable $stockDataTable)
    {
    return $stockDataTable->render('stocks.index');
    }


    /**
     * Show the form for creating a new Stock.
     */
    public function create()
    {
       
        return view('stocks.create')->with(['readonly'=>'']);
    }
    public function autoProduitBoutique(Request $request)
    {
        $produit = $request->input('produit');
    
        $sql=" SELECT id,code,libelle FROM produit_boutique 
where code like '%".$produit."%'  or libelle like '%".$produit."%'";
             

        $produits = DB::connection()->select($sql) ;

        return response()->json($produits);
    }
    public function autoStock(Request $request)
    {
        $produit = $request->input('produit');
    
        $sql=" SELECT s.id,p.code,p.libelle,ifnull(s.prix,0) prix FROM produit_boutique p 
        inner join stock s on s.id=p.stock
        
where s.quantite>0 and (p.code like '%".$produit."%'  or p.libelle like '%".$produit."%') ";
             

        $produits = DB::connection()->select($sql) ;

        return response()->json($produits);
    }
    /**
     * Store a newly created Stock in storage.   
     */
    public function store(CreateStockRequest $request)
    {
        $request->request->add(['qte_init' => $request->input('quantite')]);
        $request->request->add(['magasinier' => Auth::user()->id]);
        $input = $request->all();

        $stock = $this->stockRepository->create($input);

        
        
        $produitBoutique = $this->produitBoutiqueRepository->find($stock->produit_boutique);
        $produitBoutique->stock=$stock->id;
        $produitBoutique->save();

        Flash::success('Stock enregistré(e) avec succès.');

        return redirect(route('stocks.index'));
    }

    /**
     * Display the specified Stock.
     */
    public function show($id)
    {
        $stock = $this->stockRepository->find($id);

        if (empty($stock)) {
            Flash::error('Stock not found');

            return redirect(route('stocks.index'));
        }

        return view('stocks.show')->with('stock', $stock);
    }

    /**
     * Show the form for editing the specified Stock.
     */
    public function edit($id)
    {
        $stock = $this->stockRepository->find($id);

        if (empty($stock)) {
            Flash::error('Stock not found');

            return redirect(route('stocks.index'));
        }

        return view('stocks.edit')->with(['readonly'=>'readonly','stock'=> $stock]);
    }

    /**
     * Update the specified Stock in storage.
     */
    public function update($id, UpdateStockRequest $request)
    {
        $stock = $this->stockRepository->find($id);
        $request->request->add(['magasinier' => Auth::user()->id]);
        if (empty($stock)) {
            Flash::error('Stock not found');

            return redirect(route('stocks.index'));
        }

        $stock = $this->stockRepository->update($request->all(), $id);

        Flash::success('Stock mis à jour avec succès.');

        return redirect(route('stocks.index'));
    }

    /**
     * Remove the specified Stock from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $stock = $this->stockRepository->find($id);

        if (empty($stock)) {
            Flash::error('Stock not found');

            return redirect(route('stocks.index'));
        }

        $this->stockRepository->delete($id);

        Flash::success('Stock supprimé(e) avec succès. ');

        return redirect(route('stocks.index'));
    }
}
