<?php

namespace App\Http\Controllers;

use App\DataTables\ProduitBoutiqueDataTable;
use App\DataTables\ProduitsDataTable;
use App\Http\Requests\CreateProduitBoutiqueRequest;
use App\Http\Requests\UpdateProduitBoutiqueRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProduitBoutiqueRepository;
use Illuminate\Http\Request;
use Flash;
use App\Models\Stock;
use App\Models\DetailBoutique;
use DB;
use Carbon\Carbon;

class ProduitBoutiqueController extends AppBaseController
{
    /** @var ProduitBoutiqueRepository $produitBoutiqueRepository*/
    private $produitBoutiqueRepository;

    public function __construct(ProduitBoutiqueRepository $produitBoutiqueRepo)
    {
        $this->produitBoutiqueRepository = $produitBoutiqueRepo;
    }

    /**
     * Display a listing of the ProduitBoutique.
     */
    public function index(ProduitBoutiqueDataTable $produitBoutiqueDataTable)
    {
        return $produitBoutiqueDataTable->render('produit_boutiques.index');
    }
    public function liste(ProduitsDataTable $produitsDataTable)
    {
        return $produitsDataTable->render('produit_boutiques.liste');
    }


    /**
     * Show the form for creating a new ProduitBoutique.
     */
    public function create()
    {
        return view('produit_boutiques.create');
    }

    /**
     * Store a newly created ProduitBoutique in storage.
     */
    public function store(CreateProduitBoutiqueRequest $request)
    {
        $input = $request->all();

        $produitBoutique = $this->produitBoutiqueRepository->create($input);

        Flash::success('Produit Boutique enregistré(e) avec succès.');

        return redirect(route('produitBoutiques.index'));
    }

    /**
     * Display the specified ProduitBoutique. 
     */

    public function produitBoutiqueSituation(Request $request)
    {
        $id = $request->id;
        $from = Carbon::parse($request->from)->format('Y-m-d');
        $to = Carbon::parse($request->to)->format('Y-m-d');
        $produitBoutique = $this->produitBoutiqueRepository->find($id);

        // $entres=Stock::select("DATE(created_at) as date,qte_init as entre, 0 as sortie")->where('produit_boutique',$id);

        $entres = Stock::selectRaw("
        DATE(created_at) as date,
        SUM(qte_init) as entre,
        0 as sortie
    ")
            ->where('produit_boutique', $id)->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
            ->groupBy(DB::raw('DATE(created_at)'));

        $sortie = DetailBoutique::selectRaw("
        DATE(created_at) as date,
        0 as entre,
        SUM(quantite) as sortie
    ")
            ->where('produit_boutique', $id)->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
            ->groupBy(DB::raw('DATE(created_at)'));

            $vendu = DetailBoutique::where('produit_boutique', $id)
    ->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
    ->sum('quantite');


        $movements = $entres
            ->unionAll($sortie);

        $results = DB::query()
            ->fromSub($movements, 'm')
            ->orderBy('date')
            ->get();


        if (empty($produitBoutique)) {
            Flash::error('Produit Boutique not found');

            return redirect(route('produitBoutiques.index'));
        }

        return view('produit_boutiques.show')->with(['results' => $results, 'produitBoutique' => $produitBoutique,'vendu'=> $vendu,'from'=>$from, 'to'=>$to]);
    }

    public function show($id)
    {
        $produitBoutique = $this->produitBoutiqueRepository->find($id);
        $from = Carbon::now()->startOfMonth()->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        // $entres=Stock::select("DATE(created_at) as date,qte_init as entre, 0 as sortie")->where('produit_boutique',$id);

        $entres = Stock::selectRaw("
        DATE(created_at) as date,
        SUM(qte_init) as entre,
        0 as sortie
    ")
            ->where('produit_boutique', $id)->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
            ->groupBy(DB::raw('DATE(created_at)'));

        $sortie = DetailBoutique::selectRaw("
        DATE(created_at) as date,
        0 as entre,
        SUM(quantite) as sortie
    ")
            ->where('produit_boutique', $id)->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
            ->groupBy(DB::raw('DATE(created_at)'));

             $vendu = DetailBoutique::where('produit_boutique', $id)
    ->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
    ->sum('quantite');

        $movements = $entres
            ->unionAll($sortie);

        $results = DB::query()
            ->fromSub($movements, 'm')
            ->orderBy('date')
            ->get();


        if (empty($produitBoutique)) {
            Flash::error('Produit Boutique not found');

            return redirect(route('produitBoutiques.index'));
        }

        return view('produit_boutiques.show')->with(['results' => $results, 'produitBoutique' => $produitBoutique,'vendu'=> $vendu,'from'=>$from, 'to'=>$to]);
    }

    /**
     * Show the form for editing the specified ProduitBoutique.
     */
    public function edit($id)
    {
        $produitBoutique = $this->produitBoutiqueRepository->find($id);

        if (empty($produitBoutique)) {
            Flash::error('Produit Boutique not found');

            return redirect(route('produitBoutiques.index'));
        }

        return view('produit_boutiques.edit')->with('produitBoutique', $produitBoutique);
    }

    /**
     * Update the specified ProduitBoutique in storage.
     */
    public function update($id, UpdateProduitBoutiqueRequest $request)
    {
        $produitBoutique = $this->produitBoutiqueRepository->find($id);

        if (empty($produitBoutique)) {
            Flash::error('Produit Boutique not found');

            return redirect(route('produitBoutiques.index'));
        }

        $produitBoutique = $this->produitBoutiqueRepository->update($request->all(), $id);

        Flash::success('Produit Boutique mis à jour avec succès.');

        return redirect(route('produitBoutiques.index'));
    }

    /**
     * Remove the specified ProduitBoutique from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $produitBoutique = $this->produitBoutiqueRepository->find($id);

        if (empty($produitBoutique)) {
            Flash::error('Produit Boutique not found');

            return redirect(route('produitBoutiques.index'));
        }

        $this->produitBoutiqueRepository->delete($id);

        Flash::success('Produit Boutique supprimé(e) avec succès. ');

        return redirect(route('produitBoutiques.index'));
    }
}
