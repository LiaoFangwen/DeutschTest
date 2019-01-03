<?php

namespace App\Http\Controllers;

use App\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{
    private static $timeStart;
    private static $timeEnd;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('testCatalog')->with('tests', \App\Test::all());
    }
    public function showTest(Request $request) {
        self::$timeStart = Carbon::now()->toDateTimeString();
        echo self::$timeStart;
        $testId = $request->id;
        return view('testContent')->with('testId', $testId);
    }
    public function showResult(Request $request) {
        self::$timeEnd = Carbon::now();
        $testId = $request->id;
        $correctAnswers = Question::where('testId', $testId);
        $results = array();
        $score = 0;
        $i = 0;
        foreach ($correctAnswers->cursor() as $correctAnswer) {
            $j = $i/3+1;
            if($j==10)
                $unknownAnswer = $request->get('input0');
            else
                $unknownAnswer = $request->get('input' . $j);
            if ($correctAnswer->answer == $unknownAnswer) {
                $results[$i] = 'right';
                $score++;
            } else
                $results[$i] = 'wrong';
            $results[$i+1] = $correctAnswer->answer;
            $results[$i+2] = $unknownAnswer;
            $i = $i+3;
        }
        $results[30] = $score;
        $results[31] = $testId;
        $results[32] = self::$timeStart;
        return view('testResult')->with('results', $results);
    }
    private function calculateTime($timeStart, $timeEnd) {
        $date=floor((strtotime($timeEnd)-strtotime($timeStart))/86400);
        $hour=floor((strtotime($timeEnd)-strtotime($timeStart))%86400/3600);
        $minute=floor((strtotime($timeEnd)-strtotime($timeStart))%86400/60);
        $second=floor((strtotime($timeEnd)-strtotime($timeStart))%86400%60);
        return "Your test lasts".$date."day(s)".$hour."hour(s)".$minute."minute(s)".$second."second(s)";
    }
}
