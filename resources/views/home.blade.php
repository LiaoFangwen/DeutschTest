@extends('layouts.app')

@section('content')
<div style="margin-top:20px;"class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hi, {{ Auth::user()->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul>
                        <li><a href="{{ url('/test') }}">Take a test</a></li>
                        <li><a href="{{ url('/userRecord') }}">History Record</a></li>
                        <li>{{$averageScores[0]['testAverageScore']}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="width:700px; height: 900px; margin-left: auto; margin-right: auto;">
    <canvas id="myChart"></canvas>
    @for($i=0;$i<count($averageScores);$i++)
        <input type="hidden" id="y{{$i}}" value="{{$averageScores[$i]['userAverageScore']}}">{{$averageScores[$i]['userAverageScore']}}</input>
        <input type="hidden" id="t{{$i}}" value="{{$averageScores[$i]['testAverageScore']}}">{{$averageScores[$i]['testAverageScore']}}</input>
    @endfor
</div>
@endsection

<script type="text/javascript" src="{{ URL::asset('js/Chart.js-2.7.3/dist/Chart.js') }}"></script>
<script>
    window.onload = function(){
        var x1 = "test1";
        var x2 = "text2";
        var x3 = "test3";
        var x4 = "test4";
        var x5 = "test5";
        var x6 = "test6";
        var x7 = "test7";
        var x8 = "test8";
        var x9 = "test9";
        var x10 = "test10";

        var y0 = document.getElementById("y0").value;
        var y1 = document.getElementById("y1").value;
        var y2 = document.getElementById("y2").value;
        var y3 = document.getElementById("y3").value;
        var y4 = document.getElementById("y4").value;
        var y5 = document.getElementById("y5").value;
        var y6 = document.getElementById("y6").value;
        var y7 = document.getElementById("y7").value;
        var y8 = document.getElementById("y8").value;
        var y9 = document.getElementById("y9").value;

        var t0 = document.getElementById("t0").value;
        var t1 = document.getElementById("t1").value;
        var t2 = document.getElementById("t2").value;
        var t3 = document.getElementById("t3").value;
        var t4 = document.getElementById("t4").value;
        var t5 = document.getElementById("t5").value;
        var t6 = document.getElementById("t6").value;
        var t7 = document.getElementById("t7").value;
        var t8 = document.getElementById("t8").value;
        var t9 = document.getElementById("t9").value;

        var ctx = document.getElementById("myChart");

        if(ctx == null){
            alert("null");
        }
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [ x1, x2, x3, x4, x5,x6,x7,x8,x9,x10],
                datasets: [{
                    label: 'your average score',
                    data: [y0,y1, y2, y3, y4, y5, y6, y7, y8, y9],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)'
                    ],
                    borderWidth: 1
                },
                    {
                        label: 'users average score',
                        data: [t0,t1, t2, t3, t4, t5, t6, t7,t8, t9],
                        backgroundColor: [
                            'rgba(220,220,220,1)'
                        ],
                        borderColor: [
                            'rgba(220,220,220,1)'
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