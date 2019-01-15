<!-- connected to TestController@showResult -->
<!-- show user answers and results -->
@extends('layouts.app')

@section('content')
<div id="title" style="text-align: center;margin-top:20px;">
    <h1>Your Result of Test</h1>
</div>

<!-- test result table-->
<!-- first row: question number-->
<!-- second row: user's answer-->
<!-- third row: right answer-->
<!-- fourth row: result-->
<div style="text-align: center;">
    <table class="table table-condensed" style="width:500px;margin-left:auto;margin-right:auto;margin-top:30px;">
        <tr>
            <th>Question Nr.</th>
           <th>Your Answer</th>
           <th>Right Answer</th>
           <th>Result</th>
       </tr>
       @for($i = 0; $i<10; $i++)
            <tr>
            @for($j=0;$j<4;$j++)
                <td>
                    @if ($j==1 && $results[$i][$j]=="")
                     No Answer
                    @else
                        {{$results[$i][$j]}}
                   @endif
                </td>
            @endfor
            </tr>
        @endfor
    </table>

    <br/>

    <!-- test score-->
    <div style="width:440px;margin-left: auto;margin-right: auto;text-align: center">
        <h5>Your score: {{$score}}</h5>
    </div>


    <div style="width:400px;margin-left:auto;margin-right:auto;margin-top:40px;">
        <table>
            <tr><td class="linkTd" style="text-align:left;">
                    <a class="link" href="{{url('/home')}}"> Go to Evaluation</a>
                </td><td class="linkTd" style="text-align:right;">
                    <a class="link" href="{{url('/test')}}"> Take a Test</a>
                </td></tr>
        </table>
    </div>
</div>
<br/><br/>
@endsection

<!-- style -->
<style>
    .linkTd{
        width:200px;
        height:10px;
    }
    .link{
        text-decoration:none;
        font-size: 20px;
    }
</style>