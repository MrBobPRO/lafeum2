@extends('layouts.app', ['pageClass' => 'contacts-page', 'includeRightBar' => false])

@section('main')
<div class="contacts">
    <div class="contacts__inner">
        <div class="contacts__about">
            <h1 class="contacts-about__title main-title">Контакты</h1>
            <p class="contacts-about__desc">
                Мы рады, что Вы посетили наш сайт и ознакомились с находящейся на нем информацией. Вся информация
                находится в свободном доступе и предназначена только для частного пользования. Если Вы считаете, что
                Ваша работа была размещена на нашем сайте в нарушение Вашего авторского права, сообщите нам об этом,
                используя обратную связь. Будем рады рассмотреть Ваши рекомендации по усовершенствованию сайта.
            </p>

            <p class="contacts-about__mail">
                <strong>Электронная почта:</strong><br>
                <a href="mailto:info@lafeum.ru">info@lafeum.ru</a>
            </p>
        </div>

        <div class="feedback">
            <h2 class="feedback__title main-title">Свяжитесь с нами</h2>

            <form class="feedback-form" action="{{ route('feedback.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="label" for="name">Ваше имя<span class="required">*</span></label>
                    <input class="input" type="text" name="name" id="name" required>
                </div>

                <div class="form-group">
                    <label class="label" for="email">Ваша почта<span class="required">*</span></label>
                    <input class="input" type="email" name="email" id="email" required>
                </div>

                <div class="form-group">
                    <label class="label" for="topic">Тема</label>
                    <input class="input" type="text" name="topic" id="topic">
                </div>

                <div class="form-group">
                    <label class="label" for="message">Текст<span class="required">*</span></label>
                    <textarea class="textarea" name="message" id="message" rows="5" required></textarea>
                </div>

                <button class="feedback-form__submit submit">Отправить</button>
            </form>
        </div>
    </div>
</div>
@endsection
