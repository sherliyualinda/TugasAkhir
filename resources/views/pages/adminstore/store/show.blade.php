@extends('layouts2.dashboard')

@section('title')
Store Dashboard Store Details Pages
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">
       {{ $pengguna->nama }}
      </h2>
      <p class="dashboard-subtitle">
        Detail Toko
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
          <form action="{{ route('dashboard.store-approve', $pengguna->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Nama Toko</label>
                      <input type="text" class="form-control" name="name" value="{{ $pengguna->nama }}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">NIK</label>
                      <input type="number" name="price" class="form-control" value="{{ $pengguna->nik }}" readonly>
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Email</label>
                      <input type="text" name="email" class="form-control" value="{{ $pengguna->email }}" readonly>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">No Handphone</label>
                      <input type="number" name="nomor_hp" class="form-control" value="{{ $pengguna->nomor_hp }}" readonly>
                    </div>
                  </div>


                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Alamat Toko</label>
                      <textarea name="alamat" class="form-control" readonly>{!! $pengguna->alamat !!}</textarea>
                    </div>
                  </div>


                </div>
                @if ($pengguna->status_pengajuan_store == 'PENDING')                    
                <div class="row">
                  <div class="col-12">
                    <button type="submit" class="btn btn-success px-5 mt-3 btn-block">
                      Setujui
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
