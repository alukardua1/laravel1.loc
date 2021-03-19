@extends('web.frontend.layout.app')

@section('title', $title ?? config('secondConfig.nameSite'))
@section('description', $description ?? config('secondConfig.descriptionSite'))
@section('keywords', config('secondConfig.keywordsSite'))

@section('category-title')
	@if(!empty($title))
		<div class="category-title">
			<h1>{{$title}}</h1>
		</div>
	@endif
@endsection

@section('category-description')
	@if(!empty($description))
		<div class="category-description">
			<p>{!! $description !!}</p>
		</div>
	@endif
@endsection

@section('content')
	<div class="contents">
		@include('web.frontend.anime.component.short_post', ['allAnime'=>$allAnime])
	</div>
	<div class="align-content-center">
		{{$allAnime->links('web.frontend.vendor.pagination.semantic-ui')}}
	</div>
@endsection