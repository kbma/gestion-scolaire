<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


/* gérer les etudiants   */
Route::get('AddStudent', 'EtudiantController@AddStudent')->name('AddStudent');
Route::post('SaveStudent', 'EtudiantController@SaveStudent')->name('SaveStudent');
Route::post('UpdateStudent', 'EtudiantController@UpdateStudent')->name('UpdateStudent');
Route::post('DelStudent', 'EtudiantController@DelStudent')->name('DelStudent');
Route::get('ShowStudent', 'EtudiantController@ShowStudent')->name('ShowStudent');
Route::get('SearchStudent', 'EtudiantController@SearchStudent')->name('SearchStudent');
Route::get('DisableStudent/{id}', 'EtudiantController@DisableStudent')->name('DisableStudent');
Route::get('EnableStudent/{id}', 'EtudiantController@EnableStudent')->name('EnableStudent');

/* gérer les categories des formations   */
Route::get('ShowForm', 'CategorieController@ShowForm')->name('ShowForm');
Route::post('AddCatForm', 'CategorieController@AddCatForm')->name('AddCatForm');
Route::post('SaveCatForm', 'CategorieController@SaveCatForm')->name('SaveCatForm');
Route::post('UpdateCatForm', 'CategorieController@UpdateCatForm')->name('UpdateCatForm');
Route::post('DelCatForm', 'CategorieController@DelCatForm')->name('DelCatForm');
Route::get('SearchCatForm', 'CategorieController@SearchCatForm')->name('SearchCatForm');

Route::get('/getDiplomes', 'CategorieController@getDiplomes')->name('getDiplomes');





/* gérer les categories des prestataires   */
Route::get('ShowCatPres', 'CatPresController@ShowCatPres')->name('ShowCatPres');
Route::post('SaveCatPres', 'CatPresController@SaveCatPres')->name('SaveCatPres');
Route::post('UpdateCatPres', 'CatPresController@UpdateCatPres')->name('UpdateCatPres');
Route::post('DelCatPres', 'CatPresController@DelCatPres')->name('DelCatPres');


/* gérer les prestataires   */
Route::get('AddPres', 'CatPresController@AddPres')->name('AddPres');
Route::get('ShowPres', 'CatPresController@ShowPres')->name('ShowPres');
Route::post('SavePres', 'CatPresController@SavePres')->name('SavePres');

Route::post('UpdatePres', 'CatPresController@UpdatePres')->name('UpdatePres');
Route::post('DelPres', 'CatPresController@DelPres')->name('DelPres');
Route::get('DisablePrestataire/{id}', 'CatPresController@DisablePrestataire')->name('DisablePrestataire');
Route::get('EnablePrestataire/{id}', 'CatPresController@EnablePrestataire')->name('EnablePrestataire');






/* gérer les diplomes des formations   */
Route::get('ShowDiplome', 'CategorieController@ShowDiplome')->name('ShowDiplome');
Route::post('SaveDiplome', 'CategorieController@SaveDiplome')->name('SaveDiplome');
Route::post('UpdateDiplome', 'CategorieController@UpdateDiplome')->name('UpdateDiplome');
Route::post('DelDiplome', 'CategorieController@DelDiplome')->name('DelDiplome');
Route::get('SearchCatForm', 'CategorieController@SearchCatForm')->name('SearchCatForm');
Route::get('DisableDiplome/{id}', 'CategorieController@DisableDiplome')->name('DisableDiplome');
Route::get('EnableDiplome/{id}', 'CategorieController@EnableDiplome')->name('EnableDiplome');

/* gérer les recettes   */

Route::get('AddRecette', 'PayementController@AddRecette')->name('AddRecette');
Route::post('SaveRecette', 'PayementController@SaveRecette')->name('SaveRecette');
Route::post('UpdateDiplome', 'CategorieController@UpdateDiplome')->name('UpdateDiplome');

Route::get('SearchCatForm', 'CategorieController@SearchCatForm')->name('SearchCatForm');
/* gérer les depences   */
Route::get('AddDepence', 'PayementController@AddDepence')->name('AddDepence');
Route::post('SaveDepence', 'PayementController@SaveDepence')->name('SaveDepence');

Route::get('ShowRecettesDepences', 'PayementController@ShowRecettesDepences')->name('ShowRecettesDepences');
Route::post('DelPayement', 'PayementController@DelPayement')->name('DelPayement');




Route::post('UpdateDepence', 'PayementController@UpdateDepence')->name('UpdateDepence');
Route::post('DelDepence', 'PayementController@DelDepence')->name('DelDepence');
Route::get('SearchDepence', 'PayementController@SearchDepence')->name('SearchDepence');



Route::post('/etudiant/SaveEtudiant', 'EtudiantController@SaveEtudiant');
Route::get('/etudiant/ShowEditEtudiant', 'EtudiantController@ShowEditEtudiant')->name('ShowEditEtudiant');
Route::post('/etudiant/SaveEditEtudiant', 'EtudiantController@SaveEditEtudiant');
Route::post('/etudiant/DeleteEtudiant', 'EtudiantController@DeleteEtudiant');
Auth::routes();

Route::get('/home', 'HomeController@index');



/* gérer les societes   */
Route::get('AddCompany', 'CompanyController@AddCompany')->name('AddCompany');
Route::get('ShowCompany', 'CompanyController@ShowCompany')->name('ShowCompany');
Route::post('SaveCompany', 'CompanyController@SaveCompany')->name('SaveCompany');

Route::post('UpdateCompany', 'CompanyController@UpdateCompany')->name('UpdateCompany');
Route::post('DelCompany', 'CompanyController@DelCompany')->name('DelCompany');
Route::get('DisableCompany/{id}', 'CompanyController@DisableCompany')->name('DisableCompany');
Route::get('EnableCompany/{id}', 'CompanyController@EnableCompany')->name('EnableCompany');


/* gérer les inscriptions   */
Route::get('AddRegister', 'RegisterController@AddRegister')->name('AddRegister');
Route::post('SaveRegistert', 'RegisterController@SaveRegister')->name('SaveRegister');
Route::get('ShowRegister', 'RegisterController@ShowRegister')->name('ShowRegister');
Route::post('UpdateRegister', 'RegisterController@UpdateRegister')->name('UpdateRegister');
Route::post('DelRegister', 'RegisterController@DelRegister')->name('DelRegister');
Route::get('SearchRegister', 'RegisterController@SearchRegister')->name('SearchRegister');
Route::get('PDFRegister/{id}', 'RegisterController@PDFRegister')->name('PDFRegister');



/* gérer les mode de formation   */
Route::get('AddModeForma', 'ModeFormaController@AddModeForma')->name('AddModeForma');
Route::get('ShowModeForma', 'ModeFormaController@ShowModeForma')->name('ShowModeForma');
Route::post('SaveModeForma', 'ModeFormaController@SaveModeForma')->name('SaveModeForma');
Route::post('UpdateModeForma', 'ModeFormaController@UpdateModeForma')->name('UpdateModeForma');
Route::post('DelModeForma', 'ModeFormaController@DelModeForma')->name('DelModeForma');
Route::get('DisableModeForma/{id}', 'ModeFormaController@DisableModeForma')->name('DisableModeForma');
Route::get('EnableModeForma/{id}', 'ModeFormaController@EnableModeForma')->name('EnableModeForma');


/* gérer les sessions   */
Route::get('AddSession', 'SessionController@AddSession')->name('AddSession');
Route::get('ShowSession', 'SessionController@ShowSession')->name('ShowSession');
Route::post('SaveSession', 'SessionController@SaveSession')->name('SaveSession');
Route::post('UpdateSession', 'SessionController@UpdateSession')->name('UpdateSession');
Route::post('DelSession', 'SessionController@DelSession')->name('DelSession');
Route::get('DisableSession/{id}', 'SessionController@DisableSession')->name('DisableSession');
Route::get('EnableSession/{id}', 'SessionController@EnableSession')->name('EnableSession');

/* gérer les groupes   */
Route::get('AddGroupe', 'GroupeController@AddGroupe')->name('AddGroupe');
Route::get('ShowGroupe', 'GroupeController@ShowGroupe')->name('ShowGroupe');
Route::post('SaveGroupe', 'GroupeController@SaveGroupe')->name('SaveGroupe');
Route::post('UpdateGroupe', 'GroupeController@UpdateGroupe')->name('UpdateGroupe');
Route::post('DelGroupe', 'GroupeController@DelGroupe')->name('DelGroupe');
Route::get('DisableGroupe/{id}', 'GroupeController@DisableGroupe')->name('DisableGroupe');
Route::get('EnableGroupe/{id}', 'GroupeController@EnableGroupe')->name('EnableGroupe');


/* gérer les mode de payement   */
Route::get('AddModePayement', 'ModePayementController@AddModePayement')->name('AddModePayement');
Route::get('ShowModePayement', 'ModePayementController@ShowModePayement')->name('ShowModePayement');
Route::post('SaveModePayement', 'ModePayementController@SaveModePayement')->name('SaveModePayement');
Route::post('UpdateModePayement', 'ModePayementController@UpdateModePayement')->name('UpdateModePayement');
Route::post('DelModePayement', 'ModePayementController@DelModePayement')->name('DelModePayement');
Route::get('DisableModePayement/{id}', 'ModePayementController@DisableModePayement')->name('DisableModePayement');
Route::get('EnableModePayement/{id}', 'ModePayementController@EnableModePayement')->name('EnableModePayement');
Route::get('/getSESSION', 'PayementController@getSESSION')->name('getSESSION');
Route::get('/getFORMATION', 'PayementController@getFORMATION')->name('getFORMATION');

Route::get('/getSESSION_ENTREPRISE', 'PayementController@getSESSION_ENTREPRISE')->name('getSESSION_ENTREPRISE');
Route::get('/getFORMATION_ENTREPRISE', 'PayementController@getFORMATION_ENTREPRISE')->name('getFORMATION_ENTREPRISE');

Route::get('/getTOTAL_ETUDIANT', 'PayementController@getTOTAL_ETUDIANT')->name('getTOTAL_ETUDIANT');
Route::get('/getTOTAL_ENTREPRISE', 'PayementController@getTOTAL_ENTREPRISE')->name('getTOTAL_ENTREPRISE');

