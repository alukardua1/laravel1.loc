@extends('web.backend.layout.app')

@section('title', 'Добавление новой категории')

@section('content')
	<form action="{{route('storeCategoryAdmin')}}" method="post">
		@csrf
		<div class="input-group mb-3">
			<label for="title" class="input-group-text">Заголовок</label>
			<input type="text" name="title" id="title" class="form-control" placeholder="Заголовок" aria-label="Заголовок" aria-describedby="title" value="">
		</div>
		<div class="input-group mb-3">
			<label for="english" class="input-group-text">На английском</label>
			<input type="text" name="english" id="english" class="form-control" placeholder="На английском" aria-label="На английском" aria-describedby="english" value="">
		</div>
		<div id="descript" class="input-group mb-3">
			<label for="description" class="input-group-text">Описание категории</label>
			<textarea class="form-control ckeditor" id="description" name="description" rows="3"></textarea>
		</div>
		<div class="form-check form-switch">
			<input name="posted_at" class="form-check-input" type="checkbox" id="posted_at" value="1">
			<label class="form-check-label" for="posted_at">Опубликовать</label>
		</div>
		<div class="form-submit">
			<button type="submit" class="btn btn-success">@lang('main.success')</button>
		</div>
	</form>
@endsection