<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Domain\Users\User::class)->create([
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
        ]);
    }
}
