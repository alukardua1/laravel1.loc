<div class="view zoom m-2">
	<div class="card bg-dark text-white">
		<a href="{{route('showAnime', [$value->id, $value->url])}}">
			<img itemprop="image" src="{{asset('storage/'.$value->preview_img)}}" data-src="{{asset('storage/'.$value->original_img)}}"
				 class="card-img lazy shortstory-img" alt="{{$value->russian}}">
			<div class="mask rgba-stylish-strong">
				<h5 class="card-img-overlay">
					<strong class="card-title title-carousel">{{$value->russian}}</strong>
				</h5>
				<div class="series">
					<span>{{$value->episodes_aired}} серия</span>
				</div>
				<div class="rating">
					{!! $value->vote['rating'] !!}
				</div>
				<div class="vote">
					{{$value->get_vote_count}}
				</div>
				<div class="age">
					<span data-bs-toggle="tooltip" data-bs-placement="top" title="{{$value->getRating->description}}">{{$value->getRating->name}}</span>
				</div>
			</div>
		</a>
	</div>
</div>