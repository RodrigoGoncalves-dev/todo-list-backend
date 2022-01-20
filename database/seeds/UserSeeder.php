<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'first_name'=> 'Rodrigo',
            'last_name'=> 'Silva',
            'email'=> 'rodrigo@gmail.com',
            'password'=> bcrypt('password')
        ]);
    }
}
