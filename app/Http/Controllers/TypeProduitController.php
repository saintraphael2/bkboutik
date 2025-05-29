<?php

namespace App\Http\Controllers;

use App\DataTables\TypeProduitDataTable;
use App\Http\Requests\CreateTypeProduitRequest;
use App\Http\Requests\UpdateTypeProduitRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\TypeProduitRepository;
use Illuminate\Http\Request;
use Flash;

class TypeProduitController extends AppBaseController
{
    /** @var TypeProduitRepository $typeProduitRepository*/
    private $typeProduitRepository;

    public function __construct(TypeProduitRepository $typeProduitRepo)
    {
        $this->typeProduitRepository = $typeProduitRepo;
    }

    /**
     * Display a listing of the TypeProduit.
     */
    public function index(TypeProduitDataTable $typeProduitDataTable)
    {
    return $typeProduitDataTable->render('type_produits.index');
    }


    /**
     * Show the form for creating a new TypeProduit.
     */
    public function create()
    {
        return view('type_produits.create');
    }

    /**
     * Store a newly created TypeProduit in storage.
     */
    public function store(CreateTypeProduitRequest $request)
    {
        $input = $request->all();

        $typeProduit = $this->typeProduitRepository->create($input);

        Flash::success('Type Produit enregistré(e) avec succès.');

        return redirect(route('typeProduits.index'));
    }

    /**
     * Display the specified TypeProduit.
     */
    public function show($id)
    {
        $typeProduit = $this->typeProduitRepository->find($id);

        if (empty($typeProduit)) {
            Flash::error('Type Produit not found');

            return redirect(route('typeProduits.index'));
        }

        return view('type_produits.show')->with('typeProduit', $typeProduit);
    }

    /**
     * Show the form for editing the specified TypeProduit.
     */
    public function edit($id)
    {
        $typeProduit = $this->typeProduitRepository->find($id);

        if (empty($typeProduit)) {
            Flash::error('Type Produit not found');

            return redirect(route('typeProduits.index'));
        }

        return view('type_produits.edit')->with('typeProduit', $typeProduit);
    }

    /**
     * Update the specified TypeProduit in storage.
     */
    public function update($id, UpdateTypeProduitRequest $request)
    {
        $typeProduit = $this->typeProduitRepository->find($id);

        if (empty($typeProduit)) {
            Flash::error('Type Produit not found');

            return redirect(route('typeProduits.index'));
        }

        $typeProduit = $this->typeProduitRepository->update($request->all(), $id);

        Flash::success('Type Produit mis à jour avec succès.');

        return redirect(route('typeProduits.index'));
    }

    /**
     * Remove the specified TypeProduit from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $typeProduit = $this->typeProduitRepository->find($id);

        if (empty($typeProduit)) {
            Flash::error('Type Produit not found');

            return redirect(route('typeProduits.index'));
        }

        $this->typeProduitRepository->delete($id);

        Flash::success('Type Produit supprimé(e) avec succès. ');

        return redirect(route('typeProduits.index'));
    }
}
