<?php

namespace App\Http\Controllers;

use App\Test;
use App\UserRecord;
use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function showChart()
    {
        $user = $this->user;
        $averageScores = array();
        for($i=1;$i<=10;$i++) {
            $totalScore=0;
            $records = UserRecord::where(['userId' => $user->id, 'testId' => $i]);
            $number = 0;
            foreach($records->cursor() as $record){
                    $totalScore = $totalScore + $record->score;
                    $number ++;
            }
            $ts = Test::find($i);
            if($number !=0){
                $averageScore = round($totalScore/$number,2);
            }
            else{
                $averageScore = 0;
            }
            array_push($averageScores,['testId'=>$i,
                'userAverageScore'=>$averageScore,'testAverageScore'=>round($ts->averageScore,2)]);
        }
        return view('home')->with('averageScores',$averageScores);
    }
}
