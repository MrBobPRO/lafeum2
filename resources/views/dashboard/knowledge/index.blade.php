@extends('dashboard.layouts.app', [
    'breadcrumbs' => [
        'Область знаний - ' . count($allItems) . ' элементов'
    ],

    'actions' => [
        'create',
        'multiselect',
        'multiple-destroy',
        'edit-nestedset'
    ]
])

@section('main')
    @include('dashboard.searches.linked', ['titleColumn' => 'name'])

    <div class="table-container">
        @include('dashboard.tables.knowledge')
    </div>

    @include('dashboard.modals.single-destroy')
    @include('dashboard.modals.multiple-destroy')
@endsection
