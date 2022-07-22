@extends('layouts2.main')

@section('title', 'Sewa Peralatan')

@section('content') 
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-5">
                <div class="card-header">
                    Upload Bukti Bayar
                </div>
                <div class="card-body">
                <form action="{{route('uploadBukti')}}" method="POST" enctype="multipart/form-data">
                @foreach ($sewa as $sewa)
                <input type="hidden" name="id_sewa" value="{{$sewa->id_sewa}}">
                 {{ csrf_field() }}           
                <div class="form-group">
                            <label>Bukti Bayar</label><br>
                            <input type="file" name="bukti_bayar" class="form-control form-control-user mb-1" value="{{old('bukti_bayar',$sewa->bukti_bayar)}}" required>
                            <img src="{{ url('bukti_bayar') }}/{{ $sewa->bukti_bayar }} "width="50" height="50">
                        </div>
                        @endforeach
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">< Kembali</a>
                        <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Kirim</button>                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection