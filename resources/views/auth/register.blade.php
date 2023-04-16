@extends('auth.app')

@section('form')
<form class="form register-form" action="{{ route('register') }}" method="POST">
    @csrf

    <h1 class="title">Регистрация</h1>
    <p class="desc">
        <a href="{{ route('login') }}">У Вас есть аккаунт?</a>
    </p>

    <div class="form-group {{ $errors->get('name') ? 'form-group--error' : ($errors->any() ? 'form-group--valid' : '') }}">
        <label class="label" for="name">Имя, Фамилия</label>
        <input class="input" type="text" name="name" id="name" placeholder="Как вас зовут?" value="{{ old('name') }}" required>
    </div>

    <div class="form-group {{ $errors->get('email') ? 'form-group--error' : ($errors->any() ? 'form-group--valid' : '') }}">
        <label class="label" for="email">{{ $errors->get('email') ? 'Пользователь с такой электронной почтой уже существует' : 'Ваш Email' }}</label>
        <input class="input" type="email" name="email" id="email" placeholder="Введите Ваш Email" value="{{ old('email') }}" required>
    </div>

    <div class="form-group {{ $errors->get('password') ? 'form-group--error' : '' }}">
        <label class="label" for="password">{{ $errors->get('password') ? (in_array('validation.min.string', $errors->get('password')) ? 'Минимальная длина пароли 6 символов' : 'Пароли не совпадают') : 'Пароль' }}</label>
        <input class="input" type="password" name="password" id="password" autocomplete="new-password" placeholder="Введите Ваш пароль" minlength="6" required>
    </div>

    <div class="form-group {{ $errors->get('password') ? 'form-group--error' : '' }}">
        <label class="label" for="password_confirmation">{{ $errors->get('password') ? (in_array('validation.confirmed', $errors->get('password')) ? 'Пароли не совпадают' : 'Подтверждения пароля') : 'Подтверждения пароля' }}</label>
        <input class="input" type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" placeholder="Повторите пароль" minlength="6" required>
    </div>

    <button class="submit">Регистрация</button>
</form>
@endsection
