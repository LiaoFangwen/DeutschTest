@extends('layouts.app')

@section('content')
    <div id="title" style="text-align: center;">
        <h1>{{ 'Test'.$testId }}</h1>
    </div>
    <hr>
    <div id="content" style="text-align: center;">
        <form action="{{url('admin/saveTestEdit/'.$testId)}}" method="post">
            {!! csrf_field() !!}
            <table>
                @foreach ($questions->cursor() as $question)
                    <tr>
                        <td>Question content: <input type="text" name="content{{($question->id)%10}}" value="{{$question->questionContent}}"></td><br>
                    </tr>
                    <tr>
                        <td><input type="radio" name="type{{($question->id)%10}}" value="single">single</td>
                        <td><input type="radio" name="type{{($question->id)%10}}" value="blank">blank</td>
                        <td><input type="radio" name="type{{($question->id)%10}}" value="multi">multi</td>
                    </tr>
                    <tr>
                        <td>Only for blank: <input type="text" name="blank{{($question->id)%10}}"></td><br>
                    </tr>
                    <tr>
                        <td>Only for single only one is allowed to choose </td>
                    </tr>
                    @foreach(\App\QuestionOption::where('questionId', ($question->id))->cursor() as $option)
                        <td><input type="checkbox" name="option{{($question->id)%10}}[]" value="{{($option->id)%4}}"></td>
                        <td><input type="text" name="optionContent{{($question->id)%10}}[]" value="{{$option->optionContent}}"></td>
                    @endforeach
                @endforeach
            </table>
            <input type="submit" class="btn btn-default" value="Next">
        </form>
    </div>
@endsection