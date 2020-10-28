<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    protected $table = 'groupe';
    protected $fillable = ['CODE', 'LIBELLE','created_at','updated_at','ACTIVE'];
}
