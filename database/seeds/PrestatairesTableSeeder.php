<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PrestatairesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\prestataire');

        for($i=1;$i<=10; $i++){
            DB::table('prestataire')->insert([
                'CODE'=>$faker->bothify('COMPANY####?????'),
                'NOM'=>$faker->company,
                'ADRESSE'=>$faker->address,
                'VILLE'=>$faker->country,
                'EMAIL'=>$faker->email,
                'CP'=>$faker->biasedNumberBetween(000000,999999),
                'TEL'=>$faker->phoneNumber,
                'CATEGORIE'=>$faker->biasedNumberBetween(1,10),
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now(),
                'OBSERVATION'=>$faker->paragraph(1),
                'ACTIVE'=>$faker->boolean,
            ]);
        }
    }
}
