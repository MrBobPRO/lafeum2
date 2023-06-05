@extends('dashboard.layouts.app', [
    'breadcrumbs' => [
        'Все цитаты - ' . count($allItems) . ' элементов'
    ],

    'actions' => [
        'create',
        'multiselect'
    ]
])

@section('main')
    @include('dashboard.layouts.default-search', ['action' => route('quotes.dashboard.search')])

    <div class="table-container">
        <div class="table-container__inner">
            @include('dashboard.tables.quotes', ['quotes' => $items])
        </div>
    </div>

    @include('dashboard.modals.single-destroy')
    @include('dashboard.modals.multiple-destroy')
@endsection
