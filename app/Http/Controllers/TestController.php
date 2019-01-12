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
    private $averageScore;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('testCatalog')->with('tests', \App\Test::all());
    }

    public function showTest(Request $request) {
        $testId = $request->id;
        return view('testContent')->with('testId', $testId);
    }

    public function showResult(Request $request) {
        $testId = $request->id;
        $correctAnswers = Question::where('testId', $testId);
        $results = array();
        $score = 0;
        $j = 1;
        foreach ($correctAnswers->cursor() as $correctAnswer) {
            $unknownAnswer = "";
            if( $j == 10){
                $multis10 = $request->get('input0');
                if($multis10 != null){
                    $length = count($multis10);
                    for($toCheck = 0; $toCheck< $length; $toCheck++){
                        $unknownAnswer = $unknownAnswer.$multis10[$toCheck].",";
                    }
                }
            }
            elseif( $j == 8 || $j== 9){
                $multis = $request->get('input'.$j);
                if($multis != null){
                    $length = count($multis);
                    for($toCheck = 0; $toCheck< $length; $toCheck++){
                        $unknownAnswer = $unknownAnswer.$multis[$toCheck].",";
                    }
                }
            }
            else
                $unknownAnswer = $request->input('input' . $j);

            if ($correctAnswer->answer == $unknownAnswer) {
                $checkAnswer = 'Right';
                $score++;
            } else {
                $checkAnswer = 'Wrong';
            }
            $result = array($j,$unknownAnswer,$correctAnswer->answer,$checkAnswer);
            array_push($results,$result);
            $j++;
        }

        $this->createUserRecord($score,$testId);
        $this->updateTest($testId);
        return view('testResult',['results'=>$results,'score'=>$score]);

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

}
