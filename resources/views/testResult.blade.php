@extends('layouts.app')

@section('content')
<div id="title" style="text-align: center;">
    <h1>Your Result of Test</h1>
</div>
<div style = "padding-left: 400px">
</div>
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
    <div style="width:440px;margin-left: auto;margin-right: auto">
        <div style="float: left"><h5>Your score: {{$score}}</h5></div>
        <div style="float: right"><h5>Your time: </h5></div>
    </div>
</div>
<br/><br/>
@endsection
