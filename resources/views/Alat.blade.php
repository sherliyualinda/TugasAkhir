@extends('layouts2.main')

@section('title', 'Tambah Kebutuhan Alat')

@section('content') 
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
               
                    <form action="{{url('lahan/simpan_alat/{id}')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @foreach ($sdm as $sdm)
                <div class="form-group">
                    <input type="hidden" name="id_lahan" value="{{$sdm->id}}" >
                </div>
                @endforeach
                <div class="form-group">
                            <label>Kebutuhan Alat</label>
                            <input type="input" name="resource"  class="form-control form-control-user" placeholder="kebutuhan">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control form-control-user" rows="4"></textarea>
                        </div>
                        <a href="{{ url('lahan/kelola_lahan') }}" class="btn btn-secondary">< Kembali</a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Tambah</button>                     
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'keterangan' );
</script>
@endsection