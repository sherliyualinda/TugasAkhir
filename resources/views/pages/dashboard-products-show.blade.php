@extends('layouts2.dashboard')

@section('title')
Store Dashboard Products Details Pages
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">
       {{ $product->name }}
      </h2>
      <p class="dashboard-subtitle">
        Detail Produk
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
          <form action="{{ route('dashboard-product-approve', $product->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Nama Produk</label>
                      <input type="text" class="form-control" name="name" value="{{ $product->name }}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Harga</label>
                      <input type="number" name="price" class="form-control" value="{{ $product->price }}" readonly>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Stok</label>
                      <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" readonly>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Kategori Produk</label>
                      <input type="text" name="kategori" class="form-control" value="{{ $product->category->name }}" readonly>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Deskripsi</label>
                      <textarea name="description" id="editor" readonly>{!! $product->description !!}</textarea>
                    </div>
                  </div>


                </div>
                @if ($product->status == 'PENDING')                    
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

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<script>
  function thisFileUpload() {
    document.getElementById("file").click();
  }
</script>

<script>
  CKEDITOR.replace('editor');
</script>
@endpush