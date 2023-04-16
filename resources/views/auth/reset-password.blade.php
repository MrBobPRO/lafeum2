@extends('auth.app')

@section('form')
<form class="form login-form" action="{{ route('password.store') }}" method="POST">
    @csrf

    <h1 class="title">Обновить пароль</h1>

    {{-- Password Reset Token --}}
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="form-group">
        <label class="label" for="email">Ваш Email</label>
        <input class="input" type="email" name="email" id="email" placeholder="Введите Ваш Email" value="{{ $request->email }}" required readonly>
    </div>

    <div class="form-group {{ $errors->get('password') ? 'form-group--error' : '' }}">
        <label class="label" for="password">{{ $errors->get('password') ? (in_array('validation.min.string', $errors->get('password')) ? 'Минимальная длина пароли 6 символов' : 'Пароли не совпадают') : 'Новый пароль' }}</label>
        <input class="input" type="password" name="password" id="password" autocomplete="new-password" placeholder="Введите новый пароль" minlength="6" required autofocus>
    </div>

    <div class="form-group {{ $errors->get('password') ? 'form-group--error' : '' }}">
        <label class="label" for="password_confirmation">{{ $errors->get('password') ? (in_array('validation.confirmed', $errors->get('password')) ? 'Пароли не совпадают' : 'Подтверждения пароля') : 'Подтверждения пароля' }}</label>
        <input class="input" type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" placeholder="Повторите пароль" minlength="6" required>
    </div>

    <button class="submit">Обновить пароль</button>
</form>
@endsection
