<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman S-Curve WBS</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>


<body style="background: lightgray">
    @include('nav_barMar')
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-header text-center"><h2>S-Curve</h2></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <canvas id="Aktual" width="600" height="400"></canvas>
                            </div>
                            <div class="col-md-3">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Kegiatan</th>
                                        {{-- <th scope="col">Jumlah</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['data_kegiatan'] as $key => $item)
                                            <tr>
                                                <td>{{$key}}</td>
                                                @foreach ($item as $value)
                                                <td>
                                                    {{$value}}
                                                </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-9">
                                <canvas id="Percent" width="600" height="400"></canvas>
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Kembali</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            </div>
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
        var data_tanggal = @json($data['data_tanggal']);
        var total_aktual = @json($data['total_aktual']);
        var total_history = @json($data['total_history']);
        //line one
        var arrFirst = [];
        var tempArrFirst = 0;
            for (const key in total_aktual) {
                if (Object.hasOwnProperty.call(total_aktual, key)) {
                    const data = total_aktual[key];
                    if (data != 0) {   
                        const chart_data = data + tempArrFirst;
                        tempArrFirst = chart_data;
                        arrFirst.push(chart_data)
                        console.log(arrFirst);
                    }
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
        var dataSecond = {
            label: "Histori",
            data: arrSecond,
            lineTension: 0,
            fill: false,
            borderColor: 'blue'
        };
// console.log(arrSecond[arrSecond.length-1]);
console.log(arrSecond);
        // line three
        var arrDifference = [];
        var tempArrDifference = 0;
        var history_total = arrSecond[arrSecond.length-1]
            for (let index = 0; index < arrFirst.length; index++) {
                if(arrFirst[index] != 0){
                    const weight = (arrFirst[index] / history_total) * 100;
                    console.log(weight.toFixed(2));
                    tempArrDifference = weight.toFixed(2);
                    arrDifference.push(weight.toFixed(2));
                }
            }

        var dataDifference = {
            label: "Progress",
            data: arrDifference,
            lineTension: 0,
            fill: false,
            borderColor: 'red'
        };
            

        var speedData = {
            labels: data_tanggal,
            datasets: [dataFirst, dataSecond]
        };
        
        var speedDataPercent = {
            labels: data_tanggal,
            datasets: [dataDifference]
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

        var lineChart = new Chart(speedCanvasPercent, {
            type: 'line',
            data: speedDataPercent,
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
    </script>
</body>
</html>