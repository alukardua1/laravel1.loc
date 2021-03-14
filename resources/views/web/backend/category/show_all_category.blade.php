@extends('web.backend.layout.app')

@section('content')
	<table class="table table-dark">
		<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Название</th>
			<th scope="col">Опубликовано</th>
		</tr>
		</thead>
		<tbody>
		@foreach($allCategory as $category)
			<tr>
				<th scope="row">
					{{$category->id}}
				</th>
				<td>
					<a href="{{route('editAnimeAdmin', $category->url)}}">{{$category->title}}</a>
				</td>
				<td>
					{!! $category->posted_at ? '<i class="fa fa-check-circle"></i>' : '<i class="fa fa-exclamation-circle"></i>' !!}
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection