@extends('auth.app')

@section('form')
<form class="form login-form" action="{{ route('login') }}" method="POST">
    @csrf

    <h1 class="title">Вход</h1>
    <p class="desc">Добро пожаловать, мы ждали Вас !</p>

    <div class="form-group {{ $errors->get('email') ? 'form-group--error' : ($errors->any() ? 'form-group--valid' : '') }}">
        <label class="label" for="email">{{ $errors->get('email') ? 'Неверный Email' : 'Ваш Email' }}</label>
        <input class="input" type="email" name="email" id="email" placeholder="Введите Ваш Email" value="{{ old('email') }}" required autofocus>
    </div>

    <div class="form-group {{ $errors->any() ? 'form-group--error' : '' }}">
        <label class="label" for="password">{{ $errors->get('password') ? 'Неверный пароль' : 'Пароль' }}</label>
        <input class="input" type="password" name="password" id="password" autocomplete="current-password" placeholder="Введите Ваш пароль" required>
    </div>

    <div class="additional-links">
        <a class="additional-links__register" href="{{ route('register') }}">У вас нет аккаунта?</a>
        <a class="additional-links__forgot" href="{{ route('password.request') }}">Забыли пароль?</a>
    </div>

    <button class="submit">Вход</button>
</form>
@endsection
