@extends('layouts2.main')

@section('title', 'Sewa Lahan')

@section('jstop')
<div class="container">

<div class="col-md-12 mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <?php session_start(); ?>
            <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Back</a></li>
        </ol>
    </nav>
</div>
    <form action="{{route('porto')}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
                            <center>
                            <label>Pilih Portofolio</label>
                            </center>
                                <select class="form-control" name="id_sewa" placeholder="--Pilih">
                                    @foreach ($datas as $index=>$data)
                                        <option value="{{$data->id_sewa}}">
                                            {{$index+1}}
                                        </option>
                                        @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lihat</button>
</div>
@endsection