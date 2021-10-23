@extends('web.backend.layout.app')

@section('title', 'Добавление')

@section('content')
	<form action="{{route('storeAnimeAdmin')}}" class="bg-dark p-3" method="post" multiple>
		@csrf
		<div class="input-group mb-3">
			<label for="name" class="input-group-text">Заголовок</label>
			<input type="text" name="name" id="name" class="form-control" placeholder="Заголовок" aria-label="Заголовок" aria-describedby="name" value="">
			<a type="button" class="btn btn-primary btn-sm" id="nameBtn" href="#">Найти похожее</a>
		</div>
		<div class="alert alert-success" role="alert" id='searchsuggestions' style="display: none"></div>
		<div class="row mb-3">
			<div class="col-6">
				<div class="input-group">
					<label for="license_name_ru" class="input-group-text">Лицензионное название</label>
					<input type="text" id="license_name_ru" class="form-control" name="license_name_ru" value="">
				</div>
			</div>
			<div class="col-6">
				<div class="input-group">
					<label for="english" class="input-group-text">Английское название</label>
					<input type="text" id="english" class="form-control" name="english" value="">
				</div>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-6">
				<div class="input-group">
					<label for="japanese" class="input-group-text">Японское название</label>
					<input type="text" id="japanese" class="form-control" name="japanese" value="">
				</div>
			</div>
			<div class="col-6">
				<div class="input-group mb-3">
					<label for="synonyms" class="input-group-text">Альтернативные название</label>
					<input type="text" id="synonyms" class="form-control" name="synonyms" value="">
				</div>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-4">
				<label for="category" class="form-label">Категории</label>
				<select class="js-selectize-multiple" multiple aria-label="category" name="category[]" id="category">
					@foreach($category as $value)
						<option value="{{$value->id}}">{{$value->title}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-4">
				<label for="kind_id" class="form-label">Выберите тип</label>
				<select class="js-selectize" aria-label="kind_id" name="kind_id" id="kind_id">
					@foreach($kind as $value)
						@if ($loop->first)
							<option value="{{$value->id}}" selected>{{$value->full_name}}</option>
						@else
							<option value="{{$value->id}}">{{$value->full_name}}</option>
						@endif

					@endforeach
				</select>
			</div>
			<div class="col-4">
				<label for="channel_id" class="form-label">Выберите канал</label>
				<select class="js-selectize" aria-label="channel_id" name="channel_id" id="channel_id">
					@foreach($channel as $value)
						<option value="{{$value->id}}">{{$value->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-4">
				<label for="country" class="form-label">Выберите страну</label>
				<select class="js-selectize" multiple aria-label="country" name="country[]" id="country">
					@foreach($country as $value)
						<option value="{{$value->id}}">{{$value->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-4">
				<label for="studios" class="form-label">Выберите студию</label>
				<select class="js-selectize" multiple aria-label="studios" name="studios[]" id="studios">
					@foreach($studios as $value)
						<option value="{{$value->id}}">{{$value->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-4">
				<label for="quality" class="form-label">Выберите качество</label>
				<select class="js-selectize" multiple aria-label="quality" name="quality[]" id="quality">
					@foreach($quality as $value)
						<option value="{{$value->id}}">{{$value->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-3">
				<div class="input-group mb-3">
					<label for="broadcast" class="input-group-text">Время показа</label>
					<input type="time" id="broadcast" class="form-control" name="broadcast" value="">
				</div>
			</div>
			<div class="col-3">
				<div class="input-group mb-3">
					<label for="episodes" class="input-group-text">Количество эпизодов</label>
					<input type="number" id="episodes" class="form-control" name="episodes" value="">
				</div>
			</div>
			<div class="col-3">
				<div class="input-group mb-3">
					<label for="duration" class="input-group-text">Длительность (мин)</label>
					<input type="number" id="duration" class="form-control" name="duration" value="">
				</div>
			</div>
			<div class="col-3 row">
				<div class="col-6">
					<div class="form-check form-switch">
						<input name="anons" class="form-check-input" type="checkbox" id="anons" value="1">
						<label class="form-check-label" for="anons">Анонс</label>
					</div>
				</div>
				<div class="col-6">
					<div class="form-check form-switch">
						<input name="ongoing" class="form-check-input" type="checkbox" id="ongoing" value="1">
						<label class="form-check-label" for="ongoing">Онгоинг</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<div class="input-group mb-3">
					<label for="aired_on" class="input-group-text">Дата начала показа</label>
					<input type="date" id="aired_on" class="form-control" name="aired_on" value="">
				</div>
			</div>
			<div class="col-6">
				<div class="input-group mb-3">
					<label for="released_on" class="input-group-text">Дата окончания показа</label>
					<input type="date" id="released_on" class="form-control" name="released_on" value="">
				</div>
			</div>
		</div>
		<div class="mb-3">
			<label for="poster" class="form-label">Выберите постер</label>
			<input class="form-control form-control-sm" name="poster" id="poster" type="file" accept="image/*">
			<input type="hidden" id="original_img" name="original_img" value="">
		</div>
		<div id="descript" class="row mb-3">
			<label for="description" class="form-label">Описание</label>
			<textarea class="form-control ckeditor" id="description" name="description" rows="3"></textarea>
		</div>
		<div class="row">
			<div class="mb-3">
				<label for="trailer" class="form-label">Трейлер</label>
				<button class="btn btn-primary btn-sm" type="button" id="addTrailer"><i class="far fa-plus-square"></i></button>
				<input type="text" id="trailer[]" class="form-control" name="trailer[]" value="">
				<div id="Trailer"></div>
			</div>
		</div>
		<div class="row">
			<div class="mb-3">
				<label for="player" class="form-label">Плеер</label>
				<button class="btn btn-primary btn-sm" type="button" id="addPlayer"><i class="far fa-plus-square"></i></button>
					<div class="row">
						<div class="col-2">
							<input type="text" id="player_name[]" class="form-control" name="player_name[]" value="">
						</div>
						<div class="col">
							<input type="text" id="player_url[]" class="form-control" name="player_url[]" value="">
						</div>
					</div>
				<div id="Player"></div>
			</div>
		</div>
		<div class="row">
			<div class="mb-3">
				<label for="OtherLink" class="form-label">Ссылки на другие сайты</label>
				<button class="btn btn-primary btn-sm" type="button" id="addOtherLink"><i class="far fa-plus-square"></i></button>
					<div class="row">
						<div class="col-2">
							<input type="text" class="form-control" name="otherLink_title[]" value="">
						</div>
						<div class="col">
							<input type="text" class="form-control" name="otherLink_url[]" value="">
						</div>
					</div>
				<div id="OtherLink"></div>
			</div>
		</div>
		<div class="row">
			<div class="mb-3">
				<label for="translate" class="form-label">Озвучивание</label>
				<select class="js-selectize-multiple" multiple aria-label="translate" name="translate[]" id="translate">
					@foreach($translate as $value)
						@if (Auth::user()->id === $value->id)
							<option value="{{$value->id}}" selected>{{$value->name}}</option>
						@else
							<option value="{{$value->id}}">{{$value->name}}</option>
						@endif

					@endforeach
				</select>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-6">
				<div class="input-group">
					<label for="updated_at" class="input-group-text">Дата обновления</label>
					<input type="date" id="updated_at" class="form-control" name="updated_at" value="{{date('Y-m-d')}}">
				</div>
			</div>
			<div class="col-6">
				<div class="input-group">
					<label for="created_at" class="input-group-text">Дата добавления</label>
					<input type="date" id="created_at" class="form-control" name="created_at" value="{{date('Y-m-d')}}">
				</div>
			</div>
		</div>
		<div class="row mb-3">
			<label for="user_id" class="form-label">Автор</label>
			<select class="js-selectize" aria-label="user_id" name="user_id" id="user_id">
				@foreach($user as $value)
					<option value="{{$value->id}}">{{$value->login}}</option>
				@endforeach
			</select>
		</div>
		<div class="row mb-3">
			<div class="col-6">
				<label class="form-label" for="region">Регион</label>
				<select class="js-selectize-multiple" aria-label="region" name="region[]" id="region" multiple>
					@foreach($geoBlock as $value)
						<option value="{{$value->code}}">{{$value->country}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-6">
				<label for="copyright_holder" class="form-label">Правообладатель</label>
				<select class="js-selectize-multiple" aria-label="copyright_holder" name="copyright_holder[]" id="copyright_holder" multiple>
					@foreach($copyrightHolder as $value)
						<option value="{{$value->id}}">{{$value->copyright_holder}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-4">
				<div class="form-check form-switch">
					<input name="posted_at" class="form-check-input" type="checkbox" id="posted_at" value="1" checked>
					<label class="form-check-label" for="posted_at">Опубликовать</label>
				</div>
			</div>
			<div class="col-4">
				<div class="form-check form-switch">
					<input name="posted_rss" class="form-check-input" type="checkbox" id="posted_rss" value="1" checked>
					<label class="form-check-label" for="posted_rss">Выводить в Rss</label>
				</div>
			</div>
			<div class="col-4">
				<div class="form-check form-switch">
					<input name="comment_at" class="form-check-input" type="checkbox" id="comment_at" value="1" checked>
					<label class="form-check-label" for="comment_at">разрешить комментировать</label>
				</div>
			</div>
		</div>
		<div class="form-submit">
			<button type="submit" class="btn btn-success">@lang('main.success')</button>
		</div>
	</form>
@endsection