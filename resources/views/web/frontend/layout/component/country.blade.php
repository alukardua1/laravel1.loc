@foreach($country as $item)
	<li>
		<a href="{{ route('showCountry', $item->url) }}">{{ $item->title }} <span>{{$item->get_anime_count}}</span></a>
	</li>
@endforeach