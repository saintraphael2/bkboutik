<?php

namespace App\Http\Controllers;

use App\Models\Conducteur;
use App\Models\Contrat;
use App\Models\Moto;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Repositories\ParametreRepository;

use Ichtrojan\Otp\Otp;


use Session;

use App\Models\Connexion;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $connexion = Connexion::where(['identifier'=>Auth::user()->email])->first();

        if($connexion!=null && $connexion->validity==1){
            


        return view('home');


       
           
        }else{
            Auth::logout();
            return redirect('/login');
        }
    }

    public function otp()
    {
        
        return view('auth.otp')->with('email',Session::get('email'))->with('emailc',Session::get('emailc'));
    }

    public function validationOtp(Request $request){
        // dd($request->otp);
        $parametreRepository = new ParametreRepository;

        $parametre = $parametreRepository->find(1);
         $result=(new Otp)->validate($parametre["mailotp"], $request->otp);
        
         if($result->status==true){
             $connexion = Connexion::where(['identifier'=>Auth::user()->email])->first();
             $connexion->validity=1;
                 $connexion->save();
              return redirect("/");
         }
            
         elseif(trim($result->status)==false)  {
            // $errors = new MessageBag; 
             //$errors = new MessageBag(['password' => ['Code Invalide ou expiré.']]);
             Auth::logout();
             return redirect('/login')->withErrors(['email' => 'Code Invalide ou expiré. Veuillez vous reconnecter!'])->with( ['message' => 'test code'] );
         }
       
     }
}
