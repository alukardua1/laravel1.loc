@extends('web.backend.layout.app')

@section('title', 'Редактирование ' . $currentAnime->name)

@section('content')
	<form action="" class="bg-dark p-3" multiple>
		<div class="row mb-3">
			<div class="col-11 row">
				<label for="name" class="col-2">Заголовок</label>
				<input type="text" id="name" name="name" class="form-control form-control-sm col" value="{{$currentAnime->name}}">
			</div>
			<div class="col">
				<a type="button" class="btn btn-primary btn-sm" href="#">Найти похожее</a>
			</div>
		</div>
		<div class="row mb-3">
			<label for="english" class="col-2">Английское название</label>
			<input type="text" id="english" class="form-control col" name="english" value="{{$currentAnime->english}}">
		</div>
		<div class="row mb-3">
			<div class="col-6 row">
				<label for="updated_at" class="col-4">Дата обновления</label>
				<input type="date" id="updated_at" class="form-control col" name="updated_at" value="{{\Carbon\Carbon::parse($currentAnime->updated_at)->format('Y-m-d')}}">
			</div>
			<div class="col-6 row">
				<label for="author" class="col-2">Автор</label>
				<input type="text" id="author" class="form-control col" name="author" value="{{$currentAnime->getUser->login}}">
			</div>
		</div>
		<div class="row mb-3">
			<label for="category" class="col-2">Категории</label>
			<select class="js-selectize col" multiple aria-label="category" name="category[]" id="category">
				@foreach($category as $value)
						<option value="{{$value->id}}" @if($currentAnime->getCategory->contains($value->id)) selected @endif>{{$value->title}}</option>
				@endforeach
			</select>
		</div>
		<div id="descript" class="row mb-3">
			<label for="description_html" class="form-label">Описание</label>
			<textarea class="form-control ckeditor" id="description_html" name="description_html" rows="3">{{$currentAnime->description_html}}</textarea>
		</div>
	</form>
@endsection
