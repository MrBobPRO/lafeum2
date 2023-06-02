<table class="table" cellpadding="8" cellspacing="10">
    {{-- Head start --}}
    <thead>
        <tr>
            {{-- Empty space for checkbox --}}
            <th width="20"></th>

            <th>Цитата</th>
            <th>Автор</th>
            <th width="130">Мысли автора</th>
            <th>Категории</th>
            <th width="130">Опубликовано</th>
        </tr>
    </thead> {{-- Head end --}}

    {{-- Body start --}}
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td>@include('dashboard.tables.checkbox')</td>
                <td><div class="limited-three-lines">{!! $item->body !!}</div></td>
                <td>{{ $item->author }}</td>
                <td>{{ $item->notes }}</td>

                <td>
                    @foreach ($item->categories as $category)
                        {{ $category->name }}<br>
                    @endforeach
                </td>

                <td>{{ $item->publish_at }}</td>
            </tr>
        @endforeach
    </tbody> {{-- Body end --}}
</table>
