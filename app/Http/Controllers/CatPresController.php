<?php

namespace App\Http\Controllers;
use App\prestataire;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\CatPres;

class CatPresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ShowCatPres()
    {
        $AllCatPres= CatPres::paginate(10);
        return view('CatPres.ShowCatPres')->with('AllCatPres',$AllCatPres);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function SaveCatPres(Request $request)
    {
        $valeur=$request::all();
        $AllCatPres=CatPres::all();
        $test = CatPres::where('CODE', '=', $valeur['CODE'])->first();
        if ($test === null) {
            // user doesn't exist
            $cat =new CatPres($valeur);
            $cat->save($valeur);
           // return Redirect::route('ShowCatPres')->with('AllCatPres',$AllCatPres);
            return back();
        }else{
            return back();

        }
    }

    public function UpdateCatPres(Request $request){

        $valeurs= $request::all();
        $cat = CatPres::where('id', '=', $valeurs['id']) ->first();

        if(isset($_POST['CODE'])) {$cat-> CODE = $valeurs['CODE'];}
        if(isset($_POST['LIBELLE'])) { $cat-> LIBELLE = $valeurs['LIBELLE'];}
        $cat->save();
        return back();

    }
    public function DelCatPres(Request $request){

        $valeurs= $request::all();
        $cat = CatPres::where('id', '=', $valeurs['id']) ->first();
        $cat->delete();
       // il faut ajouter
        prestataire::where('CATEGORIE', '=',$valeurs['id'])->delete();
        return back();


    }

        public  function AddPres(){
            $AllCatPres=CatPres::all();
            return view('CatPres.addPres')->with('AllCatPres',$AllCatPres);;
        }

    public function SavePres(Request $request)
    {
        $valeur=$request::all();
        $AllPres=prestataire::all();
        $test = prestataire::where('CODE', '=', $valeur['CODE'])->first();
        if ($test === null) {
            // user doesn't exist
            $pres =new prestataire($valeur);
            $pres->ACTIVE=1;
            $pres->save($valeur);
            return Redirect::route('ShowPres')->with('AllPres',$AllPres);
        }else{
            // user doesn exist

            //return Redirect::route('ShowPres')->with('AllPres',$AllPres);
            return back()->with('msg', 'Opération effectuée avec succès.');
        }


    }

    public function ShowPres()
    {
        $AllPres= prestataire::paginate(10);
        $AllCatPres=CatPres::all();
        return view('CatPres.ShowPres')->with('AllPres',$AllPres)->with('AllCatPres',$AllCatPres);
    }

        public  function UpdatePres(Request $request){

            $valeurs= $request::all();
            $pres = prestataire::where('id', '=', $valeurs['id']) ->first();
           // dd($pres);
            if(isset($_POST['CODE'])) {$pres-> CODE = $valeurs['CODE'];}
            if(isset($_POST['NOM'])) { $pres-> NOM = $valeurs['NOM'];}
            if(isset($_POST['CATEGORIE'])) { $pres-> CATEGORIE = $valeurs['CATEGORIE'];}
            if(isset($_POST['ADRESSE'])) { $pres-> ADRESSE = $valeurs['ADRESSE'];}
            if(isset($_POST['VILLE'])) { $pres-> VILLE = $valeurs['VILLE'];}
            if(isset($_POST['CP'])) { $pres-> CP = $valeurs['CP'];}
            if(isset($_POST['TEL'])) { $pres-> TEL = $valeurs['TEL'];}
            if(isset($_POST['EMAIL'])) { $pres-> EMAIL = $valeurs['EMAIL'];}
            if(isset($_POST['OBSERVATION'])) { $pres-> OBSERVATION = $valeurs['OBSERVATION'];}


            $pres->save();
            return back()->with('msg', 'Opération effectuée avec succès.');

        }

    public function DelPres(Request $request){

        $valeurs= $request::all();
        $cat = prestataire::where('id', '=', $valeurs['id']) ->first();
        $cat->delete();

        $cat->save();
        return back()->with('msg', 'Opération effectuée avec succès.');


    }

    public function DisablePrestataire($id){
        prestataire::where('id', $id)
            ->update(['ACTIVE' => 0]);
        return back();
    }
    public function EnablePrestataire($id){
        prestataire::where('id', $id)
            ->update(['ACTIVE' => 1]);
        return back();
    }


}
