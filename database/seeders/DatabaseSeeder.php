<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Demo Educator',
            'email'    => 'educator@eduseria.com',
            'password' => bcrypt('password'),
            'role'     => 'educator',
        ]);

        User::create([
            'name'     => 'Demo Learner',
            'email'    => 'learner@eduseria.com',
            'password' => bcrypt('password'),
            'role'     => 'learner',
        ]);
    }
}