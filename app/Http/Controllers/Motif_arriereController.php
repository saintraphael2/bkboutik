<?php

namespace App\Http\Controllers;

use App\DataTables\Motif_arriereDataTable;
use App\Http\Requests\CreateMotif_arriereRequest;
use App\Http\Requests\UpdateMotif_arriereRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Motif_arriereRepository;
use Illuminate\Http\Request;
use Flash;

class Motif_arriereController extends AppBaseController
{
    /** @var Motif_arriereRepository $motifArriereRepository*/
    private $motifArriereRepository;

    public function __construct(Motif_arriereRepository $motifArriereRepo)
    {
        $this->motifArriereRepository = $motifArriereRepo;
    }

    /**
     * Display a listing of the Motif_arriere.
     */
    public function index(Motif_arriereDataTable $motifArriereDataTable)
    {
    return $motifArriereDataTable->render('motif_arrieres.index');
    }


    /**
     * Show the form for creating a new Motif_arriere.
     */
    public function create()
    {
        return view('motif_arrieres.create');
    }

    /**
     * Store a newly created Motif_arriere in storage.
     */
    public function store(CreateMotif_arriereRequest $request)
    {
        $input = $request->all();

        $motifArriere = $this->motifArriereRepository->create($input);

        Flash::success('Motif Arriere enregistré(e) avec succès.');

        return redirect(route('motif_arrieres.index'));
    }

    /**
     * Display the specified Motif_arriere.
     */
    public function show($id)
    {
        $motifArriere = $this->motifArriereRepository->find($id);

        if (empty($motifArriere)) {
            Flash::error('Motif Arriere not found');

            return redirect(route('motif_arrieres.index'));
        }

        return view('motif_arrieres.show')->with('motifArriere', $motifArriere);
    }

    /**
     * Show the form for editing the specified Motif_arriere.
     */
    public function edit($id)
    {
        $motifArriere = $this->motifArriereRepository->find($id);

        if (empty($motifArriere)) {
            Flash::error('Motif Arriere not found');

            return redirect(route('motif_arrieres.index'));
        }

        return view('motif_arrieres.edit')->with('motifArriere', $motifArriere);
    }

    /**
     * Update the specified Motif_arriere in storage.
     */
    public function update($id, UpdateMotif_arriereRequest $request)
    {
        $motifArriere = $this->motifArriereRepository->find($id);

        if (empty($motifArriere)) {
            Flash::error('Motif Arriere not found');

            return redirect(route('motif_arrieres.index'));
        }

        $motifArriere = $this->motifArriereRepository->update($request->all(), $id);

        Flash::success('Motif Arriere mis à jour avec succès.');

        return redirect(route('motif_arrieres.index'));
    }

    /**
     * Remove the specified Motif_arriere from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $motifArriere = $this->motifArriereRepository->find($id);

        if (empty($motifArriere)) {
            Flash::error('Motif Arriere not found');

            return redirect(route('motif_arrieres.index'));
        }

        $this->motifArriereRepository->delete($id);

        Flash::success('Motif Arriere supprimé(e) avec succès. ');

        return redirect(route('motif_arrieres.index'));
    }
}
