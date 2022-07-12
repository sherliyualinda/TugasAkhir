<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Lahan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<style>  

div.b {  
  width: 100%;
  word-wrap: break-word;
}  
pre {
        white-space: pre-wrap; 
        white-space: -moz-pre-wrap;
        white-space: -pre-wrap;
        white-space: -o-pre-wrap;
        word-wrap: break-word; 
        text-align: justify;   
        /* font-size: 10px; */
        /* margin: 0% 8% 0px 8%;  */
    }
</style>
	
        @include('nav_barMar')

</div>
<body style="background: lightgray">
    <div class="container">
    <div class="row">
@foreach($manual as $index=>$manual)


<b><h2>{{ $manual->nama}}</h2><br>
<img src="{{ url('gambar_manual') }}/{{ $manual->gambar }} ">
<br>{{ $manual->jenis_lahan}}</br><br>
Langkahnya adalah :<br><br></b>
<p style="align:justify">
<div class="b">
    <pre>
        {{$manual->deskripsi}}
    </pre>
</div>

</p>
                                  
                                

                        
@endforeach   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>
</html>