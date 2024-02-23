<?php

namespace App\Http\Controllers;

use App\DataTables\VidangeDataTable;
use App\DataTables\ContratAssuranceDataTable;
use App\DataTables\MotoDataTable;
use App\Http\Requests\CreateMotoRequest;
use App\Http\Requests\UpdateMotoRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\MotoRepository;
use Illuminate\Http\Request;
use Flash;
use Auth;
use App\Models\Contrat;

class MotoController extends AppBaseController
{
    /** @var MotoRepository $motoRepository*/
    private $motoRepository;

    public function __construct(MotoRepository $motoRepo)
    {
        $this->motoRepository = $motoRepo;
    }

    /**
     * Display a listing of the Moto.
     */
    public function index(MotoDataTable $motoDataTable)
    {
        $comptable=Auth::user()->comptable;
        $motoDataTable->comptable=Auth::user()->comptable;
    return $motoDataTable->render('motos.index',compact('comptable'));
    }

    public function disponibleMotor(Request $request){
        $moto = $this->motoRepository->find($request->id);
        $contrats=$moto->contrats;
        $disponible=$moto->disponible;
        $sous_contrat_actif=false;
        if(count($contrats)>0){
            foreach($contrats as $contrat){
                if($contrat->actif==1){
                    $sous_contrat_actif=true;
                    break;
                }
            }
        }

        if(!$sous_contrat_actif){
            $moto->disponible=($disponible==0)?1:0;
            $moto->save();
            Flash::success('La disponibilité est mise à jour avec succès.');
        }else{
            Flash::error('La moto est liée à un contrat actif');
        }
        return redirect(route('motos.index'));
    }

    /**
     * Show the form for creating a new Moto.
     */
    public function create()
    {
        return view('motos.create')->with('disabled','');
    }

    /**
     * Store a newly created Moto in storage.
     */
    public function store(CreateMotoRequest $request)
    {
        $request->request->add(['disponible' => 1]);
        $input = $request->all();

        $moto = $this->motoRepository->create($input);

        Flash::success('Moto enregistré(e) avec succès.');

        return redirect(route('motos.index'));
    }

    /**
     * Display the specified Moto.
     */
    public function show($id)
    {
        $moto = $this->motoRepository->find($id);
        $vidangeDataTable =new VidangeDataTable();
        $prochaine=date("d/m/Y", strtotime($moto->prochaine_vidange));
        $vidangeDataTable->idMoto=$id;
        if (empty($moto)) {
            Flash::error('Moto not found');

            return redirect(route('motos.index'));
        }
        return $vidangeDataTable->render('motos.show',compact('moto','id'));
        //return view('motos.show')->with('moto', $moto);
    }

    public function listeAssurance($id)
    {
        $moto = $this->motoRepository->find($id);
        $contratAssuranceDataTable =new ContratAssuranceDataTable ();
        $contratAssuranceDataTable->idMoto=$id;
        if (empty($moto)) {
            Flash::error('Moto not found');

            return redirect(route('motos.index'));
        }
        return $contratAssuranceDataTable->render('motos.assurance',compact('moto','id'));
        //return view('motos.show')->with('moto', $moto);
    }
    public function editdisponible($id,$disponible)
    {
        $moto = $this->motoRepository->find($id);
        $contrat=
        $contratAssuranceDataTable =new ContratAssuranceDataTable ();
        $contratAssuranceDataTable->idMoto=$id;
        if (empty($moto)) {
            Flash::error('Moto not found');

            return redirect(route('motos.index'));
        }
        return $contratAssuranceDataTable->render('motos.assurance',compact('moto','id'));
        //return view('motos.show')->with('moto', $moto);
    }
    /**
     * Show the form for editing the specified Moto.
     */
    public function edit($id)
    {
        $moto = $this->motoRepository->find($id);

        if (empty($moto)) {
            Flash::error('Moto not found');

            return redirect(route('motos.index'));
        }

        return view('motos.edit')->with('moto', $moto)->with('disabled','readonly');
    }

    /**
     * Update the specified Moto in storage.
     */
    public function update($id, UpdateMotoRequest $request)
    {
        $moto = $this->motoRepository->find($id);

        if (empty($moto)) {
            Flash::error('Moto not found');

            return redirect(route('motos.index'));
        }

        $moto = $this->motoRepository->update($request->all(), $id);

        Flash::success('Moto mis à jour avec succès.');

        return redirect(route('motos.index'));
    }

    /**
     * Remove the specified Moto from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $moto = $this->motoRepository->find($id);

        if (empty($moto)) {
            Flash::error('Moto not found');

            return redirect(route('motos.index'));
        }

        $this->motoRepository->delete($id);

        Flash::success('Moto supprimé(e) avec succès. ');

        return redirect(route('motos.index'));
    }
}
