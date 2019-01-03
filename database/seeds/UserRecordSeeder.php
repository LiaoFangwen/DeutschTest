<?php

use Illuminate\Database\Seeder;

class UserRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_records')->delete();

        for ($i=1; $i < 51; $i++) {
            for ($j=1; $j<11; $j++) {
                for ($k=1; $k<6; $k++) {
                    \App\UserRecord::create([
                        'userId' => $i,
                        'attemptNumber' => $k,
                        'score' => rand(1, 10),
                        'testId' => $j
                    ]);
                }
            }
        }
    }
}
