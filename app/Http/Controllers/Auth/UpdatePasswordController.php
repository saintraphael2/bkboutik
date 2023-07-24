<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAuthPasswordRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
//use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Auth;
use Laracasts\Flash\Flash;

class UpdatePasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function showUpdateForm()
    {
        return view('auth.passwords.update');
    }

    /**
     * Update the specified Caution in storage.
     */
    public function update(UpdateAuthPasswordRequest $request)
    {
        $user = Auth::user();

        if (empty($user)) {
            Flash::error('Utilisateur non trouvé.');

        } else if(!Hash::check($request->password, $user->password)){
            //dd("bad password");
            Flash::error('Mauvais mot de passe');

        } else {
            //dd("good password");
            $user->password = Hash::make($request->new_password);
            $user->save();
    
            Flash::success('Mot de passe mis à jour avec succès.');
        }

        //dd("yes, update",$request->password, $request->new_password, $request);
        
        return redirect(route('password.my_edit'));
    }

}
