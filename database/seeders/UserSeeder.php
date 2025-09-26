<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'user' ,
            'email' => 'user@gmailcom' ,
            'password' => Hash::make('123456') ,
        ]);



        Admin::create([
            'email' => 'admin@gmailcom' ,
            'password' => Hash::make('123456') ,
        ]);


    }
}
