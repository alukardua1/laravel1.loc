@extends('web.frontend.layout.app')

@section('title', $faqShow->title)
@section('description', '')

@section('error')
	@if ($errors->any())
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			@foreach($errors->all() as $error)
				{{$error}}
			@endforeach
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
@endsection

@section('content')
	<div class="text-center">
		<h1>{{$faqShow->title}}</h1>
	</div>
	<div>
		{!! $faqShow->description !!}
	</div>
@endsection