<div id="title" style="text-align: center;">
    <h1>Test Content</h1>
    <div style="padding: 5px; font-size: 16px;">Test Catalog</div>
</div>
<hr>
<div id="content">
    <ul>
        @foreach (\App\Question::where('testId', $testId)->cursor() as $question)
            <li style="margin: 50px 0;">
                <div>
                    <h4>{{$question->questionContent}}</h4>
                    <div>

                        @foreach (\App\QuestionOption::where('questionId', $question->id)->cursor() as $questionOption)
                            <input type="radio" value="{{$questionOption->optionContent}}">{{$questionOption->optionContent}}
                        @endforeach

                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>