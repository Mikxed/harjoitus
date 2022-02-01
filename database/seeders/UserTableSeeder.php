<?php

namespace Database\Seeders;

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
        DB::table('users')->delete();
        User::create(array(
            'name'     => 'Testi Käyttäjä',
            'email'    => 'test@user.com',
            'password' => Hash::make('awesome'),
        ));
    }
}
