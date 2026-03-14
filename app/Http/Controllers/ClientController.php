<?php

namespace App\Http\Controllers;

use App\DataTables\ClientDataTable;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Flash;
use DB;
use Carbon\Carbon;
use App\Models\Depot;
use App\Models\Vente;

class ClientController extends AppBaseController
{
    /** @var ClientRepository $clientRepository*/
    private $clientRepository;

    public function __construct(ClientRepository $clientRepo)
    {
        $this->clientRepository = $clientRepo;
    }

    /**
     * Display a listing of the Client.
     */
    public function index(ClientDataTable $clientDataTable)
    {
    return $clientDataTable->render('clients.index');
    }


    /**
     * Show the form for creating a new Client.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created Client in storage.
     */
    public function store(CreateClientRequest $request)
    {
        $request->request->add(['solde' =>0]);
        $input = $request->all();

        $client = $this->clientRepository->create($input);

        Flash::success('Client enregistré(e) avec succès.');

        return redirect(route('clients.index'));
    }

    /**
     * Display the specified Client.
     */

    public function clientSituation(Request $request)
    {
        $id = $request->id;
        $from = Carbon::parse($request->fromDate)->format('Y-m-d');
        $to = Carbon::parse($request->toDate)->format('Y-m-d');
       $client = $this->clientRepository->find($id);

        $entres = Depot::selectRaw("
        DATE(created_at) as date,code as reference,
        montant as depot,
        0 as achat
    ")
            ->where('client', $id)->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
            ;

        $sortie = Vente::selectRaw("
        DATE(created_at) as date, code as reference,
        0 as depot,
        ttc as achat
    ")
            ->where('client', $id)->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
            ;

            

        $movements = $entres
            ->unionAll($sortie);

        $results = DB::query()
            ->fromSub($movements, 'm')
            ->orderBy('date')
            ->get();


        if (empty($client)) {
            Flash::error('Client not found');

            return redirect(route('clients.index'));
        }

        return view('clients.show')->with(['from'=>$from, 'to'=>$to,'results'=>$results])->with('client', $client);
        
        }


    public function show($id)
    {
        $client = $this->clientRepository->find($id);

         $from = Carbon::now()->startOfMonth()->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

         $entres = Depot::selectRaw("
        DATE(created_at) as date,code as reference,
        montant as depot,
        0 as achat
    ")
            ->where('client', $id)->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
            ;

        $sortie = Vente::selectRaw("
        DATE(created_at) as date, code as reference,
        0 as depot,
        ttc as achat
    ")
            ->where('client', $id)->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
            ;

            

        $movements = $entres
            ->unionAll($sortie);

        $results = DB::query()
            ->fromSub($movements, 'm')
            ->orderBy('date')
            ->get();


        if (empty($client)) {
            Flash::error('Client not found');

            return redirect(route('clients.index'));
        }

        return view('clients.show')->with(['from'=>$from, 'to'=>$to,'results'=>$results])->with('client', $client);
    }

    /**
     * Show the form for editing the specified Client.
     */
    public function edit($id)
    {
        $client = $this->clientRepository->find($id);

        if (empty($client)) {
            Flash::error('Client not found');

            return redirect(route('clients.index'));
        }

        return view('clients.edit')->with('client', $client);
    }

    /**
     * Update the specified Client in storage.
     */
    public function update($id, UpdateClientRequest $request)
    {
        $client = $this->clientRepository->find($id);

        if (empty($client)) {
            Flash::error('Client not found');

            return redirect(route('clients.index'));
        }

        $client = $this->clientRepository->update($request->all(), $id);

        Flash::success('Client mis à jour avec succès.');

        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified Client from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $client = $this->clientRepository->find($id);

        if (empty($client)) {
            Flash::error('Client not found');

            return redirect(route('clients.index'));
        }

        $this->clientRepository->delete($id);

        Flash::success('Client supprimé(e) avec succès. ');

        return redirect(route('clients.index'));
    }
}
