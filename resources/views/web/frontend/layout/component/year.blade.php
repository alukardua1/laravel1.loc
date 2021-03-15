@foreach($year as $item)
	<li>
		<a href="{{ route('year', $item['name']) }}">{{ $item['name'] }} <span>{{$item['get_anime_count']}}</span></a>
	</li>
@endforeach