<?php

namespace App\Http\Controllers;

use App\DataTables\CautionDataTable;
use App\Http\Requests\CreateCautionRequest;
use App\Http\Requests\UpdateCautionRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\CautionRepository;
use App\Repositories\Cautions_conduteurRepository;
//use App\Models\Cautions_conduteur;
use Illuminate\Http\Request;
use Flash;

class CautionController extends AppBaseController
{
    /** @var CautionRepository $cautionRepository*/
    private $cautionRepository;
    private $cautionsConduteurRepository;

    public function __construct(CautionRepository $cautionRepo, Cautions_conduteurRepository $cautionsConduteurRepo)
    {
        $this->cautionRepository = $cautionRepo;
        $this->cautionsConduteurRepository = $cautionsConduteurRepo;
    }

    /**
     * Display a listing of the Caution.
     */
    public function index(CautionDataTable $cautionDataTable)
    {
    return $cautionDataTable->render('cautions.index');
    }


    /**
     * Show the form for creating a new Caution.
     */
    public function create()
    {
        return view('cautions.create');
    }

    /**
     * Store a newly created Caution in storage.
     */
    public function store(CreateCautionRequest $request)
    {
        $input = $request->all();

        if(!$request->control){
            $caution = $this->cautionRepository->create($input);

            if($request->conducteur){
                //$cautionsConduteur = $this->cautionsConduteurRepository->create([
                $this->cautionsConduteurRepository->create([
                    "conducteur" =>$request->conducteur,
                    "caution" =>$caution->id
                ]);
            }
        }
        
        if($request->ajax && $request->control){
            // simple requet ajax pour le control des paramètres
            return true;
        } else if($request->ajax){
            return $caution;
        }
        
        Flash::success('Caution enregistré(e) avec succès.');

        return redirect(route('cautions.index'));
    }

    /**
     * Display the specified Caution.
     */
    public function show($id)
    {
        $caution = $this->cautionRepository->find($id);

        if (empty($caution)) {
            Flash::error('Caution not found');

            return redirect(route('cautions.index'));
        }

        return view('cautions.show')->with('caution', $caution);
    }

    /**
     * Show the form for editing the specified Caution.
     */
    public function edit($id)
    {
        $caution = $this->cautionRepository->find($id);

        if (empty($caution)) {
            Flash::error('Caution not found');

            return redirect(route('cautions.index'));
        }

        return view('cautions.edit')->with('caution', $caution);
    }

    /**
     * Update the specified Caution in storage.
     */
    public function update($id, UpdateCautionRequest $request)
    {
        $caution = $this->cautionRepository->find($id);

        if (empty($caution)) {
            Flash::error('Caution not found');

            return redirect(route('cautions.index'));
        }

        $caution = $this->cautionRepository->update($request->all(), $id);

        Flash::success('Caution mis à jour avec succès.');

        return redirect(route('cautions.index'));
    }

    /**
     * Remove the specified Caution from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $caution = $this->cautionRepository->find($id);

        if (empty($caution)) {
            Flash::error('Caution not found');

            return redirect(route('cautions.index'));
        }

        $this->cautionRepository->delete($id);

        Flash::success('Caution supprimé(e) avec succès. ');

        return redirect(route('cautions.index'));
    }
}
