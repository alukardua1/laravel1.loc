@extends('web.frontend.layout.app')

@section('title', 'Регистрация нового пользователя')

@section('error')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            Регистрация нового пользователя
        </div>
        <form action="{{route('register')}}" method="post">
            <div class="card-body">
                @csrf
                <div class="mb-3 row">
                    <label for="login" class="col-sm-2 col-form-label">Логин</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="login" name="login">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control form-control-sm" id="email" name="email">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password1" class="col-sm-2 col-form-label">Пароль</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control form-control-sm" id="password1" name="password1">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password2" class="col-sm-2 col-form-label">Повторите пароль</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control form-control-sm" id="password2" name="password2">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Зарегестрироватся</button>
            </div>
        </form>
    </div>
@endsection