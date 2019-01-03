@extends('layouts.app')

@section('content')
<h2>Your Test Result of Test{{$results[31]}}</h2>
<h4>Your answers:</h4>
<table>
    <tr>
        @for($i = 0; $i<30; $i=$i+3)
            <th>{{$results[$i+2]}}</th>
        @endfor
    </tr>
</table>
<h4>The Right answers:</h4>
<table>
    <tr>
        @for($i = 0; $i<30; $i=$i+3)
            <th>{{$results[$i+1]}}</th>
        @endfor
    </tr>
</table>
<h4>Your results</h4>
<table>
    <tr>
        @for($i = 0; $i<30; $i=$i+3)
            <th>{{$results[$i]}}</th>
        @endfor
    </tr>
</table>
<h4>Your score: {{$results[30]}}</h4>
<h4>Your time: {{$results[32]}}</h4>
@endsection
