<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = ['CODE', 'LIBELLE', 'created_at','updated_at'];

    public function diplomes(){
        return $this->hasMany('App\Diplome');
    }

}
