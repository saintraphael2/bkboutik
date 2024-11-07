<?php

namespace App\Http\Controllers;

use App\DataTables\OffreDataTable;
use App\Http\Requests\CreateOffreRequest;
use App\Http\Requests\UpdateOffreRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\OffreRepository;
use Illuminate\Http\Request;
use Flash;

class OffreController extends AppBaseController
{
    /** @var OffreRepository $offreRepository*/
    private $offreRepository;

    public function __construct(OffreRepository $offreRepo)
    {
        $this->offreRepository = $offreRepo;
    }

    /**
     * Display a listing of the Offre.
     */
    public function index(OffreDataTable $offreDataTable)
    {
    return $offreDataTable->render('offres.index');
    }


    /**
     * Show the form for creating a new Offre.
     */
    public function create()
    {
        return view('offres.create');
    }

    /**
     * Store a newly created Offre in storage.
     */
    public function store(CreateOffreRequest $request)
    {
        $input = $request->all();

        $offre = $this->offreRepository->create($input);

        Flash::success('Offre enregistré(e) avec succès.');

        return redirect(route('offres.index'));
    }

    /**
     * Display the specified Offre.
     */
    public function show($id)
    {
        $offre = $this->offreRepository->find($id);

        if (empty($offre)) {
            Flash::error('Offre not found');

            return redirect(route('offres.index'));
        }

        return view('offres.show')->with('offre', $offre);
    }

    /**
     * Show the form for editing the specified Offre.
     */
    public function edit($id)
    {
        $offre = $this->offreRepository->find($id);

        if (empty($offre)) {
            Flash::error('Offre not found');

            return redirect(route('offres.index'));
        }

        return view('offres.edit')->with('offre', $offre);
    }

    /**
     * Update the specified Offre in storage.
     */
    public function update($id, UpdateOffreRequest $request)
    {
        $offre = $this->offreRepository->find($id);

        if (empty($offre)) {
            Flash::error('Offre not found');

            return redirect(route('offres.index'));
        }

        $offre = $this->offreRepository->update($request->all(), $id);

        Flash::success('Offre mis à jour avec succès.');

        return redirect(route('offres.index'));
    }

    /**
     * Remove the specified Offre from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $offre = $this->offreRepository->find($id);

        if (empty($offre)) {
            Flash::error('Offre not found');

            return redirect(route('offres.index'));
        }

        $this->offreRepository->delete($id);

        Flash::success('Offre supprimé(e) avec succès. ');

        return redirect(route('offres.index'));
    }
}
