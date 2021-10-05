@foreach($country as $item)
	<li>
		<a href="{{ route('country', $item->url) }}">{{ $item->name }} <span>{{$item->get_anime_count}}</span></a>
	</li>
@endforeach