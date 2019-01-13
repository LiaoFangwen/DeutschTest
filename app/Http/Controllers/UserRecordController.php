<?php

namespace App\Http\Controllers;

use App\Test;
use App\UserRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class UserRecordController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = $request->user();
            return $next($request);
        });
    }
    public function showRecord() {
        $user = $this->user;
        $testAverageScores = array();
        $averageScores = array();
        $recordsList = array();
        for($i=1;$i<=10;$i++) {
            $totalScore=0;
            $records = UserRecord::where(['userId' => $user->id, 'testId' => $i])->orderBy('updated_at', 'DESC');
            $number = 0;
            foreach($records->cursor() as $record){
                if($number<5){
                    $totalScore = $totalScore + $record->score;
                    $number ++;
                    array_push($recordsList,['testId'=>$i,'attemptNumber'=>$record->attemptNumber,'score'=>$record->score]);
                }
            }
            $ts = Test::find($i);
            $testAverageScores[$i] = round($ts->averageScore,2);
            $averageScore = round($totalScore/$number,2);

            $averageScores['test'.$i] = $averageScore;

        }
        return view('userRecords',['recordsList'=>$recordsList,'averageScores'=>$averageScores, 'testAverageScores' => $testAverageScores]);

    }
}
