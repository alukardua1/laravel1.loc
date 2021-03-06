@extends('web.backend.layout.app')

@section('title', 'Редактирование категорий')

@section('content')
	<div class="mb-3">
		<a class="btn btn-primary" href="{{route('addCategoryAdmin')}}" type="button">Добавить</a>
	</div>
	<table class="table table-dark table-striped table-sm">
		<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Название</th>
			<th scope="col">Опубликовано</th>
			<th scope="col">Действия</th>
		</tr>
		</thead>
		<tbody>
		@foreach($allCategory as $category)
			<tr>
				<th scope="row">
					{{$category->id}}
				</th>
				<td>
					<a href="{{route('editCategoryAdmin', $category->url)}}">{{$category->title}}</a>
				</td>
				<td>
					{!! $category->posted_at ? '<i class="fa fa-check-circle"></i>' : '<i class="fa fa-exclamation-circle"></i>' !!}
				</td>
				<td>
					<i class="far fa-edit"></i>
					<a href="{{route('deleteCategoryAdmin', $category->url)}}"><i class="far fa-trash-alt"></i></a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection