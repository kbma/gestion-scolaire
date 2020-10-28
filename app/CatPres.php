<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatPres extends Model
{
    protected $table = 'catpres';
    protected $fillable = ['CODE', 'LIBELLE', 'created_at','updated_at'];
}
