<!-- connected to TestController@showTest -->
<!-- show test content and record user answers -->
@extends('layouts.app')

@section('content')
    <!-- test id and timer -->
    <div style="width:100%;height:50px;position:fixed;background-color:#f8fafc;">
        <div style="width: 100% ;position: relative">
        <div id="title" style="text-align: center;">
            <h1>{{ 'Test'.$testId }}</h1>
        </div>
        <div id="timeDiv">Time：<span id="timer">20 : 00</span></div>
        </div>

    </div>

    <!-- validation alert -->
    <div style="margin-left:auto; margin-right:auto; margin-top:60px;">
        @if ($errors->any())
            <div id="alertDiv">
                <ul>
                    <li>Please answer:
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach</li>
                </ul>
            </div>
        @endif
    </div>

    <!-- test content-->
    <div id="content" style="text-align: center;margin-top:20px;">
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
                    @elseif($question->type == "blank")
                        <tr><td colspan="4" ><h4>{{$question->questionContent}}</h4></td></tr>
                        <td colspan="4"><input class="uncorrectedAnswer" type="text" name="input{{($question->id)%10}}" maxlength="40" value="{{old('input'.($question->id)%10)}}">

                        </td>
                        </tr>
                    @elseif($question->type == "multi")
                        <tr><td colspan="4" ><h4>{{$question->questionContent}}</h4></td></tr>
                        <tr>
                            @foreach (\App\QuestionOption::where('questionId', $question->id)->cursor() as $questionOption)
                                <td><input class="uncorrectedAnswer" type="checkbox" name="input{{($question->id)%10}}[]"
                                           value="{{$questionOption->optionContent}}"
                                    <?php
                                        $answers = old('input'.($question->id)%10);
                                        if(is_array($answers)){
                                            for($i=0;$i<count($answers);$i++){
                                                if($questionOption->optionContent == $answers[$i])
                                                { echo 'checked';}
                                            }
                                        }
                                    ?>
                                    >{{$questionOption->optionContent}}
                                </td>
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

<!-- style -->
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
    #alertDiv{
        margin-left:auto;
        margin-right:auto;
        text-align:center;
        width:1000px;
        height:60px;
        background-color: rgba(255,0,0,0.3);
        border: 1px solid;
        border-color: rgba(255, 2, 10, 0.12);
        border-radius:5px;
        font-size:18px;
        color:rgba(142, 2, 7, 0.88);
    }
</style>

<!-- script -->
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