@extends('web.backend.layout.app')

@section('title', 'Редактирование аниме опубликованных на сайте')

@section('content')
	<div>
		<a class="btn btn-outline-success" href="{{route('createAnimeAdmin')}}" type="button">Добавить</a>
	</div>
	<div class="input-group mb-3">
		<input type="text" id="name" class="form-control" placeholder="Поиск" aria-label="Поиск" aria-describedby="name">
		<a type="button" class="btn btn-outline-primary btn-sm" id="nameBtn" href="#">Поиск</a>
	</div>
	<div class="alert alert-success" role="alert" id='searchsuggestions' style="display: none"></div>
	<table class="table table-dark table-striped table-sm">
		<thead>
		<tr>
			<th scope="col">Дата</th>
			<th scope="col">Название</th>
			<th scope="col">Просмотров</th>
			<th scope="col">Комментариев</th>
			<th scope="col">Опубликовано</th>
			<th scope="col">Категория</th>
			<th scope="col">Автор</th>
			<th scope="col">Действия</th>
		</tr>
		</thead>
		<tbody>
		@foreach($index as $item)
			<tr>
				<th scope="row" class="id_row">
					<ul class="list-group-flush">
						<li class="list-group-item">Обновлено: {{\Carbon\Carbon::parse($item->updated_at)->format('d.m.Y')}}</li>
						<li class="list-group-item">Добавлено: {{\Carbon\Carbon::parse($item->created_at)->format('d.m.Y')}}</li>
					</ul>
				</th>
				<td>
					<a href="{{route('editAnimeAdmin', $item->id)}}">{{$item->russian}} / {{$item->name}} <i class="far fa-edit"></i></a>
				</td>
				<td>
					{{$item->read_count}}
				</td>
				<td>
					{{$item->getComments()->withTrashed()->count()}}
				</td>
				<td>
					{!! $item->posted_at ? '<i class="fa fa-check-circle"></i>' : '<i class="fa fa-exclamation-circle"></i>' !!}
				</td>
				<td>
					@foreach($item->getCategory as $category)
						@if ($loop->last)
							{{$category->title}}
						@else
							{{$category->title}},
						@endif
					@endforeach
				</td>
				<td>
					{{$item->getUser->login}}
				</td>
				<td>
					<div class="btn-group">
						<a type="button" class="btn" href="{{route('editAnimeAdmin', $item->id)}}"><i class="far fa-edit"></i></a>
						<a type="button" class="btn" href="{{route('deleteAnimeAdmin',  $item->id)}}"><i class="far fa-trash-alt"></i></a>
					</div>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	<!--Pagination-->
	@if($index->total() > $index->count())
		{{ $index->links('web.frontend.vendor.pagination.bootstrap-4') }}
	@endif
	<!--Pagination-->
@endsection