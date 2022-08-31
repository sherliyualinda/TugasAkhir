@extends('layouts2.main')

@section('title', 'Request Peralatan')

@section('content') 
<style>
     .container .popup-image{
    position: fixed;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0,.9);
    height: 100%;
    width: 100%;
    z-index: 100;
    display: none;

}
.container .popup-image span{
    position: absolute;
    top: 0;
    right: 10px;
    font-size: 60px;
    font-weight: bolder;
    color: #fff;
    cursor: pointer;
    z-index: 100%;

}
.container .popup-image img{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    border: 5px solid #fff;
    border-radius: 5px;
    width: 500px;
    object-fit: cover;

}
@media (max-width:768px){
    .container .popup-image img{
        width: 95%;
    }
}
</style>
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ url('peralatan/kelola_peralatan') }}" class="btn btn-secondary mb-2">< Kembali</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Penyewa</th>
                                <th scope="col">NIK</th>
                                <th scope="col">Alamat Penyewa</th>
                                <th scope="col">KTP</th>
                                <th scope="col">Total Alat</th>
                                <th scope="col">Total Hari</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Bukti Bayar</th>
                                <th scope="col" >Kelola</th>
                                <th scope="col">Status</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($sewa as $index=>$sewa)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ $sewa->nama}}</td>
                                    <td>{{ $sewa->nik}}</td>
                                    <td>{{ $sewa->alamat}}</td>
                                    <td>
                                        <center>
                                        <img src="/data_file/{{$sewa->nama}}/foto_profil/{{ $sewa->foto_profil }} "width="50" height="50">
                                        </center>
                                        <div class="popup-image">
                                        <span>
                                            &times;
                                        </span>
                                        <img src="/data_file/{{$sewa->nama}}/foto_profil/{{ $sewa->foto_profil }} ">
                                        </div>
                                    </td>
                                    <td>{{ $sewa->qty}}</td>
                                    <td>{{ $sewa->totalHari}}</td>
                                    <td>{{ $sewa->totalHarga}}</td>
                                    <td>
                                        <center>
                                            <img src="{{ url('bukti_bayar') }}/{{ $sewa->bukti_bayar }} "width="50" height="50">
                                        </center>
                                        <div class="popup-image">
                                        <span>
                                            &times;
                                        </span>
                                        <img src="{{ url('bukti_bayar') }}/{{ $sewa->bukti_bayar }} ">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{url('peralatan/acc/{$sewa->id_sewa}')}}" method="POST">
                                        {{ csrf_field() }}
                                            <input type="hidden" name="status" class="form-control form-control-user" value="acc">
                                            <input type="hidden" name="id_penyewa" class="form-control form-control-user" value="{{$sewa->id_penyewa}}">
                                            <input type="hidden" name="qty" class="form-control form-control-user" value="{{$sewa->qty}}">
                                            <?php if($sewa->status == 'Acc'){?>
                                                Disetujui
                                            <?php }elseif($sewa->status == 'Tolak'){?>
                                                Tidak Disetujui
                                            <?php }elseif($sewa->status == 'Done'){?>
                                                Done
                                            <?php }else{?>
                                                <a href="/peralatan/tolak/{{$sewa->id_sewa}}" class="btn btn-sm btn-danger">Tolak</a>
                                                <a href="/peralatan/acc/{{$sewa->id_sewa}},{{$sewa->id_peralatan}},{{$sewa->stok}},{{$sewa->qty}}" class="btn btn-sm btn-success">Terima</a>
                                            <?php } ?>
                                            <td>
                                            <?php if($sewa->status == 'Acc'){?>
                                            <a href="/peralatan/done/{{$sewa->id_sewa}},{{$sewa->id_peralatan}},{{$sewa->stok}},{{$sewa->qty}}" class="btn btn-sm btn-success">Done</a>
                                        <?php }else{ ?>
                                            <a href="#" class="btn btn-sm btn-secondary">Done</a>
                                        <?php } ?>    
                                            </td>
                                            @endforeach 
                                            @foreach($peralatan as $peralatan)
                                            <input type="hidden" name="stok" class="form-control form-control-user" value="{{ $peralatan->stok}}">
                                            <input type="hidden" name="stok" class="form-control form-control-user" value="{{ $peralatan->id_peralatan}}">
                                        </form>
                        
                              @endforeach   
                            </tbody>
                          </table>  
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.querySelectorAll('.card-body img').forEach(image =>{
       image.onclick =() =>{
           document.querySelector('.popup-image').style.display ='block';
           document.querySelector('.popup-image img').src=image.getAttribute('src');
           
       } 
    });
    document.querySelector('.popup-image span').onclick = () =>{
        document.querySelector('.popup-image').style.display ='none';
    }
</script>

@endsection