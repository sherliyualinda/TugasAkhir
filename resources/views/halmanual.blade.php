@extends('layouts2.main')

@section('title', 'Manual Book Lahan')

@section('css')
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
@endsection

@section('content') 
<div class="row">
    <div class="col-md-12 mt-1">
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">< Kembali</a>
        <div class="card mb-5">
            <div class="card-body">
                @foreach($manual as $index=>$manual)


                <b><h2>{{ $manual->nama}}</h2><br>
                <img src="{{ url('gambar_manual') }}/{{ $manual->gambar }} ">
                <br>{{ $manual->jenis_lahan}}</br><br>
                Langkahnya adalah :<br><br></b>
                <p style="align:justify">
                    <div class="b">
                        <pre>
                            {!! $manual->deskripsi !!}
                        </pre>
                    </div>
                </p>
                @endforeach   
            </div>
        </div>
    </div>
</div>
@endsection