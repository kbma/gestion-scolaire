<?php

namespace App\Http\Controllers;

use App\Diplome;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Categorie;
use Illuminate\Support\Facades\Cache;



class CategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ShowForm()
    {
        $CatForm= Categorie::paginate(10);
        return view('Formation.ShowForm')->with('CatForm',$CatForm);
    }
    public function SaveCatForm(Request $request)
    {
        $valeur=$request::all();
        $AllCat=Categorie::all();
        $test = Categorie::where('CODE', '=', $valeur['CODE'])->first();
        if ($test === null) {
            // user doesn't exist
            $cat =new Categorie($valeur);

            $cat->save($valeur);
            return Redirect::route('ShowForm')->with('AllCat',$AllCat);
        }else{
            // user doesn exist
            $errors=array(['kjhkj'=>'khkjhkj']);
            return Redirect::route('ShowForm')->with('AllCat',$AllCat);
        }


    }

    public function UpdateCatForm(Request $request){

       $valeurs= $request::all();
        $cat = Categorie::where('id', '=', $valeurs['id']) ->first();

        if(isset($_POST['CODE'])) {$cat-> CODE = $valeurs['CODE'];}
        if(isset($_POST['LIBELLE'])) { $cat-> LIBELLE = $valeurs['LIBELLE'];}
        $cat->save();
        return Redirect::route('ShowForm');

    }
    public function DelCatForm(Request $request){

        $valeurs= $request::all();
        $cat = Categorie::where('id', '=', $valeurs['id']) ->first();
        $cat->delete();
        Diplome::where('CATEGORIE', '=',$valeurs['id'])->delete();
        return Redirect::route('ShowForm');


    }

    /************************************************************/

    public function ShowDiplome()
    {
        $CatForm= Categorie::all();
        $AllDip=Diplome::orderBy('LIBELLE')->paginate(10);
        return view('Formation.ShowDiplome')
            ->with('CatForm',$CatForm)
            ->with('AllDip',$AllDip);
    }
    public function SaveDiplome(Request $request)
    {
        $valeur=$request::all();
        $CatForm= Categorie::all();
        $AllDip=Diplome::all();
        $test = Diplome::where('CODE', '=', $valeur['CODE'])->first();
        if ($test === null) {
            // user doesn't exist
            $dip =new Diplome($valeur);
            $dip ->ACTIVE=0;
            $dip->save($valeur);

        }else{

        }
        return back();

    }

    public function UpdateDiplome(Request $request){

        $valeurs= $request::all();

       // dd($valeurs);
        $dip = Diplome::where('id', '=', $valeurs['id']) ->first();

        if(isset($_POST['CODE'])) {$dip-> CODE = $valeurs['CODE'];}
        if(isset($_POST['LIBELLE'])) { $dip-> LIBELLE = $valeurs['LIBELLE'];}
        if(isset($_POST['CATEGORIE'])) { $dip-> CATEGORIE = intval($valeurs['CATEGORIE']);}
        $dip->save();
        return back();


    }

    public function DelDiplome(Request $request){

        $valeurs= $request::all();
        $dip = Diplome::where('id', '=', $valeurs['id']) ->first();
        $dip->delete();
        return back();


    }

    public function getDiplomes(Request $request){
        $valeur =Request::all();
        // dd($valeur);
       return $listeDiplomesParCategorie = Diplome::where('CATEGORIE', '=',$valeur['cat'])->get();
    }


    public function DisableDiplome($id){
        Diplome::where('id', $id)
            ->update(['ACTIVE' => 0]);
        return back();
    }
    public function EnableDiplome($id){
        Diplome::where('id', $id)
            ->update(['ACTIVE' => 1]);
        return back();
    }


}
