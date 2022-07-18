@extends('layouts2.main')

@section('title', 'Ubah SDM')

@section('content') 
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-5">
                <div class="card-header">
                    Ubah SDM 
                </div>
                <div class="card-body">
                @foreach ($resource as $resource)
                <form action="{{route('updateSDM')}}" method="POST" enctype="multipart/form-data">
                 {{ csrf_field() }}
                 <input type="hidden" name="id_lahan_resources" value="{{$resource->id_lahan_resources}}">
                 <input type="hidden" name="id_lahan" value="{{$resource->id_lahan}}">
                
                        <div class="form-group">
                            <label>Kebutuhan</label>
                            <input type="input" name="resource" value="{{old('resource',$resource->resource)}}" class="form-control form-control-user">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control form-control-user">{{old('keterangan',$resource->keterangan)}}</textarea>
                        </div>
                        @endforeach
                        <a href="/lahan/kelola_resource/{{$resource->id_lahan}}" class="btn btn-secondary">< Kembali</a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update Data</button>                    
                    </form>
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
