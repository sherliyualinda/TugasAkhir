@extends('layouts2.dashboard')

@section('title')
Lahan Detail
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">
       {{ $lahan->category->nama }}
      </h2>
      <p class="dashboard-subtitle">
        Detail Lahan {{ $lahan->category->nama }}
      </p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12">
          @if($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
              <li> {{ $error }} </li>
              @endforeach
            </ul>
          </div>
          @endif
          <form action="{{ route('dashboard.lahan.approval', $lahan->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Kategori Lahan</label>
                      <input type="text" class="form-control" value="{{ $lahan->category->nama }}" readonly>
                    </div>
                    <div class="form-group">
                      <label for="">Pemilik</label>
                      <input type="text" class="form-control" value="{{ $lahan->user->name }}" readonly>
                    </div>
                    <div class="form-group">
                      <label for="">Ukuran</label>
                      <input type="text" class="form-control" value="{{ $lahan->ukuran }}" readonly>
                    </div>
                    <div class="form-group">
                      <label for="">Deskripsi</label>
                      <textarea class="form-control" rows="4" readonly>{{ $lahan->deskripsi }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Gambar</label>
                      <br>
                      <img src="{{ url('gambar_lahan') }}/{{ $lahan->gambar }} "width="300">
                    </div>
                  </div>



                </div>
                @if ($lahan->statusLahan == 'Waiting')                    
                <div class="row">
                  <div class="col-6">
                    <button type="submit" name="approve" value="1" class="btn btn-success px-5 mt-3 btn-block">
                      Setujui
                    </button>
                  </div>
                  <div class="col-6">
                    <button type="submit" name="reject" value="1" class="btn btn-danger px-5 mt-3 btn-block">
                      Tolak
                    </button>
                  </div>
                </div>
                @endif
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
