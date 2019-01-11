@extends('layouts.app')

@section('content')
<div id="title" style="text-align: center;">
    <h1>{{ 'Test'.$testId }}</h1>
</div>
<hr>
<div id="content" style="text-align: center;">
    <form action="{{url('/test/testResult/'.$testId)}}" method="post">
        {!! csrf_field() !!}
            <table class="table table-striped" style="width:700px;margin-left:auto;margin-right:auto;text-align:left">
                @foreach (\App\Question::where('testId', $testId)->cursor() as $question)
                    @if($question->type == "single")
                    <tr><td colspan="4" ><h4>{{$question->questionContent}}</h4></td></tr>
                    <tr>
                        @foreach (\App\QuestionOption::where('questionId', $question->id)->cursor() as $questionOption)
                        <td><input class="uncorrectedAnswer" type="radio" name="input{{($question->id)%10}}"
                               value="{{$questionOption->optionContent}}">{{$questionOption->optionContent}}
                        </td>
                        @endforeach
                    </tr>
                    @endif
                @endforeach
            </table>
            <table class="table table-striped" style="width:700px;margin-left:auto;margin-right:auto;text-align:left">
                @foreach(\App\Question::where('testId', $testId)->cursor() as $question)
                     @if($question->type == "blank")
                        <tr><td colspan="4" ><h4>{{$question->questionContent}}</h4></td></tr>
                        <td><input class="uncorrectedAnswer" type="text" name="input{{($question->id)%10}}"></td>
                        </tr>
                     @endif
                 @endforeach
            </table>
        <br/>
        <input type="submit" class="btn btn-default" value="Show Result">
    </form>
</div>
@endsection