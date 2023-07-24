<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User_liens;
use App\Models\Liens;
use Auth;

class roleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::user()){
            return redirect('/home');  
        }
        $routeName=$request->route()->getName();
        $routeNameArray=explode('.',$routeName);
        $userLien=new User_liens();
        $liens=json_decode(Liens::select(['libelle'])->get());
        if(!$this->checkJson($routeNameArray[0],$liens)){
            return $next($request);
        }else{
            if(isset($request->user()->id)){
                $arrayResult=json_decode($userLien->getRight($request->user()->id));
               // var_dump($routeNameArray[0]);exit;
                if($this->checkJson($routeNameArray[0],$arrayResult)){
                    return $next($request);
                }else return redirect()->back();
            }else{
                return redirect()->back();
               
            }
        }
        /*if(isset($request->user()->id)){
            $arrayResult=json_decode($userLien->getRight($request->user()->id));
            if($this->checkJson($routeNameArray[0],$arrayResult)){
                return $next($request);
            }else return redirect()->back();
        }else{
            return redirect()->back();
           
        }*/

        
    }
    function checkJson($href,$arr){
        $result=false;
        
        foreach($arr as $key=>$value){
           
            if(isset($value->libelle) && $value->libelle==$href){
                $result=true;
                break;
            }
        }
        return $result;
    }
}
