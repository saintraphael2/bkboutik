<?php

namespace App\Http\Controllers;

use App\DataTables\VenteDataTable;
use App\Http\Requests\CreateVenteRequest;
use App\Http\Requests\UpdateVenteRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\VenteRepository;
use App\Models\Client;
use Illuminate\Http\Request;
use Flash;

class VenteController extends AppBaseController
{
    /** @var VenteRepository $venteRepository*/
    private $venteRepository;

    public function __construct(VenteRepository $venteRepo)
    {
        $this->venteRepository = $venteRepo;
    }

    /**
     * Display a listing of the Vente.
     */
    public function index(VenteDataTable $venteDataTable)
    {
    return $venteDataTable->render('ventes.index');
    }


    /**
     * Show the form for creating a new Vente.
     */
    public function create()
    {
        $clients=Client::pluck('nom_client','id');
        return view('ventes.create')->with(['clients'=>$clients]);
    }

    /**
     * Store a newly created Vente in storage.
     */
    public function store(CreateVenteRequest $request)
    {
        $input = $request->all();

        $vente = $this->venteRepository->create($input);

        Flash::success('Vente enregistré(e) avec succès.');

        return redirect(route('ventes.index'));
    }

    /**
     * Display the specified Vente.
     */
    public function show($id)
    {
        $vente = $this->venteRepository->find($id);

        if (empty($vente)) {
            Flash::error('Vente not found');

            return redirect(route('ventes.index'));
        }

        return view('ventes.show')->with('vente', $vente);
    }

    /**
     * Show the form for editing the specified Vente.
     */
    public function edit($id)
    {
        $vente = $this->venteRepository->find($id);

        if (empty($vente)) {
            Flash::error('Vente not found');

            return redirect(route('ventes.index'));
        }

        return view('ventes.edit')->with('vente', $vente);
    }

    /**
     * Update the specified Vente in storage.
     */
    public function update($id, UpdateVenteRequest $request)
    {
        $vente = $this->venteRepository->find($id);

        if (empty($vente)) {
            Flash::error('Vente not found');

            return redirect(route('ventes.index'));
        }

        $vente = $this->venteRepository->update($request->all(), $id);

        Flash::success('Vente mis à jour avec succès.');

        return redirect(route('ventes.index'));
    }

    /**
     * Remove the specified Vente from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $vente = $this->venteRepository->find($id);

        if (empty($vente)) {
            Flash::error('Vente not found');

            return redirect(route('ventes.index'));
        }

        $this->venteRepository->delete($id);

        Flash::success('Vente supprimé(e) avec succès. ');

        return redirect(route('ventes.index'));
    }
}
