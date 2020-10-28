<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payement', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('TYPE');
            $table->string('NUMERO');
            $table->date('DATE_OPERATION');
            $table->integer('MODE');
            $table->string('PRESTATAIRE');
            $table->double('MONTANT_DEPENCE');
            $table->string('MOTIF_DEPENCE');
            $table->integer('ETUDIANT');
            $table->integer('ETUDIANT_SESSION');
            $table->integer('ETUDIANT_FORMATION');
            $table->integer('ENTREPRISE');
            $table->integer('ENTREPRISE_SESSION');
            $table->integer('ENTREPRISE_FORMATION');
            $table->string('MOTIF_RECETTE');
            $table->double('MONTANT_RECETTE');
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
        Schema::dropIfExists('payement');
    }
}
