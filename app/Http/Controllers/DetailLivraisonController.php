<?php

namespace App\Http\Controllers;

use App\DataTables\DetailLivraisonDataTable;
use App\Http\Requests\CreateDetailLivraisonRequest;
use App\Http\Requests\UpdateDetailLivraisonRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\DetailLivraisonRepository;
use Illuminate\Http\Request;
use Flash;

class DetailLivraisonController extends AppBaseController
{
    /** @var DetailLivraisonRepository $detailLivraisonRepository*/
    private $detailLivraisonRepository;

    public function __construct(DetailLivraisonRepository $detailLivraisonRepo)
    {
        $this->detailLivraisonRepository = $detailLivraisonRepo;
    }

    /**
     * Display a listing of the DetailLivraison.
     */
    public function index(DetailLivraisonDataTable $detailLivraisonDataTable)
    {
    return $detailLivraisonDataTable->render('detail_livraisons.index');
    }


    /**
     * Show the form for creating a new DetailLivraison.
     */
    public function create()
    {
        return view('detail_livraisons.create');
    }

    /**
     * Store a newly created DetailLivraison in storage.
     */
    public function store(CreateDetailLivraisonRequest $request)
    {
        $input = $request->all();

        $detailLivraison = $this->detailLivraisonRepository->create($input);

        Flash::success('Detail Livraison enregistré(e) avec succès.');

        return redirect(route('detailLivraisons.index'));
    }

    /**
     * Display the specified DetailLivraison.
     */
    public function show($id)
    {
        $detailLivraison = $this->detailLivraisonRepository->find($id);

        if (empty($detailLivraison)) {
            Flash::error('Detail Livraison not found');

            return redirect(route('detailLivraisons.index'));
        }

        return view('detail_livraisons.show')->with('detailLivraison', $detailLivraison);
    }

    /**
     * Show the form for editing the specified DetailLivraison.
     */
    public function edit($id)
    {
        $detailLivraison = $this->detailLivraisonRepository->find($id);

        if (empty($detailLivraison)) {
            Flash::error('Detail Livraison not found');

            return redirect(route('detailLivraisons.index'));
        }

        return view('detail_livraisons.edit')->with('detailLivraison', $detailLivraison);
    }

    /**
     * Update the specified DetailLivraison in storage.
     */
    public function update($id, UpdateDetailLivraisonRequest $request)
    {
        $detailLivraison = $this->detailLivraisonRepository->find($id);

        if (empty($detailLivraison)) {
            Flash::error('Detail Livraison not found');

            return redirect(route('detailLivraisons.index'));
        }

        $detailLivraison = $this->detailLivraisonRepository->update($request->all(), $id);

        Flash::success('Detail Livraison mis à jour avec succès.');

        return redirect(route('detailLivraisons.index'));
    }

    /**
     * Remove the specified DetailLivraison from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detailLivraison = $this->detailLivraisonRepository->find($id);

        if (empty($detailLivraison)) {
            Flash::error('Detail Livraison not found');

            return redirect(route('detailLivraisons.index'));
        }

        $this->detailLivraisonRepository->delete($id);

        Flash::success('Detail Livraison supprimé(e) avec succès. ');

        return redirect(route('detailLivraisons.index'));
    }
}
