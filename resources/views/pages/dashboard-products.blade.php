@extends('layouts2.dashboard')

@section('title')
Store Dashboard Products Pages
@endsection

@section('content')
      <div class="section-content section-dashboard-home" data-aos="fade-up">
          <div class="container-fluid">
            <div class="dashboard-heading">
              <h2 class="dashboard-title">
                Produk
              </h2>
              <p class="dashboard-subtitle">
                Upload lebih banyak produkmu
              </p>

            </div>
            <div class="dashboard-content">
              <div class="row">
                <div class="col-12">
                @php 
                $product = App\Product::with('user')->where('users_id',Auth::user()->id)->count()     
                @endphp
                {{-- @if (Auth::user()->store_name) --}}
                  <a href="{{ route('dashboard-product-create') }}" class="btn btn-success">Tambah Produk</a>
                {{-- @else
                  <a href="{{ route('dashboard-settings-store') }}" class="btn btn-warning text-white">Buat Toko</a>
                @endif      --}}
                </div>
              </div>
              <div class="row mt-4">
              @if (auth()->user()->pengguna->jenis_akun == 'pribadi')

              @endif
              @if (auth()->user()->pengguna->jenis_akun == 'desa')
              @foreach ($products as $product)
                 <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                  <div class="card card-dashboard-product d-block">
                  {{-- <a href="{{ route('dashboard-product-details', $product->id) }}" class="card card-dashboard-product d-block"> --}}
                    <div class="card-body">
                      <img src="{{ Storage::url($product->galleries->first()->photos ?? '') }}" class="w-100 mb-2" alt="">
                      <div class="product-title">
                        {{ $product->name }}
                      </div>

                      <div class="row">
                        <div class="col-9">
                            <div class="d-flex justify-content-start">
                                <div class="product-category">
                                 {{ $product->category->name }}
                          
                                </div>
                            </div>
                            @if ($product->status == 'APPROVE')
                                <span style="font-size:13px; color:#29a867; ">
                                    APPROVE
                                </span>
                                @elseif ($product->status == 'PENDING')
                                <span style="font-size:13px; color:orange; ">
                                    PENDING
                                </span>
                                @elseif ($product->status == 'NOTAPPROVE')
                                <span style="font-size:13px; color:red; ">
                                    NOTAPPROVE
                                </span>
                                @endif
                        </div>
                        <div class="col-3">
                            <div class="justify-content-end">
                                <a href="{{ route('dashboard-product-show', $product->id) }}" class="pr-3">
                                  <i class="fa fa-eye"></i>
                                </a>
                                {{-- <a href="{{ route('dashboard-product-details', $product->id) }}" class="pr-3">
                                  <i class="fa fa-pencil"></i>
                                </a> --}}
                            </div>
                        </div>
                    </div>

                      
                    </div>
                  </div>
                  {{-- </a> --}}
                </div>
              @endforeach
              @endif
              </div>
            </div>
          </div>
        </div>
@endsection