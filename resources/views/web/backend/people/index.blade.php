@extends('web.backend.layout.app')

@section('title', 'Редактирование новостей опубликованных на сайте')

@section('content')
	<div>
		<a class="btn btn-outline-success" href="#" type="button">Добавить</a>
	</div>
	<div class="input-group mb-3">
		<input type="text" id="name" class="form-control" placeholder="Поиск" aria-label="Поиск" aria-describedby="name">
		<a type="button" class="btn btn-outline-primary btn-sm" id="nameBtn" href="#">Поиск</a>
	</div>
	<div class="alert alert-success" role="alert" id='searchsuggestions' style="display: none"></div>
	<table class="table table-dark table-striped table-sm">
		<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Имя по русски</th>
		</tr>
		</thead>
		<tbody>
		@foreach($people as $item)
			<tr>
				<th scope="row" class="id_row">
					{{$item->id}}
				</th>
				<td>
					<a href="{{route('#', $item->url)}}">{{$item->russian}} / {{$item->name}} <i class="far fa-edit"></i></a>
				</td>
				<td>
					<div class="btn-group">
						<a type="button" class="btn" href="{{route('#', $item->url)}}"><i class="far fa-edit"></i></a>
						<a type="button" class="btn" href="{{route('#',  $item->url)}}"><i class="far fa-trash-alt"></i></a>
					</div>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	<!--Pagination-->
	@if($people->total() > $people->count())
		{{ $people->links('web.frontend.vendor.pagination.bootstrap-4') }}
	@endif
	<!--Pagination-->
@endsection