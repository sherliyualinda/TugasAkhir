@extends('layouts2.main')

@section('title', 'Projek Saya')

<script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script> 
<script src="http://export.dhtmlx.com/gantt/api.js"></script>
<link rel="stylesheet" href="codebase/dhtmlxgantt.css" type="text/css">
<link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">
@section('content')  


<style type="text/css">
        html, body{
            height:100%;
            padding:0px;
            margin:0px;
        }
        .gambar{
            display:block;
            margin:auto;
        }

    </style>
    <div class="row">
        @foreach ($sewa as $data)
        <div class="col-md-12">
            <a href="{{ url('lahan/projek_user') }}" class="btn btn-secondary">< Kembali</a>
            <a href="/lahan/dokumentasi/{{$data->id_sewa}}/{{$data->id_penyewa}}" target="_blank" class="btn btn-secondary"><i class="fa fa-eye"></i>Dokumentasi</a>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="gambar">
                            <img src="{{ url('gambar_lahan') }}/{{ $data->gambar }}" class="rounded mx-auto d-block" width="100%" alt="" > 
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="detail"
                                    aria-selected="false">Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="sdm-tab" data-toggle="tab" href="#sdm" role="tab" aria-controls="sdm"
                                    aria-selected="false">Sumber Daya</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tabel-tab" data-toggle="tab" href="#tabel" role="tab" aria-controls="tabel"
                                    aria-selected="false">Jadwal Kegiatan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="risiko-tab" data-toggle="tab" href="#risiko" role="tab" aria-controls="risiko"
                                    aria-selected="false">Risiko</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="boq-tab" data-toggle="tab" href="#boq" role="tab" aria-controls="boq"
                                    aria-selected="false">Anggaran</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="scurve-tab" data-toggle="tab" href="#scurve" role="tab" aria-controls="scurve"
                                    aria-selected="false">Grafik</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Daily-tab" data-toggle="tab" href="#Daily" role="tab" aria-controls="Daily"
                                    aria-selected="false">Laporan Harian</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Struk-tab" data-toggle="tab" href="#Struk" role="tab" aria-controls="Struk"
                                    aria-selected="false">Struk</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Jadwal-tab" data-toggle="tab" href="#Jadwal" role="tab" aria-controls="Jadwal"
                                    aria-selected="false">Jadwal Pertemuan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="kalender-tab" data-toggle="tab" href="#Kalender" role="tab" aria-controls="Kalender"
                                    aria-selected="false">Kalender</a>
                                </li>
                            </ul>
                            <br><br>
                                

                            <div class="tab-content" id="myTabContent">
                                
                                    <div class="tab-pane fade in active show" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                                        <h3>{{ $data->nama }}</h3>
                                        <table class="table">
                                            <tbody>
            
                                                <tr>
                                                    <td>Ukuran</td>
                                                    <td>:</td>
                                                    <td>{{$data->ukuran}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Deskripsi</td>
                                                    <td>:</td>
                                                    <td>{!! $data->deskripsi !!}</td>
                                                </tr> 
                                                <tr>
                                                    <td>Status</td>
                                                    <td>:</td>
                                                    <td>{{$data->status}}</td>
                                                </tr>
                                            </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="sdm" role="tabpanel" aria-labelledby="sdm-tab">
                                       
                                        <table class="table table-bordered">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                </tr>
                                @foreach($orang as $index=>$orang)
                                    <tr>
                                        <td>{{ $index+1}}</td>
                                        <td>{{ $orang->resource}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                                <b>Material Yang Digunakan</b>
                                <table class="table table-bordered">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Material</th>
                                </tr>
                                @foreach($material as $index=>$material)
                                    <tr>
                                        <td>{{ $index+1}}</td>
                                        <td>{{ $material->resource}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                                <b> Alat Yang Digunakan</b>
                                <table class="table table-bordered">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Alat</th>
                                </tr>
                                @foreach($alat as $index=>$alat)
                                    <tr>
                                        <td>{{ $index+1}}</td>
                                        <td>{{ $alat->resource}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                                    </div>
                                    
                                    <div class="tab-pane fade" id="tabel" role="tabpanel" aria-labelledby="tabel-tab">
                                        <input value="Export to PNG" type="button" onclick='gantt.exportToPNG()'>
                                        <div id="gantt_here"  style='width:100%; height:83%;'></div>
                                        <!-- <a href="/gantt/{{$_SESSION['id_sewa']}}" class="btn btn-info mt-3">Gantt Chart</a> -->
                                    
                                    
                                    </div>
                                    <div class="tab-pane fade" id="risiko" role="tabpanel" aria-labelledby="risiko-tab">
                                       
                                        <div>
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
                                        </div>
                                      
                                    </div>
                                    <div class="tab-pane fade" id="boq" role="tabpanel" aria-labelledby="boq-tab">
                                        <div class="row">
                                            <div class="col-3 pt-3">
                                              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <a class="nav-link active" id="v-pills-aktual-tab" data-toggle="pill" href="#v-pills-aktual" role="tab" aria-controls="v-pills-aktual" aria-selected="true">Aktual</a>
                                                <a class="nav-link" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false">Histori</a>
                                               </div>
                                            </div>
                                            <div class="col-9">
                                              <div class="tab-content" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active" id="v-pills-aktual" role="tabpanel" aria-labelledby="v-pills-aktual-tab">
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
                                                <div class="tab-pane fade" id="v-pills-history" role="tabpanel" aria-labelledby="v-pills-history-tab">
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
                                            </div>
                                          </div>
                                    </div>
                                    <div class="tab-pane fade" id="scurve" role="tabpanel" aria-labelledby="scurve-tab">
                                        <div class="col-md-9">
                                            <canvas id="Aktual" width="700" height="400"></canvas>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Daily" role="tabpanel" aria-labelledby="Daily-tab">
                                        <h3>Laporan Harian</h3>
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
                                    <td><a href="{{ url('gambar_daily') }}/{{ $daily->gambar }}" target="_blank">
                                        <img src="{{ url('gambar_daily') }}/{{ $daily->gambar }} "width="50" height="50"><a>
                                    </td>
                                    <td>{{ $daily->keterangan}}</td>
                                    <td>{{ $daily->date}}</td>
                                </tr>
                        
                              @endforeach   
                          </table>  
                                      
                                </div>

                            <div class="tab-pane fade" id="Struk" role="tabpanel" aria-labelledby="Struk-tab">
                                <h3>Struk</h3>
                            <table class="table table-bordered">
                              <tr>
                                <th scope="col">No</th>                                
                                <th scope="col">Gambar</th>
                                <th scope="col">Keterangan</th>                               
                                <th scope="col">Tanggal</th>
                              </tr>
                            
                            @foreach($struk as $index=>$struk)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td><a href="{{ url('gambar_struk') }}/{{ $struk->gambar }} " target="_blank">
                                        <img src="{{ url('gambar_struk') }}/{{ $struk->gambar }} "width="50" height="50"><a>
                                    <td>{{ $struk->keterangan}}</td>
                                    <td>{{ $struk->tanggal}}</td>
                                </tr>
                                @endforeach   
                            </table>
                            </div>

                            <div class="tab-pane fade" id="Jadwal" role="tabpanel" aria-labelledby="Jadwal-tab">
                                <h3>Jadwal Pertemuan</h3>
                            <table class="table table-bordered">

                              <tr>
                                <th scope="col">No</th>                                
                                <th scope="col">Tanggal</th>
                                <th scope="col">Agenda</th>                               
                                <th scope="col">Keterangan</th>
                                <th scope="col">Link Meet</th>
                              </tr>
                            
                            @foreach($jadwal as $index=>$jadwal)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $jadwal->date}}</td>
                                    <td>{{ $jadwal->agenda}}</td>
                                    <td>{{ $jadwal->keterangan}}</td>
                                    <td>{{ $jadwal->linkMeet}}</td>
                                </tr>
                                @endforeach   
                            </table>
                                    </div>
                                    <div class="tab-pane fade" id="Kalender" role="tabpanel" aria-labelledby="Kalender-tab">
                                        <h3>Kalender</h3>
                                        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
                                        <div id='calendar'></div>     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    
    <!-- gantt -->
    
    
    
    <script type="text/javascript">
        gantt.config.date_format = "%Y-%m-%d %H:%i:%s";
        gantt.config.order_branch = true;
        gantt.config.order_branch_free = true;
    
        gantt.config.readonly =true;
      
    
        gantt.init("gantt_here");
        
        gantt.load("/api/data");
        
        var dp = new gantt.dataProcessor("/api");
        dp.init(gantt);
        dp.setTransactionMode("REST");
    </script>
    
    
    
    <!-- tutup gantt -->
@endsection

@section('js')
        <script>
            $(function(){
                var url = document.location.toString();
                if (url.match('#')) {
                    console.log(url.split('#')[1]);
                    $('a[href="#'+url.split('#')[1]+'"]').parent().addClass('active');
                    $('#'+url.split('#')[1]).addClass('active in')
                }
                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    window.location.hash = e.target.hash;
                });
            });
        </script>
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
    </script>


        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
        <script>
            $(document).ready(function() {
                $('#calendar').fullCalendar({
                    events : [
                    @foreach($jadwal2 as $jadwal2)
                    {
                        title : '{{ $jadwal2->agenda }}',
                        start : '{{ $jadwal2->date }}',
                        link : '{{ $jadwal2->linkMeet }}',
                    },
                        @endforeach
                    ]
                    })
                    });
        </script>



@endsection


