<div>
    @if (isset($konten_desa))
        <?php $j=1; $k=0; ?>
        <div class="loadMore"> <!-- loadMore ada di script.js nya winku. -->
        @foreach ($konten_desa as $data_desa)
        <div class="central-meta item" id="post_{{ $data_desa->id_konten }}">
            <div class="user-post">
                <div class="friend-info">
                    <figure>
                        <img src="{{ $data_desa->foto_profil != null ? url('/data_file/'.$data_desa->username.'/foto_profil/'.$data_desa->foto_profil) : asset('user.jpg') }}" alt="" style="width: 45px; height: 45px;">
                    </figure>
                    <div class="friend-name">
                        <ins>
                            <a href="/sosial-media/profil/{{$data_desa->username}}" title="">
                                {{ $data_desa->username }}
                            </a>
                        </ins>
                        <span style="color: black;"><a href="/sosial-media/explore/{{$data_desa->tempat}}">{{ $data_desa->tempat }}</a></span>
                        <div class="d-flex justify-content-end">
                        <?php $tgl = date_format(date_create($data_desa->created_at), "d-m-Y"); ?>
                        @if(($data_desa->username) != auth()->user()->pengguna->username)
                            <a onclick="modalMore('{{ $data_desa->id_konten }}', '{{ $data_desa->username }}', '{{ $data_desa->slug }}', '{{ $data_desa->foto_profil }}')" style="cursor: pointer;"><i class="fa fa-ellipsis-v"></i></a>
                        @else
                            <a onclick="modalMore2('{{ $data_desa->id_konten }}', '{{ $data_desa->foto_profil }}', '{{ $data_desa->username }}', '{{ $data_desa->tempat }}', '{{ $data_desa->foto_video_konten }}', '{{ str_replace('"', "&quot;", str_replace("'", "\'", $data_desa->caption)) }}', '{{ $tgl }}', '{{ $data_desa->slug }}')" style="cursor: pointer;"><i class="fa fa-ellipsis-v"></i></a>
                        @endif
                        </div>
                    </div>
                    <div class="post-meta">
                        <div class="slideshow-container all d-flex justify-content-center">
                            <?php $media_desa = explode(", ", $data_desa->foto_video_konten); $i=1;?>
                            <?php $tgl = date_format(date_create($data_desa->created_at),"d-m-Y"); ?>
                            @foreach ($media_desa as $media_konten_ds)
                                <div class="mySlides{{$j}}">
                                    @if (strpos($media_konten_ds, '.mp4'))
                                        <video width="100%" height="100%" autoplay loop muted>
                                            <source src="{{ url('/data_file/'.$data_desa->username.'/foto_konten/'.$tgl.'/'.$data_desa->slug.'/'.$media_konten_ds) }}" type="video/mp4">
                                            <source src="{{ url('/data_file/'.$data_desa->username.'/foto_konten/'.$tgl.'/'.$data_desa->slug.'/'.$media_konten_ds) }}" type="video/ogg">
                                            Your browser does not support the video tag.
                                        </video>
                                    @else
                                        <img src="{{ url('/data_file/'.$data_desa->username.'/foto_konten/'.$tgl.'/'.$data_desa->slug.'/'.$media_konten_ds) }}" style="width:100%;">
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
                                <li data-id="{{$data_desa->id_konten}}" data-is-like="{{$data_desa->is_like ? 1 : 0}}" class="action-like-or-dislike" style="margin-right: 5px;height: 23px;">
                                    <span class="like" data-toggle="tooltip" title="{{$data_desa->is_like ? 'Batal Menyukai' : 'Menyukai'}}">
                                        <div class="menu" style="width: 23px; height: 23px;">
                                            <div class="btn trigger" style="background: none;">
                                                <i id="icon_like{{$data_desa->id_konten}}" class="{{$data_desa->is_like ? 'fa fa-heart' : 'fa fa-heart-o'}}" style="font-size: 20px;color: black;"></i>
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

                                                $url = url("/sosial-media/p/".$data_desa->slug);
                                                $media_desa = explode(", ", $data_desa->foto_video_konten); $i=1;
                                                foreach ($media_desa as $media_konten_ds){
                                                    $img = urlencode(url('/data_file/'.$media_konten_ds));
                                                    if($loop->iteration == 1){
                                                        break;
                                                    }
                                                }
                                                $title = $data_desa->username;
                                                $summary = $data_desa->caption;

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
                        @if($likes_desa)
                            @foreach ($likes_desa as $like_desa)
                                @if($like_desa->id_konten == $data_desa->id_konten)
                                    <p style="margin-bottom: 0px;">Disukai oleh <a href="/sosial-media/profil/{{$like_desa->username}}"><b>{{$like_desa->username}}</b></a>
                                    dan<span style="cursor: pointer;" data-toggle="modal" data-target="#modalLike{{$data_desa->id_konten}}"> <b>lainnya</b></span></p>
                                    @if(COUNT((array)$like_desa->username) == 1)
                                    @break
                                    @endif
                                @endif
                            @endforeach
                        @endif
                        <div class="description" style="margin-top: 0;">
                            <p style="margin-bottom: 0px;"> 
                                <strong>{{ $data_desa->username }}</strong> <span class="addReadMore showlesscontent"> {{ $data_desa->caption }} </span>
                            </p>
                            <span style="color: #999; float: left;font-size: 12px;text-transform: capitalize;width: 100%;">
                                <?php echo date_format(date_create($data_desa->created_at), "d M Y H:i A"); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modalLike{{$data_desa->id_konten}}" role="dialog">
                    <div class="modal-dialog modal-sm modal-dialog-centered" style="max-width: 400px;">
                        <div class="modal-content">
                            <div class="modal-header d-flex justify-content-center" style="padding: 0.5rem;">
                                <h6 class="modal-title">Menyukai</h6>
                            </div>
                            <ul class="friendz-list list-group list-group-flush" style="overflow-y: auto!important; max-height: 250px;">
                                @if ($likes_all_desa != NULL)
                                    @foreach ($likes_all_desa as $data2_desa)
                                        @if($data2_desa->id_konten == $data_desa->id_konten)
                                            <div class="list-group list-group-flush" style="max-height: 315px;">
                                                <a href="#" class="list-group-item list-group-item-action" data-dismiss="modal" style="padding-left: 10px; padding-right: 10px;">
                                                    <div class="media">
                                                        <img src="{{ url('/data_file/'.$data2_desa->username.'/foto_profil/'.$data2_desa->foto_profil) }}" class="align-self-center mr-3" alt="..." style="width: 40px; height: 40px; border-radius: 50%; margin-left: 5px;">
                                                        <div class="media-body align-self-center">
                                                            <small style="font-weight: 700; color: black; margin-bottom: 0rem;">{{ $data2_desa->username}}</small><br>
                                                            <small class="mt-0" style="margin-bottom: 0rem; font-weight: 500; color: #989e99;">{{ $data2_desa->nama }}</small>
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
                    <ul class="we-comet list-cmt{{$data_desa->id_konten}}" style="overflow-y: auto; max-height: 200px;">
                        @foreach ($komentar_desa as $dataa)
                            @if(isset($dataa->isi_komentar))
                                @if(($data_desa->id_konten == $dataa->id_konten) && $dataa->id_balas_komen == 0)
                                    <li id="comment_{{$dataa->id_cmt}}" class="list-rep_cmt_{{$dataa->id_cmt}}">
                                        <div class="comet-avatar">
                                            <img src="{{ $dataa->foto_profil != null ? url('/data_file/'.$dataa->username.'/foto_profil/'.$dataa->foto_profil) : asset('user.jpg') }}" alt="" style="height: 45px; width: 45px;">
                                        </div>
                                        <div class="we-comment">
                                            <div class="coment-head">
                                                <h5 style="text-transform: none;"><a href="/sosial-media/profil/{{$dataa->username}}" title="">{{ $dataa->username }}</a></h5>
                                                <span>{{ date_format(date_create($dataa->tanggal_komen), "d M Y H:i A") }}</span>
                                                {{-- <a onclick="moreOnComment('{{ $dataa->id }}', '{{Auth::user()->pengguna->username}}', '{{$dataa->username}}', '{{$data_desa->username}}')" style="cursor: pointer"><i class="fa fa-ellipsis-h"></i></a> --}}
                                                @if((Auth::user()->pengguna->username == $dataa->username) OR (Auth::user()->pengguna->username == $data_desa->username))
                                                <a onclick="modalHapusKomentar('{{$dataa->id_cmt}}')" style="cursor: pointer" title="Hapus Komentar"><i class="ti-trash hide" style="color: red;"></i></a>
                                                @endif
                                                @if(Auth::user()->pengguna->username != $dataa->username)
                                                <a onclick="modalReportKomentar('{{$dataa->id_cmt}}')" style="cursor: pointer" title="Report Komentar"><i class="ti-info-alt hide" style="color: red;"></i></a>
                                                @endif
                                                <button class="we-reply btn btn-link" style="font-size: 12px; font-weight: 500; float: right; position: relative; top: 0;" onclick="balas_komen('{{ '@'.$dataa->username }}', '{{$dataa->id_cmt}}', '{{$dataa->username}}', '{{$data_desa->id_konten}}')" value="{{$dataa->id_cmt}}">Balas</button>
                                            </div>
                                            <p style="margin-top: 0px;">{{ $dataa->isi_komentar }}</p>
                                        </div>
                                        <?php $id_cmt_parent = $dataa->id_cmt; ?>
                                        @foreach ($balas_komentar_desa as $balas_komen)
                                        @if($balas_komen->id_balas_komen != 0)
                                        @if($dataa->id_cmt == $balas_komen->id_balas_komen)
                                        <ul id="comment_{{$balas_komen->id_cmt}}">
                                            <li>
                                                <div class="comet-avatar">
                                                    <img src="{{ $balas_komen->foto_profil != null ? url('/data_file/'.$balas_komen->username.'/foto_profil/'.$balas_komen->foto_profil) : asset('user.jpg') }}" alt="" style="height: 35px; width: 35px;">
                                                </div>
                                                <div class="we-comment">
                                                    <div class="coment-head">
                                                        <h5 style="text-transform: none;"><a href="/sosial-media/profil/{{$balas_komen->username}}" title="">{{ $balas_komen->username }}</a></h5>
                                                        <span>{{ date_format(date_create($balas_komen->tanggal_komen), "d M Y H:i A") }}</span>
                                                        {{-- <a onclick="moreOnComment('{{ $balas_komen->id }}', '{{Auth::user()->pengguna->username}}', '{{$balas_komen->username}}', '{{$data_desa->username}}')" style="cursor: pointer"><i class="fa fa-ellipsis-h"></i></a> --}}
                                                        @if((Auth::user()->pengguna->username == $balas_komen->username) OR (Auth::user()->pengguna->username == $data_desa->username))
                                                        <a onclick="modalHapusKomentar('{{$balas_komen->id_cmt}}')" style="cursor: pointer" title="Hapus Komentar"><i class="ti-trash hide" style="color: red;"></i></a>
                                                        @endif
                                                        @if(Auth::user()->pengguna->username != $balas_komen->username)
                                                        <a onclick="modalReportKomentar('{{$balas_komen->id_cmt}}')" style="cursor: pointer" title="Report Komentar"><i class="ti-info-alt hide" style="color: red;"></i></a>
                                                        @endif
                                                        {{-- @endif --}}
                                                        <button class="we-reply btn btn-link" style="font-size: 12px; font-weight: 500; float: right;position: relative;top: 0;" onclick="balas_komen('{{ '@'.$balas_komen->username }}', '{{$id_cmt_parent}}', '{{$balas_komen->username}}','{{$data_desa->id_konten}}')" value="{{$balas_komen->id_cmt}}">Balas</button>
                                                    </div>
                                                    <p style="margin-top: 0px;"><?php echo  html_entity_decode($balas_komen->isi_komentar) ?></p>
                                                </div>
                                            </li>
                                        </ul>
                                        @endif
                                        @endif
                                        @endforeach
                                    </li>
                                    
                                    <!-- <li>
                                        <a href="#" title="" class="showmore underline">more comments</a>
                                    </li> -->
                                @endif
                            @endif
                        @endforeach
                    </ul>
                    <ul class="we-comet">
                        <li class="post-comment">
                            <div class="comet-avatar">
                                <img src="{{ auth()->user()->pengguna->foto_profil != null ? url('/data_file/'.auth()->user()->pengguna->username.'/foto_profil/'.auth()->user()->pengguna->foto_profil) : asset('user.jpg') }}" alt="" value="{{ auth()->user()->pengguna->foto_profil != null ? url('/data_file/'.auth()->user()->pengguna->username.'/foto_profil/'.auth()->user()->pengguna->foto_profil) : asset('user.jpg') }}" class="img-auth" style="width: 35px; height: 35px;">
                            </div>
                            <div class="post-comt-box2"> <!-- post-comt-box -->
                                <form method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <input type="hidden" name="id_konten" class="konten_{{$data_desa->id_konten}}" value="{{$data_desa->id_konten}}">
                                    <span class="thumb-xs{{$data_desa->id_konten}}">
                                        <textarea placeholder="Post your comment" name="isi_komentar" style="width: 100%;" class="txt_comment_{{$data_desa->id_konten}}" onkeyup="showBtn(this, '{{$data_desa->id_konten}}');"></textarea>
                                    </span>
                                    {{-- <button type="submit" class="btn btn-submit" style="border-radius: 3px;">Post</button> --}}
                                    <button type="button" onclick="uploadKomen('{{$data_desa->id_konten}}')" class="btn btn-submit btn-{{$data_desa->id_konten}}" style="border-radius: 3px; display: none;">Post</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
        </div>
    @endif
</div>

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
                        <textarea rows="3" name="caption" id="capt"  onkeyup="countCharsEdit(this);" maxlenght="500" style="border: 1px solid #eeeeee; border-radius: 0; border-bottom:0;"></textarea>
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
                                <div class="input-group mb-3" style="margin-bottom: 0px;">
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