@extends('layouts.admin')

@section('content')
    <div id="title" style="text-align: center;">
        <h1>{{ 'Test'.$testId }}</h1>
    </div>
    <hr>
    <div style="width:600px;margin-left:auto;margin-right:auto">
        <form action="{{url('admin/saveTestEdit/'.$testId)}}" method="post">
            {!! csrf_field() !!}
            <table class="table">
                @foreach ($questions->cursor() as $question)
                    <tr>
                        <th colspan="3">Question content: <input type="text" name="content{{($question->id)%10}}" value="{{$question->questionContent}}"></th>
                    </tr>
                    <tr>
                        <td><input type="radio" name="type{{($question->id)%10}}" value="single" onclick="showSingle({{($question->id)%10}})">single</td>
                        <td><input type="radio" name="type{{($question->id)%10}}" value="blank" onclick="showBlank({{($question->id)%10}})">blank</td>
                        <td><input type="radio" name="type{{($question->id)%10}}" value="multi" onclick="showMulti({{($question->id)%10}})">multi</td>
                    </tr>
                    <tr id="blank{{($question->id)%10}}" style="display:none">
                        <td colspan="3">Only for blank: <input type="text" name="blank{{($question->id)%10}}"></td>
                    </tr>
                    @foreach(\App\QuestionOption::where('questionId', ($question->id))->cursor() as $option)
                        <tr name="single{{($question->id)%10}}" style="display:none">
                            <td><input type="radio" name="option{{($question->id)%10}}[]" value="{{($option->id)%4}}"></td>
                            <td colspan="2"><input type="text" name="optionContent{{($question->id)%10}}[]" value="{{$option->optionContent}}"></td>
                        </tr>
                    @endforeach

                    @foreach(\App\QuestionOption::where('questionId', ($question->id))->cursor() as $option)
                        <tr name="multi{{($question->id)%10}}" style="display:none">
                            <td><input type="checkbox" name="option{{($question->id)%10}}[]" value="{{($option->id)%4}}"></td>
                            <td colspan="2"><input type="text" name="optionContent{{($question->id)%10}}[]" value="{{$option->optionContent}}"></td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
            <div style="width:100%;text-align:center;">
            <input type="submit" class="btn btn-default" value="Save">
            </div>
        </form>
    </div>
@endsection

<script>
    function showSingle(id){
        var singles = document.getElementsByName("single"+id);
        for(n=0;n<singles.length;n++){
            singles[n].style.display = "table-row";
        }
        document.getElementById("blank"+id).style.display="none";
        var multis = document.getElementsByName("multi"+id);
        for(n=0;n<multis.length;n++){
            multis[n].style.display = "none";
        }
    }

    function showBlank(id){
        var singles = document.getElementsByName("single"+id);
        for(n=0;n<singles.length;n++){
            singles[n].style.display = "none";
        }
        document.getElementById("blank"+id).style.display="table-row";
        var multis = document.getElementsByName("multi"+id);
        for(n=0;n<multis.length;n++){
            multis[n].style.display = "none";
        }
    }

    function showMulti(id){
        var singles = document.getElementsByName("single"+id);
        for(n=0;n<singles.length;n++){
            singles[n].style.display = "none";
        }
        document.getElementById("blank"+id).style.display="none";
        var multis = document.getElementsByName("multi"+id);
        for(n=0;n<multis.length;n++){
            multis[n].style.display = "table-row";
        }
    }
</script>