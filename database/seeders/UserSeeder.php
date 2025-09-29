<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
     /*   User::create( [
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('12345678'),
            'estado'=>'1',
            'remember_token' => Str::random(10),
            'id_direcc' => '1',
            'rol' => '1'
             'id_dpto' => '1',
            'menu1' => '1',
            'menu2' => '1',
            'menu3' => '1',
            'menu4' => '1',
            'menu5' => '1',
            'menu6' => '1',
            'menu7' => '1',
            'menu8' => '1',
            'menu9' => '1',
            'menu10' => '1',
 
        ]);

 
    }
}