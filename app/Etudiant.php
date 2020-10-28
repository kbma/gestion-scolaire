<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = ['DATE_INSCRIPTION', 'MATRICULE', 'NOM_ETUDIANT', 'PRENOM_ETUDIANT', 'DATE_NAISSANCE', 'LIEU','CIN_PASSPORT','NATIONALITE','ADRESSE','VILLE','CP','TEL','EMAIL','NIVEAU_SCOLAIRE','NOM_TUTEUR','PRENOM_TUTEUR','TEL_TUTEUR','EMAIL_TUTEUR','TYPE_FORMATION','DIPLOME','AUTRE1','DOSSIER_SCOLAIRE','DESISION','AUTRE2','created_at','updated_at'];

}
