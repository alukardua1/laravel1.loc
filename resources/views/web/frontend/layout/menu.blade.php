<div class="list-group list-group-flush">
	@foreach($menu as $item)
		<li class="list-group-item @if($path == "/category/".$item->url) active @endif">
			<a href="{{ route('currentCategory', $item->url) }}">{{ $item->title }}</a>
		</li>
	@endforeach
</div>
