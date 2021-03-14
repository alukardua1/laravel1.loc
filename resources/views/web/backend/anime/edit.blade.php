@extends('web.backend.layout.app')

@section('title', 'Редактирование ' . $currentAnime->name)

@section('content')
	<form action="" class="table table-dark edit-table-dark">
		<div class="row mb-3 mt-3">
			<label for="name" class="col-sm-2 col-form-label">Название</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="name" id="name" value="{{$currentAnime->name}}">
			</div>
		</div>
		
	</form>
@endsection
