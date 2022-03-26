<section>
	<div class="gap100" style="padding: 20px 0;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="shop-page">
						<div class="row">
						@php
							$api_product = json_decode(file_get_contents('http://marketpalcedesaku.masuk.web.id/api/productvillage/'.$d->village_id), true);
						@endphp
						@if ($api_product != NULL)
							@foreach ($api_product as $api)
								<div class="col-4">
									<div class="product-box">
										<figure>
											<span class="new">New</span>
											<?php $x=1; ?>
											@if($api['galleries'])
												@foreach ($api['galleries'] as $api_gbr)
													<img src="http://marketpalcedesaku.masuk.web.id/storage/{{ $api_gbr['photos'] }}" style="height: 261px; widht: 261px; object-fit: cover;" alt="">
													@if($loop->iteration == 1)
													@break
													@endif
												@endforeach
											@else
												<img src="http://marketpalcedesaku.masuk.web.id/storage/{{ $api['category']['photo'] }}" style="height: 261px; widht: 261px; object-fit: cover;" alt="">
											@endif
										</figure>
										<div class="product-name" style="padding-bottom: 5px; text-align: left">
											<h5><a href="#" title="">{{ $api['name'] }}</a></h5>
											<div class="prices">
												<ins>Rp{{ number_format($api['price']) }}</ins>
											</div>
										</div>
										<a href="http://marketpalcedesaku.masuk.web.id/details/{{ $api['slug'] }}" target="_blank">
											<button type="button" class="btn btn-sm btn-warning btn-block" style="position: relative; float: left; font-weight: bold; color: white;padding-bottom: 1px; padding-top: 1px; border-radius: 0;">Lihat</button>
										</a>
									</div>
								</div>
								@if($loop->iteration == 6)
								@break
								@endif
							@endforeach 
						@else
							<div class="col-lg" style="padding-bottom:15px;">
								<strong style="font-size: 16px;">Belum Ada Produk</strong>
							</div>
						@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>