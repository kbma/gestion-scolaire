<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EtudiantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker = Faker::create('App\Etudiant');

        for($i=1;$i<=600; $i++){
            DB::table('etudiants')->insert([
                'DATE_INSCRIPTION'=>$faker->date('Y-m-d'),
                'MATRICULE'=>$faker->biasedNumberBetween(11111111,99999999),
                'NOM_ETUDIANT'=>$faker->firstName,
                'PRENOM_ETUDIANT'=>$faker->lastName,
                'DATE_NAISSANCE'=>$faker->date('Y-m-d'),
                'LIEU'=>$faker->city,
                'ADRESSE'=>$faker->address,
                'NATIONALITE'=>$faker->country,
                'VILLE'=>$faker->country,
                'EMAIL'=>$faker->email,
                'CP'=>$faker->biasedNumberBetween(000000,000000),
                'TEL'=>$faker->phoneNumber,
                'CIN_PASSPORT'=>$faker->biasedNumberBetween(11111111,99999999),
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now(),
                'NIVEAU_SCOLAIRE'=>$faker->randomDigit,
                'NOM_TUTEUR'=>$faker->lastName,
                'PRENOM_TUTEUR'=>$faker->firstName,
                'TEL_TUTEUR'=>$faker->phoneNumber,
                'EMAIL_TUTEUR'=>$faker->email,
                'OBSERVATION'=>$faker->paragraph(1),
                'ACTIVE'=>$faker->boolean,
            ]);
        }
    }
}
