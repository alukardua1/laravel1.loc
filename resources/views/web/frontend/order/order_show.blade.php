@extends('web.frontend.layout.app')

@section('title', __('order.table_order'))

@section('content')
	<a href="{{route('tableOrderAdd')}}" class="btn btn-primary">Добавить заказ</a>
    {{__('order.table_order')}}
@endsection