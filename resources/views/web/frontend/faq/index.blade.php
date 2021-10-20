@extends('web.frontend.layout.app')

@section('title', 'FAQ')
@section('description', "Справка")

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
	@foreach($allFaq as $faq)
		<div class="faq mb-3">
			<a href="{{route('showFaq', $faq->url)}}">{{$faq->title}}</a>
		</div>
	@endforeach
	@if($allFaq->total() > $allFaq->count())
		<div class="align-content-center">
			{{$allFaq->links('web.frontend.vendor.pagination.semantic-ui')}}
		</div>
	@endif
@endsection