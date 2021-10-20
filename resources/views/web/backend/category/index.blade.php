@extends('web.backend.layout.app')

@section('title', 'Редактирование категорий')

@section('content')
	<div class="mb-3">
		<a class="btn btn-primary" href="{{route('createCategoryAdmin')}}" type="button">Добавить</a>
	</div>
	<table class="table table-dark table-striped table-sm">
		<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Название</th>
			<th scope="col">Описание</th>
			<th scope="col">Опубликовано</th>
			<th scope="col">Действия</th>
		</tr>
		</thead>
		<tbody>
		@foreach($all as $item)
			<tr>
				<th scope="row">
					{{$item->id}}
				</th>
				<td>
					<a href="{{route('editCategoryAdmin', $item->url)}}">{{$item->title}}</a>
				</td>
				<td>
					{!! $item->description !!}
				</td>
				<td>
					{!! $item->posted_at ? '<i class="fa fa-check-circle"></i>' : '<i class="fa fa-exclamation-circle"></i>' !!}
				</td>
				<td>
					<div class="btn-group">
						<a type="button" class="btn" href="{{route('editCategoryAdmin', $item->url)}}"><i class="far fa-edit"></i></a>
						<a type="button" class="btn" href="{{route('deleteCategoryAdmin', $item->url)}}"><i class="far fa-trash-alt"></i></a>
					</div>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection