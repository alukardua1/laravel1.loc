@extends('web.backend.layout.app')

@section('title', 'База фильмов, сериалов и аниме с сайта Kodik')

@section('content')
	<div class="card bg-dark">
		<div class="card-header">
			<div class="navbar navbar-expand-lg navbar-dark bg-dark">
				<div class="container-fluid" id="navbar-filter">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a href="{{route('kodikBaseList', 'movie')}}" class="legitRipple nav-link {{$active['movies']}}">Фильмы</a>
						</li>
						<li class="nav-item">
							<a href="{{route('kodikBaseList', 'serials')}}" class="legitRipple nav-link {{$active['serials']}}">Сериалы</a>
						</li>
						<li class="nav-item">
							<a href="{{route('kodikBaseList', 'anime')}}" class="legitRipple nav-link {{$active['anime']}}">Аниме</a>
						</li>
						<li class="nav-item">
							<a href="{{route('kodikBaseList', 'anime_serials')}}" class="legitRipple nav-link {{$active['anime_serials']}}">Аниме сериалы</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="card-body">
			@if (is_array($kodik['json']))
				<table id="dtBasicExample" class="table table-striped table-sm table-dark">
					<thead>
					<tr>
						<th class="th-sm">ID</th>
						<th class="th-sm">Название</th>
						<th class="th-sm">Год</th>
						<th class="th-sm">Серия</th>
						<th class="th-sm">Озвучивание</th>
						<th class="th-sm">Качество</th>
						<th class="th-sm">Дата</th>
					</tr>
					</thead>
					<tbody id="tbody_kodikValue">

					@foreach($kodik['json'] as $value)
						<tr>
							<th scope="row" class="id_row">
								<ul class="list-group-flush">
									@foreach($value['other_link'] as $link)
										<li class="list-group-item">{!! $link !!}</li>
									@endforeach
								</ul>
							</th>
							<td>{!! $value['link_update'] !!}</td>
							<td>{{$value['year']}}</td>
							<td>{!! $value['last_episode_update'] !!}</td>
							<td>{!! $value['translate_update'] !!}</td>
							<td>{{$value['quality']}}</td>
							<th scope="row" class="id_row">
								<ul class="list-group-flush">
									<li class="list-group-item">{{$value['updated_at']}}</li>
									<li class="list-group-item">{{$value['created_at']}}</li>
								</ul>
							</th>
						</tr>
					@endforeach
					</tbody>
					<tbody id="tbody_result" hidden>
					</tbody>
				</table>
			@else
				<div class="alert alert-danger" role="alert">
					{{ $kodik['json']}}
				</div>
			@endif
		</div>
		<div class="card-footer">
			<div class="btn-group" role="group">
				<a type="button" class="btn btn-primary btn-rounded {{$button['prev_page']}}" href="{{route('kodikBaseList', ['category'=>$cat['category'], 'page'=>$button['prev_page_link']])}}"><<<
																																																   Предыдущая</a>
				<a type="button" class="btn btn-primary btn-rounded {{$button['next_page']}}" href="{{route('kodikBaseList', ['category'=>$cat['category'], 'page'=>$button['next_page_link']])}}">Следующая
																																																   >>></a>
			</div>
		</div>
	</div>
@endsection