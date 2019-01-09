<?php

namespace App\Http\Controllers;

use App\UserRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class UserRecordController extends Controller
{
    protected $user;
    private $averageScore;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = $request->user();
            return $next($request);
        });
    }
    public function showRecord() {
        $user = $this->user;

        $averageScores = array();
        $recordsList = array();
        for($i=1;$i<=10;$i++) {
            $totalScore=0;
            $records = UserRecord::whereRaw('userId = ? and testId = ? order by updated_at desc',[$user->id,$i]);
            $number = 1;
            foreach($records->cursor() as $record){
                if($number<=5){
                    $totalScore = $totalScore + $record->score;
                    $number ++;
                    array_push($recordsList,['testId'=>$i,'attemptNumber'=>$record->attemptNumber,'score'=>$record->score]);
                }
            }
            $averageScore = $totalScore/$number;
            $averageScores['test'.$i] = $averageScore;

        }
        return view('userRecords',['recordsList'=>$recordsList,'averageScores'=>$averageScores]);
    }
}
