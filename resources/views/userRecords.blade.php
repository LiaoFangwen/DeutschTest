@extends('layouts.app')

@section('content')

    <div style="width:700px; height: 900px;">
        <canvas id="myChart"></canvas>
    </div>

    <div id="title" style="text-align: center;">
        <h1>History Record</h1>
    </div>
    <div style = "padding-left: 400px">

    </div>
    <div style="width:1140px;margin-left:auto;margin-right:auto">
        <div style="width:600px;margin-left:auto;margin-right:auto">
            <table class="table">
                <tr>
                    <th>Test Name</th>
                    <th>Attempt</th>
                    <th>Score</th>
                    <th>Your Average Score</th>
                    <th>Average Score of Test</th>
                </tr>
                @for($i=0;$i<count($recordsList);$i++)
                    @if($i%5==0)
                        <tr>
                            <td>{{'Test'.$recordsList[$i]['testId']}}</td>
                            <td id="attempt{{$i}}" value = "attempt{{$recordsList[$i]['attemptNumber']}}">{{$recordsList[$i]['attemptNumber']}}</td>
                            <td id="score{{$i}}" value = "score{{$recordsList[$i]['score']}}">{{$recordsList[$i]['score']}}</td>
                            <td rowspan="5" style="text-align: center">{{$averageScores['test'.$recordsList[$i]['testId']]}}</td>
                            <td rowspan="5" style="text-align: center">{{$testAverageScores[$recordsList[$i]['testId']]}}</td>
                        </tr>
                    @else
                        <tr>
                            <td>{{'Test'.$recordsList[$i]['testId']}}</td>
                            <td id="attempt{{$i}}" value = "attempt{{$recordsList[$i]['attemptNumber']}}">{{$recordsList[$i]['attemptNumber']}}</td>
                            <td id="score{{$i}}" value = "score{{$recordsList[$i]['score']}}">{{$recordsList[$i]['score']}}</td>
                        </tr>
                    @endif
                @endfor
            </table>
        </div>
    </div>



@endsection

<script type="text/javascript" src="{{ URL::asset('js/Chart.js-2.7.3/dist/Chart.js') }}"></script>
<script>
    window.onload = function(){
        var x1 = document.getElementById("attempt4").innerHTML;
        var x2 = document.getElementById("attempt3").innerHTML;
        var x3 = document.getElementById("attempt2").innerHTML;
        var x4 = document.getElementById("attempt1").innerHTML;
        var x5 = document.getElementById("attempt0").innerHTML;

        var y1 = document.getElementById("score4").innerHTML;
        var y2 = document.getElementById("score3").innerHTML;
        var y3 = document.getElementById("score2").innerHTML;
        var y4 = document.getElementById("score1").innerHTML;
        var y5 = document.getElementById("score0").innerHTML;

        var ctx = document.getElementById("myChart");

        if(ctx == null){
            alert("null");
        }
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [ x1, x2, x3, x4, x5 ],
                datasets: [{
                    label: 'grade',
                    data: [y1, y2, y3, y4, y5 ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
        myChart.Bar(data);
    }
</script>
