<?php

namespace App\Http\Controllers;

use App\DataTables\FrequencePaiementDataTable;
use App\Http\Requests\CreateFrequencePaiementRequest;
use App\Http\Requests\UpdateFrequencePaiementRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\FrequencePaiementRepository;
use Illuminate\Http\Request;
use Flash;

class FrequencePaiementController extends AppBaseController
{
    /** @var FrequencePaiementRepository $frequencePaiementRepository*/
    private $frequencePaiementRepository;

    public function __construct(FrequencePaiementRepository $frequencePaiementRepo)
    {
        $this->frequencePaiementRepository = $frequencePaiementRepo;
    }

    /**
     * Display a listing of the FrequencePaiement.
     */
    public function index(FrequencePaiementDataTable $frequencePaiementDataTable)
    {
    return $frequencePaiementDataTable->render('frequence_paiements.index');
    }


    /**
     * Show the form for creating a new FrequencePaiement.
     */
    public function create()
    {
        return view('frequence_paiements.create');
    }

    /**
     * Store a newly created FrequencePaiement in storage.
     */
    public function store(CreateFrequencePaiementRequest $request)
    {
        $input = $request->all();

        $frequencePaiement = $this->frequencePaiementRepository->create($input);

        Flash::success('Frequence Paiement enregistré(e) avec succès.');

        return redirect(route('frequencePaiements.index'));
    }

    /**
     * Display the specified FrequencePaiement.
     */
    public function show($id)
    {
        $frequencePaiement = $this->frequencePaiementRepository->find($id);

        if (empty($frequencePaiement)) {
            Flash::error('Frequence Paiement not found');

            return redirect(route('frequencePaiements.index'));
        }

        return view('frequence_paiements.show')->with('frequencePaiement', $frequencePaiement);
    }

    /**
     * Show the form for editing the specified FrequencePaiement.
     */
    public function edit($id)
    {
        $frequencePaiement = $this->frequencePaiementRepository->find($id);

        if (empty($frequencePaiement)) {
            Flash::error('Frequence Paiement not found');

            return redirect(route('frequencePaiements.index'));
        }

        return view('frequence_paiements.edit')->with('frequencePaiement', $frequencePaiement);
    }

    /**
     * Update the specified FrequencePaiement in storage.
     */
    public function update($id, UpdateFrequencePaiementRequest $request)
    {
        $frequencePaiement = $this->frequencePaiementRepository->find($id);

        if (empty($frequencePaiement)) {
            Flash::error('Frequence Paiement not found');

            return redirect(route('frequencePaiements.index'));
        }

        $frequencePaiement = $this->frequencePaiementRepository->update($request->all(), $id);

        Flash::success('Frequence Paiement mis à jour avec succès.');

        return redirect(route('frequencePaiements.index'));
    }

    /**
     * Remove the specified FrequencePaiement from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $frequencePaiement = $this->frequencePaiementRepository->find($id);

        if (empty($frequencePaiement)) {
            Flash::error('Frequence Paiement not found');

            return redirect(route('frequencePaiements.index'));
        }

        $this->frequencePaiementRepository->delete($id);

        Flash::success('Frequence Paiement supprimé(e) avec succès. ');

        return redirect(route('frequencePaiements.index'));
    }
}
