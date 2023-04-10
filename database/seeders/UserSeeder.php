<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
                'username' => 'angga',
                'email' => 'angga@email.com',
                'password' => bcrypt('rahasia'),
                'firstname' => 'angga',
                'lastname' => 'pratama',
                'created_at' => now()
            ]
        );
    }
}
