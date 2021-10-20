@extends('web.frontend.layout.app')

@section('title', __('order.table_order'))

@section('content')
	<div class="mb-3">
		<a href="{{route('createTableOrder')}}" class="btn btn-primary">Добавить заказ</a>
	</div>

	<table id="dtBasicExample" class="table table-dark table-striped" width="100%">
		<thead>
		<tr>
			<th class="th-sm">#</th>
			<th class="th-sm">Статус</th>
			<th class="th-sm">Название</th>
			<th class="th-sm">Озвучка</th>
			<th class="th-sm">WA</th>
			<th class="th-sm">КП</th>
			<th class="th-sm">ImDB</th>
			<th class="th-sm">Shikimori</th>
			<th class="th-sm">Добавлен</th>
			<th class="th-sm">Обновлен</th>
		</tr>
		</thead>
		<tbody>
		@foreach($allTableOrder as $value)
			<tr>
				<td>{{$value->id}}</td>
				<td>{{$value->status}}</td>
				<td><a href="{{route('showTableOrder', $value->id)}}">{{$value->name_rus}} / {{$value->name_origin}}</a></td>
				<td>{{$value->getTranslate->name}}</td>
				<td>
					@if ($value->wa_url)
						<a target="_blank" href="{{$value->wa_url}}">WA</a>
					@endif
				</td>
				<td>
					@if ($value->kp_url)
						<a target="_blank" href="{{$value->kp_url}}">КП</a>
					@endif
				</td>
				<td>
					@if ($value->imdb_url)
						<a target="_blank" href="{{$value->imdb_url}}">ImDB</a>
					@endif
				</td>
				<td>
					@if ($value->shikimori_url)
						<a target="_blank" href="{{$value->shikimori_url}}">Shikimori</a>
					@endif
				</td>
				<td>{{$value->created_at}}</td>
				<td>{{$value->updated_at}}</td>
			</tr>
		@endforeach
		<tfoot>
		{{$allTableOrder->links('web.frontend.vendor.pagination.semantic-ui')}}
		</tfoot>
	</table>
@endsection