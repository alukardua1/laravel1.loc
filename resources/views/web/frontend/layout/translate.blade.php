@foreach($menu as $item)
	@if ($item->get_anime_count>0)
		<li>
			<a href="{{ route('translate', $item->url) }}">{{ $item->name }} <span>{{$item->get_anime_count}}</span></a>
		</li>
	@endif
@endforeach