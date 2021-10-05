@foreach($year as $item)
	<li>
		<a href="{{ route('year', $item['year']) }}">{{ $item['year'] }} <span>{{$item['get_anime_count']}}</span></a>
	</li>
@endforeach