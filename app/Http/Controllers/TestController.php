<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestResultPost;
use App\Question;
use App\Test;
use App\User;
use App\UserRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Mews\Purifier\Purifier;
use Validator;
class TestController extends Controller
{
    private $averageScore;
    public function __construct()
    {
        //if the user is not logged in, redirect to log in.
        $this->middleware('auth');
    }

    /**
     * show the test catalog page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('testCatalog')->with('tests', \App\Test::all());
    }

    /**
     * show the specific content of the test where user can do the test
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTest(Request $request) {
        $testId = $request->id;
        return view('testContent')->with('testId', $testId);
    }

    /**
     * after user post the test, calculate the score of this test, and show the result in test result page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function showResult(Request $request) {
        $testId = $request->id;
        //validation with laravel validator
        $messages = [
            'input0.required' => 'question 10',
            'input1.required' => 'question 1',
            'input2.required' => 'question 2',
            'input3.required' => 'question 3',
            'input4.required' => 'question 4',
            'input5.required' => 'question 5',
            'input6.required' => 'question 6',
            'input7.required' => 'question 7',
            'input8.required' => 'question 8',
            'input9.required' => 'question 9',

        ];
        $validator = Validator::make($request->all(), [
            'input0' => 'required',
            'input1' => 'required',
            'input2' => 'required',
            'input3' => 'required',
            'input4' => 'required',
            'input5' => 'required',
            'input6' => 'required',
            'input7' => 'required',
            'input8' => 'required',
            'input9' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect('test/'.$testId)
                ->withErrors($validator)
                ->withInput();
        }

        //user purifier to clean the input data in order to stop XSS!!!
        for($toClean = 0; $toClean< 10; $toClean ++){


        }

        //if is valid, calculate the score
        $correctAnswers = Question::where('testId', $testId);
        $types = array();
        $results = array();
        $score = 0;
        $j = 1;
        foreach ($correctAnswers->cursor() as $correctAnswer) {
            $types[$j-1] = $correctAnswer->type;
            $answerGetFromTest = null;
            $unknownAnswer = "";
            if($j == 10){
                $answerGetFromTest = $request->get('input0');
                //if it is a multi choice, then the input is an array
                if(is_array($answerGetFromTest)) {
                    $length = count($answerGetFromTest);
                    if($length == 1) {
                        $unknownAnswer = $answerGetFromTest[0].",";
                    } else {
                        //connect all checked answers into one string
                        for($toCheck = 0; $toCheck< $length; $toCheck++){
                            $unknownAnswer = $unknownAnswer.$answerGetFromTest[$toCheck].",";
                        }
                    }
                } else {
                    $unknownAnswer = strip_tags(clean($answerGetFromTest));
                }
            } else {
                $answerGetFromTest = $request->input('input' . $j);
                if(is_array($answerGetFromTest)) {
                    $length = count($answerGetFromTest);
                    if($length == 1) {
                        $unknownAnswer = $answerGetFromTest[0].",";
                    } else {
                        for($toCheck = 0; $toCheck< $length; $toCheck++){
                            $unknownAnswer = $unknownAnswer.$answerGetFromTest[$toCheck].",";
                        }
                    }
                } else {
                    $unknownAnswer = strip_tags(clean($answerGetFromTest));
                }
            }
            if ($correctAnswer->answer == $unknownAnswer) {
                $checkAnswer = 'Right';
                $score++;
            } else {
                $checkAnswer = 'Wrong';
            }
            //put the result into results array
            $result = array($j,$unknownAnswer,$correctAnswer->answer,$checkAnswer);
            array_push($results,$result);
            $j++;
        }
        //add a new user record in database
        $this->createUserRecord($score,$testId);
        //update the average test score into database
        $this->updateTest($testId);
        return view('testResult',['results'=>$results,'score'=>$score, 'types' => $types]);

    }

    /**
     * create a new user test record in the database after the score is calculated
     * @param $score user score of the test
     * @param $testId test id
     */
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

    /**
     * after a new user test record created, recalculated the average score of the test and update it in database
     * @param $testId test id
     */
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
