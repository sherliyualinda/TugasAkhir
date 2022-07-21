@extends('layouts2.main')

@section('title', 'WBS')

@section('content') 
<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded">
            <div class="card-body">                        
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kegiatan</th>
                        <th scope="col">Durasi</th>
                        <th scope="col">Tanggal Mulai</th>
                        <th scope="col">QTY</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total Harga</th>
                        <th colspan="2" >Kelola</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($wbs as $index=>$wbs)
                        <tr>
                            <td>{{ $index+1}}</td>
                            <?php if($wbs->parent == 0){?>
                                <td><b>{{ $wbs->text}}</b></td>
                            <?php }else{?>
                                <td>{{ $wbs->text}}</td>
                            <?php }?>
                            <td>{{ $wbs->duration}}</td>
                            <td>{{ $wbs->start_date}}</td>

                            <td>{{ $wbs->qty}}</td>
                            <td>{{ $wbs->harga}}</td>
                            <td>{{ $wbs->totalHarga}}</td>
                            <td class="text-center">
                                <a href="/lahan/update_wbs/{{$wbs->id}}" class="btn btn-sm btn-warning">Update</a>

                            </td>
                        </tr>
                        @endforeach   
                    </tbody>
                    </table>  
                
            </div>
        </div>
    </div>
</div>
@endsection