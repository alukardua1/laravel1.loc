@extends('web.frontend.layout.app')

@section('title', $currentCategory->title ?? 'Аниме')

@section('category-title')
	@if(!empty($currentCategory->title))
		<div class="category-title">
			<h1>{{$currentCategory->title}}</h1>
		</div>
	@endif
@endsection

@section('category-description')
	@if(!empty($currentCategory->description))
		<div class="category-description">
			<p>{{$currentCategory->description}}</p>
		</div>
	@endif
@endsection

@section('content')
	<div class="contents">
		@foreach($allAnime as $value)
			@include('web.frontend.anime.component.short_post', ['value'=>$value])
		@endforeach
	</div>
	<div class="align-content-center">
		{{$allAnime->links('web.frontend.vendor.pagination.semantic-ui')}}
	</div>
@endsection