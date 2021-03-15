@foreach($quality as $item)
	@if ($item->get_anime_count>0)
		<li>
			<a href="{{ route('quality', $item->url) }}">{{ $item->name }} <span>{{$item->get_anime_count}}</span></a>
		</li>
	@endif
@endforeach