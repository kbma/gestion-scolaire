<?php

namespace App\Http\Controllers;


use App\ModeForma;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class ModeFormaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function AddModeForma(){
        //$AllCatPres=Mode::all();
        return view('ModeForma.addModeForma');
    }

    public function SaveModeForma(Request $request)
    {
        $valeur=$request::all();


        $AllModeForma=ModeForma::all();
        $test = ModeForma::where('CODE', '=', $valeur['CODE'])->first();
        if ($test === null) {
            // user doesn't exist
            $mf =new ModeForma($valeur);
            $mf-> CODE = strtoupper($valeur['CODE']);
            $mf-> LIBELLE = strtoupper($valeur['LIBELLE']);
            $mf-> ACTIVE = 1;
            $mf->save($valeur);
            return Redirect::route('ShowModeForma')->with('AllModeForma',$AllModeForma);
        }else{
            // user doesn exist
            return Redirect::route('ShowModeForma')->with('AllModeForma',$AllModeForma);
        }


    }

    public function ShowModeForma()
    {
        $AllModeForma= ModeForma::paginate(10);
        return view('ModeForma.ShowModeForma')->with('AllModeForma',$AllModeForma);
    }

    public  function UpdateModeForma(Request $request){

        $valeurs= $request::all();


        $ModeForma = ModeForma::where('id', '=', $valeurs['id']) ->first();
        if(isset($_POST['CODE'])) {$ModeForma-> CODE = $valeurs['CODE'];}
        if(isset($_POST['LIBELLE'])) { $ModeForma-> LIBELLE = $valeurs['LIBELLE'];}

        if(isset($_POST['ACTIVE'])) { $ModeForma-> ACTIVE = $valeurs['ACTIVE'];}

        $ModeForma-> CODE = strtoupper($valeurs['CODE']);
        $ModeForma-> LIBELLE = strtoupper($valeurs['LIBELLE']);
        $ModeForma->save();
        return Redirect::route('ShowModeForma');

    }

    public function DelModeForma(Request $request){

        $valeurs= $request::all();
        $cat = ModeForma::where('id', '=', $valeurs['id']) ->first();
        $cat->delete();
        return Redirect::route('ShowModeForma');

    }

    public function DisableModeForma($id){
        ModeForma::where('id', $id)
            ->update(['ACTIVE' => 0]);
        return Redirect::route('ShowModeForma');
    }
    public function EnableModeForma($id){
        ModeForma::where('id', $id)
            ->update(['ACTIVE' => 1]);
        return Redirect::route('ShowModeForma');
    }
}
