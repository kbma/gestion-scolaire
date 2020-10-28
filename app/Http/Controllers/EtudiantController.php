<?php

namespace App\Http\Controllers;

use App\Register;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Etudiant;
use App\Categorie;
use Illuminate\Support\Facades\DB;
class EtudiantController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function AddStudent()
    {
        $AllCat=Categorie::all();
        return view('Etudiant.add')->with(['AllCat'=>$AllCat]);
    }

    public function SaveStudent(Request $request)
    {
        $allStudents= Etudiant::paginate(10);
        $valeur= Request::all();

        $total= Etudiant::all();
        $user = Etudiant::where('MATRICULE', '=', $valeur['MATRICULE'])->first();
        if ($user === null) {
            // user doesn't exist
            $etudiant =new Etudiant($valeur);
            $etudiant-> ACTIVE=1;
            $etudiant->save($valeur);
            return redirect('ShowStudent');
        }else{
            // user doesn exist
            $errors=array(['kjhkj'=>'khkjhkj']);
            return Redirect::route('ShowStudent')->with($errors);
        }

    }


    public function ShowStudent($col='NOM_ETUDIANT',$order='desc')
    {
        $AllEtudiant= DB::table('etudiants')->orderBy($col, $order)->paginate(10);
        return view('Etudiant.show')->with('AllEtudiant',$AllEtudiant);
    }


    public function UpdateStudent(Request $request)
    {
        $valeurs= $request::all();
        $etudiant = Etudiant::where('id', '=', $valeurs['id']) ->first();
        $etudiant->save();
        return back()->with('msg', 'Opération effectuée avec succès.');

    }

    public function SearchStudent(Request $request)
    {
        $valeur=Request::all();
        $AllEtudiant = Etudiant::where('MATRICULE', 'like', '%'.trim($valeur['key']).'%')
            ->orWhere('NOM_ETUDIANT', 'like', '%'.trim($valeur['key']).'%')
            ->orWhere('PRENOM_ETUDIANT', 'like', '%'.trim($valeur['key']).'%')
            ->paginate(10);


        return view('Etudiant.show')->with('AllEtudiant',$AllEtudiant);
    }

    public function DelStudent(Request $request){

        $valeurs= $request::all();
        $cat = Etudiant::where('id', '=', $valeurs['id']) ->first();
        Register::where('ETUDIANT', '=',$valeurs['id'])->delete();
        $cat->delete();
        return back()->with('msg', 'Opération effectuée avec succès.');

    }

    public function DisableStudent($id){
        Etudiant::where('id', $id)
            ->update(['ACTIVE' => 0]);
        return back() ;
    }
    public function EnableStudent($id){
        Etudiant::where('id', $id)
            ->update(['ACTIVE' => 1]);
        return back();
    }

}
