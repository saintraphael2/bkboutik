<?php

namespace App\Http\Controllers;

use App\DataTables\ProduitDataTable;
use App\Http\Requests\CreateProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProduitRepository;
use Illuminate\Http\Request;
use App\Models\TypeProduit;
use Flash;

class ProduitController extends AppBaseController
{
    /** @var ProduitRepository $produitRepository*/
    private $produitRepository;

    public function __construct(ProduitRepository $produitRepo)
    {
        $this->produitRepository = $produitRepo;
    }

    /**
     * Display a listing of the Produit.
     */
    public function index(ProduitDataTable $produitDataTable)
    {
    return $produitDataTable->render('produits.index');
    }


    /**
     * Show the form for creating a new Produit.
     */
    public function create()
    {
        $typeProduits=TypeProduit::pluck('libelle','id');
        return view('produits.create')->with(['typeProduits'=>$typeProduits]);
    }

    /**
     * Store a newly created Produit in storage.
     */
    public function store(CreateProduitRequest $request)
    {
        $input = $request->all();

        $produit = $this->produitRepository->create($input);

        Flash::success('Produit enregistré(e) avec succès.');

        return redirect(route('produits.index'));
    }

    /**
     * Display the specified Produit.
     */
    public function show($id)
    {
        $produit = $this->produitRepository->find($id);

        if (empty($produit)) {
            Flash::error('Produit not found');

            return redirect(route('produits.index'));
        }

        return view('produits.show')->with('produit', $produit);
    }

    /**
     * Show the form for editing the specified Produit.
     */
    public function edit($id)
    {
        $produit = $this->produitRepository->find($id);
        $typeProduits=TypeProduit::pluck('libelle','id');
        if (empty($produit)) {
            Flash::error('Produit not found');

            return redirect(route('produits.index'));
        }

        return view('produits.edit')->with(['typeProduits'=>$typeProduits,'produit'=> $produit]);
    }

    /**
     * Update the specified Produit in storage.
     */
    public function update($id, UpdateProduitRequest $request)
    {
        $produit = $this->produitRepository->find($id);

        if (empty($produit)) {
            Flash::error('Produit not found');

            return redirect(route('produits.index'));
        }

        $produit = $this->produitRepository->update($request->all(), $id);

        Flash::success('Produit mis à jour avec succès.');

        return redirect(route('produits.index'));
    }

    /**
     * Remove the specified Produit from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $produit = $this->produitRepository->find($id);

        if (empty($produit)) {
            Flash::error('Produit not found');

            return redirect(route('produits.index'));
        }

        $this->produitRepository->delete($id);

        Flash::success('Produit supprimé(e) avec succès. ');

        return redirect(route('produits.index'));
    }
}
