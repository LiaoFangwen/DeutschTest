<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        for ($i=0; $i < 50; $i++) {
            \App\User::create([
                'name' => 'User'.$i,
                'email' => 'Liao'.$i.'@th.de',
                'password' => bcrypt('12345678')
            ]);
        }
    }
}
