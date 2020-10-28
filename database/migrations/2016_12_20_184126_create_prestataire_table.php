<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestataireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestataire', function (Blueprint $table) {
            $table->increments('id');
            $table->string('CODE')->unique();
            $table->string('NOM');
            $table->string('ADRESSE');
            $table->string('VILLE');
            $table->integer('CP');
            $table->string('TEL');
            $table->string('EMAIL');
            $table->integer('CATEGORIE');
            $table->text('OBSERVATION');

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
        Schema::drop('prestataire');
    }
}
