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

    
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="{{ asset('js/chart.js/Chart.min.js') }}"></script>
    <script>
        var speedCanvas = document.getElementById("Aktual");

            Chart.defaults.global.defaultFontFamily = "Roboto";
            Chart.defaults.global.defaultFontSize = 18;
            var tanggal = @json($data['tanggal']);
        var total_aktual = @json($data['total_aktual']);
        var total_history = @json($data['total_history']);
        //line one
        var arrFirst = [];
        var tempArrFirst = 0;
        let chart_data_first = 0;
        for (var i = 0; i < tanggal.length; i++) {
            const data = total_aktual[tanggal[i]];
            chart_data_first = data + tempArrFirst;
            tempArrFirst = chart_data_first;
            arrFirst.push(chart_data_first)
        }
            
        var dataFirst = {
            label: "Aktual",
            data: arrFirst,
            lineTension: 0,
            fill: false,
            borderColor: 'green'
        };
        // line two
        var arrSecond = [];
        var tempArrSecond = 0;
        let chart_data_second = 0;
            for (var i = 0; i < tanggal.length; i++) {
                if (Object.hasOwnProperty.call(total_history, tanggal[i])) {
                    const data = total_history[tanggal[i]];
                        chart_data_second = data + tempArrSecond;
                        tempArrSecond = chart_data_second;
                        arrSecond.push(chart_data_second)
                }
            }
        var dataSecond = {
            label: "Histori",
            data: arrSecond,
            lineTension: 0,
            fill: false,
            borderColor: 'blue'
        };
        
        // line three
        var arrDifference = [];
        var tempArrDifference = 0;
        var history_total = arrSecond[arrSecond.length-1]
            for (let index = 0; index < arrFirst.length; index++) {
                if(arrFirst[index] != 0){
                    const weight = (arrFirst[index] / history_total) * 100;
                    const num = history_total * (weight.toFixed(0) / 100);
                    tempArrDifference = num.toFixed(0);
                    arrDifference.push(num.toFixed(0));
                }
            }

        var dataDifference = {
            label: "Selisih",
            data: arrDifference,
            lineTension: 0,
            fill: false,
            borderColor: 'red'
        };
            

        var speedData = {
            labels: tanggal,
            datasets: [dataFirst, dataSecond, dataDifference]
        };

        var chartOptions = {
            legend: {
                display: true,
                position: 'top',
                labels: {
                boxWidth: 80,
                fontColor: 'black'
                }
            }
        };

        var lineChart = new Chart(speedCanvas, {
            type: 'line',
            data: speedData,
            options: chartOptions
        });

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

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');
        }

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endsection