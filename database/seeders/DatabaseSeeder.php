<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()->create([
            'name'=>'admin',
            'email'=>'admin@test.com',
            'password'=> Hash::make('password'),
            'verification_code' => '111111'
        ]);

         User::factory(30)->create();
    }
}
