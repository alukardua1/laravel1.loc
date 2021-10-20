@foreach($translate as $item)
	<li>
		<a href="{{ route('showTranslate', $item->url) }}">{{ $item->title }} <span>{{$item->get_anime_count}}</span></a>
	</li>
@endforeach