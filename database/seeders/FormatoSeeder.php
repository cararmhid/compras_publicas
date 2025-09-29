<?php

namespace Database\Seeders;

use App\Models\Formato;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FormatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Formato::factory()->count(42)->create();
        $faker = Faker::create(); 

        for ($i = 0; $i < 100; $i++) { 
            Formato::create([ 
                'descripcion' => $faker->sentence, 
                'url' => $faker->randomElement([ 
                    'public/formatos/' . $faker->word . '.docx', 
                    'public/formatos/' . $faker->word . '.xlsx', 
                    'public/formatos/' . $faker->word . '.pdf' 
                ]) 
            ]); 
            
        }
    }
}
