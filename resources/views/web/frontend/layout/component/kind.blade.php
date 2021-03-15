@foreach($kind as $item)
	<li>
		<a href="{{ route('kind', $item->url) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$item->full_name}}">{{ $item->full_name }} <span>{{$item->get_anime_count}}</span></a>
	</li>
@endforeach