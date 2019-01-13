<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Admin0',
            'email' => 'Admin0@th.de',
            'password' => bcrypt('12345678'),
        ]);
        DB::table('admins')->insert([
            'name' => 'Admin1',
            'email' => 'Admin1@th.de',
            'password' => bcrypt('12345678'),
        ]);
        /*
        $this->call(UserSeeder::class);
        $this->call(TestSeeder::class);
        $this->call(QuestionSeeder::class);
        $questions = \App\Question::where('type', 'multi');
        $answerArray = Array();
        $answerArray[0] = Array('1,','2,','3,','4,');
        $answerArray[1] = Array('1,2,','1,3,','1,4,','2,3,','2,4,','3,4,');
        $answerArray[2] = Array('1,2,3,','1,2,4,','1,3,4,', '2,3,4,');
        $answerArray[3] = Array('1,2,3,4,');
        foreach ($questions->cursor() as $question) {
            $answerNumber = rand(1, 4);
            $randomKey = array_rand($answerArray[$answerNumber-1], 1);
            $answer = $answerArray[$answerNumber-1][$randomKey];
            $question->answer = $answer;
            $question->save();
        }
        $this->call(QuestionOptionSeeder::class);
        $this->call(UserRecordSeeder::class);
        */
    }
}
