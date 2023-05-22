@extends('layouts.profile-app', ['pageClass' => 'profile-page'])

@section('leftbar')
    @include('layouts.profile-leftbar', ['title' => 'Профиль'])
@endsection

@section('main')
<div class="profiled-page-content profile-edit">
    <div class="profiled-page-content__inner">
        <div class="profiled-page-content__box">
            {{-- AVATAR --}}
            <div class="form-group edit-ava-group">
                <label class="label edit-ava-group__label" for="update-ava-input">Изменить фотографию профиля</label>

                <div class="edit-ava">
                    <form class="update-ava">
                        <img class="update-ava__img" src="{{ asset('img/users/' . $user->photo) }}" alt="{{ $user->name }}">
                        <input class="visually-hidden" type="file" name="photo" id="update-ava-input" accept=".png, .jpg, .jpeg">
                        <label class="update-ava__label submit" for="update-ava-input">Изменить аватарку</label>
                    </form>

                    <form class="remove-ava" action="{{ route('profile.remove-ava') }}" method="POST" data-on-submit="show-spinner">
                        @csrf
                        <button class="remove-ava__submit cancel">Удалить</button>
                    </form>
                </div>
            </div>

            {{-- Name --}}
            <form class="profile-edit__form" action="{{ route('profile.update') }}" method="POST">
                @csrf

                @error('name')
                    <label class="label" for="name">Имя пользователя. Пользователь с таким именем уже существует!<span class="required">*</span></label>
                @else
                    <label class="label" for="name">Имя пользователя<span class="required">*</span></label>
                @enderror

                <div class="profile-edit__form-divider">
                    <input class="input @error('name')input--error @enderror" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                    <button class="submit">Сохранить изменения</button>
                </div>
            </form>

            {{-- EMAIL --}}
            <form class="profile-edit__form" action="{{ route('profile.update') }}" method="POST" data-on-submit="show-spinner">
                @csrf
                @error('email')
                    <label class="label" for="email">Адрес E-mail. Пользователь с такой почтой уже существует!<span class="required">*</span></label>
                @else
                    <label class="label" for="email">Адрес E-mail<span class="required">*</span></label>
                @enderror

                <div class="profile-edit__form-divider">
                    <input class="input @error('email')input--error @enderror" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                    <button class="submit">Сохранить изменения</button>
                </div>
            </form>

            {{-- Password --}}
            <form class="profile-edit__form" action="{{ route('profile.update') }}" method="POST">
                @csrf
                <label class="label" for="password">Пароль<span class="required">*</span></label>

                <div class="profile-edit__form-divider">
                    <input class="input" type="password" name="password" id="password" placeholder="Старый пароль">
                    <input class="input" type="password" name="password_confirmation" placeholder="Новый пароль">
                    <button class="submit">Сохранить изменения</button>
                </div>
            </form>

            {{-- Country --}}
            <form class="profile-edit__form" action="{{ route('profile.update') }}" method="POST">
                @csrf
                <label class="label" for="country_id">Страна<span class="required">*</span></label>

                <div class="profile-edit__form-divider">
                    <select class="select" name="country_id" id="country_id">
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" @selected($country->id == $user->country_id)>{{ $country->name }}</option>
                        @endforeach
                    </select>

                    <button class="submit">Сохранить изменения</button>
                </div>
            </form>

            {{-- Age --}}
            <form class="profile-edit__form" action="{{ route('profile.update') }}" method="POST">
                @csrf
                <label class="label" for="age">Возраст</label>

                <div class="profile-edit__form-divider">
                    <input class="input" type="number" min="10" max="100" step="1" name="age" id="age" value="{{ old('age', $user->age) }}" required>
                    <button class="submit">Сохранить изменения</button>
                </div>
            </form>

            {{-- Gender --}}
            <form class="profile-edit__form" action="{{ route('profile.update') }}" method="POST">
                @csrf
                <label class="label" for="gender_id">Пол<span class="required">*</span></label>

                <div class="profile-edit__form-divider">
                    <select class="select" name="gender_id" id="gender_id">
                        @foreach ($genders as $gender)
                            <option value="{{ $gender->id }}" @selected($gender->id == $user->gender_id)>{{ $gender->name }}</option>
                        @endforeach
                    </select>

                    <button class="submit">Сохранить изменения</button>
                </div>
            </form>

            {{-- Biography --}}
            <form class="profile-edit__form" action="{{ route('profile.update') }}" method="POST">
                @csrf
                <label class="label" for="biography">Коротко о себе</label>

                <div class="profile-edit__form-divider profile-edit__form-divider-biography">
                    <textarea class="textarea" name="biography" rows="3" id="biography">{{ old('biography', $user->biography) }}</textarea>
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
