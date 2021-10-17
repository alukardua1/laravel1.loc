@foreach($quality as $item)
	<li>
		<a href="{{ route('quality', $item->url) }}">{{ $item->title }} <span>{{$item->get_anime_count}}</span></a>
	</li>
@endforeach