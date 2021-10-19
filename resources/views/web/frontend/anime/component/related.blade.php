<div class="view zoom">
	<div class="card bg-dark text-white">
		<a href="{{route('showAnime', [$relates->getAnime()->first()->id, $relates->getAnime()->first()->url])}}">
			<img itemprop="image" src="{{asset('storage/'.$relates->getAnime()->first()->preview_img)}}" data-src="{{asset('storage/'.$relates->getAnime()->first()->original_img)}}"
				 class="card-img card-img-related lazy" alt="{{$relates->getAnime()->first()->russian}}">
			<div class="mask rgba-stylish-strong">
				<h5 class="card-img-overlay">
					<strong class="card-title title-carousel">{{$relates->getAnime()->first()->russian}}</strong>
				</h5>
				<div class="series">
					<span>{{$relates->getAnime()->first()->episodes_aired}} серия</span>
				</div>
			</div>
		</a>
	</div>
</div>