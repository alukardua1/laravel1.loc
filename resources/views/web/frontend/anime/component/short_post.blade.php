<div class="view zoom m-2 pop" data-toggle="tooltip" data-placement="right" data-html="true" title="" id="{news-id}">
	<div class="card bg-dark text-white">
		<a href="{{route('showAnime', [$content->id, $content->url])}}">
			<img itemprop="image" src="{{asset('storage/'.$content->preview_img)}}" data-src="{{asset('storage/'.$content->original_img)}}"
				 class="card-img lazy shortstory-img" alt="{{$content->russian}}"/>
			<div class="mask rgba-stylish-strong">
				<div class="update-post">
					@if(date('Y-m-d', strtotime($content->updated_at)) == date('Y-m-d', time()))
						<div class="reason"></div>
					@endif
				</div>
				<h5 class="card-img-overlay">
					<strong class="card-title title-carousel d-none d-xl-block">{{$content->russian}}</strong>
					<strong class="card-title title-carousel-md d-block d-xl-none">{{$content->russian}}</strong>
				</h5>
				@if($content->episodes_aired)
					<div class='series @if($content->ongoing) short-online @endif'>
						<span>{{$content->episodes_aired}} серия</span>
					</div>
				@endif
				<div class="rating">
					{!! $content->vote['rating'] !!}
				</div>
				<div class="vote">
					{{$content->get_vote_count}}
				</div>
				<div class="age">
					<span data-bs-toggle="tooltip" data-bs-placement="top"
						  title="{{$content->getRating->description}}">{{$content->getRating->name}}</span>
				</div>
			</div>
		</a>
	</div>
</div>