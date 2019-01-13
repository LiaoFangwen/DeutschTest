<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use function PHPSTORM_META\type;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('adminLogin:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }

    public function showAdminFunction() {
        return view('admin.adminFunction');
    }

    public function showTestCatalog() {
        return view('admin.adminEditTest')->with('tests', \App\Test::all());
    }

    public function editTestContent(Request $request) {
        $testId = $request->id;
        $questions = \App\Question::where('testId', $testId);
        return view('admin.adminTestContent')->with(['testId' => $testId, 'questions' => $questions]);
    }

    public function saveTestEdit(Request $request) {
        $testId = $request->id;
        $contents = Array();
        $types = Array();
        $blanks = Array();
        $optionContents = Array();
        $options = Array();
        for($i = 0; $i < 10; $i++) {
            $contents[$i] = $request->get('content'.($i%10));
            $types[$i] = $request->get('type'.($i%10));
            $blanks[$i] = $request->get('blank'.($i%10));
            $optionContents[$i] = $request->get('optionContent'.($i%10));
            $options[$i] = $request->get('option'.($i%10));
        }
        for($j = 1; $j < 11; $j++) {
            $questionId = ($testId-1)*10+$j;
            $newQuestion = Question::find($questionId);
            $newQuestion->questionContent = $contents[$j%10];
            $newQuestion->type = $types[$j%10];
            if($types[$j%10] == 'single') {
                $newOptionContents = QuestionOption::where('questionId', $questionId);
                $n = 0;
                foreach ($newOptionContents->cursor() as $content){
                    $content->optionContent = $optionContents[$j%10][$n];
                    $content->save();
                    $n++;
                }
                $newQuestion->answer = $optionContents[$j%10][($options[$j%10][0]+3)%4];
            } else if($types[$j%10] == 'blank') {
                $newQuestion->answer = $blanks[$j%10];
            } else if($types[$j%10] == 'multi') {
                $newOptionContents = QuestionOption::where('questionId', $questionId);
                $n = 0;
                foreach ($newOptionContents->cursor() as $content){
                    $content->optionContent = $optionContents[$j%10][$n];
                    $content->save();
                    $n++;
                }
                $answer = "";
                for($k = 0; $k < count($options[$j%10]); $k++) {
                    $answer = $answer.$optionContents[$j%10][($options[$j%10][$k]+3)%4].",";
                }
                $newQuestion->answer = $answer;
            }
            $newQuestion->save();
        }
        echo "Save Success!";
        //return view('admin.adminTestOptions')->with(['testId' => $testId, 'contents' => $contents, 'types' => $types]);
    }

    public function editTestAnswers(Request $request) {
        $testId = $request->id;
        $contents = Array();

    }
}
