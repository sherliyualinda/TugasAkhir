@extends('layouts2.app')

@section('title')
Pengajuan Store
@endsection

@section('content')
<div class="page-content page-details">
    <div class="store-details-container" data-aos="fade-up">
      <section class="store-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 mt-3">
              <div class="owner card">
                <div class="card-body">
                  <a href="store.html" class="card-list d-block mb-0">
                    <div class="card-body py-0">
                      <div class="row align-items-center">
                        <img src="/images/icon-store.svg" alt="" class="mr-3" style="max-height: 65px;">
                        <p class="text-bold mt-4" style="font-size: 20px;">Pengajuan Store</p>
                      </div>
                    </div>
                  </a>
                  <div class="row">
                    <div class="col-12 col-md-12">
                      <form action="{{route('send-submission-store', $pengguna->id_pengguna)}}" method="POST" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Username</label>
                          <input type="text" class="form-control" value="{{$pengguna->username}}" readonly>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Nama</label>
                          <input type="text" name="nama" class="form-control" placeholder="Nama Toko" value="{{$pengguna->nama}}" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Email</label>
                          <input type="email" name="email" class="form-control" placeholder="name@example.com" value="{{$pengguna->email}}" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlInput1">NIK (sesuai KTP)</label>
                          <input type="number" name="nik" class="form-control" placeholder="20012xxx" value="{{$pengguna->nik}}" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Nomor HP</label>
                          <input type="number" name="nomor_hp" class="form-control" placeholder="085xxx" value="{{$pengguna->nomor_hp}}" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Pekerjaan</label>
                          <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan" value="{{$pengguna->pekerjaan}}" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">Alamat</label>
                          <textarea class="form-control" name="alamat" rows="3" required>{{$pengguna->alamat}}</textarea>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlFile1">Foto KTP</label>
                          <input type="file" name="foto_ktp" class="form-control-file">
                          <img class="pt-3" src="{{asset($pengguna->foto_ktp)}}" alt="Foto KTP" width="200px">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlFile1">Foto Profil</label>
                          <input type="file" name="foto_profil" class="form-control-file">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlFile1">Foto Sampul</label>
                          <input type="file" name="foto_sampul" class="form-control-file">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">Deskripsi</label>
                          <textarea class="form-control" name="bio" rows="3">{{$pengguna->bio}}</textarea>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Link Website</label>
                          <input type="text" name="website" class="form-control" placeholder="Website" value="{{$pengguna->website}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Link Youtube</label>
                          <input type="text" name="youtube" class="form-control" placeholder="Youtube" value="{{$pengguna->youtube}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Link Marketplace</label>
                          <input type="text" name="marketplace" class="form-control" placeholder="Marketplace" value="{{$pengguna->marketplace}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Link Berita</label>
                          <input type="text" name="berita" class="form-control" placeholder="Berita" value="{{$pengguna->berita}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Musrembang</label>
                          <input type="text" name="musrembang" class="form-control" placeholder="Musrembang" value="{{$pengguna->musrembang}}">
                        </div>
                        <div class="form-group float-right">
                          <button type="submit" class="btn btn-primary">Ajukan Toko</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>

    </div>

  </div>

@endsection