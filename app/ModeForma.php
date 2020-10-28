<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeForma extends Model
{
    protected $table = 'modeforma';
    protected $fillable = ['CODE', 'LIBELLE','created_at','updated_at','ACTIVE'];
}
