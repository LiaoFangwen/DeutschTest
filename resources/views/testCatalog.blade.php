@extends('layouts.app')

@section('content')
    <div id="title" style="text-align: center;">
        <h1>Take a List</h1>
    </div>
    <hr>
    <div id="content" style="width:1140px;margin-left:auto;margin-right:auto;display:flex">
        <div id="ul1" style="width:400px;margin-left:auto;margin-right:auto;text-align:center">
        <ul>
            @foreach ($tests as $test)
                @if ($test->id <=5 )
                <li style="margin: 50px;">
                    <div class="title">
                        <a href="{{ url('test/'.$test->id) }}">
                            <h4>{{ $test->testName }}</h4>
                        </a>

                    </div>
                </li>
                @endif
            @endforeach
        </ul>
        </div>
        <div id="ul2" style="width:400px;margin-left:auto;margin-right:auto;text-align:center">
        <ul>
            @foreach ($tests as $test)
                @if ($test->id >5 )
                <li style="margin: 50px;">
                    <div class="title">
                        <a href="{{ url('test/'.$test->id) }}">
                            <h4>{{ $test->testName }}</h4>
                        </a>
                    </div>
                </li>
                @endif
            @endforeach
        </ul>
        </div>
    </div>
@endsection