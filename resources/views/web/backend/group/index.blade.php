@extends('web.backend.layout.app')

@section('title', 'Редактирование новостей опубликованных на сайте')

@section('content')
	<div>
		<a class="btn btn-primary" href="{{route('addGroupAdmin')}}" type="button">Добавить</a>
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
					<a href="{{route('editGroupAdmin', $group->title)}}" style="color: {{$group->color}} !important;">{{$group->title}}</a>
				</td>
				<td>
					{{$group->description}}
				</td>
				<td>
					<a href="{{route('editGroupAdmin', $group->title)}}"><i class="far fa-edit"></i></a>
					@if (in_array($group->id, [1,2,3,4]))
						<a href="{{route('deleteGroupAdmin', $group->title)}}" class="disabled"><i class="far fa-trash-alt"></i></a>
					@else
						<a href="{{route('deleteGroupAdmin', $group->title)}}"><i class="far fa-trash-alt"></i></a>
					@endif
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