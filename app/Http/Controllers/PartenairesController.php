<?php

namespace App\Http\Controllers;

use App\DataTables\PartenairesDataTable;
use App\Http\Requests\CreatePartenairesRequest;
use App\Http\Requests\UpdatePartenairesRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PartenairesRepository;
use Illuminate\Http\Request;
use App\DataTables\MotoPartenairesDataTable;
use DB;
use Flash;

class PartenairesController extends AppBaseController
{
    /** @var PartenairesRepository $partenairesRepository*/
    private $partenairesRepository;

    public function __construct(PartenairesRepository $partenairesRepo)
    {
        $this->partenairesRepository = $partenairesRepo;
    }

    /**
     * Display a listing of the Partenaires.
     */
    public function index(PartenairesDataTable $partenairesDataTable)
    {
    return $partenairesDataTable->render('partenaires.index');
    }


    /**
     * Show the form for creating a new Partenaires.
     */
    public function create()
    {
        return view('partenaires.create');
    }

    /**
     * Store a newly created Partenaires in storage.
     */
    public function store(CreatePartenairesRequest $request)
    {
        $input = $request->all();

        $partenaires = $this->partenairesRepository->create($input);

        Flash::success('Partenaires enregistré(e) avec succès.');

        return redirect(route('partenaires.index'));
    }

    /**
     * Display the specified Partenaires.
     */
    public function show($id)
    {
        $partenaires = $this->partenairesRepository->find($id);
        $total_moto =DB::select(' SELECT count(*) as total_moto FROM moto WHERE partenaire='.$id.' ');
        $total_disponible =DB::select(' SELECT count(*) as total_disponible FROM moto WHERE partenaire='.$id.' and disponible=1 ');
        //->selectRaw('( SELECT count(distinct c.id) FROM contrat c inner join moto m on c.moto=m.id WHERE m.partenaire=partenaires.id and c.actif=1) as total_contrat ');
        $total_contrat =DB::select(' SELECT count(distinct m.id) total_contrat FROM moto m  inner join contrat c on c.moto=m.id WHERE m.partenaire='.$id.' and actif=1 ');
    
        if (empty($partenaires)) {
            Flash::error('Partenaires not found');

            return redirect(route('partenaires.index'));
        }
        $total_moto= $total_moto[0]->total_moto;
        $total_disponible= $total_disponible[0]->total_disponible;
        $total_contrat= $total_contrat[0]->total_contrat;
        
        $motoPartenairesDataTable=new MotoPartenairesDataTable();
        $motoPartenairesDataTable->partenaire=$id;
        
        return $motoPartenairesDataTable->render('partenaires.show',compact('partenaires',
        'total_moto','total_disponible','total_contrat'));

    }

    /**
     * Show the form for editing the specified Partenaires.
     */
    public function edit($id)
    {
        $partenaires = $this->partenairesRepository->find($id);

        if (empty($partenaires)) {
            Flash::error('Partenaires not found');

            return redirect(route('partenaires.index'));
        }

        return view('partenaires.edit')->with('partenaires', $partenaires);
    }

    /**
     * Update the specified Partenaires in storage.
     */
    public function update($id, UpdatePartenairesRequest $request)
    {
        $partenaires = $this->partenairesRepository->find($id);

        if (empty($partenaires)) {
            Flash::error('Partenaires not found');

            return redirect(route('partenaires.index'));
        }

        $partenaires = $this->partenairesRepository->update($request->all(), $id);

        Flash::success('Partenaires mis à jour avec succès.');

        return redirect(route('partenaires.index'));
    }

    /**
     * Remove the specified Partenaires from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $partenaires = $this->partenairesRepository->find($id);

        if (empty($partenaires)) {
            Flash::error('Partenaires not found');

            return redirect(route('partenaires.index'));
        }

        $this->partenairesRepository->delete($id);

        Flash::success('Partenaires supprimé(e) avec succès. ');

        return redirect(route('partenaires.index'));
    }
}
