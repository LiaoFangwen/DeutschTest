@extends('layouts.admin')

@section('content')
    <div id="title" style="text-align: center;">
        <h1>{{ 'Test'.$testId }}</h1>
    </div>
    <hr>
    <div style="width:600px;margin-left:auto;margin-right:auto">
        <form action="{{url('admin/saveTestEdit/'.$testId)}}" method="post">
            {!! csrf_field() !!}
            <table class="table table-striped">
                @foreach ($questions->cursor() as $question)
                    <tr>
                        <th colspan="3">Question content: <input type="text" name="content{{($question->id)%10}}" value="{{$question->questionContent}}"></th>
                    </tr>
                    <tr>
                        <td><input type="radio" name="type{{($question->id)%10}}" value="single">single</td>
                        <td><input type="radio" name="type{{($question->id)%10}}" value="blank">blank</td>
                        <td><input type="radio" name="type{{($question->id)%10}}" value="multi">multi</td>
                    </tr>
                    <tr>
                        <td colspan="3">Only for blank: <input type="text" name="blank{{($question->id)%10}}"></td>
                    </tr>
                    <tr>
                        <td colspan="3">Only for single only one is allowed to choose </td>
                    </tr>
                    @foreach(\App\QuestionOption::where('questionId', ($question->id))->cursor() as $option)
                        <tr>
                        <td><input type="checkbox" name="option{{($question->id)%10}}[]" value="{{($option->id)%4}}"></td>
                        <td><input type="text" name="optionContent{{($question->id)%10}}[]" value="{{$option->optionContent}}"></td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
            <div style="width:100%;text-align:center;">
            <input type="submit" class="btn btn-default" value="Next">
            </div>
        </form>
    </div>
@endsection