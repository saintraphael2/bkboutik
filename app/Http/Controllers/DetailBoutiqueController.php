<?php

namespace App\Http\Controllers;

use App\DataTables\DetailBoutiqueDataTable;
use App\Http\Requests\CreateDetailBoutiqueRequest;
use App\Http\Requests\UpdateDetailBoutiqueRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\DetailBoutiqueRepository;
use Illuminate\Http\Request;
use Flash;

class DetailBoutiqueController extends AppBaseController
{
    /** @var DetailBoutiqueRepository $detailBoutiqueRepository*/
    private $detailBoutiqueRepository;

    public function __construct(DetailBoutiqueRepository $detailBoutiqueRepo)
    {
        $this->detailBoutiqueRepository = $detailBoutiqueRepo;
    }

    /**
     * Display a listing of the DetailBoutique.
     */
    public function index(DetailBoutiqueDataTable $detailBoutiqueDataTable)
    {
    return $detailBoutiqueDataTable->render('detail_Boutiques.index');
    }


    /**
     * Show the form for creating a new DetailBoutique.
     */
    public function create()
    {
        return view('detail_Boutiques.create');
    }

    /**
     * Store a newly created DetailBoutique in storage.
     */
    public function store(CreateDetailBoutiqueRequest $request)
    {
        $input = $request->all();

        $detailBoutique = $this->detailBoutiqueRepository->create($input);

        Flash::success('Detail Boutique enregistré(e) avec succès.');

        return redirect(route('detail_Boutiques.index'));
    }

    /**
     * Display the specified DetailBoutique.
     */
    public function show($id)
    {
        $detailBoutique = $this->detailBoutiqueRepository->find($id);

        if (empty($detailBoutique)) {
            Flash::error('Detail Boutique not found');

            return redirect(route('detail_Boutiques.index'));
        }

        return view('detail_Boutiques.show')->with('detailBoutique', $detailBoutique);
    }

    /**
     * Show the form for editing the specified DetailBoutique.
     */
    public function edit($id)
    {
        $detailBoutique = $this->detailBoutiqueRepository->find($id);

        if (empty($detailBoutique)) {
            Flash::error('Detail Boutique not found');

            return redirect(route('detail_Boutiques.index'));
        }

        return view('detail_Boutiques.edit')->with('detailBoutique', $detailBoutique);
    }

    /**
     * Update the specified DetailBoutique in storage.
     */
    public function update($id, UpdateDetailBoutiqueRequest $request)
    {
        $detailBoutique = $this->detailBoutiqueRepository->find($id);

        if (empty($detailBoutique)) {
            Flash::error('Detail Boutique not found');

            return redirect(route('detail_Boutiques.index'));
        }

        $detailBoutique = $this->detailBoutiqueRepository->update($request->all(), $id);

        Flash::success('Detail Boutique mis à jour avec succès.');

        return redirect(route('detail_Boutiques.index'));
    }

    /**
     * Remove the specified DetailBoutique from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detailBoutique = $this->detailBoutiqueRepository->find($id);

        if (empty($detailBoutique)) {
            Flash::error('Detail Boutique not found');

            return redirect(route('detail_Boutiques.index'));
        }

        $this->detailBoutiqueRepository->delete($id);

        Flash::success('Detail Boutique supprimé(e) avec succès. ');

        return redirect(route('detail_Boutiques.index'));
    }
}
