<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\ModePayement;

class ModePayementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function AddModePayement(){
        //$AllCatPres=Mode::all();
        return view('ModePayement.addModePayement');
    }

    public function SaveModePayement(Request $request)
    {
        $valeur=$request::all();


        $AllModePayement=ModePayement::all();
        $test = ModePayement::where('CODE', '=', $valeur['CODE'])->first();
        if ($test === null) {
            // user doesn't exist
            $mf =new ModePayement($valeur);
            $mf-> CODE = strtoupper($valeur['CODE']);
            $mf-> LIBELLE = strtoupper($valeur['LIBELLE']);
            $mf-> ACTIVE = 1;
            $mf->save($valeur);
            return Redirect::route('ShowModePayement')->with('AllModePayement',$AllModePayement);
        }else{
            // user doesn exist
            return Redirect::route('ShowModePayement')->with('AllModePayement',$AllModePayement);
        }


    }

    public function ShowModePayement()
    {
        $AllModePayement= ModePayement::paginate(10);
        return view('ModePayement.ShowModePayement')->with('AllModePayement',$AllModePayement);
    }

    public  function UpdateModePayement(Request $request){

        $valeurs= $request::all();


        $ModePayement = ModePayement::where('id', '=', $valeurs['id']) ->first();
        if(isset($_POST['CODE'])) {$ModePayement-> CODE = $valeurs['CODE'];}
        if(isset($_POST['LIBELLE'])) { $ModePayement-> LIBELLE = $valeurs['LIBELLE'];}

        if(isset($_POST['ACTIVE'])) { $ModePayement-> ACTIVE = $valeurs['ACTIVE'];}

        $ModePayement-> CODE = strtoupper($valeurs['CODE']);
        $ModePayement-> LIBELLE = strtoupper($valeurs['LIBELLE']);
        $ModePayement->save();
        return Redirect::route('ShowModePayement');

    }

    public function DelModePayement(Request $request){

        $valeurs= $request::all();
        $cat = ModePayement::where('id', '=', $valeurs['id']) ->first();
        $cat->delete();
        return Redirect::route('ShowModePayement');

    }

    public function DisableModePayement($id){
        ModePayement::where('id', $id)
            ->update(['ACTIVE' => 0]);
        return Redirect::route('ShowModePayement');
    }
    public function EnableModePayement($id){
        ModePayement::where('id', $id)
            ->update(['ACTIVE' => 1]);
        return Redirect::route('ShowModePayement');
    }
}
