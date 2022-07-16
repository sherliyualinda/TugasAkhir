@extends('layouts2.dashboard')

@section('title')
Store Dashboard Store
@endsection

@section('content')
      <div class="section-content section-dashboard-home" data-aos="fade-up">
          <div class="container-fluid">
            <div class="dashboard-heading">
              <h2 class="dashboard-title">
                Toko
              </h2>

            </div>
            <div class="dashboard-content">
              <div class="row">
                <div class="col-12">
                  <a href="{{ route('dashboard-settings-store') }}" class="btn btn-warning text-white">Buat Toko</a>
                </div>
              </div>
              <div class="row mt-4">
              @foreach ($pengguna as $item)
                 <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                  <div class="card card-dashboard-product d-block">
                    <div class="card-body">
                      <div class="product-title">
                        {{ $item->nama }}
                      </div>

                      <div class="row">
                        <div class="col-9">
                            <div class="d-flex justify-content-start">
                                <div class="product-category">
                                 {{ $item->nik }}
                          
                                </div>
                            </div>
                            @if ($item->status_pengajuan_store == 'APPROVE')
                                <span style="font-size:13px; color:#29a867; ">
                                    APPROVE
                                </span>
                                @elseif ($item->status_pengajuan_store == 'PENDING')
                                <span style="font-size:13px; color:orange; ">
                                    PENDING
                                </span>
                                @elseif ($item->status_pengajuan_store == 'REJECT')
                                <span style="font-size:13px; color:red; ">
                                    REJECT
                                </span>
                                @endif
                        </div>
                        <div class="col-3">
                            <div class="justify-content-end">
                                <a href="{{ route('dashboard.store-pending-show', $item->id) }}" class="pr-3">
                                  <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                      
                    </div>
                  </div>
                </div>
              @endforeach
              </div>
            </div>
          </div>
        </div>
@endsection