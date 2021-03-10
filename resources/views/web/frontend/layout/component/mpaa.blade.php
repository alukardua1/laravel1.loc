@foreach($menu as $item)
	<li>
		<a href="{{ route('rating', $item->url) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$item->description}}">{{ $item->name }} <span>{{$item->get_anime_count}}</span></a>
	</li>
@endforeach