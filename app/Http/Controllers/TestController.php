<?php

namespace App\Http\Controllers;

use App\Question;
use App\Test;
use App\User;
use App\UserRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->createUserRecord($score, $testId);
        $this->updateTest($testId);

        return view('testResult')->with('results', $results);
    }
    private function createUserRecord($score, $testId) {
        $user = Auth::user();
        $attemptNumber = UserRecord::where(['userId' => $user->id, 'testId' => $testId])->max('attemptNumber');
        $userRecord = new UserRecord();
        $userRecord->userId = $user->id;
        $userRecord->attemptNumber = $attemptNumber+1;
        $userRecord->score = $score;
        $userRecord->testId = $testId;
        $userRecord->save();
    }
    private function updateTest($testId) {
        $records = UserRecord::where(['testId' => $testId]);
        $peopleCounting = $records->count();
        $total = 0;
        foreach($records->cursor() as $record) {
            $total = $total + $record->score;
        }
        $averageScore = $total/$peopleCounting;
        $test = Test::find($testId);
        $test->averageScore = $averageScore;
        $test->peopleCounting = $peopleCounting;
        $test->save();

    }
    private function calculateTime($timeStart, $timeEnd) {
        $date=floor((strtotime($timeEnd)-strtotime($timeStart))/86400);
        $hour=floor((strtotime($timeEnd)-strtotime($timeStart))%86400/3600);
        $minute=floor((strtotime($timeEnd)-strtotime($timeStart))%86400/60);
        $second=floor((strtotime($timeEnd)-strtotime($timeStart))%86400%60);
        return "Your test lasts".$date."day(s)".$hour."hour(s)".$minute."minute(s)".$second."second(s)";
    }
}
