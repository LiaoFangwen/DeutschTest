<!-- connected to userRecordController@showRecord -->
<!-- show history record of users -->
@extends('layouts.app')

@section('content')
    <div id="title" style="text-align: center; margin-top:20px;">
        <h1>History Record</h1>
    </div>
    <div style = "padding-left: 400px">

    </div>
    <div style="width:1140px;margin-left:auto;margin-right:auto">
        <div style="width:600px;margin-left:auto;margin-right:auto">
            <!-- records table-->
            <!-- first row: Test ID-->
            <!-- second row: attempt times-->
            <!-- third row: score of every attempt-->
            <!-- fourth row: average score of these attempts-->
            <!-- fifth row: average score of every test-->
            <table class="table">
                <tr>
                    <th>Test Name</th>
                    <th>Attempt</th>
                    <th>Score</th>
                    <th>Your Average Score</th>
                    <th>Average Score of Test</th>
                </tr>
                @for($i=0;$i<count($recordsList);$i++)
                    <!-- only show latest 5 attempt times of every test-->
                    @if($i%5==0)
                        <tr>
                            <td>{{'Test'.$recordsList[$i]['testId']}}</td>
                            <td id="attempt{{$i}}" value = "attempt{{$recordsList[$i]['attemptNumber']}}">{{$recordsList[$i]['attemptNumber']}}</td>
                            <td id="score{{$i}}" value = "score{{$recordsList[$i]['score']}}">{{$recordsList[$i]['score']}}</td>
                            <td rowspan="5" style="text-align: center">{{$averageScores['test'.$recordsList[$i]['testId']]}}</td>
                            <td rowspan="5" style="text-align: center">{{$testAverageScores[$recordsList[$i]['testId']]}}</td>
                        </tr>
                    @else
                        <tr>
                            <td>{{'Test'.$recordsList[$i]['testId']}}</td>
                            <td id="attempt{{$i}}" value = "attempt{{$recordsList[$i]['attemptNumber']}}">{{$recordsList[$i]['attemptNumber']}}</td>
                            <td id="score{{$i}}" value = "score{{$recordsList[$i]['score']}}">{{$recordsList[$i]['score']}}</td>
                        </tr>
                    @endif
                @endfor
            </table>
        </div>
    </div>

@endsection


