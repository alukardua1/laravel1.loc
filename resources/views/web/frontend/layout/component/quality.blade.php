@foreach($quality as $item)
	<li>
		<a href="{{ route('showQuality', $item->url) }}">{{ $item->title }} <span>{{$item->get_anime_count}}</span></a>
	</li>
@endforeach