<?php

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->delete();

        for ($i=1; $i < 11; $i++) {
            for ($j=1; $j<11; $j++) {
                \App\Question::create([
                    'questionContent' => 'Question'.$i.'.'.$j,
                    'testId' => $i,
                    'type' => 'single',
                    'answer' => rand(1,4)
                ]);
            }

        }
    }
}
