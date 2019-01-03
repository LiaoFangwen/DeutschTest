<?php

namespace App\Http\Controllers;

use App\UserRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class UserRecordController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = $request->user();

            return $next($request);
        });
    }
    public function showRecord() {
        $user = $this->user;
        $this->calculateAverage();
        //return view('userRecords')->with('user', $user);
    }
    public function calculateAverage() {
        $user = $this->user;
        $records = UserRecord::where(['userId' => $user->id, 'testId' => 1]);
        $number = $records->count();
        $total = 0;
        foreach ($records->cursor() as $record) {
            $total = $total + $record->score;
        }
        $averageScore = $total/$number;
        echo $averageScore;


    }
}
