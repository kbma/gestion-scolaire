<?php

namespace App\Http\Controllers;


use App\Categorie;
use App\Diplome;
use App\Groupe;
use App\ModeForma;
use App\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Etudiant;
use App\Company;
use App\Register;
use Dompdf\Dompdf;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public  function AddRegister(){
        $AllEtudiants=Etudiant::where('active', 1)->get();
        $AllCompany=Company::where('active', 1)->get();
        $AllCat =Categorie::all();
        $AllSession =Session::where('active', 1)->get();
        $AllGroupe =Groupe::where('active', 1)->get();
        $AllModeForma =ModeForma::where('active', 1)->get();
        return view('Register.addRegister')
            ->with('AllEtudiants',$AllEtudiants)
            ->with('AllCompany',$AllCompany)
            ->with('AllSession',$AllSession)
            ->with('AllGroupe',$AllGroupe)
            ->with('AllModeForma',$AllModeForma)
            ->with('AllCat',$AllCat);
    }


     public function SaveRegister(Request $request)
    {
    $valeur=$request::all();
    $AllRegister=Register::all();
    $register =new Register($valeur);
        $register->RESTE=$valeur['TOTAL'];
        $register->PAYE=0;
        $register->save($valeur);


    return Redirect::route('ShowRegister')->with('AllRegister',$AllRegister)->with('msg', 'Inscription effectuée avec succès.');



    }

    public function ShowRegister()
    {
        $AllCat = Categorie::all();
        $AllDip = Diplome::all();
        $AllSession =Session::all();
        $AllGroupe =Groupe::all();
        $AllCompany=Company::all();
        $AllModeForma =ModeForma::all();
        $AllRegister= Register::orderBy('DATE_INSCRIPTION','desc')->paginate(10);
        //dd($AllRegister);

    return view('Register.ShowRegister')
        ->with('AllRegister',$AllRegister)
        ->with('AllCat',$AllCat)
        ->with('AllSession',$AllSession)
        ->with('AllDip',$AllDip)
        ->with('AllGroupe',$AllGroupe)
        ->with('AllModeForma',$AllModeForma)
        ->with('AllCompany',$AllCompany);
    }

    public  function UpdateRegister(Request $request){

    $valeurs= $request::all();
      // dd($_POST['DIPLOME']);

    $register = Register::where('id', '=', $valeurs['id']) ->first();
        $register-> GROUPE = NULL;  $register-> GROUPE = $valeurs['GROUPE'];

     $register-> NB = $valeurs['NBE'];
        $register->RESTE=$register->TOTAL;
        $register->PAYE=0;
        $register-> SESSION = NULL; $register->SESSION=$_POST['SESSION'];
        $register-> DIPLOME = NULL; $register->DIPLOME=$_POST['DIPLOME'];
        $register-> DATE_INSCRIPTION = NULL; $register->DATE_INSCRIPTION=$_POST['DATE_INSCRIPTION'];
        $register-> SOCIETE = NULL; $register->SOCIETE=$_POST['SOCIETE'];



        if(isset($_POST['PUE'])) { $register-> PU = $valeurs['PUE'];}
        if(isset($_POST['DIE'])) { $register-> DI = $valeurs['DIE'];}
        if(isset($_POST['DEE'])) { $register-> DE = $valeurs['DEE'];}
        if(isset($_POST['MODE_FORMATION'])) { $register-> MODE_FORMATION = $valeurs['MODE_FORMATION'];}
        if(isset($_POST['TOTALE'])) { $register-> TOTAL = $valeurs['TOTALE'];}
        if(isset($_POST['DOSSIER_SCOLAIRE'])) { $register-> DOSSIER_SCOLAIRE = $valeurs['DOSSIER_SCOLAIRE'];}
        if(isset($_POST['DECISION'])) { $register-> DECISION = $valeurs['DECISION'];}
    if(isset($_POST['OBSERVATION'])) { $register-> OBSERVATION = $valeurs['OBSERVATION'];}
        if(isset($_POST['updated_at'])) { $register-> updated_at = $valeurs['updated_at'];}


        $register->save();
        session()->flash('msg', 'Modification effectuée avec succès.');
        return redirect()->back();

    }

    public function DelRegister(Request $request){

    $valeurs= $request::all();
    $cat = Register::where('id', '=', $valeurs['id']) ->first();
    $cat->delete();
        return back()->with('msg', 'Suppression effectuée avec succès.');

    }
        /**
    public function DisableCompany($id){
    Company::where('id', $id)
    ->update(['ACTIVE' => 0]);
    return Redirect::route('ShowCompany');
    }
    public function EnableCompany($id){
    Company::where('id', $id)
    ->update(['ACTIVE' => 1]);
    return Redirect::route('ShowCompany');
    }
     */



    public function PDFRegister($id){

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        //$nom = Etudiant::find($id)->NOM_ETUDIANT;
        $html = header("Content-type:application/pdf");
        $html = <<<HTML
        <html>
        <body>
            <h4>Inscription: </h4>
            <p>Etudiant numero $id</p>

        </body>
        </html>
HTML;
        $dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
        $dompdf->render();

// Output the generated PDF to Browser
        //$dompdf->stream();
        $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));

    }
}
