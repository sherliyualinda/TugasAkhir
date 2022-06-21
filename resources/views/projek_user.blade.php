<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    

    <title>Projek Saya</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
	
        @include('nav_barMar')

</div>
<body>

<div class="container">
    <div class="row">
        @foreach ($sewa as $data)
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/lahan/projek_user/{{Auth::user()->pengguna->id_pengguna}}">Back</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12 mt-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ url('gambar_lahan') }}/{{ $data->gambar }}" class="rounded mx-auto d-block" width="50%" alt=""> 
                        </div>
                        <div class="col-md-6">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="detail"
                                    aria-selected="false">Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="sdm-tab" data-toggle="tab" href="#sdm" role="tab" aria-controls="sdm"
                                    aria-selected="false">Sumber Daya</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                                    aria-selected="false">Contact</a>
                                </li>
                            </ul>
                    

                            <div class="tab-content" id="myTabContent">
                                
                                    <div class="tab-pane fade" id="detail" role="tabpanel" aria-labelledby="detail-tab">
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
                                                    <td>{{$data->deskripsi}}</td>
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
                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                        <h3>Contact</h3>
                                    </div>
                                
                            </div>
                        </div>
                   

                       
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>
</html>




