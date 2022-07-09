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
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['data_kegiatan'] as $key => $item)
                                            <tr>
                                                <td>{{$key}}</td>
                                                <td>
                                                @foreach ($item as $value)
                                                    {{$value}},
                                                @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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

            Chart.defaults.global.defaultFontFamily = "Roboto";
            Chart.defaults.global.defaultFontSize = 18;
        var data_tanggal = @json($data['data_tanggal']);
        var total_aktual = @json($data['total_aktual']);
        var total_history = @json($data['total_history']);
        
        var arrFirst = [];
            for (const key in total_aktual) {
                if (Object.hasOwnProperty.call(total_aktual, key)) {
                    const data = total_aktual[key];
                    arrFirst.push(data)
                }
            }
            
        var dataFirst = {
            label: "Aktual",
            data: arrFirst,
            lineTension: 0,
            fill: false,
            borderColor: 'red'
        };

        var arrSecond = [];
            for (const key in total_history) {
                if (Object.hasOwnProperty.call(total_history, key)) {
                    const data = total_history[key];
                    arrSecond.push(data)
                }
            }
        var dataSecond = {
            label: "Histori",
            data: arrSecond,
            lineTension: 0,
            fill: false,
            borderColor: 'blue'
        };

        var speedData = {
            labels: data_tanggal,
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
    </script>
</body>
</html>