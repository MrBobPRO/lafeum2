<a class="{{ $params['orderType'] }} @if($params['orderBy'] == $orderBy) active @endif"
    href="{{ route($modelTag . '.dashboard.index') . '?page=' . $params['currentPage'] . '&orderBy=' . $orderBy . '&orderType=' . $params['reversedOrderType'] }}">{{ $title }}
</a>
