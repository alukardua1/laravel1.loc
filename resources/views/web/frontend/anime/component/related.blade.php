<div class="view zoom">
	<div class="card bg-dark text-white">
		<a href="{{route('showAnime', [$relates->id, $relates->url])}}">
			<img itemprop="image" src="{{asset('storage/'.$relates->preview_img)}}" data-src="{{asset('storage/'.$relates->original_img)}}" class="card-img card-img-related lazy" alt="{{$relates->name}}">
			<div class="mask rgba-stylish-strong">
				<h5 class="card-img-overlay">
					<strong class="card-title title-carousel">{{$relates->name}}</strong>
				</h5>
				<div class="series">
					<span>{{$relates->episodes_aired}} серия</span>
				</div>
			</div>
		</a>
	</div>
</div>