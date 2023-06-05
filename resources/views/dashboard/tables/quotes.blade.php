<table class="table" cellpadding="8" cellspacing="10">
    {{-- Head start --}}
    <thead>
        <tr>
            {{-- Empty space for checkbox --}}
            <th width="20"></th>

            <th>Цитата</th>

            <th width="220">
                @include('dashboard.tables.thead-link', ['orderBy' => 'author', 'title' => 'Автор'])
            </th>

            <th width="200">Категории</th>

            <th width="220">
                @include('dashboard.tables.thead-link', ['orderBy' => 'notes', 'title' => 'Мысли автора'])
            </th>

            <th width="170">
                @include('dashboard.tables.thead-link', ['orderBy' => 'publish_at', 'title' => 'Опубликовано'])
            </th>

            <th width="140">Действие</th>
        </tr>
    </thead> {{-- Head end --}}

    {{-- Body start --}}
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td>@include('dashboard.tables.checkbox')</td>
                <td><div class="limited-three-lines">{!! $item->body !!}</div></td>
                <td>{{ $item->author }}</td>

                <td>
                    @foreach ($item->categories as $category)
                        {{ $category->name }}<br>
                    @endforeach
                </td>

                <td><div class="limited-three-lines">{!! $item->notes !!}</div></td>
                <td>{{ $item->publish_at }}</td>

                <td class="table__actions">
                    @include('dashboard.tables.view-button', ['href' => route($modelTag . '.show', $item->id)])
                    @include('dashboard.tables.edit-button')
                    @include('dashboard.tables.destroy-button')
                </td>
            </tr>
        @endforeach
    </tbody> {{-- Body end --}}
</table>

{{ $items->links('dashboard.layouts.pagination') }}
