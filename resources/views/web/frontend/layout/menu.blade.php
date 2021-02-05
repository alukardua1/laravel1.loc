	@foreach($menu as $item)
		<li class="desctop">
			<a href="{{ route('currentCategory', $item->url) }}">{{ $item->title }} <span>{{$item->getAnime->count()}}</span></a>
		</li>
		<li class="mobile">
			<a class="dropdown-item" href="{{ route('currentCategory', $item->url) }}">{{ $item->title }} <span>{news-count}</span></a>
		</li>
<!--		<li class="list-group-item @if($path == "/category/".$item->url) active @endif">
			<a href="{{ route('currentCategory', $item->url) }}">{{ $item->title }}</a>
		</li>-->
	@endforeach
