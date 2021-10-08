@extends('web.backend.layout.app')

@section('title', 'Редактирование группы пользователей')

@section('content')
	<form action="{{route('updateGroupAdmin', $groupEdit->title)}}" class="bg-dark p-3" method="post">
		<div class="input-group">
			<label for="title" class="form-label">Наименование</label>
			<input type="text" name="title" id="title" class="form-control" value="{{$groupEdit->title}}">
		</div>
		<div class="input-group colorful-card">
			<label for="color" class="form-label">Цвет группы</label>
			<input type="color" name="color" id="color" class="form-control form-control-color" value="{{$groupEdit->color}}">
		</div>
		<div class="input-group" id="descript">
			<label for="description_html" class="form-label">Описание</label>
			<textarea class="form-control ckeditor" name="description_html" id="description_html" cols="30" rows="10">{{$groupEdit->description_html}}</textarea>
		</div>
		<div class="form-check form-switch">
			<input type="checkbox" name="is_dashboard" id="is_dashboard" class="form-check-input" value="1" {{$groupEdit->is_dashboard ? 'checked' : ''}}>
			<label for="is_dashboard" class="form-check-label">Доступ к админке</label>
		</div>
		<div class="form-submit">
			<button type="submit" class="btn btn-success">@lang('main.success')</button>
		</div>
	</form>
@endsection