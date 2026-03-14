<?php

namespace App\Http\Controllers;

use App\DataTables\DepotDataTable;
use App\Http\Requests\CreateDepotRequest;
use App\Http\Requests\UpdateDepotRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\DepotRepository;
use Illuminate\Http\Request;
use Flash;
use App\Models\Client;
use Auth;
use App\Repositories\ClientRepository;
use App\Repositories\ParametreRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class DepotController extends AppBaseController
{
    /** @var DepotRepository $depotRepository*/
    private $depotRepository;
     private $clientRepository;
     private $parametreRepository;

    public function __construct(ClientRepository $clientRepo,DepotRepository $depotRepo, ParametreRepository $parametreRepo)
    {
        $this->depotRepository = $depotRepo;
        $this->clientRepository = $clientRepo;
        $this->parametreRepository = $parametreRepo;
    }

    /**
     * Display a listing of the Depot.
     */
    public function index(DepotDataTable $depotDataTable)
    {
         $depotDataTable->comptable = Auth::user()->comptable;
    return $depotDataTable->render('depots.index');
    }


    /**
     * Show the form for creating a new Depot.
     */
    public function create()
    {
        $clients = Client::pluck('nom_client', 'id');
        return view('depots.create')->with(['clients' => $clients]);
    }

    /**
     * Store a newly created Depot in storage.
     */
    public function store(CreateDepotRequest $request)
    {
         $request->request->add(['caissier' => Auth::user()->id]);
        $input = $request->all();

        $depot = $this->depotRepository->create($input);

         $client = $this->clientRepository->find($depot->client);
        $client->solde += $depot->montant;
        $client->save();
$this::print($depot->id);
        Flash::success('Depot enregistré(e) avec succès.');

        //return redirect(route('depots.index'));
         return redirect(route('depot', $depot->id));
    }

    public function print($id)
    {
       
        //dd($id);
        // $demande = $this->demandeRepository->find($id);
        $parametre = $this->parametreRepository->find(1);
       
        $depot= $this->depotRepository->find($id);

        $data = [
            'depot' => $depot,
            'parametre' => $parametre,
           
        ];
   
        //$pdf = Pdf::loadView('boutiques.caisse', $data);

        // return $pdf->stream('recu.pdf');
        $pdfRecu = PDF::loadView('depots.caisse', $data)->setPaper('a4', 'portrait')->setWarnings(false);

 //dd($pdfRecu);
        $filename = $depot->code . '.pdf';
        //Storage::put('public/recus/'.$contrat->numero.'/'.$filename, $pdfRecu->output());
        Storage::disk('uploads')->put('depot/' . $filename, $pdfRecu->output());
    }
    
    public function cheminDepot(Request $request)
    {
        $depot = $this->depotRepository->find($request->depot);


        return response()->json(['chemin' => $depot->code . '.pdf']);
    }
    /**
     * Display the specified Depot.
     */
    public function show($id)
    {
        $depot = $this->depotRepository->find($id);

        if (empty($depot)) {
            Flash::error('Depot not found');

            return redirect(route('depots.index'));
        }

        return view('depots.show')->with('depot', $depot);
    }

    /**
     * Show the form for editing the specified Depot.
     */
    public function edit($id)
    {
        $depot = $this->depotRepository->find($id);

        if (empty($depot)) {
            Flash::error('Depot not found');

            return redirect(route('depots.index'));
        }

        return view('depots.edit')->with('depot', $depot);
    }

    /**
     * Update the specified Depot in storage.
     */
    public function update($id, UpdateDepotRequest $request)
    {
        $depot = $this->depotRepository->find($id);

        if (empty($depot)) {
            Flash::error('Depot not found');

            return redirect(route('depots.index'));
        }

        $depot = $this->depotRepository->update($request->all(), $id);

        Flash::success('Depot mis à jour avec succès.');

        return redirect(route('depots.index'));
    }

    /**
     * Remove the specified Depot from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $depot = $this->depotRepository->find($id);

        if (empty($depot)) {
            Flash::error('Depot not found');

            return redirect(route('depots.index'));
        }

        $this->depotRepository->delete($id);

        Flash::success('Depot supprimé(e) avec succès. ');

        return redirect(route('depots.index'));
    }
}
