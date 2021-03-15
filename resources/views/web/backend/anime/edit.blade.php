@extends('web.backend.layout.app')

@section('title', 'Редактирование ' . $currentAnime->name)

@section('content')
	<form action="" class="bg-dark p-3" multiple>
		<div class="input-group mb-3">
			<label for="name" class="input-group-text">Заголовок</label>
			<input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="name" value="{{$currentAnime->name}}">
			<a type="button" class="btn btn-primary btn-sm" id="name" href="#">Найти похожее</a>
		</div>
		<div class="row mb-3">
			<div class="col-6">
				<div class="input-group">
					<label for="license_name_ru" class="input-group-text">Лицензионное название</label>
					<input type="text" id="license_name_ru" class="form-control" name="license_name_ru" value="{{$currentAnime->license_name_ru}}">
				</div>
			</div>
			<div class="col-6">
				<div class="input-group">
					<label for="english" class="input-group-text">Английское название</label>
					<input type="text" id="english" class="form-control" name="english" value="{{$currentAnime->english}}">
				</div>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-6">
				<div class="input-group">
					<label for="japanese" class="input-group-text">Японское название</label>
					<input type="text" id="japanese" class="form-control" name="japanese" value="{{$currentAnime->japanese}}">
				</div>
			</div>
			<div class="col-6">
				<div class="input-group mb-3">
					<label for="synonyms" class="input-group-text">Альтернативные название</label>
					<input type="text" id="synonyms" class="form-control" name="synonyms" value="{{$currentAnime->synonyms}}">
				</div>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-6">
				<div class="input-group">
					<label for="updated_at" class="input-group-text">Дата обновления</label>
					<input type="date" id="updated_at" class="form-control" name="updated_at" value="{{\Carbon\Carbon::parse($currentAnime->updated_at)->format('Y-m-d')}}">
				</div>
			</div>
			<div class="col-6">
				<div class="input-group">
					<label for="author" class="input-group-text">Автор</label>
					<input type="text" id="author" class="form-control" name="author" value="{{$currentAnime->getUser->login}}">
				</div>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-6">
				<label for="category" class="form-label">Категории</label>
				<select class="js-selectize" multiple aria-label="category" name="category[]" id="category">
					@foreach($category as $value)
						<option value="{{$value->id}}" @if($currentAnime->getCategory->contains($value->id)) selected @endif>{{$value->title}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-6">
				<label for="kind" class="form-label">Выберите тип</label>
				<select class="js-selectize" aria-label="kind" name="kind" id="kind">
					@foreach($kind as $value)
						<option value="{{$value->id}}" @if($currentAnime->getKind->id == $value->id) selected @endif>{{$value->full_name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-6">
				<label for="channel_id" class="form-label">Выберите канал</label>
				<select class="js-selectize" aria-label="channel_id" name="channel_id" id="channel_id">
					@foreach($channel as $value)
						@if ($currentAnime->getChannel)
							<option value="{{$value->id}}" @if($currentAnime->getChannel->id == $value->id) selected @endif>{{$value->name}}</option>
						@else
							<option value="0">нет</option>
						@endif
							<option value="{{$value->id}}">{{$value->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-6">
				<div class="input-group mb-3">
					<label for="broadcast" class="input-group-text">Время показа</label>
					<input type="time" id="broadcast" class="form-control" name="broadcast" value="{{$currentAnime->broadcast}}">
				</div>
			</div>
		</div>
		<div id="descript" class="row mb-3">
			<label for="description_html" class="form-label">Описание</label>
			<textarea class="form-control ckeditor" id="description_html" name="description_html" rows="3">{{$currentAnime->description_html}}</textarea>
		</div>
		<div class="mb-3">
			<label for="original_img" class="form-label">Выберите постер</label>
			<input class="form-control form-control-sm" name="original_img" id="original_img" type="file" value="{{$currentAnime->original_img}}">
		</div>
		<button type="submit" class="btn btn-success">Success</button>
	</form>
@endsection
