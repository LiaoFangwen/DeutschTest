@extends('layouts.app')

@section('content')
<div style="margin-top:20px;"class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hi, {{ Auth::user()->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul>
                        <li><a href="{{ url('/test') }}">Take a test</a></li>
                        <li><a href="{{ url('/userRecord') }}">History Record</a></li>
                        <li>{{$averageScores[0]['testAverageScore']}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
