<?php

namespace App\Http\Controllers;

use App\DataTables\User_liensDataTable;
use App\Http\Requests\CreateUser_liensRequest;
use App\Http\Requests\UpdateUser_liensRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\User_liensRepository;
use Illuminate\Http\Request;
use Flash;

class User_liensController extends AppBaseController
{
    /** @var User_liensRepository $userLiensRepository*/
    private $userLiensRepository;

    public function __construct(User_liensRepository $userLiensRepo)
    {
        $this->userLiensRepository = $userLiensRepo;
    }

    /**
     * Display a listing of the User_liens.
     */
    public function index(User_liensDataTable $userLiensDataTable)
    {
    return $userLiensDataTable->render('user_liens.index');
    }


    /**
     * Show the form for creating a new User_liens.
     */
    public function create()
    {
        return view('user_liens.create');
    }

    /**
     * Store a newly created User_liens in storage.
     */
    public function store(CreateUser_liensRequest $request)
    {
        $input = $request->all();

        $userLiens = $this->userLiensRepository->create($input);

        Flash::success('User Liens enregistré(e) avec succès.');

        return redirect(route('userLiens.index'));
    }

    /**
     * Display the specified User_liens.
     */
    public function show($id)
    {
        $userLiens = $this->userLiensRepository->find($id);

        if (empty($userLiens)) {
            Flash::error('User Liens not found');

            return redirect(route('userLiens.index'));
        }

        return view('user_liens.show')->with('userLiens', $userLiens);
    }

    /**
     * Show the form for editing the specified User_liens.
     */
    public function edit($id)
    {
        $userLiens = $this->userLiensRepository->find($id);

        if (empty($userLiens)) {
            Flash::error('User Liens not found');

            return redirect(route('userLiens.index'));
        }

        return view('user_liens.edit')->with('userLiens', $userLiens);
    }

    /**
     * Update the specified User_liens in storage.
     */
    public function update($id, UpdateUser_liensRequest $request)
    {
        $userLiens = $this->userLiensRepository->find($id);

        if (empty($userLiens)) {
            Flash::error('User Liens not found');

            return redirect(route('userLiens.index'));
        }

        $userLiens = $this->userLiensRepository->update($request->all(), $id);

        Flash::success('User Liens mis à jour avec succès.');

        return redirect(route('userLiens.index'));
    }

    /**
     * Remove the specified User_liens from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $userLiens = $this->userLiensRepository->find($id);

        if (empty($userLiens)) {
            Flash::error('User Liens not found');

            return redirect(route('userLiens.index'));
        }

        $this->userLiensRepository->delete($id);

        Flash::success('User Liens supprimé(e) avec succès. ');

        return redirect(route('userLiens.index'));
    }
}
