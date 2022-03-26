<div>
    @if (isset($konten))
        <?php $j=1; $k=0; ?>
        @foreach ($konten as $data)
        <div class="central-meta item" style="padding-bottom: 0!important;">
            <div class="user-post">
                <div class="friend-info">
                    <figure>
                        <img src="{{ url('/data_file/foto_profil/'.$data->foto_profil) }}" alt="" style="width: 45px; height: 45px;">
                    </figure>
                    <div class="friend-name">
                        <ins>
                            <a href="/sosial-media/profil/{{$data->username}}" title="">
                                {{ $data->username }}
                            </a>
                        </ins>
                        <span style="color: black;"><a href="/sosial-media/explore/{{$data->tempat}}">{{ $data->tempat }}</a></span>
                        <div class="d-flex justify-content-end">
                        @if(($data->username) != Session::get('username'))
                            <!-- <a href="#" data-toggle="modal" data-target="#myModalMore{{ $data->id_konten }}"><i class="fa fa-ellipsis-h"></i></a> -->
                            <a onclick="modalMore('{{ $data->id_konten }}', '{{ $data->username }}', '{{ $data->slug }}')" style="cursor: pointer;"><i class="fa fa-ellipsis-h"></i></a>
                        @else
                            <!-- <a href="#" data-toggle="modal" data-target="#myModalMore2{{ $data->id_konten }}"><i class="fa fa-ellipsis-h"></i></a> -->
                            <a onclick="modalMore2('{{ $data->id_konten }}', '{{ $data->foto_profil }}', '{{ $data->username }}', '{{ $data->tempat }}', '{{ $data->foto_video_konten }}', '{{ $data->caption }}', '{{ $data->slug }}')" style="cursor: pointer;"><i class="fa fa-ellipsis-h"></i></a>
                        @endif
                        </div>
                    </div>
                    <!-- <div class="modal fade" id="myModalMore{{ $data->id_konten }}" role="dialog">
                        <div class="modal-dialog modal-sm" style="max-width: 400px;">
                            <div class="modal-content">
                                <div class="modal-content" style="text-align: center;">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><a href="/sosial-media/hapus_following/{{$data->username}}" style="font-weight: 600; color: red;"> Batal Mengikuti </a></li>
                                        <li class="list-group-item"><a onclick="salin('{{ $data->id_konten }}')" value="{{ url('/sosial-media/'.$data->slug) }}" id="salin/{{ $data->id_konten }}" style="cursor: pointer;"> Salin Link </a></li>
                                        <li class="list-group-item"><a data-toggle="modal" data-target="#modalShare{{ $data->id_konten }}" data-id="{{$data->id_konten}}" class="bagikan" style="cursor: pointer;"> Bagikan </a></li>
                                        <li class="list-group-item"><a href="" data-dismiss="modal"> Batalkan </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="modal fade" id="myModalMore2{{ $data->id_konten }}" role="dialog">
                        <div class="modal-dialog modal-sm" style="max-width: 400px;">
                            <div class="modal-content">
                                <div class="modal-content" style="text-align: center;">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><a onclick="if(!confirm('Anda yakin ingin menghapus konten ini?')) return false;" href="/sosial-media/hapus_konten/{{ $data->id_konten }}" style="font-weight: 600; color: red;"> Hapus </a></li>
                                        <li class="list-group-item"><a href="#" data-toggle="modal" data-target="#myModalEdit{{ $data->id_konten }}" style="font-weight: 600; color: blue;"> Edit </a></li>
                                        <li class="list-group-item"><a style="cursor: pointer;" onclick="salin('{{ $data->id_konten }}')" value="{{ url('/sosial-media/'.$data->slug) }}" id="salin/{{ $data->id_konten }}"> Salin Link </a></li>
                                        <li class="list-group-item"><a data-toggle="modal" data-target="#modalShare{{ $data->id_konten }}" data-id="{{$data->id_konten}}" style="cursor: pointer;" class="bagikan"> Bagikan </a></li>
                                        <li class="list-group-item"><a href="" data-dismiss="modal"> Batalkan </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="modal fade" id="modalShare{{ $data->id_konten }}" data-id="{{$data->id_konten}}" role="dialog">
                        <div class="modal-dialog modal-sm" style="max-width: 400px;">
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-center" style="padding: 0.5rem;">
                                    <h6 class="modal-title">Bagikan</h6>
                                </div>
                                <div class="input-group flex-nowrap" id="cari_teman{{ $data->id_konten }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="addon-wrapping" style="border-radius: 0rem;">
                                            Ke: 
                                        </span>
                                    </div>
                                    <div id="kolom_input_cari{{$data->id_konten}}" class="kolom_cari" style="width: 100%;"></div>
                                </div>
                                <form method="post" action="" enctype="multipart/form-data">
                                {{csrf_field()}}
                                    <ul class="friendz-list list-group list-group-flush" style="margin-top: 0px; overflow-y: auto!important; max-height: 250px;" id="teman_yang_dicari{{ $data->id_konten }}">
                                        @if ($teman != NULL)
                                            @foreach ($teman as $data2)
                                            <div class="list-group list-group-flush" style="max-height: 315px;">
                                                <a class="list-group-item list-group-item-action" style="padding-right: 10px; padding-left: 10px;">
                                                    <div class="input-group mb-3" style="margin-bottom: 0px;">
                                                        <div class="media">
                                                            <img src="{{ (url('/data_file/foto_profil/'.$data2->foto_profil) != null) ? (url('/data_file/foto_profil/'.$data2->foto_profil)) : url('/data_file/foto_profil/'.user.jpg) }}" class="align-self-center mr-3" alt="..." style="width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;">
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
                                    <input type="hidden" name="id_konten" value="{{$data->id_konten}}"></input>
                                    <div class="modal-footer" style="padding: 8px;">
                                        <input class="btn btn-sm btn-submit" type="submit" style="background-color: #358f66; color: white;" value="Submit"></input> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="modal fade" id="myModalEdit{{ $data->id_konten }}" role="dialog">
                        <div class="modal-dialog" style="max-width: 600px;">
                            <form method="post" action="/sosial-media/edit_konten_proses" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Konten</h5>
                                        <button type="button" class="close" data-dismiss="modal2" aria-label="Close" value="{{$data->id_konten}}">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="text-align: center;">
                                        <div class="friend-info" style="text-align: left; margin-bottom: 15px;">
                                            <figure style="width: 10%;">
                                                <img src="{{ url('/data_file/foto_profil/'.$data->foto_profil) }}" alt="" style="width: 45px; height: 45px; border-radius: 50%;">
                                            </figure>
                                            <div class="friend-name" style="width:85%; padding-left: 0px;">
                                                <ins>
                                                    <a href="/sosial-media/profil/{{$data->username}}" title="">
                                                        {{ $data->username }}
                                                    </a>
                                                </ins>
                                                <span style="color: black;">{{$data->tempat}}</span>
                                            </div>
                                        </div>
                                        <div class="wrap-modal-slider">
                                        <div class="single-item2">
                                            <?php $media = explode(", ", $data->foto_video_konten); ?>
                                            @foreach ($media as $media_konten)
                                            @if (strpos($media_konten, '.mp4'))
                                                <video width="200" height="400" autoplay loop muted>
                                                    <source src="{{ url('/data_file/'.$media_konten) }}" type="video/mp4">
                                                    <source src="{{ url('/data_file/'.$media_konten) }}" type="video/ogg">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                <img src="{{ url('/data_file/'.$media_konten) }}" alt="" style="height: 200px; width: 400px;">
                                            @endif
                                            @endforeach
                                        </div>
                                        </div>
                                            <input type="hidden" name="id_konten" value="{{$data->id_konten}}"></input>
                                            <textarea rows="3" name="caption" style="border: 1px solid #eeeeee; border-radius: 0;">{{ $data->caption }}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <input class="btn btn-sm btn-submit" type="submit" style="background-color: #358f66; color: white;" value="Update"></input>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> -->
                    <div class="post-meta">
                        <!-- <div class="single-item">
                        <?php $media = explode(", ", $data->foto_video_konten); ?>
                        @foreach ($media as $media_konten)
                            @if (strpos($media_konten, '.mp4'))
                                <video width="100%" height="100%" autoplay loop muted>
                                    <source src="{{ url('/data_file/'.$media_konten) }}" type="video/mp4">
                                    <source src="{{ url('/data_file/'.$media_konten) }}" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <img src="{{ url('/data_file/'.$media_konten) }}" alt="">
                            @endif
                        @endforeach
                        </div> -->
                        <div class="slideshow-container">
                            <?php $media = explode(", ", $data->foto_video_konten); $i=1;?>
                            @foreach ($media as $media_konten)
                                <div class="mySlides{{$j}}">
                                    @if (strpos($media_konten, '.mp4'))
                                        <video width="100%" height="100%" autoplay loop muted>
                                            <source src="{{ url('/data_file/'.$media_konten) }}" type="video/mp4">
                                            <source src="{{ url('/data_file/'.$media_konten) }}" type="video/ogg">
                                            Your browser does not support the video tag.
                                        </video>
                                    @else
                                        <img src="{{ url('/data_file/'.$media_konten) }}" style="width:100%;">
                                    @endif
                                </div>
                            @endforeach
                            <?php $j++; ?>
                            <a class="prev" onclick="plusSlides(-1, {{$k}})">&#10094;</a>
                            <a class="next" onclick="plusSlides(1, {{$k}})">&#10095;</a>
                            <?php $k++; ?>
                        </div>
                        <div class="we-video-info" style="padding-top: 0; padding-bottom: 0; margin-top: 10px;">
                            <ul style="max-height: 30px;">
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

                                                $url = url("/sosial-media/p/".$data->slug);
                                                $media = explode(", ", $data->foto_video_konten); $i=1;
                                                foreach ($media as $media_konten){
                                                    $img = urlencode(url('/data_file/'.$media_konten));
                                                    if($loop->iteration == 1){
                                                        break;
                                                    }
                                                }
                                                $title = $data->username;
                                                $summary = $data->caption;

                                                // $url=urlencode("http://www.fbchandra.com/developers/share-page-on-facebook");

                                                // $img=urlencode("http://www.fbchandra.com/media/developers/share-page.jpg");

                                                // $title=urlencode("Share your link on facebook");

                                                // $summary="Share your link on facebook using sharer.php. You can choose your custom title, image and summary to share content on facebook timeline.";

                                            ?>
                                            <div class="rotater">
                                                <div class="btn btn-icon"><a href="https://www.facebook.com/sharer/sharer.php?u={{$url}}&display=popup" target="_blank" title=""><i class="fa fa-facebook"></i></a></div>
                                            </div>
                                            <!-- <div class="rotater">
                                                <div class="btn btn-icon"><a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo $url ?>&p[images][0]=<?php echo $img ?>&p[title]=<?php echo $title ?>&p[summary]=<?php echo $summary ?>" target="_blank" title=""><i class="fa fa-facebook"></i></a></div>
                                            </div> -->
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
                        </div>
                        @if($likes)
                            @foreach ($likes as $like)
                                @if($like->id_konten == $data->id_konten)
                                    <p style="margin-bottom: 0px;">Disukai oleh <a href="/sosial-media/profil/{{$like->username}}"><b>{{$like->username}}</b></a> dan<span style="cursor: pointer;" data-toggle="modal" data-target="#modalLike{{$data->id_konten}}"> <b>lainnya</b></span></p>
                                @endif
                            @endforeach
                        @endif
                        <div class="description" style="margin-top: 0;">
                            <p style="margin-bottom: 0px;"> 
                                <strong>{{ $data->username }}</strong> {{ $data->caption }} 
                            </p>
                            <span style="color: #999; float: left;font-size: 12px;text-transform: capitalize;width: 100%;">
                                <?php echo date_format(date_create($data->created_at), "d M Y H:i A"); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modalLike{{$data->id_konten}}" role="dialog">
                    <div class="modal-dialog modal-sm" style="max-width: 400px;">
                        <div class="modal-content">
                            <div class="modal-header d-flex justify-content-center" style="padding: 0.5rem;">
                                <h6 class="modal-title">Menyukai</h6>
                            </div>
                            <ul class="friendz-list list-group list-group-flush" style="overflow-y: auto!important; max-height: 250px;">
                                @if ($likes_all != NULL)
                                    @foreach ($likes_all as $data2)
                                        @if($data2->id_konten == $data->id_konten)
                                            <div class="list-group list-group-flush" style="max-height: 315px;">
                                                <a class="list-group-item list-group-item-action" data-dismiss="modal" style="padding-left: 10px; padding-right: 10px;">
                                                    <div class="media">
                                                        <img src="{{ url('/data_file/foto_profil/'.$data2->foto_profil) }}" class="align-self-center mr-3" alt="..." style="width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;">
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
                    <ul class="we-comet" style="overflow-y: auto; max-height: 200px;">
                        @foreach ($komentar as $dataa)
                            @if(isset($dataa->isi_komentar))
                                @if(($data->id_konten == $dataa->id_konten) && $dataa->id_balas_komen == 0)
                                    <li>
                                        <div class="comet-avatar">
                                            <img src="{{ url('/data_file/foto_profil/'.$dataa->foto_profil) }}" alt="" style="height: 45px; width: 45px;">
                                        </div>
                                        <div class="we-comment">
                                            <div class="coment-head">
                                                <h5 style="text-transform: none;"><a href="/sosial-media/profil/{{$dataa->username}}" title="">{{ $dataa->username }}</a></h5>
                                                <span>{{ date_format(date_create($dataa->tanggal_komen), "d M Y H:i A") }}</span>
                                                <button class="we-reply btn btn-link" style="font-size: 12px; font-weight: 500; float: right;position: relative;top: 0;" id="balas22" onclick="balas_komen('{{ '@'.$dataa->username }}', '{{$dataa->id}}', '{{$dataa->username}}', '{{$data->id_konten}}')" value="{{$dataa->id}}">Balas</button>
                                            </div>
                                            <p style="margin-top: 0px;">{{ $dataa->isi_komentar }}</p>
                                        </div>
                                        @foreach ($balas_komentar as $balas_komen)
                                        @if($balas_komen->id_balas_komen != 0)
                                        @if($dataa->id == $balas_komen->id_balas_komen)
                                        <ul>
                                            <li>
                                                <div class="comet-avatar">
                                                    <img src="{{ url('/data_file/foto_profil/'.$balas_komen->foto_profil) }}" alt="" style="height: 35px; width: 35px;">
                                                </div>
                                                <div class="we-comment">
                                                    <div class="coment-head">
                                                        <h5 style="text-transform: none;"><a href="/sosial-media/profil/{{$balas_komen->username}}" title="">{{ $balas_komen->username }}</a></h5>
                                                        <span>{{ date_format(date_create($balas_komen->tanggal_komen), "d M Y H:i A") }}</span>
                                                        <button class="we-reply btn btn-link" style="font-size: 12px; font-weight: 500; float: right;position: relative;top: 0;" id="balas2" onclick="balas_komen('{{ '@'.$balas_komen->username }}', '{{$dataa->id}}', '{{$balas_komen->username}}','{{$data->id_konten}}')" value="{{$balas_komen->id}}">Balas</button>
                                                    </div>
                                                    <p style="margin-top: 0px;"><?php echo  html_entity_decode($balas_komen->isi_komentar) ?></p>
                                                </div>
                                            </li>
                                        </ul>
                                        @endif
                                        @endif
                                        @endforeach
                                    </li>
                                @endif
                            @endif
                        @endforeach
                    </ul>
                    <ul class="we-comet">
                        <li class="post-comment">
                            <div class="comet-avatar">
                                <img src="<?php echo (Session::get('foto_profil') != null) ? (Session::get('foto_profil')) : asset('user.jpg') ;?>" alt="" style="width: 35px; height: 35px;">
                            </div>
                            <div class="post-comt-box2">
                                <form method="post" action="/sosial-media/post_komen" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <input type="hidden" name="id_konten" value="{{$data->id_konten}}"></input>
                                    <span class="thumb-xs{{$data->id_konten}}">
                                        <textarea placeholder="Post your comment" name="isi_komentar" style="width: 90%;"></textarea>
                                    </span>
                                    <button type="submit" class="btn btn-submit" style="border-radius: 3px;">Post</button>
                                </form>	
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>

<div class="modal fade" id="myModalMore" role="dialog">
    <div class="modal-dialog modal-sm" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal-content" style="text-align: center;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a onclick="if(!confirm('Anda yakin ingin berhenti mengikuti?')) return false;" id="batalMengikuti" href="" style="font-weight: 600; color: red;"> Batal Mengikuti </a></li>
                    <li class="list-group-item"><a id="salinLink" onclick="" value="" style="cursor: pointer;"> Salin Link </a></li>
                    <li class="list-group-item"><a id="sharePost" onclick="" data-id="" class="bagikan" style="cursor: pointer;"> Bagikan </a></li>
                    <li class="list-group-item"><a data-dismiss="modal"> Batalkan </a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalMore2" role="dialog">
    <div class="modal-dialog modal-sm" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal-content" style="text-align: center;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a onclick="if(!confirm('Anda yakin ingin menghapus konten ini?')) return false;" id="hapusKonten" href="" style="font-weight: 600; color: red;"> Hapus </a></li>
                    <li class="list-group-item"><a onclick="" id="editKonten" style="cursor: pointer; font-weight: 600; color: blue;"> Edit </a></li>
                    <li class="list-group-item"><a id="salinLink2" style="cursor: pointer;" onclick="" value=""> Salin Link </a></li>
                    <li class="list-group-item"><a onclick="" data-id="" id="shareKonten" style="cursor: pointer;" class="bagikan"> Bagikan </a></li>
                    <li class="list-group-item"><a data-dismiss="modal"> Batalkan </a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalEdit" role="dialog">
    <div class="modal-dialog" style="max-width: 600px;">
        <form method="post" action="/sosial-media/edit_konten_proses" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Konten</h5>
                    <button type="button" class="close" data-dismiss="modal2" aria-label="Close" id="closebtn" value="">
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
                        <div class="single-item2" id="media_post"></div>
                    </div>
                    <input type="hidden" name="id_konten" id="hidden_id" value=""></input>
                    <textarea rows="3" name="caption" id="capt" style="border: 1px solid #eeeeee; border-radius: 0;"></textarea>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-sm btn-submit" type="submit" style="background-color: #358f66; color: white;" value="Update"></input>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalShare" role="dialog">
    <div class="modal-dialog modal-sm" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center" style="padding: 0.5rem;">
                <h6 class="modal-title">Bagikan</h6>
            </div>
            <div class="input-group flex-nowrap searchKey" id="">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping" style="border-radius: 0rem;">
                        Ke: 
                    </span>
                </div>
                <div id="" class="kolom_cari" style="width: 100%;"></div>
            </div>
            <form method="post" action="/sosial-media/share_post" enctype="multipart/form-data">
            {{csrf_field()}}
                <ul class="friendz-list list-group list-group-flush findFr" style="margin-top: 0px; overflow-y: auto!important; max-height: 250px;" id="">
                    @if ($teman != NULL) 
                        @foreach ($teman as $data2)
                        <div class="list-group list-group-flush" style="max-height: 315px;">
                            <a class="list-group-item list-group-item-action" style="padding-right: 10px; padding-left: 10px;">
                                <div class="input-group mb-3" style="margin-bottom: 0px;">
                                    <div class="media">
                                        <img src="{{ url('/data_file/foto_profil/'.$data2->foto_profil) }}" class="align-self-center mr-3" alt="..." style="width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;">
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