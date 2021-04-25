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
			<label for="url" class="input-group-text">Урл категории</label>
			<input type="text" name="url" id="url" class="form-control" placeholder="Урл категории" aria-label="Урл категории" aria-describedby="url" value="">
		</div>
		<div id="descript" class="input-group mb-3">
			<label for="description_html" class="input-group-text">Описание категории</label>
			<textarea class="form-control ckeditor" id="description_html" name="description_html" rows="3"></textarea>
		</div>
		<div class="form-check form-switch">
			<input name="posted_at" class="form-check-input" type="checkbox" id="posted_at" value="1">
			<label class="form-check-label" for="posted_at">Опубликовать</label>
		</div>
		<div>
			<button type="submit" class="btn btn-success">Сохранить</button>
		</div>
	</form>
@endsection