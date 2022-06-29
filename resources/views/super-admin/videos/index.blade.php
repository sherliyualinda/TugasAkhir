@extends('super-admin.layouts.app')

@section('title')
    Daftar Video
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">List Video</h1>
      <a href="#">Tambah</a>
      {{-- <br>
      <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
          <li class="nav-item">
              <a class="nav-link active" data-toggle="pill" href="#pills-desa" role="tab" aria-controls="pills-desa" aria-selected="true">Akun Desa</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="pills-pribadi-tab" data-toggle="pill" href="#pills-pribadi" role="tab" aria-controls="pills-pribadi" aria-selected="false">Akun Pribadi</a>
          </li>
      </ul> --}}
  </div>

<!-- Content Row -->
  <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-desa" role="tabpanel" aria-labelledby="pills-desa-tab">
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Akun Desa</h6>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-bordered" id="dataTableX" width="100%" cellspacing="0">
                          <thead class="thead-light">
                              <tr align="center">
                                  <th>No.</th>
                                  <th>Tanggal Join</th>
                                  <th>Foto Profil</th>
                                  <th>Nama</th>
                                  <th>Username</th>
                              </tr>
                          </thead>
                          <tbody>
                              {{-- @foreach($akun_desa as $data)
                              <tr align="center">
                                  <td>{{ $i++ }}.</td>
                                  <td>{{ date_format(date_create($data->tgl_join), "d M Y H:i A") }}</td>
                                  <td><img class="img-profile rounded-circle" src="{{ $data->foto_profil != null ? url('/data_file/'.$data->username.'/foto_profil/'.$data->foto_profil) : asset('user.jpg') }}"></td>
                                  <td>{{ $data->nama }}</td>
                                  <td>{{ $data->username }}</td>
                              </tr>
                              @endforeach --}}
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
      <div class="tab-pane fade" id="pills-pribadi" role="tabpanel" aria-labelledby="pills-pribadi-tab">
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Akun Pribadi</h6>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-bordered" id="dataTableY" width="100%" cellspacing="0">
                          <thead class="thead-light">
                              <tr align="center">
                                  <th>No.</th>
                                  <th>Tanggal Join</th>
                                  <th>Foto Profil</th>
                                  <th>Nama</th>
                                  <th>Username</th>
                              </tr>
                          </thead>
                          <tbody>
                              {{-- @foreach($akun_pribadi as $data)
                              <tr align="center">
                                  <td>{{ $i++ }}.</td>
                                  <td>{{ date_format(date_create($data->tgl_join), "d M Y H:i A") }}</td>
                                  <td><img class="img-profile rounded-circle" src="{{ $data->foto_profil != null ? url('/data_file/'.$data->username.'/foto_profil/'.$data->foto_profil) : asset('user.jpg') }}"></td>
                                  <td>{{ $data->nama }}</td>
                                  <td>{{ $data->username }}</td>
                              </tr>
                              @endforeach --}}
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection