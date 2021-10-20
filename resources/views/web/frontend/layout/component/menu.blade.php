@foreach($category as $item)
	<li>
		<a href="{{ route('showCategory', $item->url) }}">{{ $item->title }} <span>{{$item->get_anime_count}}</span></a>
	</li>
@endforeach
