<?php

namespace App\Http\Controllers;

use App\DataTables\VenteDataTable;
use App\Http\Requests\CreateVenteRequest;
use App\Http\Requests\UpdateVenteRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\VenteRepository;
use App\Models\Client;
use Illuminate\Http\Request;
use Flash;
use Auth;
use App\Models\DetailVente;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Repositories\StockRepository;
use App\DataTables\DetailVenteDataTable;
use App\Repositories\ClientRepository;
use App\Repositories\ParametreRepository;

class VenteController extends AppBaseController
{
    /** @var VenteRepository $venteRepository*/
    private $venteRepository;
    private $clientRepository;
    private $parametreRepository;
    public function __construct(ClientRepository $clientRepo, StockRepository $stockRepo, VenteRepository $venteRepo, ParametreRepository $parametreRepo)
    {
        $this->venteRepository = $venteRepo;
        $this->stockRepository = $stockRepo;
        $this->clientRepository = $clientRepo;
        $this->parametreRepository = $parametreRepo;
    }

    /**
     * Display a listing of the Vente.
     */
    public function index(VenteDataTable $venteDataTable)
    {
         $venteDataTable->comptable = Auth::user()->comptable;
        return $venteDataTable->render('ventes.index');
    }


    /**
     * Show the form for creating a new Vente.
     */
    public function create()
    {
        $clients = Client::pluck('nom_client', 'id');
        return view('ventes.create')->with(['clients' => $clients]);
    }
 public function cheminVentes(Request $request)
    {
        $vente = $this->venteRepository->find($request->vente);


        return response()->json(['chemin' => $vente->code . '.pdf']);
    }
    /**
     * Store a newly created Vente in storage.
     */
    public function store(CreateVenteRequest $request)
    {
        $request->request->add(['caissier' => Auth::user()->id]);
        $input = $request->all();

        $vente = $this->venteRepository->create($input);

        $client = $this->clientRepository->find($vente->client);
        $client->solde -= $vente->ttc;
        $client->save();

        if (count($request->input('produits')) > 0) {
            for ($i = 0; $i < count($request->input('produits')); $i++) {
                $detailVente = new DetailVente();

                $stock = $this->stockRepository->find($request->input('produits')[$i]);
                $stock->quantite = $stock->quantite - $request->input('quantite')[$i];
                $stock->qte_payee = $stock->qte_payee + $request->input('quantite')[$i];
                $stock->save();

                $detailVente->vente = $vente->id;
                $detailVente->stock = $request->input('produits')[$i];
                $detailVente->quantite = $request->input('quantite')[$i];
                $detailVente->prix = $request->input('prix')[$i];
                $detailVente->ttc = $request->input('quantite')[$i] * $request->input('prix')[$i];
                $detailVente->produit_boutique = $stock->produit_boutique;
                $detailVente->save();
            }

        }

        
        Flash::success('Vente enregistré(e) avec succès.');
          $this::print($vente->id);
        return redirect(route('vente', $vente->id));

        //return redirect(route('ventes.index'));
    }
    public function print($id)
    {
        ini_set('max_execution_time', 120);
        //dd($id);
        // $demande = $this->demandeRepository->find($id);
        $parametre = $this->parametreRepository->find(1);
        $produits = DetailVente::where('vente', $id)->get();
        $vente = $this->venteRepository->find($id);

        $data = [
            'vente' => $vente,
            'parametre' => $parametre,
            'produits' => $produits
        ];
   
        //$pdf = Pdf::loadView('boutiques.caisse', $data);

        // return $pdf->stream('recu.pdf');
        $pdfRecu = PDF::loadView('ventes.caisse', $data)->setPaper('a4', 'portrait')->setWarnings(false);

 //dd($pdfRecu);
        $filename = $vente->code . '.pdf';
        //Storage::put('public/recus/'.$contrat->numero.'/'.$filename, $pdfRecu->output());
        Storage::disk('uploads')->put('vente/' . $filename, $pdfRecu->output());
    }
    /**
     * Display the specified Vente.
     */
    public function show($id)
    {
        $vente = $this->venteRepository->find($id);
        $detailVenteDataTable = new DetailVenteDataTable();
        $detailVenteDataTable->vente = $vente->id;
        if (empty($vente)) {
            Flash::error('Vente not found');

            return redirect(route('ventes.index'));
        }
        return $detailVenteDataTable->render('ventes.show', compact('vente', 'id'));
        //$detailVenteDataTable->render('ventes.show');
        return view('ventes.show')->with('vente', $vente);
    }

    /**
     * Show the form for editing the specified Vente.
     */
    public function edit($id)
    {
        $vente = $this->venteRepository->find($id);

        if (empty($vente)) {
            Flash::error('Vente not found');

            return redirect(route('ventes.index'));
        }

        return view('ventes.edit')->with('vente', $vente);
    }

    /**
     * Update the specified Vente in storage.
     */
    public function update($id, UpdateVenteRequest $request)
    {
        $vente = $this->venteRepository->find($id);

        if (empty($vente)) {
            Flash::error('Vente not found');

            return redirect(route('ventes.index'));
        }

        $vente = $this->venteRepository->update($request->all(), $id);

        Flash::success('Vente mis à jour avec succès.');

        return redirect(route('ventes.index'));
    }

    /**
     * Remove the specified Vente from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $vente = $this->venteRepository->find($id);

        if (empty($vente)) {
            Flash::error('Vente not found');

            return redirect(route('ventes.index'));
        }

        $this->venteRepository->delete($id);

        Flash::success('Vente supprimé(e) avec succès. ');

        return redirect(route('ventes.index'));
    }
}
