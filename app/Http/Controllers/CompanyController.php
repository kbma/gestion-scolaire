<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Company;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function AddCompany(){
        //$AllCatPres=Company::all();
        return view('Company.addCompany');
    }

    public function SaveCompany(Request $request)
    {
        $valeur=$request::all();
        $AllCompany=Company::all();
        $test = Company::where('CODE', '=', $valeur['CODE'])->first();
        if ($test === null) {
            // user doesn't exist
            $company =new Company($valeur);
            $company-> ACTIVE = 1;
            $company->save($valeur);
            return Redirect::route('ShowCompany')->with('AllCompany',$AllCompany);
        }else{
            // user doesn exist
            $errors=array(['kjhkj'=>'khkjhkj']);
            return Redirect::route('ShowCompany')->with('AllCompany',$AllCompany);
        }


    }

    public function ShowCompany()
    {
        $AllCompany= Company::paginate(10);

        return view('Company.ShowCompany')->with('AllCompany',$AllCompany);
    }

    public  function UpdateCompany(Request $request){

        $valeurs= $request::all();


        $company = Company::where('id', '=', $valeurs['id']) ->first();

        // dd($pres);
        if(isset($_POST['CODE'])) {$company-> CODE = $valeurs['CODE'];}
        if(isset($_POST['NOM'])) { $company-> NOM = $valeurs['NOM'];}

        if(isset($_POST['ADRESSE'])) { $company-> ADRESSE = $valeurs['ADRESSE'];}
        if(isset($_POST['VILLE'])) { $company-> VILLE = $valeurs['VILLE'];}
        if(isset($_POST['CP'])) { $company-> CP = $valeurs['CP'];}
        if(isset($_POST['TEL'])) { $company-> TEL = $valeurs['TEL'];}
        if(isset($_POST['EMAIL'])) { $company-> EMAIL = $valeurs['EMAIL'];}
        if(isset($_POST['ACTIVE'])) { $company-> ACTIVE = $valeurs['ACTIVE'];}
        if(isset($_POST['OBSERVATION'])) { $company-> OBSERVATION = $valeurs['OBSERVATION'];}


        $company->save();
        return Redirect::route('ShowCompany');

    }

    public function DelCompany(Request $request){

        $valeurs= $request::all();
        $cat = Company::where('id', '=', $valeurs['id']) ->first();
        $cat->delete();
        return back();

    }

    public function DisableCompany($id){
        Company::where('id', $id)
            ->update(['ACTIVE' => 0]);
        return back();
    }
    public function EnableCompany($id){
        Company::where('id', $id)
            ->update(['ACTIVE' => 1]);
        return back();
    }

}
