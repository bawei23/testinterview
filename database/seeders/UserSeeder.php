<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    $users= [

            [
            'name' => 'admin',
            'email' =>'admin@grtech.com.my',
            'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'user',
                'email' =>'user@grtech.com.my',
                'password' => Hash::make('12345678'),
            ]
    ];
    DB::table('users')->insert($users);
    }
}
