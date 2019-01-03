<?php

use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tests')->delete();

        for ($i=1; $i < 11; $i++) {
            \App\Test::create([
                'testName' => 'Test'.$i,
                'averageScore' => 0,
                'peopleCounting' => 0
            ]);
        }
    }
}
