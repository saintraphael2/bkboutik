<?php

namespace App\Http\Controllers;

use App\DataTables\DetailVenteDataTable;
use App\Http\Requests\CreateDetailVenteRequest;
use App\Http\Requests\UpdateDetailVenteRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\DetailVenteRepository;
use Illuminate\Http\Request;
use Flash;

class DetailVenteController extends AppBaseController
{
    /** @var DetailVenteRepository $detailVenteRepository*/
    private $detailVenteRepository;

    public function __construct(DetailVenteRepository $detailVenteRepo)
    {
        $this->detailVenteRepository = $detailVenteRepo;
    }

    /**
     * Display a listing of the DetailVente.
     */
    public function index(DetailVenteDataTable $detailVenteDataTable)
    {
    return $detailVenteDataTable->render('detail_ventes.index');
    }


    /**
     * Show the form for creating a new DetailVente.
     */
    public function create()
    {
        return view('detail_ventes.create');
    }

    /**
     * Store a newly created DetailVente in storage.
     */
    public function store(CreateDetailVenteRequest $request)
    {
        $input = $request->all();

        $detailVente = $this->detailVenteRepository->create($input);

        Flash::success('Detail Vente enregistré(e) avec succès.');

        return redirect(route('detailVentes.index'));
    }

    /**
     * Display the specified DetailVente.
     */
    public function show($id)
    {
        $detailVente = $this->detailVenteRepository->find($id);

        if (empty($detailVente)) {
            Flash::error('Detail Vente not found');

            return redirect(route('detailVentes.index'));
        }

        return view('detail_ventes.show')->with('detailVente', $detailVente);
    }

    /**
     * Show the form for editing the specified DetailVente.
     */
    public function edit($id)
    {
        $detailVente = $this->detailVenteRepository->find($id);

        if (empty($detailVente)) {
            Flash::error('Detail Vente not found');

            return redirect(route('detailVentes.index'));
        }

        return view('detail_ventes.edit')->with('detailVente', $detailVente);
    }

    /**
     * Update the specified DetailVente in storage.
     */
    public function update($id, UpdateDetailVenteRequest $request)
    {
        $detailVente = $this->detailVenteRepository->find($id);

        if (empty($detailVente)) {
            Flash::error('Detail Vente not found');

            return redirect(route('detailVentes.index'));
        }

        $detailVente = $this->detailVenteRepository->update($request->all(), $id);

        Flash::success('Detail Vente mis à jour avec succès.');

        return redirect(route('detailVentes.index'));
    }

    /**
     * Remove the specified DetailVente from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detailVente = $this->detailVenteRepository->find($id);

        if (empty($detailVente)) {
            Flash::error('Detail Vente not found');

            return redirect(route('detailVentes.index'));
        }

        $this->detailVenteRepository->delete($id);

        Flash::success('Detail Vente supprimé(e) avec succès. ');

        return redirect(route('detailVentes.index'));
    }
}
