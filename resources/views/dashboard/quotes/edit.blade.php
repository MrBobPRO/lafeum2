@extends('dashboard.layouts.app', [
    'breadcrumbs' => ['Цитаты', 'Редактировать', $item->id],

    'actions' => ['update', 'destroy'],
])

@section('main')
    <form class="form" id="edit-form" action="{{ route($modelTag . '.update') }}" method="POST">
        @csrf

        @include('dashboard.form.edit.single-select', [
            'label' => 'Автор',
            'name' => 'author_id',
            'required' => true,
            'options' => $authors,
            'relationName' => 'author',
            'valueColumnName' => 'id',
            'titleColumnName' => 'name',
        ])

        @include('dashboard.form.edit.multiple-select', [
            'label' => 'Категория',
            'name' => 'categories[]',
            'required' => true,
            'options' => $categories,
            'relationName' => 'categories',
            'valueColumnName' => 'id',
            'titleColumnName' => 'name',
        ])

        @include('dashboard.form.edit.wysiwyg-textarea', [
            'label' => 'Текст цитаты',
            'name' => 'body',
            'required' => true,
        ])

        @include('dashboard.form.edit.wysiwyg-textarea', [
            'label' => 'Мысли автора',
            'name' => 'notes',
            'required' => false,
        ])

        @include('dashboard.form.edit.input-date-time', [
            'label' => 'Дата публикации',
            'name' => 'publish_at',
            'required' => false,
        ])
    </form>

    @include('dashboard.modals.single-destroy', ['itemId' => $item->id])
@endsection
