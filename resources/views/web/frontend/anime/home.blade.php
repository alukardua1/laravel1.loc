@extends('web.frontend.layout.app')

@section('title', 'Главная')

@section('sidebar')
	@parent

	<p>This is appended to the master sidebar.</p>
@endsection

@section('content')
	<div class="contents">
		@foreach($ongoing as $value)
			@include('web.frontend.anime.component.short_post', ['value'=>$value])
		@endforeach
	</div>
@endsection