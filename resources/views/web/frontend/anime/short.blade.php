@extends('web.frontend.layout.app')

@section('title', 'Аниме')

@section('sidebar')
	@parent

	<p>This is appended to the master sidebar.</p>
@endsection

@section('content')
	<div class="contents">
		@foreach($allAnime as $value)
			@include('web.frontend.anime.component.short_post', ['value'=>$value])
		@endforeach
	</div>

	{{$allAnime->links()}}
@endsection