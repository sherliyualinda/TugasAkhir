@extends('layouts2.main')

@section('title', 'Dokumentasi Projek Lahan')

@section('content')   
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">< Kembali</a>
            <div class="card border-0 shadow rounded" id="prinDokumenArea">
                <div class="card-body">
                    @if ($sewa)
                    <div class="row d-block mb-5">
                        <h2 class="text-center">Dokumentasi Project Lahan {{ $sewa[0]->nama }}</h2>
                        <p class="text-center">Lahan ini memiliki ukuran {{$sewa[0]->ukuran}}</p>
                    </div>
                    <img src="{{ url('gambar_lahan') }}/{{ $sewa[0]->gambar }}" class="rounded mx-auto d-block" width="50%" alt=""> 
                    <h3 class="mt-5">{{ $sewa[0]->nama }} <span class="badge badge-info">{{$sewa[0]->status}}</span></h3>
                    <p>{!! $sewa[0]->deskripsi !!}</p>
                    @endif
                    <h4 class="mt-5">Sumber Daya Manusia</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                        @foreach($orang as $index=>$orang)
                        <tr>
                            <td>{{ $index+1}}</td>
                            <td>{{ $orang->resource}}</td>
                            <td>{{ $orang->keterangan}}</td>
                        </tr>
                        @endforeach
                    </table>
                        
                    <h4 class="mt-5">Material Yang Digunakan</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Material</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                        @foreach($material as $index=>$material)
                        <tr>
                            <td>{{ $index+1}}</td>
                            <td>{{ $material->resource}}</td>
                            <td>{{ $material->keterangan}}</td>
                        </tr>
                        @endforeach
                    </table>

                    <h4 class="mt-5">Alat Yang Digunakan</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Alat</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                        @foreach($alat as $index=>$alat)
                        <tr>
                            <td>{{ $index+1}}</td>
                            <td>{{ $alat->resource}}</td>
                            <td>{{ $alat->keterangan}}</td>
                        </tr>
                        @endforeach
                    </table>

                    <h4 class="mt-5">Risiko</h4>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">No</th>                                
                            <th scope="col">Penyebab</th>
                            <th scope="col">Dampak</th>                               
                            <th scope="col">Strategi</th>                               
                            <th scope="col">Biaya</th>                               
                            <th scope="col">Level Risiko</th>                                                          
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($risk as $index=>$risk)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $risk->penyebab}}</td>
                                    <td>{{ $risk->dampak}}</td>
                                    <td>{{ $risk->strategi}}</td>
                                    <td>{{ $risk->biaya}}</td>
                                    <td>{{ $risk->levelRisk}}</td>
                                </tr>    
                            @endforeach   
                        </tbody>
                    </table>

                    <h4 class="mt-5">Laporan Harian</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th scope="col">No</th>                                
                            <th scope="col">Gambar</th>
                            <th scope="col">keterangan</th>                               
                            <th scope="col">date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($daily as $index=>$daily)
                        <tr>
                            <td>{{ $index+1}}</td>
                            <td><img src="{{ url('gambar_daily') }}/{{ $daily->gambar }} "width="50" height="50"></td>
                            <td>{{ $daily->keterangan}}</td>
                            <td>{{ $daily->date}}</td>
                        </tr>
                
                        @endforeach   
                    </table>

                    <h4 class="mt-5">S-Curve</h4>
                    <div class="col-md-12">
                        <canvas id="Aktual" width="700" height="400"></canvas>
                    </div>

                    <h4 class="mt-5">BOQ Aktual</h4>
                    <div class="col-md-12">
                        <div class="row">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Uraian Pekerjaan</th>
                                    <th scope="col">Jumlah Harga</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                        $total = 0;
                                    @endphp
                                    @foreach ($boq_aktual as $parent)
                                    @if ($parent->parent == 0)
                                        <tr>
                                            <th scope="row">{{$i++}}</th>
                                            <td>{{$parent->text}}</td>
                                            <td>{{$parent->totalHarga}}
                                                @php
                                                    $total += $parent->totalHarga
                                                @endphp
                                            </td>
                                        </tr>
                                    @endif
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="text-right h5">Total</td>
                                        <td class="h5">{{number_format($total)}}</td>
                                    </tr>
                                </tbody>
                              </table>
                          </div>
                    </div>
                    <h4 class="mt-5">BOQ History</h4>
                    <div class="col-md-12">
                        <div class="row">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Uraian Pekerjaan</th>
                                    <th scope="col">Jumlah Harga</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                        $totalHistory = 0;
                                    @endphp
                                    @foreach ($boq_history as $parent)
                                    @if ($parent->parent == 0)
                                        <tr>
                                            <th scope="row">{{$i++}}</th>
                                            <td>{{$parent->text}}</td>
                                            <td>{{number_format($parent->totalHarga)}}
                                                @php
                                                    $totalHistory += $parent->totalHarga
                                                @endphp
                                            </td>
                                        </tr>
                                    @endif
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="text-right h5">Total</td>
                                        <td class="h5">{{number_format($totalHistory)}}</td>
                                    </tr>
                                </tbody>
                              </table>
                          </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row float-right mt-5">
                            <button class="btn btn-info" type="button" onclick="printDiv('prinDokumenArea')">Print Dokumen</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jstop')
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