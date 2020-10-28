<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ETUDIANT');
            $table->integer('SOCIETE');
            $table->integer('TYPE_FORMATION');
            $table->integer('FORMATION');
            $table->integer('SESSION');
            $table->integer('GROUPE');
            $table->integer('MODE_FORMATION');
            $table->double('DI');
            $table->double('DE');
            $table->integer('NB');
            $table->double('PU');
            $table->double('TOTAL');
            $table->string('DOSSIER_SCOLAIRE');
            $table->string('DECISION');
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
        Schema::drop('register');
    }
}
