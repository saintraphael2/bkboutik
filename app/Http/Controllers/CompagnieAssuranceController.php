<?php

namespace App\Http\Controllers;

use App\DataTables\CompagnieAssuranceDataTable;
use App\Http\Requests\CreateCompagnieAssuranceRequest;
use App\Http\Requests\UpdateCompagnieAssuranceRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\CompagnieAssuranceRepository;
use Illuminate\Http\Request;
use Flash;

class CompagnieAssuranceController extends AppBaseController
{
    /** @var CompagnieAssuranceRepository $compagnieAssuranceRepository*/
    private $compagnieAssuranceRepository;

    public function __construct(CompagnieAssuranceRepository $compagnieAssuranceRepo)
    {
        $this->compagnieAssuranceRepository = $compagnieAssuranceRepo;
    }

    /**
     * Display a listing of the CompagnieAssurance.
     */
    public function index(CompagnieAssuranceDataTable $compagnieAssuranceDataTable)
    {
    return $compagnieAssuranceDataTable->render('compagnieassurances.index');
    }


    /**
     * Show the form for creating a new CompagnieAssurance.
     */
    public function create()
    {
        return view('compagnieassurances.create');
    }

    /**
     * Store a newly created CompagnieAssurance in storage.
     */
    public function store(CreateCompagnieAssuranceRequest $request)
    {
        $input = $request->all();

        $compagnieAssurance = $this->compagnieAssuranceRepository->create($input);

        Flash::success('Compagnie Assurance enregistré(e) avec succès.');

        return redirect(route('compagnieassurances.index'));
    }

    /**
     * Display the specified CompagnieAssurance.
     */
    public function show($id)
    {
        $compagnieAssurance = $this->compagnieAssuranceRepository->find($id);

        if (empty($compagnieAssurance)) {
            Flash::error('Compagnie Assurance not found');

            return redirect(route('compagnieassurances.index'));
        }

        return view('compagnieassurances.show')->with('compagnieAssurance', $compagnieAssurance);
    }

    /**
     * Show the form for editing the specified CompagnieAssurance.
     */
    public function edit($id)
    {
        $compagnieAssurance = $this->compagnieAssuranceRepository->find($id);

        if (empty($compagnieAssurance)) {
            Flash::error('Compagnie Assurance not found');

            return redirect(route('compagnieassurances.index'));
        }

        return view('compagnieassurances.edit')->with('compagnieAssurance', $compagnieAssurance);
    }

    /**
     * Update the specified CompagnieAssurance in storage.
     */
    public function update($id, UpdateCompagnieAssuranceRequest $request)
    {
        $compagnieAssurance = $this->compagnieAssuranceRepository->find($id);

        if (empty($compagnieAssurance)) {
            Flash::error('Compagnie Assurance not found');

            return redirect(route('compagnieassurances.index'));
        }

        $compagnieAssurance = $this->compagnieAssuranceRepository->update($request->all(), $id);

        Flash::success('Compagnie Assurance mis à jour avec succès.');

        return redirect(route('compagnieassurances.index'));
    }

    /**
     * Remove the specified CompagnieAssurance from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $compagnieAssurance = $this->compagnieAssuranceRepository->find($id);

        if (empty($compagnieAssurance)) {
            Flash::error('Compagnie Assurance not found');

            return redirect(route('compagnieassurances.index'));
        }

        $this->compagnieAssuranceRepository->delete($id);

        Flash::success('Compagnie Assurance supprimé(e) avec succès. ');

        return redirect(route('compagnieassurances.index'));
    }
}
