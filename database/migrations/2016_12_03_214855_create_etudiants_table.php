<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->increments('id');
            $table->date('DATE_INSCRIPTION');
            $table->string('MATRICULE')->unique();
            $table->string('NOM_ETUDIANT');
            $table->string('PRENOM_ETUDIANT');
            $table->date('DATE_NAISSANCE');
            $table->string('LIEU');
            $table->string('CIN_PASSPORT');
            $table->string('NATIONALITE');
            $table->string('ADRESSE');
            $table->string('VILLE');
            $table->integer('CP');
            $table->string('TEL');
            $table->string('EMAIL');
            $table->string('NIVEAU_SCOLAIRE');
            $table->string('NOM_TUTEUR');
            $table->string('PRENOM_TUTEUR');
            $table->string('TEL_TUTEUR');
            $table->string('EMAIL_TUTEUR');
            $table->string('TYPE_FORMATION');
            $table->string('DIPLOME');
            $table->string('AUTRE1');
            $table->string('DOSSIER_SCOLAIRE');
            $table->string('DESISION');
            $table->string('AUTRE2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('etudiants');
    }
}
