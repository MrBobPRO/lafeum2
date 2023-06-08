@extends('dashboard.layouts.app', [
    'breadcrumbs' => [
        'Область знаний',
        'Изменить структуру',
    ],

    'actions' => [
        'update-structure'
    ]
])

@section('main')
    @include('dashboard.layouts.nested-set')
@endsection
