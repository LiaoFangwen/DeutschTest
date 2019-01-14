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
        //if the admin is not logged in, redirected to admin log in
        $this->middleware('adminLogin:admin');
    }

    /**
     * Show the admin page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }

    /**
     * show admin function page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAdminFunction() {
        return view('admin.adminFunction');
    }

    /**
     * show test catalog page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTestCatalog() {
        return view('admin.adminEditTest')->with('tests', \App\Test::all());
    }

    /**
     * show edit test content page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editTestContent(Request $request) {
        $testId = $request->id;
        $questions = \App\Question::where('testId', $testId);
        return view('admin.adminTestContent')->with(['testId' => $testId, 'questions' => $questions]);
    }

    /**
     * save all the edited content after editing
     * @param Request $request
     */
    public function saveTestEdit(Request $request) {
        $testId = $request->id;
        //arrays for containing posted elements
        $contents = Array();
        $types = Array();
        $blanks = Array();
        $optionContents = Array();
        $options = Array();
        //get all elements content
        for($i = 0; $i < 10; $i++) {
            $contents[$i] = $request->get('content'.($i%10));
            $types[$i] = $request->get('type'.($i%10));
            $blanks[$i] = $request->get('blank'.($i%10));
            $optionContents[$i] = $request->get('optionContent'.($i%10));
            $options[$i] = $request->get('option'.($i%10));
        }
        //save the contents in database
        for($j = 1; $j < 11; $j++) {
            $questionId = ($testId-1)*10+$j;
            $newQuestion = Question::find($questionId);
            $newQuestion->questionContent = $contents[$j%10];
            $newQuestion->type = $types[$j%10];
            //save options for single
            if($types[$j%10] == 'single') {
                $newOptionContents = QuestionOption::where('questionId', $questionId);
                $n = 0;
                foreach ($newOptionContents->cursor() as $content){
                    $content->optionContent = $optionContents[$j%10][$n];
                    $content->save();
                    $n++;
                }
                //save answer for single
                $newQuestion->answer = $optionContents[$j%10][($options[$j%10][0]+3)%4];
                //save answer for blank
            } else if($types[$j%10] == 'blank') {
                $newQuestion->answer = $blanks[$j%10];
                //save options for multi
            } else if($types[$j%10] == 'multi') {
                $newOptionContents = QuestionOption::where('questionId', $questionId);
                $n = 0;
                foreach ($newOptionContents->cursor() as $content){
                    $content->optionContent = $optionContents[$j%10][$n];
                    $content->save();
                    $n++;
                }
                //save answers for multi
                $answer = "";
                for($k = 0; $k < count($options[$j%10]); $k++) {
                    $answer = $answer.$optionContents[$j%10][($options[$j%10][$k]+3)%4].",";
                }
                $newQuestion->answer = $answer;
            }
            //save the new edited question
            $newQuestion->save();
        }
        echo "Save Success!";
    }
}
