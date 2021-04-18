@extends('web.frontend.layout.app')

@section('title', 'Сброс пароля')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('login.reset_password') }}</div>
        <form method="POST" action="{{ route('password.email') }}">
            <div class="card-body row">
                @if (session('status'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @csrf
                <div class="col-auto">
                    <label for="staticEmail" class="visually-hidden">{{ __('login.email_address') }}</label>
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ __('login.email_address') }}">
                </div>
                <div class="col">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="mail@example.com" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"> {{ __('login.send_reset_link') }}</button>
            </div>
        </form>
    </div>
@endsection