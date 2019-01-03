@extends('layouts.app')

@section('content')
<div id="title" style="text-align: center;">
    <h1>Test Content</h1>
    <div style="padding: 5px; font-size: 16px;">Test Catalog</div>
</div>
<hr>
<div id="content">
    <form action="{{url('/test/testResult/'.$testId)}}" method="post">
        {!! csrf_field() !!}
    <ul>
        @foreach (\App\Question::where('testId', $testId)->cursor() as $question)
            <li style="margin: 50px 0;">
                <div>
                    <h4>{{$question->questionContent}}</h4>
                    <div>
                        @foreach (\App\QuestionOption::where('questionId', $question->id)->cursor() as $questionOption)
                            <input class="uncorrectedAnswer" type="radio" name="input{{($question->id)%10}}"
                                   value="{{$questionOption->optionContent}}">{{$questionOption->optionContent}}
                        @endforeach
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
        <input type="submit" value="Show Result">
    </form>
</div>
@endsection