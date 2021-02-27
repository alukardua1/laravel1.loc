@foreach($menu as $item)
	<li>
		<a href="{{ route('kind', $item->url) }}">{{ $item->full_name }} <span>{{$item->get_anime_count}}</span></a>
	</li>
@endforeach