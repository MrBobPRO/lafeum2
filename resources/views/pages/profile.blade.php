@extends('layouts.profile-app', ['pageClass' => 'profile-page'])

@section('leftbar')
    @include('layouts.profile-leftbar', ['title' => 'Профиль'])
@endsection

@section('main')
<div class="profile-edit">
    <div class="profile-edit__inner">
        <div class="profile-edit__box">
            {{-- AVATAR --}}
            <div class="form-group edit-ava-group">
                <label class="label" for="update-ava-input">Изменить фотографию профиля</label>

                <div class="edit-ava">
                    <form class="update-ava" action="POST">
                        <img class="update-ava__img" src="{{ asset('img/users/' . $user->photo) }}" alt="{{ $user->name }}">
                        <input class="visually-hidden" type="file" name="photo" id="update-ava-input" accept=".png, .jpg, .jpeg">
                        <label class="update-ava__label submit" for="update-ava-input">Изменить аватарку</label>
                    </form>

                    <form class="remove-ava" action="POST">
                        @csrf
                        <button class="remove-ava__submit cancel">Удалить</button>
                    </form>
                </div>
            </div>

            {{-- Name --}}
            <form class="profile-edit__form">
                <label class="label" for="name">Имя пользователя<span class="required">*</span></label>

                <div class="profile-edit__form-divider">
                    <input class="input" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                    <button class="submit">Сохранить изменения</button>
                </div>
            </form>

            {{-- EMAIL --}}
            <form class="profile-edit__form">
                <label class="label" for="email">Адрес E-mail<span class="required">*</span></label>

                <div class="profile-edit__form-divider">
                    <input class="input" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                    <button class="submit">Сохранить изменения</button>
                </div>
            </form>

            {{-- EMAIL --}}
            <form class="profile-edit__form">
                <label class="label" for="phone">Номер телефона</label>

                <div class="profile-edit__form-divider">
                    <input class="input" type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}">
                    <button class="submit">Сохранить изменения</button>
                </div>
            </form>

            {{-- SECURITY NOTIFY --}}
            <div class="profile-security">
                <h4 class="profile-security__title">Текст о безопасности личных данных</h4>
                <p class="profile-security__desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id sit nisi, varius purus euismod. Blandit urna eu erat est. Urna arcu.</p>
            </div>
        </div>
    </div>
</div>
@endsection
