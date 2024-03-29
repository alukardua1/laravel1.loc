@extends('web.backend.layout.app')

@section('title', 'Редактирование группы пользователей')

@section('content')
	<form action="{{route('updateGroupAdmin', $edit->title)}}" class="bg-dark p-3" method="post">
		@csrf
		<div class="input-group">
			<label for="title" class="form-label">Наименование</label>
			<input type="text" name="title" id="title" class="form-control" value="{{$edit->title}}">
		</div>
		<div class="input-group colorful-card">
			<label for="color" class="form-label">Цвет группы</label>
			<input type="color" name="color" id="color" class="form-control form-control-color" value="{{$edit->color}}">
		</div>
		<div class="input-group" id="descript">
			<label for="description" class="form-label">Описание</label>
			<textarea class="form-control ckeditor" name="description" id="description" cols="30" rows="10">{{$edit->description}}</textarea>
		</div>
		<div class="form-check form-switch">
			<input type="checkbox" name="is_dashboard" id="is_dashboard" class="form-check-input" value="1" {{$edit->is_dashboard ? 'checked' : ''}}>
			<label for="is_dashboard" class="form-check-label">Доступ к админке</label>
		</div>
		<div class="form-submit">
			<button type="submit" class="btn btn-success">@lang('main.success')</button>
		</div>
	</form>
@endsection