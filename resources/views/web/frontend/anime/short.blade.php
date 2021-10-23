@extends('web.frontend.layout.app')

@section('title', $views['title'] ?? config('secondConfig.nameSite'))
@section('description', $views['description'] ?? config('secondConfig.descriptionSite'))
@section('keywords', config('secondConfig.keywordsSite'))

@section('category-title')
	@if(!empty($views['title']))
		<div class="category-title">
			<h1>{{$views['title']}}</h1>
		</div>
	@endif
@endsection

@section('category-description')
	@if(!empty($views['description']))
		<div class="category-description">
			<p>{!! $views['description'] !!}</p>
		</div>
	@endif
@endsection

@section('content')
	<div class="contents">
		@each('web.frontend.anime.component.short_post', $views['content'], 'content')
	</div>
	<div class="align-content-center">
		{{$views['content']->links('web.frontend.vendor.pagination.semantic-ui')}}
	</div>
@endsection