@extends('web.frontend.layout.app')

@section('title', $staticPage->title)

@section('error')
	@if ($errors->any())
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			@foreach($errors->all() as $error)
				<p>{{$error}}</p>
			@endforeach
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
@endsection

@section('content')
	<div class="text-center">
		<h1>{{$staticPage->title}}</h1>
	</div>
	<div class="content">
		{!! $staticPage->description_html !!}
	</div>
@endsection
