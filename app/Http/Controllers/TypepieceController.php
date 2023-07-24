<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTypepieceRequest;
use App\Http\Requests\UpdateTypepieceRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\TypepieceRepository;
use Illuminate\Http\Request;
use Flash;

class TypepieceController extends AppBaseController
{
    /** @var TypepieceRepository $typepieceRepository*/
    private $typepieceRepository;

    public function __construct(TypepieceRepository $typepieceRepo)
    {
        $this->typepieceRepository = $typepieceRepo;
    }

    /**
     * Display a listing of the Typepiece.
     */
    public function index(Request $request)
    {
        $typepieces = $this->typepieceRepository->paginate(10);

        return view('typepieces.index')
            ->with('typepieces', $typepieces);
    }

    /**
     * Show the form for creating a new Typepiece.
     */
    public function create()
    {
        return view('typepieces.create');
    }

    /**
     * Store a newly created Typepiece in storage.
     */
    public function store(CreateTypepieceRequest $request)
    {
        $input = $request->all();

        $typepiece = $this->typepieceRepository->create($input);

        Flash::success('Typepiece enregistré(e) avec succès.');

        return redirect(route('typepieces.index'));
    }

    /**
     * Display the specified Typepiece.
     */
    public function show($id)
    {
        $typepiece = $this->typepieceRepository->find($id);

        if (empty($typepiece)) {
            Flash::error('Typepiece not found');

            return redirect(route('typepieces.index'));
        }

        return view('typepieces.show')->with('typepiece', $typepiece);
    }

    /**
     * Show the form for editing the specified Typepiece.
     */
    public function edit($id)
    {
        $typepiece = $this->typepieceRepository->find($id);

        if (empty($typepiece)) {
            Flash::error('Typepiece not found');

            return redirect(route('typepieces.index'));
        }

        return view('typepieces.edit')->with('typepiece', $typepiece);
    }

    /**
     * Update the specified Typepiece in storage.
     */
    public function update($id, UpdateTypepieceRequest $request)
    {
        $typepiece = $this->typepieceRepository->find($id);

        if (empty($typepiece)) {
            Flash::error('Typepiece not found');

            return redirect(route('typepieces.index'));
        }

        $typepiece = $this->typepieceRepository->update($request->all(), $id);

        Flash::success('Typepiece mis à jour avec succès.');

        return redirect(route('typepieces.index'));
    }

    /**
     * Remove the specified Typepiece from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $typepiece = $this->typepieceRepository->find($id);

        if (empty($typepiece)) {
            Flash::error('Typepiece not found');

            return redirect(route('typepieces.index'));
        }

        $this->typepieceRepository->delete($id);

        Flash::success('Typepiece supprimé(e) avec succès. ');

        return redirect(route('typepieces.index'));
    }
}
