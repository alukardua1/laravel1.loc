@foreach($menu as $item)
	<li>
		<a href="{{ route('rating', $item->url) }}">{{ $item->name }} <span>{{$item->get_anime_count}}</span></a>
	</li>
@endforeach