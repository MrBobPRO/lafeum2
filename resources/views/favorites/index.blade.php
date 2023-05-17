@extends('layouts.profile-app', ['pageClass' => 'favorites-page'])

@section('leftbar')
    @include('layouts.profile-leftbar', ['title' => 'Избранное'])
@endsection

@section('main')
<div class="profiled-page-content">
    <div class="profiled-page-content__inner">
        <div class="profiled-page-content__box">
            {{-- Create Folder --}}
            <div class="create-folder">
                <h3 class="create-folder__title">Добавить новую папку</h3>

                <form class="create-folder__form" action="{{ route('folders.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        @error('name')
                            <label class="label" for="name">Имя папки. Папка с таким именем уже существует!<span class="required">*</span></label>
                        @else
                            <label class="label" for="name">Имя папки<span class="required">*</span></label>
                        @enderror

                        <div class="create-folder__form-divider">
                            <input class="input @error('name')input--error @enderror" type="text" name="name" id="name" value="{{ old('name') }}" required>
                            <button class="submit">Добавить</button>
                        </div>
                    </div>
                </form>
            </div>


            {{-- Folders List --}}
            <div class="folders-list-container">
                <h3 class="folders-list-container__title">Список всех папок</h3>

                <div class="folders-list">
                    @foreach ($folders as $folder)
                        <div class="folders-list__item">
                            <a class="folders-list__link" href="{{ route('favorites.folder', $folder->slug) }}">
                                <span class="material-symbols-outlined">folder</span>
                                <p class="folders-list__name">{{ $folder->name }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
