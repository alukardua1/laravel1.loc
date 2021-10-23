<div class="view zoom m-2 pop" data-toggle="tooltip" data-placement="right" data-html="true" title="" id="{news-id}">
	<div class="card bg-dark text-white">
		<a href="{{route('showAnime', [$value->id, $value->url])}}">
			<img itemprop="image" src="{{asset('storage/'.$value->preview_img)}}" data-src="{{asset('storage/'.$value->original_img)}}"
				 class="card-img lazy shortstory-img" alt="{{$value->name}}"/>
			<div class="mask rgba-stylish-strong">
				<div class="update-post">
					@if($value->updated_at == date('Y-m-d', time()))
						<div class="reason"></div>
					@endif
				</div>
				<h5 class="card-img-overlay">
					<strong class="card-title title-carousel d-none d-xl-block">{{$value->name}}</strong>
					<strong class="card-title title-carousel-md d-block d-xl-none">{{$value->name}}</strong>
				</h5>
				@if($value->episodes_aired)
					<div class='series @if($value->ongoing) short-online @endif'>
						<span>{{$value->episodes_aired}} серия</span>
					</div>
				@endif
				<div class="rating">
					{!! $value->vote['rating'] !!}
				</div>
				<div class="vote">
					{{$value->get_vote_count}}
				</div>
				<div class="age">
					<span data-bs-toggle="tooltip" data-bs-placement="top"
						  title="{{$value->getRating->description}}">{{$value->getRating->name}}</span>
				</div>
			</div>
		</a>
	</div>
</div>