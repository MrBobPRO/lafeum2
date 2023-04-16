@extends('auth.app')

@section('form')
<form class="form login-form" action="{{ route('password.email') }}" method="POST">
    @csrf

    <p class="desc">
        @if (session('status'))
            <b>{{ session('status') }}</b><br><br>
        @endif

        Забыли пароль? Без проблем. Просто сообщите нам свой адрес электронной почты, и мы отправим вам ссылку для сброса пароля, которая позволит вам выбрать новый.
    </p>

    <div class="form-group {{ $errors->get('email') ? 'form-group--error' : '' }}">
        <label class="label" for="email">{{ $errors->get('email') ? 'Пользователья с таким адресом электронной почты не существует' : 'Ваш Email' }}</label>
        <input class="input" type="email" name="email" id="email" placeholder="Введите Ваш Email" value="{{ old('email') }}" required autofocus>
    </div>

    <button class="submit">Запросить ссылку</button>

    <p class="return-home">
        <a href="{{ route('home') }}">Вернуться на главную</a>
    </p>
</form>
@endsection
