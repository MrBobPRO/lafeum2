@extends('auth.app')

@section('form')
    <form class="form verification-send-form" action="{{ route('verification.send') }}" method="POST">
        @csrf
        <p class="desc">
            @if (session('status') == 'verification-link-sent')
                <strong>На ваш адрес электронной почты, только что была отправлена новая ссылка для подтверждения!</strong><br><br>
            @endif

            Спасибо за регистрацию! Прежде чем начать, не могли бы вы подтвердить свой адрес электронной почты,
            перейдя по ссылке, которую мы только что отправили вам по электронной почте? Если вы не получили электронное
            письмо, мы с радостью вышлем вам другое.
        </p>
        <button class="submit">Выслать повторно</button>
    </form>

    <form class="form logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="submit">Выйти из аккаунта</button>
    </form>
@endsection
