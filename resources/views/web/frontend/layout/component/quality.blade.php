@foreach($quality as $item)
	<li>
		<a href="{{ route('quality', $item->url) }}">{{ $item->name }} <span>{{$item->get_anime_count}}</span></a>
	</li>
@endforeach