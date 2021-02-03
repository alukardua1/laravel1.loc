@extends('web.frontend.layout.app')

@section('title', $showAnime->name)

@section('sidebar')
	@parent

	<p>This is appended to the master sidebar1.</p>
@endsection

@section('content')
	<img src="{{asset('storage/'.$showAnime->original_img)}}" alt="">
	{{$showAnime->description}}
@endsection