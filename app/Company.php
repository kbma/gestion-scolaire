<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    protected $fillable = ['CODE', 'NOM','ADRESSE','VILLE','CP','TEL','EMAIL','OBSERVATION','created_at','updated_at','ACTIVE'];
}
