@include('nav_barMar')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel="icon" href="/logo-home.png" type="image/png" sizes="16x16"> 	    
<link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">

<!DOCTYPE html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
 
    <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    <link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">

    @foreach ($sewa as $sewa)
                <form action="{{route('tambahgantt',$sewa->id_sewa)}}" method="POST" enctype="multipart/form-data">
                 {{ csrf_field() }}
                <input type="hidden" name="id_sewa" value="{{$sewa->id_sewa}}">
                
                
   
    <style type="text/css">
        html, body{
            height:100%;
            padding:0px;
            margin:0px;
           
        }

    </style>
</head>
<div class="col-md-12 mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
                          
            <li>
                <?php if($sewa->id_pemilik == Auth::user()->pengguna->id_pengguna){?>
                    <a href="/lahan/request/{{$sewa->id_lahan}}" class="btn btn-sm btn-secondary">< Kembali</a>
                <?php }else{ ?>
                    <a href="/lahan/Dprojek_user/{{$_SESSION['id_sewa']}}" class="btn btn-sm btn-secondary">< Kembali</a>
                <?php } ?>

                <?php if($sewa->id_pemilik == Auth::user()->pengguna->id_pengguna){?>
                    <!-- <a href="/wbs/{{$_SESSION['id_sewa']}}" class="btn btn-sm btn-info">Anggaran Kegiatan</a> -->
                    <!-- <a href="{{route('boq-wbs', $_SESSION['id_sewa'])}}" class="btn btn-sm btn-info">Anggaran Awal</a>
                    <a href="{{route('scurve', $_SESSION['id_sewa'])}}" class="btn btn-sm btn-info">Grafik</a> -->
                    <?php }else{ ?>

                <?php } ?>
            </li>
        </ol>
    </nav>
</div>


<div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/gantt/{{$_SESSION['id_sewa']}}">Jadwal Kegiatan</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/wbs/{{$_SESSION['id_sewa']}}">Anggaran Kegiatan</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('boq-wbs', $_SESSION['id_sewa'])}}">Anggaran Awal</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('scurve', $_SESSION['id_sewa'])}}">Grafik</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/lahan/kelola_risk/{{$_SESSION['id_sewa']}}">Risiko</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/jadwal/kelola/{{$_SESSION['id_sewa']}}">Jadwal Ketemu</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/lahan/kelola_daily/{{$_SESSION['id_sewa']}}">Laporan Harian</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/lahan/kelola_struk/{{$_SESSION['id_sewa']}}">Struk Pembayaran</a>
                </div>
            </div>
            <!-- Page content wrapper-->
           
                <!-- Page content-->
                <div class="container">
                    <!-- ini isi -->


  
                <div id="gantt_here" style='width:100%; height:100%;'></div>

                </div>
                <!-- tutup isi -->






<script type="text/javascript">
    gantt.config.date_format = "%Y-%m-%d %H:%i:%s";
    gantt.config.order_branch = true;
    gantt.config.order_branch_free = true;

    <?php if ($sewa->id_pemilik == Auth::user()->pengguna->id_pengguna){ ?>
        gantt.config.readonly =false;
    <?php }else{ ?>
        gantt.config.readonly =true;
    <?php } ?>

    gantt.init("gantt_here");
    
    gantt.load("/api/data");
    
    var dp = new gantt.dataProcessor("/api");
    dp.init(gantt);
    dp.setTransactionMode("REST");
</script>

<script type="text/javascript">
   
   jQuery(document).ready(function(){
       jQuery("#download").click(function(){
		   screenshot();
	   });
   });

   function screenshot(){
	   html2canvas(document.getElementById("gantt_here")).then(function(canvas){
          downloadImage(canvas.toDataURL(),"UsersInformation.png");
	   });
   }

   function downloadImage(uri, filename){
	 var link = document.createElement('a');
	 if(typeof link.download !== 'string'){
        window.open(uri);
	 }
	 else{
		 link.href = uri;
		 link.download = filename;
		 accountForFirefox(clickLink, link);
	 }
   }

   function clickLink(link){
	   link.click();
   }

   function accountForFirefox(click){
	   var link = arguments[1];
	   document.body.appendChild(link);
	   click(link);
	   document.body.removeChild(link);
   }


</script>

</body>
@endforeach
 

