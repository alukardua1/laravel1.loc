@foreach($menu as $item)
	<li>
		<a href="{{ route('year', $item['url']) }}">{{ $item['name'] }} <span>{{$item['get_anime_count']}}</span></a>
	</li>
@endforeach