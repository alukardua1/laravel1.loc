@extends('web.frontend.layout.app')

@section('title', __('order.add_order'))

@section('error')
	@if ($errors->any())
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			@foreach($errors->all() as $error)
				<p>{{$error}}</p>
			@endforeach
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
@endsection

@section('content')
	<form action="{{route('tableOrderStore')}}" method="post">
		@csrf
		<div class="row mb-3">
			<div class="col">
				<label for="name_rus" class="form-label">{{__('main.name_rus')}} <span class="text-danger">*</span></label>
				<input type="text" class="form-control" id="name_rus" placeholder="{{__('main.name_rus')}}" value="{{old('name_rus')}}" name="name_rus">
			</div>
			<div class="col">
				<label for="name_origin" class="form-label">{{__('main.name_origin')}} <span class="text-danger">*</span></label>
				<input type="text" class="form-control" id="name_origin" placeholder="{{__('main.name_origin')}}" value="{{old('name_origin')}}" name="name_origin">
			</div>
		</div>
		<div class="mb-3">
			<label for="year" class="form-label">Год выпуска <span class="text-danger">*</span></label>
			<input type="text" class="form-control" id="year" placeholder="Год выпуска" value="{{old('year')}}" name="year">
		</div>
		<div class="row mb-3">
			<div class="col">
				<label for="wa_url" class="form-label">Ссылка на World-Art</label>
				<input type="url" class="form-control" id="wa_url" placeholder="Ссылка на World-Art" value="{{old('wa_url')}}" name="wa_url">
			</div>
			<div class="col">
				<label for="kp_url" class="form-label">Ссылка на Кинопоиск</label>
				<input type="url" class="form-control" id="kp_url" placeholder="Ссылка на Кинопоиск" value="{{old('kp_url')}}" name="kp_url">
			</div>
			<div class="col">
				<label for="imdb_url" class="form-label">Ссылка на ImDB</label>
				<input type="url" class="form-control" id="imdb_url" placeholder="Ссылка на ImDB" value="{{old('imdb_url')}}" name="imdb_url">
			</div>
			<div class="col">
				<label for="shikimori_url" class="form-label">Ссылка на Shikimori</label>
				<input type="url" class="form-control" id="shikimori_url" placeholder="Ссылка на Shikimori" value="{{old('shikimori_url')}}" name="shikimori_url">
			</div>
		</div>
		<div class="mb-3">
			<label for="translate_id" class="form-label">Озвучивание <span class="text-danger">*</span></label>
			<select class="js-selectize" id="translate_id" name="translate_id">
				<option selected></option>
				@foreach($translate as $key=>$value)
					<option value="{{$value['id']}}">{{$value['name']}}</option>
				@endforeach
			</select>
		</div>
		<div class="mb-3">
			<label for="download_url" class="form-label">Ссылки на трекеры <span class="text-danger">*</span></label>
			<textarea class="form-control" rows="10" id="download_url"
					  placeholder="Введите ссылки на трекеры (не прямые ссылки на торрент файл), каждую с новой строки. Справа или слева от ссылки можно указывать небольшую заметку, например номер серии."
					  name="download_url">{{old('download_url')}}</textarea>
		</div>
		<div class="mb-3">
			<p>Ссылки необходимо брать со следующих торент трекеров: <a href="https://kinozal-tv.appspot.com/" class="link-info" target="_blank">Kinozal</a>,
				<a href="http://rutor.is/" class="link-info" target="_blank">Rutor</a>, <a href="http://rutracker.org" class="link-info" target="_blank">Rutracker</a>,
				<a href="http://underverse.name/" class="link-info" target="_blank">Underverse</a>, <a href="http://tracker.green-teatv.com/" class="link-info" target="_blank">Green-tea</a>,
				<a href="http://nnmclub.to/" class="link-info" target="_blank">NNMclub.to</a>, <a href="http://nnm-club.me" class="link-info" target="_blank">NNM-club.me</a>.
				<br>Допускаются ссылки с других трекеров, но только в том случае, если на трекерах из нашего списка нет данного материала в том качестве или озвучке которая вам необходима.
			   В этом случае, при необходимости регистрации на вашем трекере, вместе с ссылкой на него также приклывайте ссылку на торрент файл, залитый в яндекс/мэйл/гугл облако.
				<b>Во всех других случаях ваша заявка будет отклонятся.</b><br><br>Если трекеры у вас заблокированы, то обойти блокировку можно с помощью
				<a href="https://chrome.google.com/webstore/detail/%D0%BE%D0%B1%D1%85%D0%BE%D0%B4-%D0%B1%D0%BB%D0%BE%D0%BA%D0%B8%D1%80%D0%BE%D0%B2%D0%BE%D0%BA-%D1%80%D1%83%D0%BD%D0%B5%D1%82%D0%B0/npgcnondjocldhldegnakemclmfkngch" class="link-info" target="_blank">этого</a> расширения.<br><br>Если же материала вообще нет ни на одном трекере, то вы можете залить файл на яндекс/мэйл/гугл облако и приложить ссылку.</p>
		</div>
		<button type="submit" class="btn btn-success">Добавить</button>
	</form>
@endsection