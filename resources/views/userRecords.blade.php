@extends('layouts.app')

@section('content')
<div id="title" style="text-align: center;">
    <h1>History Record</h1>
</div>
<hr>
    <div style="width:1140px;margin-left:auto;margin-right:auto">
        <div style="width:368px;margin-left:auto;margin-right:auto">
        <table class="table">
            <tr>
                <th>Test Name</th>
                <th>Attempt</th>
                <th>Score</th>
            </tr>
            @foreach (\App\UserRecord::where(['userId' => $user->id])->cursor() as $record)
                <tr>
                    <td>{{'Test'.$record->testId}}</td>
                    <td>{{$record->attemptNumber}}</td>
                    <td>{{$record->score}}</td>
                </tr>
             @endforeach
        </table>
        </div>
    </div>
@endsection
