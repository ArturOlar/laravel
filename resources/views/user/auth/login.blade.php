@extends('user.layout.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header">Авторизация</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Введите email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Введите пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">Запомнить меня</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Войти</button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">Забыли свой пароль?</a>
                                    <a class="btn btn-link" href="{{ route('register') }}">Регистрация</a>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4 offset-4 mt-3">
                            <div class="form-group row mb-0 mb-2">
                                <span><b>Войти через:</b></span>
                            </div>

                            <div class="form-group row mb-0">
                                <a class="mr-1" href="{{ route('auth-facebook') }}">
                                    <img class="login-icon-sign" src="{{ asset('storage/images/facebook.png') }}" alt="">
                                </a>
                                <a href="{{ route('auth-github') }}">
                                    <img class="login-icon-sign" src="{{ asset('storage/images/github.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                    </form>

                    <div class="mt-5 py-3 border-top">
                        <p><b>Что-бы войти как администратор. Используйте:</b></p>
                        <p>Логин: <b>admin@admin.com</b></p>
                        <p>Пароль: <b>12345678</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
