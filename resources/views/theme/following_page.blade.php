<div>
    @if (isset($konten))
        <?php $j=1; $k=0; ?>
        <div class="loadMore"> <!-- loadMore ada di script.js nya winku. -->
        @foreach ($konten as $data)
        <div class="central-meta item">
            <div class="user-post">
                <div class="friend-info">
                    <figure>
                        <img src="{{ $data->foto_profil != null ? url('/data_file/'.$data->username.'/foto_profil/'.$data->foto_profil) : asset('user.jpg') }}" alt="" style="width: 45px; height: 45px;">
                    </figure>
                    <div class="friend-name">
                        <ins>
                            <a href="/sosial-media/profil/{{$data->username}}" title="">
                                {{ $data->username }}
                            </a>
                        </ins>
                        <span style="color: black;"><a href="/sosial-media/explore/{{$data->tempat}}">{{ $data->tempat }}</a></span>
                        <div class="d-flex justify-content-end">
                        <!-- @if(($data->username) != Session::get('username')) -->
                            <a onclick="modalMoreFlw('{{ $data->id_konten }}', '{{ $data->username }}', '{{ $data->slug }}', '{{ $data->foto_profil }}')" style="cursor: pointer;"><i class="fa fa-ellipsis-v"></i></a>
                        <!-- @else
                            <a onclick="modalMore2Flw('{{ $data->id_konten }}', '{{ $data->foto_profil }}', '{{ $data->username }}', '{{ $data->tempat }}', '{{ $data->foto_video_konten }}', '{{ $data->caption }}', '{{ $data->slug }}')" style="cursor: pointer;"><i class="fa fa-ellipsis-h"></i></a>
                        @endif -->
                        </div>
                    </div>
                    <div class="post-meta">
                        <div class="slideshow-container allFlw d-flex justify-content-center">
                        <?php $media = explode(", ", $data->foto_video_konten); ?>
                        <?php $tgl = date_format(date_create($data->created_at),"d-m-Y"); ?>
                        @foreach ($media as $media_konten)
                            <div class="mySlidesFlw{{$j}}">
                            @if (strpos($media_konten, '.mp4'))
                                <video width="100%" height="100%" autoplay loop muted>
                                    <source src="{{ url('/data_file/'.$data->username.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media_konten) }}" type="video/mp4">
                                    <source src="{{ url('/data_file/'.$data->username.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media_konten) }}" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <img src="{{ url('/data_file/'.$data->username.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media_konten) }}" alt="">
                            @endif
                            </div>
                        @endforeach
                        <?php $j++; ?>
                        <a class="prev" onclick="plusSlidesFlw(-1, {{$k}})">&#10094;</a>
                        <a class="next" onclick="plusSlidesFlw(1, {{$k}})">&#10095;</a>
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
                                    <p style="margin-bottom: 0px;">Disukai oleh <a href="/sosial-media/profil/{{$like->username}}"><b>{{$like->username}}</b></a> dan<span style="cursor: pointer;" data-toggle="modal" data-target="#modalLikeFlw{{$data->id_konten}}"> <b>lainnya</b></span></p>
                                    @if(COUNT((array)$like->username) == 1)
                                    @break
                                    @endif
                                @endif
                            @endforeach
                        @endif
                        <div class="description" style="margin-top: 0;">
                            <p style="margin-bottom: 0px;"> 
                                <strong>{{ $data->username }}</strong> <span class="addReadMore showlesscontent"> {{ $data->caption }} </span>
                            </p>
                            <span style="color: #999; float: left;font-size: 12px;text-transform: capitalize;width: 100%;">
                                <?php echo date_format(date_create($data->created_at), "d M Y H:i A"); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modalLikeFlw{{$data->id_konten}}" role="dialog">
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
                        @foreach ($komentar as $dataa)
                            @if(isset($dataa->isi_komentar))
                                @if(($data->id_konten == $dataa->id_konten) && $dataa->id_balas_komen == 0)
                                    <li id="comment_{{$dataa->id_cmt}}" class="list-rep_cmt_{{$dataa->id_cmt}}">
                                        <div class="comet-avatar">
                                            <img src="{{ $dataa->foto_profil != null ? url('/data_file/'.$dataa->username.'/foto_profil/'.$dataa->foto_profil) : asset('user.jpg') }}" alt="" style="height: 45px; width: 45px;">
                                        </div>
                                        <div class="we-comment">
                                            <div class="coment-head">
                                                <h5 style="text-transform: none;"><a href="/sosial-media/profil/{{$dataa->username}}" title="">{{ $dataa->username }}</a></h5>
                                                <span>{{ date_format(date_create($dataa->tanggal_komen), "d M Y H:i A") }}</span>
                                                <!-- <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a> -->
                                                 {{-- <a onclick="moreOnComment('{{ $dataa->id }}', '{{Auth::user()->pengguna->username}}', '{{$dataa->username}}', '{{$data->username}}')" style="cursor: pointer"><i class="fa fa-ellipsis-h"></i></a> --}}
                                                @if((Auth::user()->pengguna->username == $dataa->username) OR (Auth::user()->pengguna->username == $data->username))
                                                <a onclick="modalHapusKomentar('{{$dataa->id_cmt}}')" style="cursor: pointer"><i class="ti-trash hide" style="color: red;"></i></a>
                                                @endif
                                                @if(Auth::user()->pengguna->username != $dataa->username)
                                                <a onclick="modalReportKomentar('{{$dataa->id_cmt}}')" style="cursor: pointer" title="Report Komentar"><i class="ti-info-alt hide" style="color: red;"></i></a>
                                                @endif
                                                <button class="we-reply btn btn-link" style="font-size: 12px; font-weight: 500; float: right;position: relative;top: 0;" onclick="balas_komen('{{ '@'.$dataa->username }}', '{{$dataa->id_cmt}}', '{{$dataa->username}}', '{{$data->id_konten}}')" value="{{$dataa->id_cmt}}">Balas</button>
                                            </div>
                                            <p style="margin-top: 0px;">{{ $dataa->isi_komentar }}</p>
                                        </div>
                                        <?php $id_cmt_parent = $dataa->id_cmt; ?>
                                        @foreach ($balas_komentar as $balas_komen)
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
                                                        @if((Auth::user()->pengguna->username == $balas_komen->username) OR (Auth::user()->pengguna->username == $data->username))
                                                        <a onclick="modalHapusKomentar('{{$balas_komen->id_cmt}}')" style="cursor: pointer"><i class="ti-trash hide" style="color: red;"></i></a>
                                                        @endif
                                                        @if(Auth::user()->pengguna->username != $balas_komen->username)
                                                        <a onclick="modalReportKomentar('{{$balas_komen->id_cmt}}')" style="cursor: pointer" title="Report Komentar"><i class="ti-info-alt hide" style="color: red;"></i></a>
                                                        @endif
                                                        <button class="we-reply btn btn-link" style="font-size: 12px; font-weight: 500; float: right;position: relative;top: 0;" onclick="balas_komen('{{ '@'.$balas_komen->username }}', '{{$id_cmt_parent}}', '{{$balas_komen->username}}','{{$data->id_konten}}')" value="{{$balas_komen->id_cmt}}">Balas</button>
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
                                <img src="{{ auth()->user()->pengguna->foto_profil != null ? url('/data_file/'.auth()->user()->pengguna->username.'/foto_profil/'.auth()->user()->pengguna->foto_profil) : asset('user.jpg') }}" value="{{ auth()->user()->pengguna->foto_profil != null ? url('/data_file/'.auth()->user()->pengguna->username.'/foto_profil/'.auth()->user()->pengguna->foto_profil) : asset('user.jpg') }}" class="img-auth" alt="" style="width: 35px; height: 35px;">
                            </div>
                            <div class="post-comt-box2"> <!-- post-comt-box -->
                                <form method="post" action="/sosial-media/post_komen" enctype="multipart/form-data">
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
                </div>
            </div>
        </div>
        @endforeach
        </div>
    @endif
</div>

<div class="modal fade" id="modalShareFlw" role="dialog">
    <div class="modal-dialog modal-sm modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center" style="padding: 0.5rem;">
                <h6 class="modal-title">Bagikan</h6>
            </div>
            <div class="input-group flex-nowrap searchKeyFlw" id="cari_teman_flw">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping" style="border-radius: 0rem;">
                        Ke: 
                    </span>
                </div>
                <div id="kolom_input_cari_flw" class="kolom_cari" style="width: 100%;"></div>
            </div>
            <form method="post" action="/sosial-media/share_post" enctype="multipart/form-data">
            {{csrf_field()}}
                <ul class="friendz-list list-group list-group-flush findFrFlw" style="margin-top: 0px; overflow-y: auto!important; max-height: 250px;" id="teman_yang_dicari_flw">
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
                <input type="hidden" name="id_konten" id="hidden_id_shareFlw" value=""></input>
                <div class="modal-footer" style="padding: 8px;">
                    <input class="btn btn-sm btn-submit" type="submit" style="background-color: #358f66; color: white;" value="Submit"></input> 
                </div>
            </form>
        </div>
    </div>
</div>