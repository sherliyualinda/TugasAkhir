@extends('super-admin.layouts.app')

@section('title')
    Daftar Video
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">List Video</h1>
      <a href="{{route('superadmin.sosial-media.video.create')}}" class="btn btn-primary">Tambah</a>
  </div>
  @if($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach($errors->all() as $error)
          <li> {{ $error }} </li>
          @endforeach
      </ul>
  </div>
  @endif
  @if (\Session::has('success'))
  <div class="alert alert-success">
      <ul>
          <li>{!! \Session::get('success') !!}</li>
      </ul>
  </div>
@endif
<!-- Content Row -->
  <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-desa" role="tabpanel" aria-labelledby="pills-desa-tab">
          <div class="card shadow mb-4">
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-bordered" id="dataTableX" width="100%" cellspacing="0">
                          <thead class="thead-light">
                              <tr align="center">
                                  <th>No.</th>
                                  <th>Judul</th>
                                  <th>Deskripsi</th>
                                  <th>Thumbnail</th>
                                  <th>Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($videos as $key => $item)
                              <tr align="center">
                                  <td>{{ $key+1 }}.</td>
                                  <td>{{ $item->title }}</td>
                                  <td>{{ $item->description }}</td>
                                  <td><img class="img-profile rounded-circle" src="{{ $item->thumbnail != null ? asset($item->thumbnail) : asset('user.jpg') }}"></td>
                                    <td>
                                        <a href="{{route('superadmin.sosial-media.video.show', $item->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="{{route('superadmin.sosial-media.video.edit', $item->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                        <a href="#" class="btn btn-danger delete btn-sm" data-toggle="modal" data-target="#deleteModal" data-url={{ route('superadmin.sosial-media.video.destroy', $item->id) }}><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
                  <div class="row">
                    <div class="col-12 mt-4">
                      {{ $videos->links() }}
                    </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Delete Warning Modal -->
<div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="delete" />
                <h5 class="text-center">Yakin mau hapus video ini?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-sm btn-danger">Ya, Hapus Video</button>
            </div>
            </form>
        </div>
    </div>
</div>
        <!-- End Delete Modal --> 
@endsection

@section('js')
<script>
     $(document).on('click','.delete',function(){
         let url = $(this).attr('data-url');
         $('#deleteModal form').attr('action',url);
    });
</script>
@endsection