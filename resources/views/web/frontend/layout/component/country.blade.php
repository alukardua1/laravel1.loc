@foreach($country as $item)
	<li>
		<a href="{{ route('country', $item->url) }}">{{ $item->title }} <span>{{$item->get_anime_count}}</span></a>
	</li>
@endforeach