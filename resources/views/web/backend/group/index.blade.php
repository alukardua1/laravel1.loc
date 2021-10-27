@extends('web.backend.layout.app')

@section('title', 'Редактирование групп пользователей')

@section('content')
	<div>
		<a class="btn btn-primary" href="{{route('createGroupAdmin')}}" type="button">Добавить</a>
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
		@foreach($index as $item)
			<tr>
				<th scope="row">
					{{$item->id}}
				</th>
				<td>
					<a href="{{route('editGroupAdmin', $item->title)}}" style="color: {{$item->color}} !important;">{{$item->title}}</a>
				</td>
				<td>
					{{$item->description}}
				</td>
				<td>
					<div class="btn-group">
						<a type="button" class="btn" href="{{route('editGroupAdmin', $item->title)}}"><i class="far fa-edit"></i></a>
						@if (in_array($item->id, [1,2,3,4]))
							<a type="button" class="btn disabled" href="{{route('deleteGroupAdmin', $item->title)}}"><i class="far fa-trash-alt"></i></a>
						@else
							<a type="button" class="btn" href="{{route('deleteGroupAdmin', $item->title)}}"><i class="far fa-trash-alt"></i></a>
						@endif
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