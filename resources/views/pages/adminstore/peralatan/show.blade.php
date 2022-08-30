@extends('layouts2.dashboard')

@section('title')
Peralatan Detail
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">
       {{ $peralatan->nama_alat }}
      </h2>
      <p class="dashboard-subtitle">
        Detail Peralatan {{ $peralatan->nama_alat }}
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
          <form action="{{ route('dashboard.peralatan-pending.approval', $peralatan->id_peralatan) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Nama Alat</label>
                      <input type="text" class="form-control" value="{{ $peralatan->nama_alat }}" readonly>
                    </div>
                    <div class="form-group">
                      <label for="">Pemilik</label>
                      <input type="text" class="form-control" value="{{ $peralatan->pengguna->nama }}" readonly>
                    </div>
                    <div class="form-group">
                      <label for="">Harga</label>
                      <input type="text" class="form-control" value="{{ $peralatan->harga }}" readonly>
                    </div>
                    <div class="form-group">
                      <label for="">Deskripsi</label>
                      <textarea class="form-control" rows="4" readonly>{!! $peralatan->deskripsi !!}</textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Gambar</label>
                      <br>
                      <img src="{{ url('gambar_peralatan') }}/{{ $peralatan->gambar }} "width="300"><br>
                      <label for="">Foto KTP</label>
                      <br>
                      <img src="{{ url('foto_ktp') }}/{{ $peralatan->pengguna->foto_ktp }} "width="300" height="200">
                    </div>
                  </div>
                 
                @if ($peralatan->status == 'Waiting')                    
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
