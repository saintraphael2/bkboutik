<?php

namespace App\Http\Controllers;

use App\DataTables\TypeContratDataTable;
use App\Http\Requests\CreateTypeContratRequest;
use App\Http\Requests\UpdateTypeContratRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\TypeContratRepository;
use Illuminate\Http\Request;
use Flash;

class TypeContratController extends AppBaseController
{
    /** @var TypeContratRepository $typeContratRepository*/
    private $typeContratRepository;

    public function __construct(TypeContratRepository $typeContratRepo)
    {
        $this->typeContratRepository = $typeContratRepo;
    }

    /**
     * Display a listing of the TypeContrat.
     */
    public function index(TypeContratDataTable $typeContratDataTable)
    {
    return $typeContratDataTable->render('type_contrats.index');
    }


    /**
     * Show the form for creating a new TypeContrat.
     */
    public function create()
    {
        return view('type_contrats.create');
    }

    /**
     * Store a newly created TypeContrat in storage.
     */
    public function store(CreateTypeContratRequest $request)
    {
        $input = $request->all();

        $typeContrat = $this->typeContratRepository->create($input);

        Flash::success('Type Contrat enregistré(e) avec succès.');

        return redirect(route('typeContrats.index'));
    }

    /**
     * Display the specified TypeContrat.
     */
    public function show($id)
    {
        $typeContrat = $this->typeContratRepository->find($id);

        if (empty($typeContrat)) {
            Flash::error('Type Contrat not found');

            return redirect(route('typeContrats.index'));
        }

        return view('type_contrats.show')->with('typeContrat', $typeContrat);
    }

    /**
     * Show the form for editing the specified TypeContrat.
     */
    public function edit($id)
    {
        $typeContrat = $this->typeContratRepository->find($id);

        if (empty($typeContrat)) {
            Flash::error('Type Contrat not found');

            return redirect(route('typeContrats.index'));
        }

        return view('type_contrats.edit')->with('typeContrat', $typeContrat);
    }

    /**
     * Update the specified TypeContrat in storage.
     */
    public function update($id, UpdateTypeContratRequest $request)
    {
        $typeContrat = $this->typeContratRepository->find($id);

        if (empty($typeContrat)) {
            Flash::error('Type Contrat not found');

            return redirect(route('typeContrats.index'));
        }

        $typeContrat = $this->typeContratRepository->update($request->all(), $id);

        Flash::success('Type Contrat mis à jour avec succès.');

        return redirect(route('typeContrats.index'));
    }

    /**
     * Remove the specified TypeContrat from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $typeContrat = $this->typeContratRepository->find($id);

        if (empty($typeContrat)) {
            Flash::error('Type Contrat not found');

            return redirect(route('typeContrats.index'));
        }

        $this->typeContratRepository->delete($id);

        Flash::success('Type Contrat supprimé(e) avec succès. ');

        return redirect(route('typeContrats.index'));
    }
}
