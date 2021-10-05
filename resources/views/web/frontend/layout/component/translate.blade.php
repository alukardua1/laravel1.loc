@foreach($translate as $item)
	<li>
		<a href="{{ route('translate', $item->url) }}">{{ $item->name }} <span>{{$item->get_anime_count}}</span></a>
	</li>
@endforeach