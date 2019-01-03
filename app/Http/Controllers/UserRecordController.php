<?php

namespace App\Http\Controllers;

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
        return view('userRecords')->with('user', $user);
    }
}
