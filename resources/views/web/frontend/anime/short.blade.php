@extends('web.frontend.layout.app')

@section('title', 'Все аниме')

@section('sidebar')
	@parent

	<p>This is appended to the master sidebar.</p>
@endsection

@section('content')
	<ul>
		@foreach($allAnime as $value)
			<li><a href="{{route('showAnime', [$value->id, $value->url])}}">{{$value->name}}</a></li>
		@endforeach
	</ul>

	{{$allAnime->links()}}
@endsection