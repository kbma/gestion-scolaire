<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prestataire extends Model
{
    protected $table = 'prestataire';
    protected $fillable = ['CODE', 'NOM','ADRESSE','VILLE','CP','TEL','EMAIL','CATEGORIE','OBSERVATION','created_at','updated_at'];

}
