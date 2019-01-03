<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('testCatalog')->with('tests', \App\Test::all());
    }
    public function showTest(Request $request) {
        $testId = $request->id;
        return view('testContent')->with('testId', $testId);
    }
}
