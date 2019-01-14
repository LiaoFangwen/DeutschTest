@extends('layouts.app')

@section('content')
    <div style="margin-left:auto; margin-right:auto;">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                <li>Please answer:</li>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </ul>
        </div>
    @endif
    </div>

    <div style="width:100%;height:50px;position:fixed;background-color:#f8fafc;">
        <div style="width: 100% ;position: relative">
        <div id="title" style="text-align: center;">

            <h1>{{ 'Test'.$testId }}</h1>
        </div>
        <div id="timeDiv">Time：<span id="timer">20 : 00</span></div>
        </div>
    </div>


    <div id="content" style="text-align: center;margin-top:70px;">
    <form action="{{url('/test/testResult/'.$testId)}}" method="post">
        {!! csrf_field() !!}
            <table class="table table-striped" style="width:700px;margin-left:auto;margin-right:auto;text-align:left">
                @foreach (\App\Question::where('testId', $testId)->cursor() as $question)
                    {{--choose one correct answer --}}
                    @if($question->type == "single")
                    <tr><td colspan="4" ><h4>{{$question->questionContent}}</h4></td></tr>
                    <tr>
                        @foreach (\App\QuestionOption::where('questionId', $question->id)->cursor() as $questionOption)
                        <td><input class="uncorrectedAnswer" type="radio" name="input{{($question->id)%10}}" value="{{$questionOption->optionContent}}"
                            <?php if($questionOption->optionContent == old('input'.($question->id)%10)){ echo 'checked';}?>>{{$questionOption->optionContent}}
                        </td>
                        @endforeach
                    </tr>
                    @endif
                @endforeach
            </table>
            <table class="table table-striped" style="width:700px;margin-left:auto;margin-right:auto;text-align:left">
                @foreach(\App\Question::where('testId', $testId)->cursor() as $question)
                    {{-- filling the blanks --}}
                     @if($question->type == "blank")
                        <tr><td colspan="4" ><h4>{{$question->questionContent}}</h4></td></tr>
                        <td><input class="uncorrectedAnswer" type="text" name="input{{($question->id)%10}}" maxlength="40" value="{{old('input'.($question->id)%10)}}">
                        </td>
                        </tr>
                     @endif
                 @endforeach
            </table>
        </table>
        <table class="table table-striped" style="width:700px;margin-left:auto;margin-right:auto;text-align:left">
            @foreach(\App\Question::where('testId', $testId)->cursor() as $question)
                {{-- multiple choices --}}
                @if($question->type == "multi")
                    <tr><td colspan="4" ><h4>{{$question->questionContent}}</h4></td></tr>
                    <tr>
                        @foreach (\App\QuestionOption::where('questionId', $question->id)->cursor() as $questionOption)
                            <td><input class="uncorrectedAnswer" type="checkbox" name="input{{($question->id)%10}}[]"
                                 value="{{$questionOption->optionContent}}" >{{$questionOption->optionContent}}
<!--                                --><?php //if($questionOption->optionContent == old('input'.($question->id)%10))
//                                        { echo 'checked';}?>
                            </td>
                            {{--<script>window.alert({{old('input'.($question->id)%10)}})</script>--}}
                        @endforeach
                    </tr>
                @endif
            @endforeach
        </table>
        <br/>
        <input type="submit" class="btn btn-default" value="Show Result">
    </form>
    </div>
@endsection

<style>
    #title{
        position:absolute;
        height:100%;
        width:100%;
        margin-top:5px;
    }
    #timeDiv{
        margin-right:5px;
        margin-top:15px;
        width: 95%;
        position:absolute;
        text-align:right;
    }
</style>
<script>
    var clock=new clock();
    var timer;

    window.onload=function(){

        timer=setInterval("clock.move()",1000);
    }
    function clock(){
        // s: whole needed seconds
        this.s=1199;
        this.move=function(){
            document.getElementById("timer").innerHTML=exchange(this.s);
            this.s=this.s-1;

            // if time is out, then stopping calling move()
            if(this.s<0){
                alert("Time is out, you can still answer.");
                clearTimeout(timer);
            }
        }
    }

    //change seconds to minutes
    function exchange(time){
        this.m=Math.floor(time/60);
        this.s=(time%60);
        if(this.s>=10)
            if(this.m>=10)
                this.text=this.m+" : "+this.s;
            else
                this.text="0"+this.m+" : "+this.s;
        else
        if(this.m>=10)
            this.text=this.m+" : 0"+this.s;
        else
            this.text="0"+this.m+" : 0"+this.s;
        return this.text;
    }
</script>