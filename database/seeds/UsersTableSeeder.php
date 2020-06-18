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
        $dt = new DateTime();
        DB::table('users')->insert([
            'firstName' => 'mucyo',
            'lastName' => 'chris',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'phoneNumber' => '07823728610',
            'gender' => 'male',
            'password' => Hash::make('markchris32'),
            'role' => 'SUPER_ADMIN',
            'email_verified_at' => $dt->format('Y-m-d H:i:s'),
            'is_verified' => 1
        ]);
    }
}
