<?php

namespace App\Http\Controllers;

use App\Groupe;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class GroupeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function AddGroupe(){
        //$AllCatPres=Mode::all();
        return view('Groupe.addGroupe');
    }

    public function SaveGroupe(Request $request)
    {
        $valeur=$request::all();
        $AllGroupe=Groupe::all();
        $test = Groupe::where('CODE', '=', $valeur['CODE'])->first();
        if ($test === null) {
            // user doesn't exist
            $mf =new Groupe($valeur);
            $mf-> CODE = strtoupper($valeur['CODE']);
            $mf-> LIBELLE = strtoupper($valeur['LIBELLE']);

            $mf-> ACTIVE = 1;
            $mf->save($valeur);
            return Redirect::route('ShowGroupe')->with('AllGroupe',$AllGroupe);
        }else{
            // user doesn exist
            return Redirect::route('ShowGroupe')->with('AllGroupe',$AllGroupe);
        }


    }

    public function ShowGroupe()
    {
        $AllGroupe= Groupe::paginate(10);
        return view('Groupe.ShowGroupe')->with('AllGroupe',$AllGroupe);
    }

    public  function UpdateGroupe(Request $request){

        $valeurs= $request::all();


        $Groupe = Groupe::where('id', '=', $valeurs['id']) ->first();
        if(isset($_POST['CODE'])) {$Groupe-> CODE = $valeurs['CODE'];}
        if(isset($_POST['LIBELLE'])) { $Groupe-> LIBELLE = strtoupper($valeurs['LIBELLE']);}


        if(isset($_POST['ACTIVE'])) { $Groupe-> ACTIVE = $valeurs['ACTIVE'];}

        $Groupe-> CODE = $valeurs['CODE'];
        $Groupe-> LIBELLE =strtoupper($valeurs['LIBELLE']);

        $Groupe->save();
        return Redirect::route('ShowGroupe');

    }

    public function DelGroupe(Request $request){

        $valeurs= $request::all();
        $cat = Groupe::where('id', '=', $valeurs['id']) ->first();
        $cat->delete();
        return Redirect::route('ShowGroupe');

    }

    public function DisableGroupe($id){
        Groupe::where('id', $id)
            ->update(['ACTIVE' => 0]);
        return Redirect::route('ShowGroupe');
    }
    public function EnableGroupe($id){
        Groupe::where('id', $id)
            ->update(['ACTIVE' => 1]);
        return Redirect::route('ShowGroupe');
    }
}
