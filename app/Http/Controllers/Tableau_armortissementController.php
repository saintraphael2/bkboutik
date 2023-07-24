<?php

namespace App\Http\Controllers;

use App\DataTables\Tableau_armortissementDataTable;
use App\Http\Requests\CreateTableau_armortissementRequest;
use App\Http\Requests\UpdateTableau_armortissementRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Tableau_armortissementRepository;
use App\Repositories\ContratRepository;
use Illuminate\Http\Request;
use Flash;

class Tableau_armortissementController extends AppBaseController
{
    /** @var Tableau_armortissementRepository $tableauArmortissementRepository*/
    private $tableauArmortissementRepository;
    private $contratRepository;

    public function __construct(Tableau_armortissementRepository $tableauArmortissementRepo, ContratRepository $contratRepo)
    {
        $this->tableauArmortissementRepository = $tableauArmortissementRepo;
        $this->contratRepository = $contratRepo;
    }

    /**
     * Display a listing of the Tableau_armortissement.
     */
    public function index(Tableau_armortissementDataTable $tableauArmortissementDataTable, Request $request)
    {
        //dd("index", $request->contrat, $tableauArmortissementDataTable);
        //$tableauArmortissement = $this->tableauArmortissementRepository->find($id);
        if(!$request->contrat){
            $request->contrat = 1;
        }
        $contrat = $this->contratRepository->find($request->contrat);
        $tableauArmortissementDataTable->idContrat = $request->contrat;
        
        if($request->ajax){
            //return $contrat->tableauArmortissements;
            return $tableauArmortissementDataTable->html();
        }

        return $tableauArmortissementDataTable->render('tableau_armortissements.index', [
            'contrat' => $contrat
        ]);
    }


    /**
     * Show the form for creating a new Tableau_armortissement.
     */
    public function create()
    {
        return view('tableau_armortissements.create');
    }

    /**
     * Store a newly created Tableau_armortissement in storage.
     */
    public function store(CreateTableau_armortissementRequest $request)
    {
        $input = $request->all();

        $tableauArmortissement = $this->tableauArmortissementRepository->create($input);

        if($request->ajax && $request->control){
            // simple requet ajax pour le control des paramètres
            return true;
        } else if($request->ajax){
            return $tableauArmortissement;
        }
        Flash::success('Tableau Armortissement enregistré(e) avec succès.');

        return redirect(route('tableauArmortissements.index'));
    }

    /**
     * Display the specified Tableau_armortissement.
     */
    public function show($id)
    {
        $tableauArmortissement = $this->tableauArmortissementRepository->find($id);

        if (empty($tableauArmortissement)) {
            Flash::error('Tableau Armortissement not found');

            return redirect(route('tableauArmortissements.index'));
        }

        return view('tableau_armortissements.show')->with('tableauArmortissement', $tableauArmortissement);
    }

    /**
     * Show the form for editing the specified Tableau_armortissement.
     */
    public function edit($id)
    {
        $tableauArmortissement = $this->tableauArmortissementRepository->find($id);

        if (empty($tableauArmortissement)) {
            Flash::error('Tableau Armortissement not found');

            return redirect(route('tableauArmortissements.index'));
        }

        return view('tableau_armortissements.edit')->with('tableauArmortissement', $tableauArmortissement);
    }

    /**
     * Update the specified Tableau_armortissement in storage.
     */
    public function update($id, UpdateTableau_armortissementRequest $request)
    {
        $tableauArmortissement = $this->tableauArmortissementRepository->find($id);

        if (empty($tableauArmortissement)) {
            Flash::error('Tableau Armortissement not found');

            return redirect(route('tableauArmortissements.index'));
        }

        $tableauArmortissement = $this->tableauArmortissementRepository->update($request->all(), $id);

        Flash::success('Tableau Armortissement mis à jour avec succès.');

        return redirect(route('tableauArmortissements.index'));
    }

    /**
     * Remove the specified Tableau_armortissement from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tableauArmortissement = $this->tableauArmortissementRepository->find($id);

        if (empty($tableauArmortissement)) {
            Flash::error('Tableau Armortissement not found');

            return redirect(route('tableauArmortissements.index'));
        }

        $this->tableauArmortissementRepository->delete($id);

        Flash::success('Tableau Armortissement supprimé(e) avec succès. ');

        return redirect(route('tableauArmortissements.index'));
    }

}
