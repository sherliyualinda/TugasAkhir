@extends('layouts2.main')

@section('title', 'Sewa Lahan')

@section('jstop')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="{{ asset('js/chart.js/Chart.min.js') }}"></script>
    <script>
        var speedCanvas = document.getElementById("Aktual");

            Chart.defaults.global.defaultFontFamily = "Roboto";
            Chart.defaults.global.defaultFontSize = 18;
        var data_tanggal = @json($dataScurve['data_tanggal']);
        var total_aktual = @json($dataScurve['total_aktual']);
        var total_history = @json($dataScurve['total_history']);
        //line one
        var arrFirst = [];
        var tempArrFirst = 0;
            for (const key in total_aktual) {
                if (Object.hasOwnProperty.call(total_aktual, key)) {
                    const data = total_aktual[key];
                    const chart_data = data + tempArrFirst;
                    tempArrFirst = chart_data;
                    arrFirst.push(chart_data)
                }
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
            for (const key in total_history) {
                if (Object.hasOwnProperty.call(total_history, key)) {
                    const data = total_history[key];
                    const chart_data = data + tempArrSecond;
                    tempArrSecond = chart_data;
                    arrSecond.push(chart_data)
                }
            }
            console.log(arrFirst);
            console.log(arrSecond);
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
            for (let index = 0; index < arrFirst.length; index++) {
                const difference = arrFirst[index] - arrSecond[index];
                const chart_data = difference + tempArrDifference;
                tempArrDifference = chart_data;
                arrDifference.push(chart_data);
            }

        var dataDifference = {
            label: "Selisih",
            data: arrDifference,
            lineTension: 0,
            fill: false,
            borderColor: 'red'
        };
            

        var speedData = {
            labels: data_tanggal,
            datasets: [dataFirst, dataSecond,dataDifference]
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