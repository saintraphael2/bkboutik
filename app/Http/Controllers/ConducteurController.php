<?php

namespace App\Http\Controllers;

use App\DataTables\ConducteurDataTable;
use App\Http\Requests\CreateConducteurRequest;
use App\Http\Requests\UpdateConducteurRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Conducteur;
use App\Repositories\ConducteurRepository;
use App\Repositories\TypepieceRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Flash;

class ConducteurController extends AppBaseController
{
    /** @var ConducteurRepository $conducteurRepository*/
    private $conducteurRepository;
    private $typepieceRepository;

    public function __construct(ConducteurRepository $conducteurRepo, TypepieceRepository $typepieceRepo)
    {
        $this->conducteurRepository = $conducteurRepo;
        $this->typepieceRepository = $typepieceRepo;
    }

    /**
     * Display a listing of the Conducteur.
     */
    public function index(ConducteurDataTable $conducteurDataTable)
    {
    return $conducteurDataTable->render('conducteurs.index');
    }


    /**
     * Show the form for creating a new Conducteur.
     */
    public function create()
    {
        $typepieces = $this->typepieceRepository->all();

        return view('conducteurs.create')->with([
            'view' => "create",
            'conducteur' => new Conducteur(), // to prevent undefined error in fields view
            'typepieces' => $typepieces
        ]);
    }

    /**
     * Store a newly created Conducteur in storage.
     */
    public function store(CreateConducteurRequest $request)
    {
        $rules = ['fichier_photo' => 'nullable|image'];
        $validator = Validator::make((array)$request->all(), $rules);
        if ($validator->fails()) {
            Flash::error('Le fichier doit etre une image');
            return redirect(route('conducteurs.create'));
        }


        if(!$request->control){
            if ($request->hasFile('fichier_photo')){
                $fichier_photo = $request->file('fichier_photo');
                $filename = "BKZ_Photo_".$request->nom.".".$fichier_photo->getClientOriginalExtension();
                Storage::putFileAs('public/photos', $fichier_photo, $filename);
                $request->request->add(['photo' => "/storage/photos/".$filename]);
            }
            $input = $request->all();
            $conducteur = $this->conducteurRepository->create($input);
        }

        if($request->ajax && $request->control){
            // simple requet ajax pour le control des paramètres
            return true;
        } else if($request->ajax){
            return $conducteur;
        }
        Flash::success('Conducteur enregistré(e) avec succès.');

        return redirect(route('conducteurs.index'));
    }

    /**
     * Display the specified Conducteur.
     */
    public function show($id)
    {
        $conducteur = $this->conducteurRepository->find($id);

        if (empty($conducteur)) {
            Flash::error('Conducteur not found');

            return redirect(route('conducteurs.index'));
        }

        return view('conducteurs.show')->with('conducteur', $conducteur);
    }

    /**
     * Show the form for editing the specified Conducteur.
     */
    public function edit($id)
    {
        $conducteur = $this->conducteurRepository->find($id);

        if (empty($conducteur)) {
            Flash::error('Conducteur not found');

            return redirect(route('conducteurs.index'));
        }

        $typepieces = $this->typepieceRepository->all();

        return view('conducteurs.edit')->with([
            'view' => "edit",
            'conducteur' => $conducteur,
            'typepieces' => $typepieces
        ]);
    }

    /**
     * Update the specified Conducteur in storage.
     */
    public function update($id, UpdateConducteurRequest $request)
    {
        //dd($request->hasFile('fichier_photo'), $request->file('fichier_photo'));
        $rules = ['fichier_photo' => 'nullable|image'];
        $validator = Validator::make((array)$request->all(), $rules);
        if ($validator->fails()) {
            Flash::error('Le fichier doit etre une image');
            return redirect(route('conducteurs.edit', $id));
        }


        $conducteur = $this->conducteurRepository->find($id);
        if (empty($conducteur)) {
            Flash::error('Conducteur not found');

            return redirect(route('conducteurs.index'));
        }


        if ($request->hasFile('fichier_photo')){
            $fichier_photo = $request->file('fichier_photo');
            $filename = "BKZ_Photo_".$request->nom.".".$fichier_photo->getClientOriginalExtension();
            Storage::putFileAs('public/photos', $fichier_photo, $filename);
            $request->request->add(['photo' => "/storage/photos/".$filename]);
        }

        $conducteur = $this->conducteurRepository->update($request->all(), $id);

        Flash::success('Conducteur mis à jour avec succès.');

        return redirect(route('conducteurs.index'));
    }

    /**
     * Remove the specified Conducteur from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $conducteur = $this->conducteurRepository->find($id);

        if (empty($conducteur)) {
            Flash::error('Conducteur not found');

            return redirect(route('conducteurs.index'));
        }

        $this->conducteurRepository->delete($id);

        Flash::success('Conducteur supprimé(e) avec succès. ');

        return redirect(route('conducteurs.index'));
    }
}
