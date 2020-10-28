<?php

namespace App\Http\Controllers;

use App\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function AddSession(){
        //$AllCatPres=Mode::all();
        return view('Session.addSession');
    }

    public function SaveSession(Request $request)
    {
        $valeur=$request::all();
        $AllSession=Session::all();
        $test = Session::where('CODE', '=', $valeur['CODE'])->first();
        if ($test === null) {
            // user doesn't exist
            $mf =new Session($valeur);
            $mf-> CODE = strtoupper($valeur['CODE']);
            $mf-> LIBELLE = strtoupper($valeur['LIBELLE']);
            $mf-> START = $valeur['START'];
            $mf-> END = $valeur['END'];
            $mf-> ACTIVE = 1;
            $mf->save($valeur);
            return Redirect::route('ShowSession')->with('AllSession',$AllSession);
        }else{
            // user doesn exist
            return Redirect::route('ShowSession')->with('AllSession',$AllSession);
        }


    }

    public function ShowSession()
    {
        $AllSession= Session::paginate(10);
        return view('Session.ShowSession')->with('AllSession',$AllSession);
    }

    public  function UpdateSession(Request $request){

        $valeurs= $request::all();


        $ModeSession = Session::where('id', '=', $valeurs['id']) ->first();
        if(isset($_POST['CODE'])) {$ModeSession-> CODE = $valeurs['CODE'];}
        if(isset($_POST['LIBELLE'])) { $ModeSession-> LIBELLE = strtoupper($valeurs['LIBELLE']);}

        if(isset($_POST['START'])) { $ModeSession-> START = $valeurs['START'];}
        if(isset($_POST['END'])) { $ModeSession-> END = $valeurs['END'];}

        if(isset($_POST['ACTIVE'])) { $ModeSession-> ACTIVE = $valeurs['ACTIVE'];}

        $ModeSession-> CODE = $valeurs['CODE'];
        $ModeSession-> LIBELLE =strtoupper($valeurs['LIBELLE']);
        $ModeSession-> START =$valeurs['START'];
        $ModeSession-> END =$valeurs['END'];
        $ModeSession->save();
        return Redirect::route('ShowSession');

    }

    public function DelSession(Request $request){

        $valeurs= $request::all();
        $cat = Session::where('id', '=', $valeurs['id']) ->first();
        $cat->delete();
        return Redirect::route('ShowSession');

    }

    public function DisableSession($id){
        Session::where('id', $id)
            ->update(['ACTIVE' => 0]);
        return back();
    }
    public function EnableSession($id){
        Session::where('id', $id)
            ->update(['ACTIVE' => 1]);
        return back();
    }
}
