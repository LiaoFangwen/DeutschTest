@extends('layouts.app')

@section('content')
<div id="title" style="text-align: center;">
    <h1>Your Result of Test{{$results[31]}}</h1>
</div>

<div style="text-align: center;">
<table class="table table-condensed" style="width:500px;margin-left:auto;margin-right:auto;margin-top:30px;">
    <tr>
        <th>Your Answer</th>
        <th>Right Answer</th>
        <th>Result</th>
    </tr>
    @for($i = 0; $i<30; $i=$i+3)
        <tr>
            <td>
                @if ($results[$i+2]=="")
                    No Answer
                @else
                    {{$results[$i+2]}}
                @endif
            </td>
            <td>{{$results[$i+1]}}</td>
            <td>{{$results[$i]}}</td>
        </tr>
    @endfor
</table>

    <br/>
    <div style="width:440px;margin-left: auto;margin-right: auto">
        <div style="float: left"><h5>Your score: {{$results[30]}}</h5></div>
        <div style="float: right"><h5>Your time: {{$results[32]}}</h5></div>
    </div>
</div>
<br/><br/>
@endsection
