<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CatPresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\CatPres');

        for($i=1;$i<=60; $i++){
            DB::table('catpres')->insert([
                'CODE'=>$faker->bothify('CAT##??'),
                'LIBELLE'=>$faker->word,
               'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now(),
            ]);
        }

    }
}
