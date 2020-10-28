<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'session';
    protected $fillable = ['CODE', 'LIBELLE','START','END','created_at','updated_at','ACTIVE'];
}
