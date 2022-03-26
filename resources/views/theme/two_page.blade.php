<div class="page-likes" style="margin:0;">
	<ul class="nav nav-tabs likes-btn"  
	style="background: #fdfdfd; border: 1px solid #ede9e9; 
	padding: 0; border-radius: 3px; margin-bottom: 5px;">
		<li class="nav-item" style="margin-bottom: 0; border-right: #f4f2f2 1px solid;">
			<a class="active" href="#allpage" data-toggle="tab" 
			style="font-size: 16px; font-weight: bold; display: block;">Semua Desa</a>
		</li>
		<li class="nav-item" style="margin-bottom: 0; border-left: #f4f2f2 1px solid;">
			<a class="" href="#followingpage" data-toggle="tab" 
			style="font-size: 16px; font-weight: bold; display: block;">Following</a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="allpage" >
			@include('theme.all_page')
		</div>
		<div class="tab-pane" id="followingpage" >
			@include('theme.following_page')
		</div>
	</div>
</div>