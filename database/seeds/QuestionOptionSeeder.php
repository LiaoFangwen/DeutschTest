<?php

use Illuminate\Database\Seeder;

class QuestionOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_options')->delete();

        for ($i=1; $i < 11; $i++) {
            for($j=1; $j<11; $j++) {
                for($k=1; $k<5; $k++) {
                    \App\QuestionOption::create([
                        'questionId' => ($i - 1) * 10 + $j,
                        'optionContent' => $k,
                    ]);
                }
            }
        }
    }
}
