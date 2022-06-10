<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Resiko</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
                        <li class="breadcrumb-item"><a href="{{ route('lahan.kelola_lahan') }}">Kelola Lahan</a></li>
                        </ol>
                        </nav>
                    </div>
                    @foreach($risk as $index=>$risk)
                    <table>
                        <tr>
                            <th scope="col">Nama Penyewa  : {{ $risk->nama}}</th>     
                                               
                        </tr>
                        <tr>
                            <th scope="col">NIK           : {{ $risk->nik}}</th>                        
                        </tr>
                    </table>
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
                                <th scope="col">Status</th>                               
                                <th olspan="2" >Kelola Risk</th>
                                
                              </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $risk->penyebab}}</td>
                                    <td>{{ $risk->dampak}}</td>
                                    <td>{{ $risk->strategi}}</td>
                                    <td>{{ $risk->biaya}}</td>
                                    <td>{{ $risk->probabilitas}}</td>
                                    <td>{{ $risk->impact}}</td>
                                    <td>{{ $risk->levelRisk}}</td>
                                    <td>{{ $risk->status}}</td>
                                    <td>
                                         <a href="/lahan/createRisk/{{$risk->id_sewa}}" class="btn btn-sm btn-info">Tambah Resiko</a>
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

</body>
</html>