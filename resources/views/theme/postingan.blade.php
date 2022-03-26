<section>
	<div class="gap gray-bg" style="padding-top: 20px;">
		<div class="container-fluid" style="width:90%">
			<div class="row">
				<div class="col-lg-12">
					<div class="row loadMore2" id="page-contents" align="center">
						<?php 
						if(Auth::check()){
							$array = array();
							foreach($teman_saya as $tmn){
								$array[] = $tmn->username;
							}
						}

						foreach($pengaturan as $p){
							$pengaturan_akun = $p->akun_privat;
						}
						?>	
						@if(Auth::check())		
							@if(!in_array($d->username, $array) AND ($pengaturan_akun == "iya") AND $d->username !== auth()->user()->pengguna->username)
								<div class="col-lg" style="padding-bottom:15px;">
									<i class="ti-lock" style="font-size: 24px; border: 1px solid; padding: 10px; border-radius: 50%;"></i>
									<br><br>
									<strong style="font-size: 16px;">Akun ini bersifat Privat</strong>
									<p>Follow untuk melihat foto dan videonya.</p>
								</div>
							@else
								@if ($konten != NULL)
									@foreach ($konten as $data)
										<div class="item col-4" style="padding-bottom:15px;">
											<div class="central-meta item" style="padding:0px; width:300px; height:300px">
												<button class="portfolio-link btn btn-light" 
													id="lihatdetil" data-toggle="modal" data-target="#myModal{{ $data->id_konten }}" style="border-radius:0; padding:0rem; height: 300px;">
													<?php $media = explode(", ", $data->foto_video_konten); ?>
													<?php $tgl = date_format(date_create($data->created_at),"d-m-Y"); ?>
													@for($x = 0; $x < 1; $x++)
													@if (strpos($media[$x], '.mp4'))
														<video width="296" height="300" style="object-fit:none">
															<source src="{{ url('/data_file/'.$d->username.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media[$x]) }}" type="video/mp4">
															<source src="{{ url('/data_file/'.$d->username.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media[$x]) }}" type="video/ogg">
															Your browser does not support the video tag.
														</video>
													@else
														<img src="{{ url('/data_file/'.$d->username.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media[$x]) }}" alt="" style="width:300px; height:300px">
													@endif
													@endfor
												</button>
											</div>
										</div>
										<div id="myModal{{ $data->id_konten }}" class="modal fade">
											<div class="modal-dialog modal-dialog-centered">
												<div class="modal-content">
													<div class="modal-body">
														<div class="row">
															<div class="col-md-8 align-self-center modal-image">
																<div class="single-item2">
																	<?php $media = explode(", ", $data->foto_video_konten); ?>
																	<?php $tgl = date_format(date_create($data->created_at),"d-m-Y"); ?>
																	@foreach ($media as $media_konten)
																		@if (strpos($media_konten, '.mp4'))
																			<video width="100%" height="100%" autoplay loop muted>
																				<source src="{{ url('/data_file/'.$d->username.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media_konten) }}" type="video/mp4">
																				<source src="{{ url('/data_file/'.$d->username.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media_konten) }}" type="video/ogg">
																				Your browser does not support the video tag.
																			</video>
																		@else
																			<img id="foto" class="img-responsive" src="{{ url('/data_file/'.$d->username.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media_konten) }}" alt="Image" style="width:567.33px;height:491px; object-fit: contain; border-radius: 0.3rem;">
																		@endif
																	@endforeach
																</div>
															</div>
															<div class="col-md-4 modal-meta" style="padding-left: 0px;height: 490px;">
																<div class="modal-meta-top">
																	<div class="img-poster clearfix" style="padding-left: 2px;">
																		<a href="#" class="img_prof1"><img src="{{ $d->foto_profil != null ? url('/data_file/'.$d->username.'/foto_profil/'.$d->foto_profil) : asset('user.jpg') }}" alt="" style="float:left;width:32px; height:32px; border-radius: 50%;"></a>
																		<!-- <a href="#" data-toggle="modal" data-target="#myModalMorePost{{ $data->id_konten }}" style="float: right;"><i class="fa fa-ellipsis-h"></i></a> -->
																		<?php $tgl = date_format(date_create($data->created_at), "d-m-Y"); ?>
																		@if(($data->username) != auth()->user()->pengguna->username)
																			<a onclick="modalMore('{{ $data->id_konten }}', '{{ $d->username }}', '{{ $data->slug }}', '{{ $d->foto_profil }}')" data-dismiss="modal" style="cursor: pointer; float: right;"><i class="fa fa-ellipsis-h"></i></a>
																		@else
																			<a onclick="modalMore2('{{ $data->id_konten }}', '{{ $d->foto_profil }}', '{{ $d->username }}', '{{ $data->tempat }}', '{{ $data->foto_video_konten }}', '{{ str_replace('"', "&quot;", str_replace("'", "\'", $data->caption)) }}', '{{ $tgl }}', '{{ $data->slug }}')" data-dismiss="modal" style="cursor: pointer; float: right;"><i class="fa fa-ellipsis-h"></i></a>
																		@endif
																		<strong><a href="#" style="padding-left: 10px;float: left;">{{ $d->username }}</a>
																		</strong>
																		<span style="font-size:11px;color:black;float: left;padding-left: 10px;text-overflow: ellipsis;white-space: nowrap;width: 200px;overflow: hidden; text-align: left;"><a href="/sosial-media/explore/{{$data->tempat}}">{{ $data->tempat }}</a></span>
																	</div>
																	<hr style="margin-top: 0.5rem;margin-bottom: 0.5rem;">
																	<ul class="img-comment-list list-cmt{{$data->id_konten}}" style="padding:0px;overflow-y: auto;overflow-x: hidden;max-height: 274px;margin-bottom: 0rem; height: 274px;">
																		<div class="row">
																			<div class="comment-img col-sm-2 img_prof2" style="padding-right:0">
																				<img src="{{ $d->foto_profil != null ? url('/data_file/'.$d->username.'/foto_profil/'.$d->foto_profil) : asset('user.jpg') }}" class="img-responsive img-circle" style="width:32px;height:32px;border-radius: 50%;">
																			</div>
																			<div class="comment-text col-sm-10" style="padding-left:10px;padding-bottom: 15px;">
																				<strong style="font-size:14px;"><a href="" class="d-flex justify-content-start">{{ $d->username }}</a></strong>
																				<p style="margin-bottom:0;font-size:13px;color:#000;text-align: left; margin-top: 0;" class="addReadMore showlesscontent">{{ $data->caption }}</p> 
																				<span class="d-flex justify-content-start" style="font-size:11px;color:gray;">{{ date_format(date_create($data->created_at),"d M Y H:i A") }}</span>
																			</div>
																		</div>
																		@foreach ($komentar as $dataa)
																			@if(isset($dataa->isi_komentar))
																				@if(($data->id_konten == $dataa->id_konten) && $dataa->id_balas_komen == 0)
																					<div class="row list-rep_cmt_{{$dataa->id_cmt}}" id="comment_{{$dataa->id_cmt}}">
																						<div class="comment-img col-sm-2" style="padding-right:0">
																							<img src="{{ $dataa->foto_profil != null ? url('/data_file/'.$dataa->username.'/foto_profil/'.$dataa->foto_profil) : asset('user.jpg') }}" class="img-responsive img-circle" style="width:32px;height:32px;border-radius: 50%;">
																						</div>
																						<div class="comment-text col-sm-10" style="padding-left:10px;">
																							<strong style="font-size:14px;"><a href="/sosial-media/profil/{{$dataa->username}}" class="d-flex justify-content-start">{{ $dataa->username }}</a></strong>
																							<p style="margin-bottom:0;font-size:13px;color:#000;text-align: left; margin-top: 0;">{{ $dataa->isi_komentar }}</p> 
																							<span class="d-flex justify-content-start" style="font-size:11px;color:gray;float: left;">{{ date_format(date_create($dataa->tanggal_komen), "d M Y H:i A") }}</span>
																							@if((Auth::user()->pengguna->username == $dataa->username) OR (Auth::user()->pengguna->username == $data->username))
																							<a onclick="modalHapusKomentar('{{$dataa->id_cmt}}')" style="cursor: pointer; position: relative; top: -5px;"><i class="ti-trash hide" style="color:red;"></i></a>
																							@endif
																							@if(Auth::user()->pengguna->username != $dataa->username)
																							<a onclick="modalReportKomentar('{{$dataa->id_cmt}}')" style="cursor: pointer; position: relative; top: -5px;" title="Report Komentar"><i class="ti-info-alt hide" style="color: red;"></i></a>
																							@endif
																							<button class="btn btn-link" style="font-size: 12px; font-weight: 500; float: left;position: relative;top: -8px;" onclick="balas_komen('{{ '@'.$dataa->username }}', '{{$dataa->id_cmt}}', '{{$dataa->username}}', '{{$data->id_konten}}')" value="{{$dataa->id_cmt}}">Balas</button>
																						</div>
																						<?php $id_cmt_parent = $dataa->id_cmt; ?>
																						@foreach ($balas_komentar as $balas_komen)
																						@if($balas_komen->id_balas_komen != 0)
																						@if($dataa->id_cmt == $balas_komen->id_balas_komen)
																						<div class="row" style="margin-left: 50px; max-width: 232px;" id="comment_{{$balas_komen->id_cmt}}">
																							<div class="comment-img col-sm-2" style="padding-right:0; padding-left: 0;">
																								<img src="{{ $balas_komen->foto_profil != null ? url('/data_file/'.$balas_komen->username.'/foto_profil/'.$balas_komen->foto_profil) : asset('user.jpg') }}" class="img-responsive img-circle" style="width:32px;height:32px;border-radius: 50%;">
																							</div>
																							<div class="comment-text col-sm-10" style="padding-left:10px;">
																								<strong style="font-size:14px;"><a href="/sosial-media/profil/{{$balas_komen->username}}" class="d-flex justify-content-start">{{ $balas_komen->username }}</a></strong>
																								<p style="margin-bottom:0;font-size:13px;color:#000;text-align: left; margin-top: 0;"><?php echo  html_entity_decode($balas_komen->isi_komentar)?></p> 
																								<span class="d-flex justify-content-start" style="font-size:11px;color:gray;float: left;">{{ date_format(date_create($balas_komen->tanggal_komen), "d M Y") }}</span>
																								@if((Auth::user()->pengguna->username == $balas_komen->username) OR (Auth::user()->pengguna->username == $data->username))
																								<a onclick="modalHapusKomentar('{{$balas_komen->id_cmt}}')" style="cursor: pointer; position: relative; top: -5px;"><i class="ti-trash hide" style="color: red;"></i></a>
																								@endif
																								@if(Auth::user()->pengguna->username != $balas_komen->username)
																								<a onclick="modalReportKomentar('{{$balas_komen->id_cmt}}')" style="cursor: pointer; position: relative; top: -5px;" title="Report Komentar"><i class="ti-info-alt hide" style="color: red;"></i></a>
																								@endif
																								<button class="btn btn-link" style="font-size: 12px; font-weight: 500; float: left;position: relative;top: -8px;" onclick="balas_komen('{{ '@'.$balas_komen->username }}', '{{$id_cmt_parent}}', '{{$balas_komen->username}}', '{{$data->id_konten}}')" value="{{$balas_komen->id_cmt}}">Balas</button>
																							</div>
																						</div>
																						@endif
																						@endif
																						@endforeach
																					</div>
																				@endif
																			@endif
																		@endforeach
																	</ul>
																	<div class="modal-meta-bottom"> <hr style="margin-top: 0.5rem;margin-bottom: 0.5rem;">
																		<div class="we-video-info" style="padding-top: 0; padding-bottom: 0;">
																			<ul style="max-height: 30px;">
																				<li data-id="{{$data->id_konten}}" data-is-like="{{$data->is_like ? 1 : 0}}" class="action-like-or-dislike" style="margin-right: 5px;height: 23px; float: left;">
																					<span class="like" data-toggle="tooltip" title="{{$data->is_like ? 'Batal Menyukai' : 'Menyukai'}}">
																						<div class="menu" style="width: 23px; height: 23px;">
																							<div class="btn trigger" style="background: none;">
																								<i id="icon_like{{$data->id_konten}}" class="{{$data->is_like ? 'fa fa-heart' : 'fa fa-heart-o'}}" style="font-size: 20px;color: black;"></i>
																							</div>
																						</div>
																					</span>
																				</li>
																				<li class="social-media" style="margin-right: 5px; height: 23px; float: left;">
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

																								// $url=$url;

																								// $img=urlencode(url('/data_file/'.$d->username.'/foto_profil/'.$d->foto_profil));

																								// $title=urlencode("Share your link on facebook");

																								// $summary="Share your link on facebook using sharer.php. You can choose your custom title, image and summary to share content on facebook timeline.";

																							?>
																							<div class="rotater">
																								<div class="btn btn-icon"><a href="https://www.facebook.com/sharer/sharer.php?u={{$url}}&display=popup" target="_blank" title=""><i class="fa fa-facebook"></i></a></div>
																								
																							</div>
																							<!-- <div class="rotater">-->
																							<!--	<div class="btn btn-icon"><a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo $url ?>&p[images][0]=<?php echo $img ?>&p[title]=<?php echo $title ?>&p[summary]=<?php echo $summary ?>" target="_blank" title=""><i class="fa fa-facebook"></i></a></div>-->
																							<!--</div>-->
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
																		<br>
																		@if($likes)
																			@foreach ($likes as $like)
																				@if($like->id_konten == $data->id_konten)
																					<p style="font-size:14px;margin:0px;color:#000;float: left;">Disukai oleh <a href="/sosial-media/profil/{{$like->username}}"><b>{{$like->username}}</b></a> dan<span style="cursor: pointer;" data-toggle="modal" data-target="#modalLike{{$data->id_konten}}"> <b>lainnya</b></span></p><br>
																					@if(COUNT((array)$like->username) == 1)
																					@break
																					@endif
																				@endif
																			@endforeach
																		@endif
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
																													<small style="font-weight: 700; color: black; margin-bottom: 0rem; float:left;">{{ $data2->username }}</small><br>
																													<small class="mt-0" style="margin-bottom: 0rem; font-weight: 500; color: #989e99; float: left;">{{ $data2->nama }}</small>
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
																		{{-- <span id="tanggal_post" style="font-size:11px;color:gray;float: left;">{{ date_format(date_create($data->created_at),"d M Y H:i A") }}</span><br> --}}
																		<hr style="margin-top: 0.5rem;margin-bottom: 0.5rem;">
																		<ul style="padding:0px; margin-top:5px;" class="post-comt-box2">
																			<form method="post" enctype="multipart/form-data">
																			{{ csrf_field() }}
																				<input type="hidden" name="id_konten" value="{{$data->id_konten}}" class="konten_{{$data->id_konten}}">
																				<span class="thumb-xs{{$data->id_konten}}">
																					<textarea placeholder="Post your comment" name="isi_komentar" style="width: 100%; float: left;" class="txt_comment_{{$data->id_konten}}" onkeyup="showBtn(this, '{{$data->id_konten}}');"></textarea>
																				</span>
																				{{-- <button type="submit" class="btn btn-submit" style="border-radius: 3px;">Post</button> --}}
																				<button type="button" onclick="uploadKomen('{{$data->id_konten}}')" class="btn btn-submit btn-{{$data->id_konten}}" style="border-radius: 3px; display: none;">Post</button>
																			</form>
																		</ul>		
																	</div><!--/ modal-meta-bottom -->
																</div><!--/ modal-meta-top -->
															</div><!--/ col-md-4 -->
														</div><!--/ row -->
													</div><!--/ modal-body -->
												</div><!--/ modal-content -->
											</div><!--/ modal-dialog -->
										</div>
									@endforeach
								@else
									<div class="col-lg" style="padding-bottom:15px;">
										<strong style="font-size: 16px;">Belum Ada Postingan</strong>
									</div>
								@endif
							@endif
						@else
							@if(!in_array($d->username, $array) AND ($pengaturan_akun == "iya"))
								<div class="col-lg" style="padding-bottom:15px;">
									<i class="ti-lock" style="font-size: 24px; border: 1px solid; padding: 10px; border-radius: 50%;"></i>
									<br><br>
									<strong style="font-size: 16px;">Akun ini bersifat Privat</strong>
									<p>Follow untuk melihat foto dan videonya.</p>
								</div>
							@else
								@if ($konten != NULL)
									@foreach ($konten as $data)
										<div class="item col-4" style="padding-bottom:15px;">
											<div class="central-meta item" style="padding:0px; width:300px; height:300px">
												<button class="portfolio-link btn btn-light" 
													id="lihatdetil" style="border-radius:0; padding:0rem; height: 300px;">
													<?php $media = explode(", ", $data->foto_video_konten); ?>
													<?php $tgl = date_format(date_create($data->created_at),"d-m-Y"); ?>
													@for($x = 0; $x < 1; $x++)
													@if (strpos($media[$x], '.mp4'))
														<video width="296" height="300" style="object-fit:none">
															<source src="{{ url('/data_file/'.$d->username.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media[$x]) }}" type="video/mp4">
															<source src="{{ url('/data_file/'.$d->username.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media[$x]) }}" type="video/ogg">
															Your browser does not support the video tag.
														</video>
													@else
														<img src="{{ url('/data_file/'.$d->username.'/foto_konten/'.$tgl.'/'.$data->slug.'/'.$media[$x]) }}" alt="" style="width:300px; height:300px">
													@endif
													@endfor
												</button>
											</div>
										</div>
									@endforeach
								@else
									<div class="col-lg" style="padding-bottom:15px;">
										<strong style="font-size: 16px;">Belum Ada Postingan</strong>
									</div>
								@endif
							@endif
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>	
</section>

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
                    <!-- <div class="wrap-modal-slider">
                        <div class="single-item" id="media_post"></div>
                    </div> -->
					<div class="wrap-modal-slider">
                        <div class="slideshow-container editSlide">
                            <div id="media_post"></div>
                            <a class="prev" onclick="" id="prevClick">&#10094;</a>
                            <a class="next" onclick="" id="nextClick">&#10095;</a>
                        </div>
                    </div>
					<div class="newpst-input" style="margin-top: 15px;">
						<input type="hidden" name="id_konten" id="hidden_id" value=""></input>
						<textarea rows="3" name="caption" id="capt" style="border: 1px solid #eeeeee; border-radius: 0; border-bottom:0;" onkeyup="countCharsEdit(this);" maxlenght="500"></textarea>
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
				<button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                        <div class="media-body align-self-center" style="text-align:left;">
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

@if(Auth::check())
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