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

        for ($i=0; $i < 400; $i++) {
            \App\QuestionOption::create([
                'questionId' => rand(1,100),
                'optionContent' => rand(1,4),
            ]);
        }
    }
}
