<?php

namespace App\Http\Controllers;

use App\DataTables\SouscriptionDataTable;
use App\Http\Requests\CreateSouscriptionRequest;
use App\Http\Requests\UpdateSouscriptionRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SouscriptionRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use App\Models\Produit;
use Auth;
class SouscriptionController extends AppBaseController
{
    /** @var SouscriptionRepository $souscriptionRepository*/
    private $souscriptionRepository;

    public function __construct(SouscriptionRepository $souscriptionRepo)
    {
        $this->souscriptionRepository = $souscriptionRepo;
    }

    /**
     * Display a listing of the Souscription.
     */
    public function index(SouscriptionDataTable $souscriptionDataTable)
    {
    return $souscriptionDataTable->render('souscriptions.index');
    }


    /**
     * Show the form for creating a new Souscription.
     */
    public function create()
    {
       
        return view('souscriptions.create');
    }
    public function autocompContrat(Request $request)
    {
        $immatriculation = $request->input('immatriculation');
    
        $sql=" SELECT c.id, immatriculation, co.nom FROM contrat c inner join moto m on m.id=c.moto
inner join conducteur co on co.id=c.conducteur
where immatriculation like '%".$immatriculation."%'";
             

        $users = DB::connection()->select($sql) ;

        return response()->json($users);
    }
    public function modeleProduit(Request $request)
    {
        $modele = $request->input('modele');
    
        $sql=" SELECT p.id,modele,t.libelle,montant FROM produit p inner join type_produit t on t.id=p.type_produit
where modele like '%".$modele."%'";
             

        $users = DB::connection()->select($sql) ;

        return response()->json($users);
    }

    /**
     * Store a newly created Souscription in storage.
     */
    public function store(CreateSouscriptionRequest $request)
    {
        $request->request->add(['solde' => $request->input('montant_initial')]);
        $request->request->add(['souscripteur' => Auth::user()->id]);
        $input = $request->all();
       // =Auth::user()->id;

        $souscription = $this->souscriptionRepository->create($input);

        Flash::success('Souscription enregistré(e) avec succès.');

        return redirect(route('souscriptions.index'));
    }

    /**
     * Display the specified Souscription.
     */
    public function show($id)
    {
        $souscription = $this->souscriptionRepository->find($id);

        if (empty($souscription)) {
            Flash::error('Souscription not found');

            return redirect(route('souscriptions.index'));
        }

        return view('souscriptions.show')->with('souscription', $souscription);
    }

    /**
     * Show the form for editing the specified Souscription.
     */
    public function edit($id)
    {
        $souscription = $this->souscriptionRepository->find($id);

        if (empty($souscription)) {
            Flash::error('Souscription not found');

            return redirect(route('souscriptions.index'));
        }

        return view('souscriptions.edit')->with('souscription', $souscription);
    }

    /**
     * Update the specified Souscription in storage.
     */
    public function update($id, UpdateSouscriptionRequest $request)
    {
        $souscription = $this->souscriptionRepository->find($id);

        if (empty($souscription)) {
            Flash::error('Souscription not found');

            return redirect(route('souscriptions.index'));
        }

        $souscription = $this->souscriptionRepository->update($request->all(), $id);

        Flash::success('Souscription mis à jour avec succès.');

        return redirect(route('souscriptions.index'));
    }

    /**
     * Remove the specified Souscription from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $souscription = $this->souscriptionRepository->find($id);

        if (empty($souscription)) {
            Flash::error('Souscription not found');

            return redirect(route('souscriptions.index'));
        }

        $this->souscriptionRepository->delete($id);

        Flash::success('Souscription supprimé(e) avec succès. ');

        return redirect(route('souscriptions.index'));
    }
}
