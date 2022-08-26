<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman S-Curve WBS</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

     <!-- Core theme CSS (includes Bootstrap)-->
     <link href="/css3/styles.css" rel="stylesheet" />


    </head>
    
    @include('theme.nav_bar')
<?php session_start(); ?>
<div class="col-md-12 mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li>            
                    <a href="/lahan/request/{{$_SESSION['id_lahan']}}" class="btn btn-secondary"> < Kembali</a>
                </li>
            </ol>
        </nav>
    </div>
<!-- <body style="background: lightgray"> -->
    
    <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/gantt/{{$_SESSION['id_sewa']}}">Jadwal Kegiatan</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/wbs/{{$_SESSION['id_sewa']}}">Anggaran Kegiatan</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('boq-wbs', $_SESSION['id_sewa'])}}">Anggaran Awal</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 active" href="{{route('scurve', $_SESSION['id_sewa'])}}">Grafik</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/lahan/kelola_risk/{{$_SESSION['id_sewa']}}">Risiko</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/lahan/lihat_jadwal/{{$_SESSION['id_sewa']}}">Kalender Ketemu</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/jadwal/kelola/{{$_SESSION['id_sewa']}}">Jadwal Ketemu</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/lahan/kelola_daily/{{$_SESSION['id_sewa']}}">Laporan Harian</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/lahan/kelola_struk/{{$_SESSION['id_sewa']}}">Struk Pembayaran</a>
                </div>
            </div>
            <!-- Page content wrapper-->
           
                <!-- Page content-->
                <div class="container">
                    <!-- ini isi -->

        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded mb-5">
                    <!-- <div class="card-header text-center"><h2>S-Curve</h2></div> -->
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
                </div>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>

    <!-- tutup isi -->
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
                chart_data_first = data + tempArrFirst;
                tempArrFirst = chart_data_first;
                arrFirst.push(chart_data_first)
            }else if(i == 0){
                chart_data_first = data + tempArrFirst;
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
                    chart_data_second = data + tempArrSecond;
                    tempArrSecond = chart_data_second;
                    for_history.push(chart_data_second);
                    arrSecond.push(chart_data_second)
                }else if(i == 0){
                    chart_data_second = data + tempArrSecond;
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


</body>
</html>
