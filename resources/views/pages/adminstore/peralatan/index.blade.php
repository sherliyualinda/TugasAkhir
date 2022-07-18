@extends('layouts2.dashboard')

@section('title')
Dashboard Peralatan
@endsection

@section('content')
      <div class="section-content section-dashboard-home" data-aos="fade-up">
          <div class="container-fluid">
            <div class="dashboard-heading">
              <h2 class="dashboard-title">
                Peralatan
              </h2>

            </div>
            <div class="dashboard-content">
              <div class="row mt-4">
              @foreach ($peralatans as $item)
                 <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                  <div class="card card-dashboard-product d-block">
                    <div class="card-body">
                      <div class="product-title">
                        {{ $item->nama_alat }}
                      </div>

                      <div class="row">
                        <div class="col-9">
                            <div class="d-flex justify-content-start">
                                <div class="product-category">
                                  <img src="{{ url('gambar_peralatan') }}/{{ $item->gambar }} "width="100" height="100">
                                </div>
                            </div>
                            @if ($item->status == 'Ready')
                                <span style="font-size:13px; color:#29a867; ">
                                    {{$item->status}}
                                </span>
                                @elseif ($item->status == 'Not Ready')
                                <span style="font-size:13px; color:orange; ">
                                  {{$item->status}}
                                </span>
                                @elseif ($item->status == 'Waiting')
                                <span style="font-size:13px; color:red; ">
                                  {{$item->status}}
                                </span>
                                @endif
                        </div>
                        <div class="col-3">
                            <div class="justify-content-end">
                                <a href="{{ route('dashboard.peralatan-pending-show', $item->id_peralatan) }}" class="pr-3">
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