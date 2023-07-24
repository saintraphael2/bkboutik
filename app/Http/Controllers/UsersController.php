<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\CreateUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Flash;
use App\Models\Liens;
use App\Models\User_liens;

class UsersController extends AppBaseController
{
    /** @var UsersRepository $usersRepository*/
    private $usersRepository;

    public function __construct(UsersRepository $usersRepo)
    {
        $this->usersRepository = $usersRepo;
    }

    /**
     * Display a listing of the Users.
     */
    public function index(UsersDataTable $usersDataTable)
    {
    return $usersDataTable->render('users.index');
    }


    /**
     * Show the form for creating a new Users.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created Users in storage.
     */
    public function store(CreateUsersRequest $request)
    {
        $request->request->add(['password' => Hash::make($request->input('password')) ]);
        $input = $request->all();
        //Hash::make($data['password'])
        $users = $this->usersRepository->create($input);

        Flash::success('Users enregistré(e) avec succès.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified Users.
     */
    public function show($id)
    {
        $users = $this->usersRepository->find($id);

        if (empty($users)) {
            Flash::error('Users not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('users', $users);
    }

    /**
     * Show the form for editing the specified Users.
     */
    public function edit($id)
    {
        $users = $this->usersRepository->find($id);
        $liens=Liens::all();
        if (empty($users)) {
            Flash::error('Users not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('users', $users)->with('liens',$liens);
    }

    /**
     * Update the specified Users in storage.
     */
    public function update($id, UpdateUsersRequest $request)
    {
        $users = $this->usersRepository->find($id);

        if (empty($users)) {
            Flash::error('Users not found');

            return redirect(route('users.index'));
        }
        $_liste_url=$request->input('item');
        $userLiens=User_liens::where('user',$id)->delete();
        if (isset($_liste_url)){
                
            for($i=0;$i<count($_liste_url);$i++){
                $userLien=new User_liens();
                $userLien->user=$id;
                $userLien->lien=$_liste_url[$i];
                $userLien->save();
            }
        }
       // $users = $this->usersRepository->update($request->all(), $id);

        Flash::success('Users mis à jour avec succès.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified Users from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $users = $this->usersRepository->find($id);

        if (empty($users)) {
            Flash::error('Users not found');

            return redirect(route('users.index'));
        }

        $this->usersRepository->delete($id);

        Flash::success('Users supprimé(e) avec succès. ');

        return redirect(route('users.index'));
    }
}
