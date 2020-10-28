<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    protected $table = 'payement';
    protected $fillable = ['TYPE', 'NUMERO','DATE_OPERATION','MODE','PRESTATAIRE','MONTANT_DEPENCE','MOTIF_DEPENCE','ETUDIANT','ETUDIANT_SESSION','ETUDIANT_FORMATION','ENTREPRISE','ENTREPRISE_SESSION','ENTREPRISE_FORMATION','ENTREPRISE_FORMATION','MOTIF_RECETTE','MONTANT_RECETTE','created_at','updated_at'];
}
