<?php

namespace App\Http\Controllers;

use App\CatPres;
use App\Diplome;
use App\ModePayement;
use App\Payement;
use App\prestataire;
use App\Register;
use App\Session;
use Illuminate\Support\Facades\Request;
use App\Etudiant;
use Illuminate\Support\Facades\DB;
use App\Company;


class PayementController extends Controller
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
    public function AddRecette()
    {
        $AllEtudiants = DB::table('register')
            ->join('etudiants', 'etudiants.id', '=', 'register.ETUDIANT')
            ->where('SOCIETE', '=',0)
            ->select('etudiants.id', 'etudiants.NOM_ETUDIANT','etudiants.PRENOM_ETUDIANT')
            ->distinct('etudiants.id')
            ->get();
        $AllPrestataires = prestataire::all();
        $AllCompany = DB::table('register')
            ->join('company', 'company.id', '=', 'register.SOCIETE')
            ->select('company.id', 'company.NOM')
            ->distinct('company.id')
            ->get();

        $AllCatPres= CatPres::all();
        $AllModePayement= ModePayement::all();
        return view('Payement.AddRecette')
            ->with('AllEtudiants',$AllEtudiants)
            ->with('AllPrestataires',$AllPrestataires)
            ->with('AllCatPres',$AllCatPres)
            ->with('AllCompany',$AllCompany)
            ->with('AllModePayement',$AllModePayement);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function SaveRecette(Request $request)
    {
        $valeurs=Request::all();
        $r= new Payement($valeurs);
        $r->ETUDIANT_SESSION=$valeurs['SESSION_ETUDIANT'];
        $r->ETUDIANT_FORMATION=$valeurs['DIPLOME_ETUDIANT'];

        $r->ENTREPRISE_SESSION=$valeurs['SESSION_ENTREPRISE'];
        $r->ENTREPRISE_FORMATION=$valeurs['DIPLOME_ENTREPRISE'];
        //dd($valeurs);
        $r->REGISTER=$valeurs['REGISTER'];
        $r->save();
        $AllPayements = DB::table('payement')
            ->orderBy('DATE_OPERATION')
            ->paginate(10);
        return redirect()->route('ShowRecettesDepences')->with('msg', 'Opération effectuée avec succès.');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ShowRecettesDepences()
    {
        $AllPayements = DB::table('payement')
            ->orderBy('DATE_OPERATION')
            ->paginate(10);

        $TOTAL_CAISSE_RECETTE = DB::table('payement')
            ->select( DB::raw('SUM(MONTANT_RECETTE) as TOTAL_CAISSE_RECETTE'))
            ->where('MODE','=',1)
            ->get();
        $TOTAL_CAISSE_RECETTE=$TOTAL_CAISSE_RECETTE->toArray()[0]->TOTAL_CAISSE_RECETTE;


        $TOTAL_CAISSE_DEPENCE = DB::table('payement')
            ->select( DB::raw('SUM(MONTANT_DEPENCE) as TOTAL_CAISSE_DEPENCE'))
            ->where('MODE','=',1)
            ->get();
        $TOTAL_CAISSE_DEPENCE=$TOTAL_CAISSE_DEPENCE->toArray()[0]->TOTAL_CAISSE_DEPENCE;




        $TOTAL_BANQUE_RECETTE = DB::table('payement')
            ->select( DB::raw('SUM(MONTANT_RECETTE) as TOTAL_BANQUE_RECETTE'))
            ->where('MODE','=',2)
            ->get();
        $TOTAL_BANQUE_RECETTE=$TOTAL_BANQUE_RECETTE->toArray()[0]->TOTAL_BANQUE_RECETTE;


        $TOTAL_BANQUE_DEPENCE = DB::table('payement')
            ->select( DB::raw('SUM(MONTANT_DEPENCE) as TOTAL_BANQUE_DEPENCE'))
            ->where('MODE','=',2)
            ->get();
        $TOTAL_BANQUE_DEPENCE=$TOTAL_BANQUE_DEPENCE->toArray()[0]->TOTAL_BANQUE_DEPENCE;



        $AllEtudiants = DB::table('register')
            ->join('etudiants', 'etudiants.id', '=', 'register.ETUDIANT')
            ->where('SOCIETE', '=',0)
            ->select('etudiants.id', 'etudiants.NOM_ETUDIANT','etudiants.PRENOM_ETUDIANT')
            ->distinct('etudiants.id')
            ->get();
        $AllPrestataires = prestataire::all();
        $AllCompany = DB::table('register')
            ->join('company', 'company.id', '=', 'register.SOCIETE')
            ->select('company.id', 'company.NOM')
            ->distinct('company.id')
            ->get();
        $AllCatPres= CatPres::all();
        $AllModePayement= ModePayement::all();
        $AllDip= Diplome::all();
        $AllSession= Session::all();



        return view('Payement.ShowRecettesDepences')
            ->with('AllPayements',$AllPayements)
            ->with('TOTAL_CAISSE_RECETTE',$TOTAL_CAISSE_RECETTE)
            ->with('TOTAL_CAISSE_DEPENCE',$TOTAL_CAISSE_DEPENCE)
            ->with('TOTAL_BANQUE_RECETTE',$TOTAL_BANQUE_RECETTE)
            ->with('TOTAL_BANQUE_DEPENCE',$TOTAL_BANQUE_DEPENCE)
            ->with('AllEtudiants',$AllEtudiants)
            ->with('AllPrestataires',$AllPrestataires)
            ->with('AllCatPres',$AllCatPres)
            ->with('AllCompany',$AllCompany)
            ->with('AllModePayement',$AllModePayement)
            ->with('AllDip',$AllDip)
            ->with('AllSession',$AllSession);
    }


    public function getSESSION(Request $request){
        $valeur =Request::all();

        $AllSessions = DB::table('register')
            ->join('session', 'session.id', '=', 'register.SESSION')
            ->where('ETUDIANT', '=',$valeur['ETUDIANT'])
            ->select('session.id', 'session.LIBELLE')
            ->distinct('session.id')
            ->get();

        return json_decode($AllSessions);
    }

    public function getFORMATION(Request $request){
        $valeur =Request::all();
        $AllDiplomes = DB::table('register')
            ->join('diplomes', 'diplomes.id', '=', 'register.DIPLOME')
            ->where('SESSION', '=',$valeur['SESSION_ETUDIANT'])
            ->where('ETUDIANT', '=',$valeur['ETUDIANT'])
            ->select('diplomes.id', 'diplomes.LIBELLE','register.TOTAL')
            ->distinct('diplomes.id')
            ->get();
        return json_decode($AllDiplomes);
    }

/*********************************************/
    public function getSESSION_ENTREPRISE(Request $request){
        $valeur =Request::all();

        $AllSessions = DB::table('register')
            ->join('session', 'session.id', '=', 'register.SESSION')
            ->where('SOCIETE', '=',$valeur['ENTREPRISE'])
            ->select('session.id', 'session.LIBELLE')
            ->distinct('session.id')
            ->get();

        return json_decode($AllSessions);
    }

    public function getFORMATION_ENTREPRISE(Request $request){
        $valeur =Request::all();
        $AllDiplomes = DB::table('register')
            ->join('diplomes', 'diplomes.id', '=', 'register.DIPLOME')
            ->where('SESSION', '=',$valeur['SESSION_ENTREPRISE'])
            ->where('SOCIETE', '=',$valeur['SOCIETE'])
            ->select('diplomes.id', 'diplomes.LIBELLE')
            ->distinct('diplomes.id')
            ->get();
        return json_decode($AllDiplomes);
    }

    public function getTOTAL_ETUDIANT(Request $request){
        $valeur =Request::all();
        $total = DB::table('register')
            ->where('ETUDIANT', '=',$valeur['ETUDIANT'])
            ->where('SESSION', '=',$valeur['SESSION_ETUDIANT'])
            ->where('DIPLOME', '=',$valeur['DIPLOME_ETUDIANT'])
            ->select('register.id', 'register.TOTAL', 'register.RESTE', 'register.PAYE')
            ->get();
        return json_decode($total);
    }

    public function getTOTAL_ENTREPRISE(Request $request){
        $valeur =Request::all();
        $total = DB::table('register')
            ->where('SOCIETE', '=',$valeur['ENTREPRISE'])
            ->where('SESSION', '=',$valeur['SESSION_ENTREPRISE'])
            ->where('DIPLOME', '=',$valeur['DIPLOME_ENTREPRISE'])
            ->select('register.id', 'register.TOTAL', 'register.RESTE', 'register.PAYE')
            ->get();
        return json_decode($total);
    }

    /************************************************/
    public function AddDepence()
    {
        $AllEtudiants = DB::table('register')
            ->join('etudiants', 'etudiants.id', '=', 'register.ETUDIANT')
            ->where('SOCIETE', '=',0)
            ->select('etudiants.id', 'etudiants.NOM_ETUDIANT','etudiants.PRENOM_ETUDIANT')
            ->distinct('etudiants.id')
            ->get();
        $AllPrestataires = prestataire::all();
        $AllCompany = DB::table('register')
            ->join('company', 'company.id', '=', 'register.SOCIETE')
            ->select('company.id', 'company.NOM')
            ->distinct('company.id')
            ->get();

        $AllCatPres= CatPres::all();
        $AllModePayement= ModePayement::all();
        return view('Payement.AddDepence')
            ->with('AllEtudiants',$AllEtudiants)
            ->with('AllPrestataires',$AllPrestataires)
            ->with('AllCatPres',$AllCatPres)
            ->with('AllCompany',$AllCompany)
            ->with('AllModePayement',$AllModePayement);
    }
    public function SaveDepence(Request $request)
    {
       $valeurs=Request::all();
        $d= new Payement($valeurs);
       // dd($valeurs);
        $d->REGISTER=$valeurs['REGISTER'];
        $d->save();

        $AllPayements = DB::table('payement')
            ->orderBy('DATE_OPERATION')
            ->paginate(10);
        return redirect()->route('ShowRecettesDepences')->with('msg', 'Opération effectuée avec succès.');

    }
    public  function DelPayement(Request $request){
        $valeurs= $request::all();
        $cat = Payement::where('id', '=', $valeurs['id']) ->first();
       // dd($valeurs['id']);
        $cat-> delete();
        return back()->with('msg', 'Suppression effectuée avec succès.');


    }
}
