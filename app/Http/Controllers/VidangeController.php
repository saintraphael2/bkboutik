<?php

namespace App\Http\Controllers;

use App\DataTables\VidangeDataTable;
use App\Http\Requests\CreateVidangeRequest;
use App\Http\Requests\UpdateVidangeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\VidangeRepository;
use App\Models\Moto;
use Illuminate\Http\Request;
use App\Models\Vidange;
use Flash;
use DB;

class VidangeController extends AppBaseController
{
    /** @var VidangeRepository $vidangeRepository*/
    private $vidangeRepository;

    public function __construct(VidangeRepository $vidangeRepo)
    {
        $this->vidangeRepository = $vidangeRepo;
    }

    /**
     * Display a listing of the Vidange.
     */
    public function index(VidangeDataTable $vidangeDataTable)
    {
    return $vidangeDataTable->render('vidanges.index');
    }


    /**
     * Show the form for creating a new Vidange.
     */
    public function create($id)
    {
        $moto = Moto::find($id);
        $prochaine=$moto->prochaine_vidange;
        $tab=explode('-',substr($prochaine, 0, 10));
        return view('vidanges.create')->with('id',$id)->with('minYear',($prochaine!=null)?$tab[0]:'')->with('minMonth',($prochaine!=null)?($tab[1]-1):'')->with('minDay',($prochaine!=null)?$tab[2]:'')
        ->with('moto',$moto)->with('date_fr','')->with('prochaine_fr','');
    }

    /**
     * Store a newly created Vidange in storage.
     */
    public function store(CreateVidangeRequest $request)
    {
        $input = $request->all();

        $vidange = $this->vidangeRepository->create($input);
        $moto=Moto::where('id',$vidange->moto)->first();
        $moto->prochaine_vidange=$vidange->prochaine;
        $moto->save();
        Flash::success('Vidange enregistré(e) avec succès.');
        return redirect(route('motos.show',$vidange->moto));
       // return redirect(route('vidanges.index'));
    }

    /**
     * Display the specified Vidange.
     */
    public function show($id)
    {
        $vidange = $this->vidangeRepository->find($id);

        if (empty($vidange)) {
            Flash::error('Vidange not found');

            return redirect(route('vidanges.index'));
        }

        return view('vidanges.show')->with('vidange', $vidange);
    }

    /**
     * Show the form for editing the specified Vidange.
     */
    public function edit($id)
    {
        $vidange = $this->vidangeRepository->find($id);

        if (empty($vidange)) {
            Flash::error('Vidange not found');

            return redirect(route('vidanges.index'));
        }
        $idmoto = $vidange->moto;
        $moto=$vidange->motos;
        $prochaine= Vidange::where('id','<>',$id)->where('moto','<>',$idmoto)->wherenull('deleted_at')->max('prochaine');//$moto->prochaine_vidange;
        $tab=explode('-',substr($prochaine, 0, 10));
       // $vidange->date=date("d/m/Y", strtotime($vidange->date));
      
       
        return view('vidanges.edit')->with('vidange', $vidange)->with('minYear',$tab[0])->with('minMonth',$tab[1]-1)->with('minDay',$tab[2])
        ->with('id',$idmoto)->with('moto',$moto)->with('date_fr',date("d-m-Y", strtotime($vidange->date)))->with('prochaine_fr',date("d-m-Y",strtotime($vidange->prochaine)));
    }

    /**
     * Update the specified Vidange in storage.
     */
    public function update($id, UpdateVidangeRequest $request)
    {
        $vidange = $this->vidangeRepository->find($id);

        if (empty($vidange)) {
            Flash::error('Vidange not found');

            return redirect(route('vidanges.index'));
        }
        $moto=Moto::where('id',$vidange->moto)->first();
        $moto->prochaine_vidange=$vidange->prochaine;
        $moto->save();
        $vidange = $this->vidangeRepository->update($request->all(), $id);

        Flash::success('Vidange mis à jour avec succès.');
        return redirect(route('motos.show',$vidange->moto));
       // return redirect(route('vidanges.index'));
    }

    /**
     * Remove the specified Vidange from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $vidange = $this->vidangeRepository->find($id);
        $moto=$vidange->moto;
        if (empty($vidange)) {
            Flash::error('Vidange not found');

            return redirect(route('vidanges.index'));
        }

        $this->vidangeRepository->delete($id);

        Flash::success('Vidange supprimé(e) avec succès. ');
        return redirect(route('motos.show',$moto));
       // return redirect(route('vidanges.index'));
    }
}
