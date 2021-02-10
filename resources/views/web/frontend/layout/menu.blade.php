@foreach($menu as $item)
	<li class="desctop">
		<a href="{{ route('currentCategory', $item->url) }}">{{ $item->title }} <span>{{$item->get_anime_count}}</span></a>
	</li>
	<li class="mobile">
		<a class="dropdown-item" href="{{ route('currentCategory', $item->url) }}">{{ $item->title }} <span>{{$item->get_anime_count}}</span></a>
	</li>
@endforeach
