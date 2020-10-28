<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diplome extends Model
{
    protected $fillable = ['CODE', 'LIBELLE','ACTIVE' ,'CATEGORIE','created_at','updated_at'];
    public function categorie(){
        return $this->belongsTo('App\Categorie');
    }
}
