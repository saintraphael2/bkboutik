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
    public function show($id)
    {
        $produitBoutique = $this->produitBoutiqueRepository->find($id);

        if (empty($produitBoutique)) {
            Flash::error('Produit Boutique not found');

            return redirect(route('produitBoutiques.index'));
        }

        return view('produit_boutiques.show')->with('produitBoutique', $produitBoutique);
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
