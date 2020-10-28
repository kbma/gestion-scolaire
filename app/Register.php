<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $table = 'register';
    protected $fillable = ['DATE_INSCRIPTION','ETUDIANT','SOCIETE','TYPE_FORMATION','DIPLOME','SESSION','GROUPE','MODE_FORMATION','DI','DE','NB','PU','TOTAL','DECISION','DOSSIER_SCOLAIRE','OBSERVATION','created_at','updated_at','ACTIVE'];
}

