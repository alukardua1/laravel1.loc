@extends('layout.app')

@section('title', 'Все аниме')

@section('sidebar')
	@parent

	<p>This is appended to the master sidebar.</p>
@endsection

@section('content')
	<ul>
		@foreach($allAnime as $value)
			<li>{{$value->name}}</li>
		@endforeach
	</ul>

	{{$allAnime->links()}}
@endsection