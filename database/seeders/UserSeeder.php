<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Mario',
                'lastname' => 'Rossi',
                'email' => 'mariorossi@gmail.com',
                'password' => 'admin'
            ]
            //Nuovi utenti nel caso da inserire qui
        ];

        foreach ($users as $user) {
            $newUser = new User();
            $newUser->name = $user['name'];
            $newUser->lastname = $user['lastname'];
            $newUser->email = $user['email'];
            $newUser->password = $user['password'];
            $newUser->save();
        }
    }
}
