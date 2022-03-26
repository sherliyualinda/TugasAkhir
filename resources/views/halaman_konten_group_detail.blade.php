<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Sosial Media Desaku</title>
    <link rel="icon" href="/logo-home.png" type="image/png" sizes="16x16"> 
    {{-- <link rel="icon" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/images/fav.png') }}" type="image/png" sizes="16x16">  --}}
    
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('slick-1.8.1/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('slick-1.8.1/slick/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('jquery-ui-1.12.1.custom/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slideshow.css') }}">
    <link rel="stylesheet" href="{{ asset('css/read-less-more.css') }}">
    <link rel="stylesheet" href="{{ asset('css/konten-group-detail.css') }}">

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/> -->

</head>
<body style="overflow-y: auto;">
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
	
	<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
		@include('theme.nav_bar')
	</nav>
		
	<section>
		<div class="gap gray-bg">
			<div class="container-fluid">
			@if (Session::get('success'))
			    <div class="alert alert-success">
			        {{ Session::get('success') }}
			        <button type="button" class="close" data-dismiss="alert">&times;</button>
			    </div>
			@endif
                <div class="row justify-content-md-center">
                    <!-- <div class="col-lg-12"> -->
                        <div class="col-lg-9" style="padding-left: 20px;">
                            <div class="central-meta" style="padding: 20px;">
                                <section>
                                    @foreach ($kueri as $data)
                                    <div class="feature-photo">
                                        <figure>
                                            <img src="{{ url('/data_file/group/'.$data->nama_group.'/foto_sampul/'.$data->foto_sampul_group) }}" alt="" style="width: 1366px; height: 200px;">
                                        </figure>
                                        <?php $array = array();
                                            foreach($list_admin as $adm){
                                                $array[] = $adm->id_admin;
                                            }
                                        ?>
                                        @if(Auth::check())
                                            @if(in_array(auth()->user()->pengguna->id_pengguna, $array))
                                            <form class="edit-phto" style="bottom: 0px; left: 0px; height: 35px!important;" method="post" action="/sosial-media/ubah_foto_sampul">
                                                <i class="fa fa-camera-retro"></i>
                                                <label class="fileContainer">
                                                    Ubah Foto Sampul
                                                    <input type="file" name="foto_sampul_grup" id="ubah_sampul"/>
                                                    <input type="hidden" name="id_group" value="{{$data->id_group}}" class="id_group"/>
                                                    <input type="hidden" name="nama_group" value="{{$data->nama_group}}" class="nama_group"/>
                                                </label>
                                            </form>
                                            @endif
                                        @endif
                                    </div>
                                    @break
                                    @endforeach
                                </section>
                                <section class="col-lg-4" style="padding-left: 0px;">
                                    <div style="padding-top: 15px;">
                                        <h4 style="color: black; margin-bottom: 0px;">{{$data->nama_group}}</h4>
                                        @foreach ($data_anggota as $data2)
                                            @if ($data->id_group == $data2->id_group)
                                                <span style="font-size: 12px;">{{$data2->jml_anggota}} anggota</span>
                                            @endif
                                        @endforeach
                                    </div>
                                </section>
                                <section class="col-lg-5" style="padding-left: 0px;">
                                    <div style="padding-top: 15px;">
                                        <div class="users-thumb-list" style="margin-top: 0px; text-align: right;">
                                        @foreach ($list_group as $row)
                                            <a href="/sosial-media/profil/{{$row->username}}" title="{{$row->nama}}" data-toggle="tooltip" style="display: inline-block; margin-left: -17px;">
                                                <img src="{{ $row->foto_profil != null ? url('/data_file/'.$row->username.'/foto_profil/'.$row->foto_profil) : asset('user.jpg') }}" style="border: 2px solid #fff; border-radius: 50%; width: 36px; height: 36px; object-fit: cover;">  
                                            </a>
                                        @endforeach
                                        </div>
                                    </div>
                                </section>
                                <section class="col-lg-3" style="padding-right: 0px;">
                                    <div style="padding-top: 15px; float: right;">
                                    <?php $array_anggota = array();
                                        foreach($list_group as $anggota){
                                            $array_anggota[] = $anggota->id_pengguna;
                                        }
                                    ?>
                                    @if(Auth::check())
                                        @if(in_array(auth()->user()->pengguna->id_pengguna, $array_anggota))
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalInvite"  style="position: relative;">Undang Teman</button>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-primary" style="position: relative;" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                    <!-- <button class="dropdown-item" type="button">Action</button> -->
                                                    <button class="dropdown-item" type="button"><a href="#" onclick="keluarGrup('{{ $data->id_group }}', '{{ $data->nama_group }}', '{{ $data->foto_sampul_group }}')" style="color: red;">Keluar Dari Group</a></button>
                                                    @if(in_array(auth()->user()->pengguna->id_pengguna, $array))
                                                    <button class="dropdown-item" type="button" onclick="hapusGrup('{{ $data->id_group }}', '{{ $data->nama_group }}', '{{ $data->foto_sampul_group }}')" style="cursor: pointer; background: red; color: white">Hapus Group</button>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <a href="/sosial-media/gabung_grup/{{$data->id_group}}"><button type="button" class="btn btn-sm btn-primary" style="position: relative;">Gabung Grup</button></a>
                                        @endif
                                    @else
                                        <a href="/sosial-media"><button type="button" class="btn btn-sm btn-primary" style="position: relative;">Login</button></a>
                                    @endif
                                    </div>
                                </section>
                            </div>
                            @if(Auth::check())
                            <div class="modal fade" id="modalInvite" role="dialog">
                                <div class="modal-dialog modal-sm modal-dialog-centered" style="max-width: 400px;">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-center" style="padding: 0.5rem;">
                                            <h6 class="modal-title">Undang Teman</h6>
                                        </div>
                                        <div class="input-group flex-nowrap" id="cari_teman">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping" style="border-radius: 0rem;">
                                                    Ke: 
                                                </span>
                                            </div>
                                            <!-- <input type="text" class="form-control form-control-sm" placeholder="cari.." style="border-radius: 0rem;"> -->
                                            <div id="kolom_input_cari" style="width: 100%;"></div>
                                        </div>
                                        <form method="post" action="/sosial-media/undangan_grup_proses" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                            <ul class="friendz-list list-group list-group-flush" style="margin-top: 0px; overflow-y: auto!important; max-height: 250px;" id="teman_yang_dicari">
                                                @if ($teman != NULL)
                                                    @foreach ($teman as $data2)
                                                    @if(!in_array($data2->id_pengguna, $array_anggota))
                                                    <div class="list-group list-group-flush" style="max-height: 315px;">
                                                        <a class="list-group-item list-group-item-action" style="padding-right: 10px; padding-left: 10px;">
                                                            <div class="input-group mb-3" style="margin-bottom: 0px;">
                                                                <div class="media">
                                                                    <img src="{{ $data2->foto_profil != null ? url('/data_file/'.$data2->username.'/foto_profil/'.$data2->foto_profil) : asset('user.jpg') }}" class="align-self-center mr-3" alt="..." style="width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;">
                                                                    <div class="media-body align-self-center">
                                                                        <small style="font-weight: 700; color: black; margin-bottom: 0rem;">{{ $data2->username }}</small><br>
                                                                        <small class="mt-0" style="margin-bottom: 0rem; font-weight: 500; color: #989e99;">{{ $data2->nama }}</small>
                                                                    </div>
                                                                </div>
                                                                <div class="input-group-append" style="position: absolute;right: 0;top: 35%;">
                                                                    <!-- <div class="input-group-text" style="background-color: #fff; border-color: #fff;"> -->
                                                                        <input type="checkbox" name="pilih_teman[]" value="{{$data2->id_pengguna}}" aria-label="Checkbox for following text input">
                                                                    <!-- </div> -->
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    @endif
                                                    @endforeach 
                                                @else
                                                    <li>
                                                        <div align="center">Tidak ada teman</div>
                                                    </li>
                                                @endif
                                            </ul>
                                            <input type="hidden" name="id_group" value="{{$data->id_group}}"></input>
                                            <div class="modal-footer" style="padding: 8px;">
                                                <input class="btn btn-sm btn-submit" type="submit" style="background-color: #358f66; color: white;" value="Submit"></input> 
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="col-lg-12">
                                <div class="row" id="page-contents">
                                    <div class="col-lg-9" style="padding-left: 0px; padding-right: 15px;">
                                        @if(Auth::check())
                                            @if(in_array(auth()->user()->pengguna->id_pengguna, $array_anggota))
                                            <div class="central-meta item">
                                                <div class="new-postbox">
                                                    <div class="newpst-input" style="margin-right: 0px; margin-left: 0px; width: 100%;">
                                                        <form method="post" action="/sosial-media/post_konten_grup" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                            <div class="form-group">
                                                                <input type="text" name="tempat" id="tempat" style="border:1px solid #eeeeee; background-color: white; padding: 10px;" placeholder="Pilih Lokasi" required />
                                                                <input type="hidden" id="long" name="longitude_tempat">
                                                                <input type="hidden" id="lat" name="latitude_tempat">
                                                            </div>
                                                            <input type="hidden" name="id_group" value="{{$data->id_group}}"></input>
                                                            <input type="hidden" name="nama_group" value="{{$data->nama_group}}"></input>
                                                            <textarea rows="3" name="caption" placeholder="write something" required></textarea>
                                                            <div class="attachments">
                                                                <ul>
                                                                    <li>
                                                                        <i class="fa fa-image"></i>
                                                                        <label class="fileContainer">
                                                                            <input type="file" name="file_foto[]" id="pro-imagee" required multiple> <!-- id="pro-image" -->
                                                                        </label>
                                                                    </li>
                                                                    <li>
                                                                        <button type="submit">Post</button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </form>
                                                        <div class="preview-images-zone"></div>
                                                    </div>
                                                </div>
                                            </div><!-- add post new box -->
                                            <div id="map"></div>
                                            @endif
                                        @endif
                                        <div>
                                            <?php $nm_grp = $data->nama_group; ?>
                                            @if (isset($konten))
                                                @foreach ($konten as $data)
                                                <div class="central-meta item">
                                                    <div class="user-post">
                                                        <div class="friend-info">
                                                            <figure>
                                                                <img src="{{ $data->foto_profil != null ? url('/data_file/'.$data->username.'/foto_profil/'.$data->foto_profil) : asset('user.jpg') }}" alt="" style="width: 35px; height: 35px;">
                                                            </figure>
                                                            <div class="friend-name">
                                                                <ins><a href="/sosial-media/profil/{{$data->username}}" title="">{{ $data->username }}</a></ins>
                                                                <span style="color: black;"><a>{{ $data->tempat }}</a></span>
                                                                <div class="d-flex justify-content-end">
                                                                @if(Auth::check())
                                                                <?php $tgl = date_format(date_create($data->created_at), "d-m-Y"); ?>
                                                                    @if(($data->username) != auth()->user()->pengguna->username)
                                                                        <a onclick="modalMore('{{ $data->id_konten }}', '{{ $data->username }}', '{{ $data->slug }}', '{{ $data->foto_profil }}')" style="cursor: pointer;"><i class="fa fa-ellipsis-v"></i></a>
                                                                    @else
                                                                        <a onclick="modalMore2('{{ $data->id_konten }}', '{{ $data->foto_profil }}', '{{ $nm_grp }}', '{{ $data->username }}', '{{ $data->tempat }}', '{{ $data->foto_video_konten }}', '{{ str_replace('"', "&quot;", str_replace("'", "\'", $data->caption)) }}', '{{ $tgl }}', '{{ $data->slug }}')" style="cursor: pointer;"><i class="fa fa-ellipsis-v"></i></a>
                                                                    @endif
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="post-meta">
                                                                <div class="single-item">
                                                                <?php $media = explode(", ", $data->foto_video_konten); ?>
                                                                <?php $tgl = date_format(date_create($data->created_at),"d-m-Y"); ?>
                                                                @foreach ($media as $media_konten)
                                                                    @if (strpos($media_konten, '.mp4'))
                                                                        <video width="100%" height="100%" autoplay loop muted>
                                                                            <source src="{{ url('/data_file/group/'.$nm_grp.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media_konten) }}" type="video/mp4">
                                                                            <source src="{{ url('/data_file/group/'.$nm_grp.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media_konten) }}" type="video/ogg">
                                                                            Your browser does not support the video tag.
                                                                        </video>
                                                                    @else
                                                                        <img src="{{ url('/data_file/group/'.$nm_grp.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media_konten) }}" alt="">
                                                                    @endif
                                                                @endforeach
                                                                </div>
                                                                <div class="we-video-info" style="padding-top: 5px; padding-bottom: 0;">
                                                                    <ul style="max-height: 30px;">
                                                                    @if(Auth::check())
                                                                        <li data-id="{{$data->id_konten}}" data-is-like="{{$data->is_like ? 1 : 0}}" class="action-like-or-dislike" style="margin-right: 5px;height: 23px;">
                                                                            <span class="like" data-toggle="tooltip" title="{{$data->is_like ? 'Batal Menyukai' : 'Menyukai'}}">
                                                                                <div class="menu" style="width: 23px; height: 23px;">
                                                                                    <div class="btn trigger" style="background: none;">
                                                                                        <i id="icon_like{{$data->id_konten}}" class="{{$data->is_like ? 'fa fa-heart' : 'fa fa-heart-o'}}" style="font-size: 20px;color: black;"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </span>
                                                                        </li>
                                                                        <li class="social-media" style="margin-right: 5px; height: 23px; position: absolute;">
                                                                            <span class="like">
                                                                                <div class="menu" style="width: 23px; height: 23px;">
                                                                                    <div class="btn trigger" style="background: none;">
                                                                                        <i class="fa fa-share-alt" style="color: black; font-size: 20px;"></i>
                                                                                    </div>
                                                                                    <?php

                                                                                        $url = url("/sosial-media/group/p/".$data->slug);
                                                                                        $media = explode(", ", $data->foto_video_konten); $i=1;
                                                                                        foreach ($media as $media_konten){
                                                                                            $img = urlencode(url('/data_file/'.$media_konten));
                                                                                            if($loop->iteration == 1){
                                                                                                break;
                                                                                            }
                                                                                        }
                                                                                        $title = $data->username;
                                                                                        $summary = $data->caption;

                                                                                    ?>
                                                                                    <div class="rotater">
                                                                                        <div class="btn btn-icon"><a href="https://www.facebook.com/sharer/sharer.php?u={{$url}}&display=popup" target="_blank" title=""><i class="fa fa-facebook"></i></a></div>
                                                                                    </div>
                                                                                    <div class="rotater">
                                                                                        <div class="btn btn-icon"><a href="https://twitter.com/intent/tweet?url={{$url}}" target="_blank" title=""><i class="fa fa-twitter"></i></a></div>
                                                                                    </div>
                                                                                    <div class="rotater">
                                                                                        <div class="btn btn-icon"><a href="whatsapp://send?text={{$url}}" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title=""><i class="fa fa-whatsapp"></i></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </span>
                                                                        </li>
                                                                    </ul>
                                                                    @endif
                                                                </div>
                                                                @if($likes)
                                                                    @foreach ($likes as $like)
                                                                        @if($like->id_konten == $data->id_konten)
                                                                            <p style="margin-bottom: 0px;">Disukai oleh <a href="/sosial-media/profil/{{$like->username}}"><b>{{$like->username}}</b></a> dan<span style="cursor: pointer;" data-toggle="modal" data-target="#modalLike{{$data->id_konten}}"> <b>lainnya</b></span></p>
                                                                            @if(COUNT((array)$like->username) == 1)
                                                                            @break
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                                <div class="description" style="margin-top: 0;">
                                                                    <p style="margin-bottom: 0px;"> 
                                                                        <strong>{{ $data->username }}</strong> <span class="addReadMore showlesscontent">{{ $data->caption }}</span>
                                                                    </p>
                                                                    <span style="color: #999; float: left;font-size: 12px;text-transform: capitalize;width: 100%;">
                                                                        <?php echo date_format(date_create($data->created_at), "d M Y H:i A"); ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="modalLike{{$data->id_konten}}" role="dialog">
                                                            <div class="modal-dialog modal-sm modal-dialog-centered" style="max-width: 400px;">
                                                                <div class="modal-content">
                                                                    <div class="modal-header d-flex justify-content-center" style="padding: 0.5rem;">
                                                                        <h6 class="modal-title">Menyukai</h6>
                                                                    </div>
                                                                    <ul class="friendz-list list-group list-group-flush" style="overflow-y: auto!important; max-height: 250px;">
                                                                        @if ($likes_all != NULL)
                                                                            @foreach ($likes_all as $data2)
                                                                                @if($data2->id_konten == $data->id_konten)
                                                                                    <div class="list-group list-group-flush" style="max-height: 315px;">
                                                                                        <a href="#" class="list-group-item list-group-item-action" data-dismiss="modal" style="padding-left: 10px; padding-right: 10px;">
                                                                                            <div class="media">
                                                                                                <img src="{{ $data2->foto_profil != null ? url('/data_file/'.$data2->username.'/foto_profil/'.$data2->foto_profil) : asset('user.jpg') }}" class="align-self-center mr-3" alt="..." style="width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;">
                                                                                                <div class="media-body align-self-center">
                                                                                                    <small style="font-weight: 700; color: black; margin-bottom: 0rem;">{{ $data2->username}}</small><br>
                                                                                                    <small class="mt-0" style="margin-bottom: 0rem; font-weight: 500; color: #989e99;">{{ $data2->nama }}</small>
                                                                                                </div>
                                                                                            </div>
                                                                                        </a>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="coment-area">
                                                            <ul class="we-comet list-cmt{{$data->id_konten}}" style="overflow-y: auto; max-height: 200px;">
                                                                @if (isset($komentar))
                                                                    @foreach ($komentar as $dataa)
                                                                        @if(isset($dataa->isi_komentar))
                                                                            @if(($data->id_konten == $dataa->id_konten) && $dataa->id_balas_komen == 0)
                                                                                <li id="comment_{{$dataa->id_cmt}}" class="list-rep_cmt_{{$dataa->id_cmt}}" style="width:100%;">
                                                                                    <div id="li-cmt-{{$dataa->id_cmt}}">
                                                                                        <div class="comet-avatar" style="width:5%;">
                                                                                            <img src="{{ $dataa->foto_profil != null ? url('/data_file/'.$dataa->username.'/foto_profil/'.$dataa->foto_profil) : asset('user.jpg') }}" alt="" style="height: 45px; width: 45px;">
                                                                                        </div>
                                                                                        <div class="we-comment" style="width:50%;">
                                                                                            <div class="coment-head">
                                                                                                <h5 style="text-transform: none;"><a href="/sosial-media/profil/{{$dataa->username}}" title="">{{$dataa->username}}</a></h5>
                                                                                                <span>{{ date_format(date_create($dataa->tanggal_komen), "d M Y H:i A") }}</span>
                                                                                                <!-- <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a> -->
                                                                                                @if(Auth::check())
                                                                                                @if(in_array(auth()->user()->pengguna->id_pengguna, $array_anggota))
                                                                                                {{-- <a onclick="moreOnComment('{{ $dataa->id }}', '{{Auth::user()->pengguna->username}}', '{{$dataa->username}}', '{{$data_desa->username}}')" style="cursor: pointer"><i class="fa fa-ellipsis-h"></i></a> --}}
                                                                                                @if((Auth::user()->pengguna->username == $dataa->username) OR (Auth::user()->pengguna->username == $data->username))
                                                                                                <a onclick="modalHapusKomentar('{{$dataa->id_cmt}}')" style="cursor: pointer"><i class="ti-trash hide" style="color:red;"></i></a>
                                                                                                @endif
                                                                                                @if(Auth::user()->pengguna->username != $dataa->username)
                                                                                                <a onclick="modalReportKomentar('{{$dataa->id_cmt}}')" style="cursor: pointer" title="Report Komentar"><i class="ti-info-alt hide" style="color: red;"></i></a>
                                                                                                @endif
                                                                                                <button class="we-reply btn btn-link" style="font-size: 12px; font-weight: 500; float: right;position: relative;top: 0;" onclick="balas_komen('{{'@'.$dataa->username}}', '{{$dataa->id_cmt}}', '{{$dataa->username}}', '{{$data->id_konten}}')" value="{{$dataa->id_cmt}}">Balas</button>
                                                                                                @endif
                                                                                                @endif
                                                                                            </div>
                                                                                            <p style="margin-top: 0px;">{{ $dataa->isi_komentar }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php $id_cmt_parent = $dataa->id_cmt; ?>
                                                                                    @if(isset($balas_komentar))
                                                                                    @foreach ($balas_komentar as $balas_komen)
                                                                                    @if($balas_komen->id_balas_komen != 0)
                                                                                    @if($dataa->id_cmt == $balas_komen->id_balas_komen)
                                                                                    <ul id="comment_{{$balas_komen->id_cmt}}" style="margin-left: 80px;">
                                                                                        <li>
                                                                                            <div class="comet-avatar">
                                                                                                <img src="{{ $balas_komen->foto_profil != null ? url('/data_file/'.$balas_komen->username.'/foto_profil/'.$balas_komen->foto_profil) : asset('user.jpg')  }}" alt="" style="height: 35px; width: 35px;">
                                                                                            </div>
                                                                                            <div class="we-comment" width: 60%;>
                                                                                                <div class="coment-head">
                                                                                                    <h5 style="text-transform: none;"><a href="/sosial-media/profil/{{$balas_komen->username}}" title="">{{$balas_komen->username}}</a></h5>
                                                                                                    <span style="text-overflow: ellipsis;white-space: nowrap;">{{ date_format(date_create($balas_komen->tanggal_komen), "d M Y H:i A") }}</span>
                                                                                                    @if(Auth::check())
                                                                                                    @if(in_array(auth()->user()->pengguna->id_pengguna, $array_anggota))
                                                                                                    {{-- <a onclick="moreOnComment('{{ $balas_komen->id }}', '{{Auth::user()->pengguna->username}}', '{{$balas_komen->username}}', '{{$data_desa->username}}')" style="cursor: pointer"><i class="fa fa-ellipsis-h"></i></a> --}}
                                                                                                    @if((Auth::user()->pengguna->username == $balas_komen->username) OR (Auth::user()->pengguna->username == $data->username))
                                                                                                    <a onclick="modalHapusKomentar('{{$balas_komen->id_cmt}}')" style="cursor: pointer"><i class="ti-trash hide" style="color: red;"></i></a>
                                                                                                    @endif
                                                                                                    @if(Auth::user()->pengguna->username != $balas_komen->username)
                                                                                                    <a onclick="modalReportKomentar('{{$balas_komen->id_cmt}}')" style="cursor: pointer" title="Report Komentar"><i class="ti-info-alt hide" style="color: red;"></i></a>
                                                                                                    @endif
                                                                                                    <button class="we-reply btn btn-link" style="font-size: 12px; font-weight: 500; float: right;position: relative;top: 0;" onclick="balas_komen('{{'@'.$balas_komen->username}}', '{{$id_cmt_parent}}', '{{$balas_komen->username}}', '{{$data->id_konten}}')" value="{{$balas_komen->id_cmt}}">Balas</button>
                                                                                                    @endif
                                                                                                    @endif
                                                                                                </div>
                                                                                                <p style="margin-top: 0px;"><?php echo  html_entity_decode($balas_komen->isi_komentar) ?></p>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                    @endif
                                                                                    @endif
                                                                                    @endforeach
                                                                                    @endif
                                                                                </li>
                                                                                
                                                                                <!-- <li>
                                                                                    <a href="#" title="" class="showmore underline">more comments</a>
                                                                                </li> -->
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </ul>
                                                            @if(Auth::check())
                                                                @if(in_array(auth()->user()->pengguna->id_pengguna, $array_anggota))
                                                                <ul class="we-comet">
                                                                    <li class="post-comment">
                                                                        <div class="comet-avatar">
                                                                            <img src="{{ auth()->user()->pengguna->foto_profil != null ? url('/data_file/'.auth()->user()->pengguna->username.'/foto_profil/'.auth()->user()->pengguna->foto_profil) : asset('user.jpg') }}" alt="" style="width: 35px; height: 35px;">
                                                                        </div>
                                                                        <div class="post-comt-box2" style="width: 93%;"> <!-- post-comt-box -->
                                                                            <form method="post" action="/sosial-media/post_komen_grup" enctype="multipart/form-data">
                                                                            {{ csrf_field() }}
                                                                                <input type="hidden" name="id_konten" value="{{$data->id_konten}}" class="konten_{{$data->id_konten}}">
                                                                                <span class="thumb-xs{{$data->id_konten}}">
                                                                                    <textarea placeholder="Post your comment" name="isi_komentar" style="width: 100%;" class="txt_comment_{{$data->id_konten}}" onkeyup="showBtn(this, '{{$data->id_konten}}');"></textarea>
                                                                                </span>
                                                                                {{-- <button type="submit" class="btn btn-submit" style="border-radius: 3px;">Post</button> --}}
                                                                                <button type="button" onclick="uploadKomen('{{$data->id_konten}}')" class="btn btn-submit btn-{{$data->id_konten}}" style="border-radius: 3px; display: none;">Post</button>
                                                                            </form>	
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                                @endif
                                                            @else
                                                                <a class="underline" href="/sosial-media" style="font-weight: bold; color: green;">Login</a> untuk memberi komentar
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>		
                                    @foreach ($kueri as $row)
                                    <div class="col-lg-3" style="padding-right: 0px;padding-left: 0px;">
                                        <aside class="sidebar static" style="margin-right: 0px;width: 100%;">
                                            <div class="widget">
                                                <h4 class="widget-title">Tentang Group</h4>	
                                                <div class="your-page">
                                                    <div class="page-meta" style="padding-left: 0px; width: 100%;">
                                                        <span>{{ $row->deskripsi_group }}</span>
                                                        <span>
                                                            <strong>Admin: 
                                                            <?php $array = array();
                                                                foreach($list_admin as $adm){
                                                                    $array[] = $adm->id_admin;
                                                                }
                                                            ?>
                                                            @if(Auth::check())
                                                                @if(in_array(auth()->user()->pengguna->id_pengguna, $array))
                                                                    <i class="ti-plus" style="float: right; border: 1px solid; border-radius: 50%; font-weight: bold; font-size: 10px; padding: 3px; cursor: pointer;" data-toggle="modal" data-target="#modalTambahAdmin"></i>
                                                                @endif
                                                            @endif
                                                            </strong>
                                                            <div class="users-thumb-list" style="margin-top: 0px; text-align: left; padding-left: 15px; padding-right: 15px;">
                                                                @foreach($list_admin as $row_adm)
                                                                    <a href="/sosial-media/profil/{{$row_adm->username}}" title="{{$row_adm->nama}}" data-toggle="tooltip" style="display: inline-block; margin-left: -17px;">
                                                                        <img src="{{ $row_adm->foto_profil != null ? url('/data_file/'.$row_adm->username.'/foto_profil/'.$row_adm->foto_profil) : asset('user.jpg') }}" style="border: 2px solid #fff; border-radius: 50%; width: 36px; height: 36px; object-fit: cover;">  
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- page like widget -->
                                            <!-- <div class="widget friend-list stick-widget"> -->
                                            <div class="widget friend-list">
                                                <h4 class="widget-title">Daftar Anggota</h4>
                                                <div id="searchDir2"></div>
                                                <ul id="people-list2" class="friendz-list" style="max-height: 200px;">
                                                @foreach ($list_group as $row)
                                                    <li>
                                                        <figure>
                                                            <img src="{{ $row->foto_profil != null ? url('/data_file/'.$row->username.'/foto_profil/'.$row->foto_profil) : asset('user.jpg') }}" alt="" style="width: 45px; height: 45px; object-fit: cover;">
                                                        </figure>
                                                        <div class="friendz-meta">
                                                            <a href="/sosial-media/profil/{{$row->username}}">{{ $row->nama_anggota }}</a>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                </ul>
                                            </div><!-- friends list sidebar -->
                                        </aside>
                                    </div><!-- sidebar -->
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    <!-- </div>	 -->
                </div>
            </div>
        </div>	
	</section>
    @if(Auth::check())
	<div class="modal fade" id="modalTambahAdmin" role="dialog">
	    <div class="modal-dialog modal-sm modal-dialog-centered" style="max-width: 400px;">
	      	<div class="modal-content">
		        <div class="modal-header d-flex justify-content-center" style="padding: 0.5rem;">
		          	<h6 class="modal-title">Tambah Admin</h6>
		        </div>
        		<div class="input-group flex-nowrap" id="cari_admin">
        			<div class="input-group-prepend">
				    	<span class="input-group-text" id="addon-wrapping" style="border-radius: 0rem;">
				    		Ke: 
				    	</span>
					</div>
					<div id="kolom_input_cari_admin" style="width: 100%;"></div>
				</div>
				<form method="post" action="/sosial-media/tambah_admin" enctype="multipart/form-data">
				{{csrf_field()}}
		        	<ul class="friendz-list list-group list-group-flush" style="margin-top: 0px; overflow-y: auto!important; max-height: 250px;" id="admin_yang_dicari">
			        	@if ($list_group != NULL)
							@foreach ($list_group as $row)
								@if($row->username !== auth()->user()->pengguna->username)
									<div class="list-group list-group-flush" style="max-height: 315px;">
							        	<a class="list-group-item list-group-item-action" style="padding-right: 10px; padding-left: 10px;">
							        		<div class="input-group mb-3" style="margin-bottom: 0px;">
								        		<div class="media">
													<img src="{{ $row->foto_profil != null ? url('/data_file/'.$row->username.'/foto_profil/'.$row->foto_profil) : asset('user.jpg') }}" class="align-self-center mr-3" alt="..." style="width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;">
												  	<div class="media-body align-self-center">
												  		<small style="font-weight: 700; color: black; margin-bottom: 0rem;">{{ $row->username }}</small><br>
												    	<small class="mt-0" style="margin-bottom: 0rem; font-weight: 500; color: #989e99;">{{ $row->nama }}</small>
												  	</div>
												</div>
												<div class="input-group-append" style="position: absolute;right: 0;top: 35%;">
											      	<input type="checkbox" name="pilih_admin[]" value="{{$row->id_pengguna}}" aria-label="Checkbox for following text input">
											    </div>
											</div>
							        	</a>
							        </div>
					        	@endif
			        		@endforeach 
						@endif
		        	</ul>
		        	<input type="hidden" name="id_group" value="{{$data->id_group}}"></input>
		        	<div class="modal-footer" style="padding: 8px;">
			      		<input class="btn btn-sm btn-submit" type="submit" style="background-color: #358f66; color: white;" value="Tambah"></input> 
			      	</div>
			    </form>
	      	</div>
	    </div>
	</div>
    @endif

</div>

@if(Auth::check())
    <div class="modal fade" id="myModalEdit" role="dialog">
        <div class="modal-dialog" style="max-width: 600px;">
            <form method="post" action="/sosial-media/edit_konten_proses" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Konten</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closebtn" value="">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        <div class="friend-info" style="text-align: left; margin-bottom: 15px;">
                            <figure style="width: 10%;">
                                <img id="foto_post" src="" alt="" style="width: 45px; height: 45px; border-radius: 50%;">
                            </figure>
                            <div class="friend-name" style="width:85%; padding-left: 0px;">
                                <ins>
                                    <a id="uname" href="" title=""></a>
                                </ins>
                                <span id="tmpt" style="color: black;"></span>
                            </div>
                        </div>
                        <div class="wrap-modal-slider">
                            <div class="slideshow-container editSlide">
                                <div id="media_post"></div>
                                <a class="prev" onclick="" id="prevClick">&#10094;</a>
                                <a class="next" onclick="" id="nextClick">&#10095;</a>
                            </div>
                        </div>
                        <div class="newpst-input" style="margin-top: 15px;">
                            <input type="hidden" name="id_konten" id="hidden_id" value=""></input>
                            <textarea rows="3" name="caption" id="capt" style="border: 1px solid #eeeeee; border-radius: 0; border-bottom: 0;"  onkeyup="countCharsEdit(this);" maxlenght="500"></textarea>
                            <div class="attachments">
                                <ul>
                                    <li><small id="charNumEdit" style="margin:0;"></small></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-sm btn-submit" type="submit" style="background-color: #358f66; color: white;" value="Update"></input>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalShare" role="dialog">
        <div class="modal-dialog modal-sm modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center" style="padding: 0.5rem;">
                    <h6 class="modal-title">Bagikan</h6>
                </div>
                <div class="input-group flex-nowrap searchKey" id="cari_teman_2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-wrapping" style="border-radius: 0rem;">
                            Ke: 
                        </span>
                    </div>
                    <div id="kolom_input_cari_2" class="kolom_cari" style="width: 100%;"></div>
                </div>
                <form method="post" action="/sosial-media/share_post" enctype="multipart/form-data">
                {{csrf_field()}}
                    <ul class="friendz-list list-group list-group-flush findFr" style="margin-top: 0px; overflow-y: auto!important; max-height: 250px;" id="teman_yang_dicari_2">
                        @if ($teman != NULL) 
                            @foreach ($teman as $data2)
                            <div class="list-group list-group-flush" style="max-height: 315px;">
                                <a class="list-group-item list-group-item-action" style="padding-right: 10px; padding-left: 10px;">
                                    <div class="input-group mb-3" style="margin-bottom: 0px!important;">
                                        <div class="media">
                                            <img src="{{ $data2->foto_profil != null ? url('/data_file/'.$data2->username.'/foto_profil/'.$data2->foto_profil) : asset('user.jpg') }}" class="align-self-center mr-3" alt="..." style="width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;">
                                            <div class="media-body align-self-center">
                                                <small style="font-weight: 700; color: black; margin-bottom: 0rem;">{{ $data2->username }}</small><br>
                                                <small class="mt-0" style="margin-bottom: 0rem; font-weight: 500; color: #989e99;">{{ $data2->nama }}</small>
                                            </div>
                                        </div>
                                        <div class="input-group-append" style="position: absolute;right: 0;top: 35%;">
                                            <input type="checkbox" name="pilih_teman[]" value="{{$data2->id_pengguna}}" aria-label="Checkbox for following text input">
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach 
                        @else
                            <li>
                                <div align="center">Tidak ada teman</div>
                            </li>
                        @endif
                    </ul>
                    <input type="hidden" name="id_konten" id="hidden_id_share" value=""></input>
                    <div class="modal-footer" style="padding: 8px;">
                        <input class="btn btn-sm btn-submit" type="submit" style="background-color: #358f66; color: white;" value="Submit"></input> 
                    </div>
                </form>
            </div>
        </div>
    </div>	

    <div class="modal fade" id="modalReport" role="dialog">
        <div class="modal-dialog modal-sm" style="max-width: 600px;">
            <form method="post" action="/sosial-media/report_proses" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Report <span class="kategori_report"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="text-align: left;">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Alasan Pelaporan <span class="kategori_report"></span></label>
                            <select class="form-control" id="alasan_report" name="alasan_report">
                                <option selected disabled>Pilih Alasan</option>
                                <option value="Spam">Spam</option>
                                <option value="Ujaran / Simbol Kebencian">Ujaran / Simbol Kebencian</option>
                                <option value="Ketelanjangan / Aktivitas Seksual">Ketelanjangan / Aktivitas Seksual</option>
                                <option value="Kekerasan / Organisasi Berbahaya">Kekerasan / Organisasi Berbahaya</option>
                                <option value="Penipuan">Penipuan</option>
                                <option value="Informasi Palsu">Informasi Palsu</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="kategori" name="kategori_report" value=""/>
                        <input type="hidden" name="acct_reporter" value="{{ Auth::user()->pengguna->id_pengguna }}"/>
                        <input type="hidden" id="reported" name="id_reported" value=""/>
                        <input class="btn btn-sm btn-submit" type="submit" style="background-color: red; color: white;" value="Report"></input>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif

<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/main.min.js') }}"></script>
<script src="{{ asset('Winku-Social-Network-Corporate-Responsive-Template/js/script.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/slideshow.js') }}"></script>
<script src="{{ asset('js/read-less-more.js') }}"></script>
<script type="text/javascript" src="{{ asset('slick-1.8.1/slick/slick.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-iHgzDAzd_uS3biSkqVRw_sxAoqS1o04&libraries=places&callback=initMap" async defer></script>
<script src="{{ asset('js/konten-group-detail.js') }}"></script>
<script type="text/javascript">

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

      $( "#search" ).autocomplete({
      	appendTo: "#container_search",
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"{{route('sosial-media.cari_pengguna')}}",
            type: 'post',
            dataType: "json",
            data: {
               _token: CSRF_TOKEN,
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           let username = ui.item.value;
           window.location.href = window.location.origin+"/sosial-media/profil/"+username;
           return false;
        }
      })
      .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
	      return $( "<li>" )
	        .append( "<div class='media'><img src='"+item.icon+"' class='align-self-center mr-3' alt='...' style='width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;'> <div class='media-body align-self-center'> <small style='font-weight: 700; color: black; margin-bottom: 0rem;'>"+item.value+"</small><br><small class='mt-0' style='margin-bottom: 0rem; font-weight: 500; color: #989e99;'>"+item.label+"</small>")
	        .appendTo( ul );
	  };

    });

    // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    // $('#notif').click(function () {
    //     $.ajax({
    //         url: "{{route('sosial-media.update_notif')}}",
    //         type: 'post',
    //         // dataType: "json",
    //         data: {
    //             _token: CSRF_TOKEN
    //         },
    //         success: function (data) {
    //             if (document.getElementById("jml_notif")) {
    //                 document.getElementById("jml_notif").style.visibility = "hidden";
    //             }
    //         }
    //     });
    // });
    
</script>
</body>	

</html>