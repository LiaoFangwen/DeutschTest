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

        for ($i=0; $i < 100; $i++) {
            \App\Question::create([
                'questionContent' => 'Question'.$i,
                'testId' => rand(1,10),
                'type' => 'single',
                'answer' => rand(1,4)
            ]);
        }
    }
}
