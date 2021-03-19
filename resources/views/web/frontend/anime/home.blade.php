@extends('web.frontend.layout.app')

@section('title', $title ?? config('secondConfig.nameSite'))
@section('description', $description ?? config('secondConfig.descriptionSite'))
@section('keywords', config('secondConfig.keywordsSite'))

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