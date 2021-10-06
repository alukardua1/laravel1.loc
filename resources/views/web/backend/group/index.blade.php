@extends('web.backend.layout.app')

@section('title', 'Редактирование новостей опубликованных на сайте')

@section('content')
	<div>
		<a class="btn btn-primary" href="#" type="button">Добавить</a>
	</div>
	<table class="table table-dark table-striped table-sm">
		<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Название</th>
			<th scope="col">Описание</th>
			<th scope="col">Действия</th>
		</tr>
		</thead>
		<tbody>
		@foreach($groupAll as $group)
			<tr>
				<th scope="row">
					{{$group->id}}
				</th>
				<td>
					<a href="#" style="color: {{$group->color}} !important;">{{$group->title}}</a>
				</td>
				<td>
					{{$group->description}}
				</td>
				<td>
					<a href="#"><i class="far fa-edit"></i></a>
					<a href="#"><i class="far fa-trash-alt"></i></a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	<!--Pagination-->
	@if($groupAll->total() > $groupAll->count())
		{{ $groupAll->links('web.frontend.vendor.pagination.bootstrap-4') }}
	@endif
	<!--Pagination-->
@endsection