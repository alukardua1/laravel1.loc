<li>
	<a href="{{ route('showKind', $value->url) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$value->full_name}}">{{ $value->full_name }} <span>{{$value->get_anime_count}}</span></a>
</li>