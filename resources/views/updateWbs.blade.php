@extends('layouts2.main')

@section('title', 'Update Wbs')

@section('content')  
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
            <div class="card">
                <div class="card-header">
                    Isi Kebutuhan dari {{ $wbs->text }}
                </div>
                <div class="card-body">
                    <form action="{{route('simpan_wbs')}}" method="POST" enctype="multipart/form-data">                
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{$wbs->id}}">
                            <input type="hidden" name="parent" value="{{$wbs->parent}}">
                        </div>
                        <div class="form-group">
                            <label>QTY</label>
                            <input type="number" name="qty" class="form-control form-control-user" placeholder="qty" value="{{ $wbs->qty }}">
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" name="satuan" class="form-control form-control-user" placeholder="satuan" value="{{ $wbs->satuan }}">
                        </div>
                        <div class="form-group">
                            <label>Harga Per Satuan</label>
                            <input type="number" name="harga" class="form-control form-control-user" placeholder="harga" value="{{ $wbs->harga }}">
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">< Kembali</a>  
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection