<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Alex',
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('qwertyui'), // password
            'remember_token' => Str::random(10),
        ]);
        factory(App\User::class, 50)->create();
    }
}
