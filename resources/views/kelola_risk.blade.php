<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Resiko</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
    @yield('css')




</head>
	
        @include('nav_barMar')

</div>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                    <div class="col-md-12 mt-2">
                        <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <?php session_start(); ?>
                        <li class="breadcrumb-item"><a href="/lahan/request/{{$_SESSION['id_lahan']}}">Back</a></li>
                        </ol>
                        </nav>
                    </div>
                    @foreach($risk2 as $index=>$risk2)
                    <table>
                        <tr>
                            <th scope="col">Nama Penyewa</th>          
                            <th scope="col">:</th>     
                            <td>{{ $risk2->nama}}</td>     
                                               
                        </tr>
                        <tr>
                            <th scope="col" >NIK</th>     
                            <th scope="col">:</th>     
                            <td>{{ $risk2->nik}}</td>                         
                        </tr>
                        
                    </table>
                    @endforeach

                    @foreach($risk3 as $index=>$risk3)
                    <table>
                        <tr>
                             <td>
                                 <a href="/lahan/createRisk/{{$risk3->id_sewa}}" class="btn btn-sm btn-info">Tambah Resiko</a>
                            </td>
                        </tr>
                    
                    </table>
                    @endforeach
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>                                
                                <th scope="col">Penyebab</th>
                                <th scope="col">Dampak</th>                               
                                <th scope="col">Strategi</th>                               
                                <th scope="col">Biaya</th>                               
                                <th scope="col">Probabilitas</th>                               
                                <th scope="col">Impact</th>                               
                                <th scope="col">Level Risk</th>                               
                                <th scope="col">Kelola</th>                               
                                
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
                                    <td>{{ $risk->ket}}</td>
                                    <td>{{ $risk->ket_impact}}</td>
                                    <td>{{ $risk->levelRisk}}</td>
                                    <td>
                                        <a href="/lahan/ubah_risk/{{$risk->id_risk}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
    @yield('js')
</body>
</html>