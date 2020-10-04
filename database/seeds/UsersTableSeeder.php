<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'user_name' => 'Mohamed Elorabi',
            'password'  => bcrypt('123456'),
        ]);

        $user->attachRole('super_admin');
    }
}
