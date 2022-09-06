@extends('layouts2.main')

@section('title', 'Sewa Lahan')

@section('jstop')

<div class="container">
<div class="col-md-12 mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <?php session_start(); ?>
            <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Back</a></li>
        </ol>
    </nav>
</div>

    <h4 class="mt-5">S-Curve</h4>
        <div class="col-md-12">
            <canvas id="Aktual" width="700" height="400"></canvas>
        </div>
</div>

    
    
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/chart.js/Chart.min.js') }}"></script>
    <script>
        var speedCanvas = document.getElementById("Aktual");
        var speedCanvasPercent = document.getElementById("Percent");

            Chart.defaults.global.defaultFontFamily = "Roboto";
            Chart.defaults.global.defaultFontSize = 18;
        const skipped = (ctx, value) => ctx.p0.skip || ctx.p1.skip ? value : undefined;
        const down = (ctx, value) => ctx.p0.parsed.y > ctx.p1.parsed.y ? value : undefined;

        var tanggal = @json($dataScurve['tanggal']);
        var total_aktual = @json($dataScurve['total_aktual']);
        var total_history = @json($dataScurve['total_history']);
        //line one
        var arrFirst = [];
        var tempArrFirst = 0;
        let chart_data_first = 0;
        for (var i = 0; i < tanggal.length; i++) {
            const data = total_aktual[tanggal[i]];
            if(i > 0 && data > 0){
                chart_data_first = +data + +tempArrFirst;
                tempArrFirst = chart_data_first;
                arrFirst.push(chart_data_first)
            }else if(i == 0){
                chart_data_first = +data + +tempArrFirst;
                tempArrFirst = chart_data_first;
                arrFirst.push(chart_data_first)
            }else{
                arrFirst.push(NaN)
            }
        }
        // console.log(arrFirst);
        var dataFirst = {
            label: "Aktual",
            data: arrFirst,
            lineTension: 0,
            fill: false,
            borderColor: 'green',
            segment: {
                borderColor: ctx => skipped(ctx, 'rgb(0,0,0,0.2)') || down(ctx, 'rgb(192,75,75)'),
                borderDash: ctx => skipped(ctx, [6, 6]),
            },
            spanGaps: true
        };
        // line two
        var for_history = [];
        var arrSecond = [];
        var tempArrSecond = 0;
        let chart_data_second = 0;
        for (var i = 0; i < tanggal.length; i++) {
            const data = total_history[tanggal[i]];

            if(i > 0 && data > 0){
                chart_data_second = +data + +tempArrSecond;
                tempArrSecond = chart_data_second;
                for_history.push(chart_data_second);
                arrSecond.push(chart_data_second)
            }else if(i == 0){
                chart_data_second = +data + +tempArrSecond;
                tempArrSecond = chart_data_second;
                arrSecond.push(chart_data_second)
            }else{
                arrSecond.push(NaN)
            }
        }
            
        var dataSecond = {
            label: "Histori",
            data: arrSecond,
            lineTension: 0,
            fill: false,
            borderColor: 'blue',
            segment: {
                borderColor: ctx => skipped(ctx, 'rgb(0,0,0,0.2)') || down(ctx, 'rgb(192,75,75)'),
                borderDash: ctx => skipped(ctx, [6, 6]),
            },
            spanGaps: true
        };
        
        // line three
        var arrDifference = [];
        var tempArrDifference = 0;
        var history_total = for_history[for_history.length-1]
            for (let index = 0; index < arrFirst.length; index++) {
                if(arrFirst[index] > 0){
                    const weight = (arrFirst[index] / history_total) * 100;
                    const num = history_total * (weight.toFixed(0) / 100);
                    //// n// e.log(num);
                    tempArrDifference = num.toFixed(0);
                    arrDifference.push(num.toFixed(0));
                }else if(index == 0){
                    arrDifference.push(arrFirst[index]);
                }else{
                    arrDifference.push(arrFirst[index]);
                }
            }
        // con// e.log(arrDifference);
        var dataDifference = {
            label: "Selisih",
            data: arrDifference,
            lineTension: 0,
            fill: false,
            borderColor: 'red',
            segment: {
                borderColor: ctx => skipped(ctx, 'rgb(0,0,0,0.2)') || down(ctx, 'rgb(192,75,75)'),
                borderDash: ctx => skipped(ctx, [6, 6]),
            },
            spanGaps: true
        };            

        var speedData = {
            labels: tanggal,
            datasets: [dataFirst, dataSecond]
        };

        var chartOptions = {
            legend: {
                display: true,
                position: 'top',
                labels: {
                boxWidth: 80,
                fontColor: 'black'
                }
            },
            elements: {
                point:{
                    radius: 0
                }
            }
        };

        var lineChart = new Chart(speedCanvas, {
            type: 'line',
            data: speedData,
            options: chartOptions
        });

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');
        }
        function convert_positive(a) {
        // Check the number is negative
            if (a < 0) {
                // Multiply number with -1
                // to make it positive
                a = a * -1;
            }
            // Return the positive number
            return a;
        }
    </script>
@endsection