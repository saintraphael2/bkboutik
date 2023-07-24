<?php

namespace App\Http\Controllers;

use App\DataTables\ContratAssuranceDataTable;
use App\Http\Requests\CreateContratAssuranceRequest;
use App\Http\Requests\UpdateContratAssuranceRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ContratAssuranceRepository;
use Illuminate\Http\Request;
use App\Models\Moto;
use App\Models\CompagnieAssurance;
use Flash;

class ContratAssuranceController extends AppBaseController
{
    /** @var ContratAssuranceRepository $contratAssuranceRepository*/
    private $contratAssuranceRepository;

    public function __construct(ContratAssuranceRepository $contratAssuranceRepo)
    {
        $this->contratAssuranceRepository = $contratAssuranceRepo;
    }

    /**
     * Display a listing of the ContratAssurance.
     */
    public function index(ContratAssuranceDataTable $contratAssuranceDataTable)
    {
    return $contratAssuranceDataTable->render('contrat_assurances.index');
    }


    /**
     * Show the form for creating a new ContratAssurance.
     */
    public function create($id)
    {
        $moto = Moto::find($id);
       // return view('vidanges.create')->with('id',$id)->with('moto',$moto)->with('date_fr','')->with('prochaine_fr','');

        //$motos=Moto::orderby('immatriculation')->pluck('immatriculation','id');->with('motos',$motos)
        $compagnieAssurances=CompagnieAssurance::orderby('designation')->pluck('designation','id');
        return view('contrat_assurances.create')->with('compagnie_assurances',$compagnieAssurances)->with('id',$id)
        ->with('compagnie_assurance',0)->with('moto',$moto)->with('date_debut_fr','')->with('date_fin_fr','');
    }

    /**date_debut',
        'date_fin
     * Store a newly created ContratAssurance in storage.
     */
    public function store(CreateContratAssuranceRequest $request)
    {
        $input = $request->all();

        $contratAssurance = $this->contratAssuranceRepository->create($input);

        Flash::success('Contrat Assurance enregistré(e) avec succès.');
        return redirect(route('contratsAssurance',$contratAssurance->moto));
        //return redirect(route('contratAssurances.index'));
    }

    /**
     * Display the specified ContratAssurance.
     */
    public function show($id)
    {
        $contratAssurance = $this->contratAssuranceRepository->find($id);

        if (empty($contratAssurance)) {
            Flash::error('Contrat Assurance not found');

            return redirect(route('contratAssurances.index'));
        }

        return view('contrat_assurances.show')->with('contratAssurance', $contratAssurance);
    }

    /**
     * Show the form for editing the specified ContratAssurance.
     */
    public function edit($id)
    {
        $contratAssurance = $this->contratAssuranceRepository->find($id);
        $motos=Moto::orderby('immatriculation')->pluck('immatriculation','id');
        $compagnieAssurances=CompagnieAssurance::orderby('designation')->pluck('designation','id');
        if (empty($contratAssurance)) {
            Flash::error('Contrat Assurance not found');

            return redirect(route('contratAssurances.index'));
        }
        //$moto=$vidange->motos;
        return view('contrat_assurances.edit')->with('contratAssurance', $contratAssurance)->with('motos',$motos)->with('id',$contratAssurance->moto)
        ->with('compagnie_assurances',$compagnieAssurances)->with('compagnie_assurance',$contratAssurance->compagnie_assurance)
        ->with('moto',$contratAssurance->motos)->with('date_debut_fr',date("d-m-Y", strtotime($contratAssurance->date_debut)))
        ->with('date_fin_fr',date("d-m-Y", strtotime($contratAssurance->date_fin)));
    }

    /**
     * Update the specified ContratAssurance in storage.
     */
    public function update($id, UpdateContratAssuranceRequest $request)
    {
        $contratAssurance = $this->contratAssuranceRepository->find($id);

        if (empty($contratAssurance)) {
            Flash::error('Contrat Assurance not found');

            return redirect(route('contratAssurances.index'));
        }

        $contratAssurance = $this->contratAssuranceRepository->update($request->all(), $id);

        Flash::success('Contrat Assurance mis à jour avec succès.');
        return redirect(route('contratsAssurance',$contratAssurance->moto));
       // return redirect(route('contratAssurances.index'));
    }

    /**
     * Remove the specified ContratAssurance from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $contratAssurance = $this->contratAssuranceRepository->find($id);
$moto=$contratAssurance->moto;
        if (empty($contratAssurance)) {
            Flash::error('Contrat Assurance not found');

            return redirect(route('contratAssurances.index'));
        }

        $this->contratAssuranceRepository->delete($id);

        Flash::success('Contrat Assurance supprimé(e) avec succès. ');
        return redirect(route('contratsAssurance',$moto));
        //return redirect(route('contratAssurances.index'));
    }
}
