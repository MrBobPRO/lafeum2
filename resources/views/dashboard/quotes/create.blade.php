@extends('dashboard.layouts.app', [
    'breadcrumbs' => ['Цитаты', 'Добавить'],

    'actions' => ['store'],
])

@section('main')
    <form class="form" id="create-form" action="{{ route($modelTag . '.store') }}" method="POST">
        @csrf

        @include('dashboard.form.create.single-select', [
            'label' => 'Автор',
            'name' => 'author_id',
            'required' => true,
            'options' => $authors,
            'valueColumnName' => 'id',
            'titleColumnName' => 'name',
        ])

        @include('dashboard.form.create.multiple-select', [
            'label' => 'Категория',
            'name' => 'categories[]',
            'required' => true,
            'options' => $categories,
            'valueColumnName' => 'id',
            'titleColumnName' => 'name',
        ])

        @include('dashboard.form.create.wysiwyg-textarea', [
            'label' => 'Текст цитаты',
            'name' => 'body',
            'required' => true,
        ])

        @include('dashboard.form.create.wysiwyg-textarea', [
            'label' => 'Мысли автора',
            'name' => 'notes',
            'required' => false,
        ])

        @include('dashboard.form.create.input-date-time', [
            'label' => 'Дата публикации',
            'name' => 'publish_at',
            'required' => false,
        ])

    </form>
@endsection
