<?php

namespace App\Http\Controllers;

use App\DataTables\Cautions_conduteurDataTable;
use App\Http\Requests\CreateCautions_conduteurRequest;
use App\Http\Requests\UpdateCautions_conduteurRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Cautions_conduteurRepository;
use Illuminate\Http\Request;
use Flash;

class Cautions_conduteurController extends AppBaseController
{
    /** @var Cautions_conduteurRepository $cautionsConduteurRepository*/
    private $cautionsConduteurRepository;

    public function __construct(Cautions_conduteurRepository $cautionsConduteurRepo)
    {
        $this->cautionsConduteurRepository = $cautionsConduteurRepo;
    }

    /**
     * Display a listing of the Cautions_conduteur.
     */
    public function index(Cautions_conduteurDataTable $cautionsConduteurDataTable)
    {
    return $cautionsConduteurDataTable->render('cautions_conduteurs.index');
    }


    /**
     * Show the form for creating a new Cautions_conduteur.
     */
    public function create()
    {
        return view('cautions_conduteurs.create');
    }

    /**
     * Store a newly created Cautions_conduteur in storage.
     */
    public function store(CreateCautions_conduteurRequest $request)
    {
        $input = $request->all();

        $cautionsConduteur = $this->cautionsConduteurRepository->create($input);
        if($request->ajax){
            return $cautionsConduteur;
        }
        Flash::success('Cautions Conduteur enregistré(e) avec succès.');

        return redirect(route('cautionsConduteurs.index'));
    }

    /**
     * Display the specified Cautions_conduteur.
     */
    public function show($id)
    {
        $cautionsConduteur = $this->cautionsConduteurRepository->find($id);

        if (empty($cautionsConduteur)) {
            Flash::error('Cautions Conduteur not found');

            return redirect(route('cautionsConduteurs.index'));
        }

        return view('cautions_conduteurs.show')->with('cautionsConduteur', $cautionsConduteur);
    }

    /**
     * Show the form for editing the specified Cautions_conduteur.
     */
    public function edit($id)
    {
        $cautionsConduteur = $this->cautionsConduteurRepository->find($id);

        if (empty($cautionsConduteur)) {
            Flash::error('Cautions Conduteur not found');

            return redirect(route('cautionsConduteurs.index'));
        }

        return view('cautions_conduteurs.edit')->with('cautionsConduteur', $cautionsConduteur);
    }

    /**
     * Update the specified Cautions_conduteur in storage.
     */
    public function update($id, UpdateCautions_conduteurRequest $request)
    {
        $cautionsConduteur = $this->cautionsConduteurRepository->find($id);

        if (empty($cautionsConduteur)) {
            Flash::error('Cautions Conduteur not found');

            return redirect(route('cautionsConduteurs.index'));
        }

        $cautionsConduteur = $this->cautionsConduteurRepository->update($request->all(), $id);

        Flash::success('Cautions Conduteur mis à jour avec succès.');

        return redirect(route('cautionsConduteurs.index'));
    }

    /**
     * Remove the specified Cautions_conduteur from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cautionsConduteur = $this->cautionsConduteurRepository->find($id);

        if (empty($cautionsConduteur)) {
            Flash::error('Cautions Conduteur not found');

            return redirect(route('cautionsConduteurs.index'));
        }

        $this->cautionsConduteurRepository->delete($id);

        Flash::success('Cautions Conduteur supprimé(e) avec succès. ');

        return redirect(route('cautionsConduteurs.index'));
    }
}
