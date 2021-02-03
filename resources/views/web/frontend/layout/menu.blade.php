@foreach($menu as $item)
	<li @if($path == $item->url) class="active" @endif>
		<a href="{{ route('currentCategory', $item->url) }}">{{ $item->title }}</a>
	</li>
@endforeach
