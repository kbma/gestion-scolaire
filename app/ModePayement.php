<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModePayement extends Model
{
    protected $table = 'modepayement';
    protected $fillable = ['CODE', 'LIBELLE','created_at','updated_at','ACTIVE'];
}
