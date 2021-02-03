@extends('layout.app')

@section('title', $showAnime->name)

@section('sidebar')
	@parent

	<p>This is appended to the master sidebar1.</p>
@endsection

@section('content')
	{{$showAnime->description}}
@endsection