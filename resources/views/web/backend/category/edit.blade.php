@extends('web.backend.layout.app')

@section('title', 'Редактирование ' . $category->title)

@section('content')
	<form action="{{route('updateCategoryAdmin', $category->url)}}" method="post">
		@csrf
	</form>
@endsection