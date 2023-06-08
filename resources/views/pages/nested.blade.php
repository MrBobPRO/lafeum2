<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}" /> --}}
</head>

<body>
    <ol class="sortable">
        <li id="menuItem_1">
            <div>Some content (id=1)</div>
        </li>

        <li id="menuItem_2">
            <div>Nested (id=2)</div>
            <ol>
                <li id="menuItem_3">
                    <div>Child 1 (id=3)</div>
                </li>

                <li id="menuItem_4">
                    <div>Child 2 (id=4)</div>
                    <span title="Click to delete item" data-id="4" class="deleteMenu">x</span>
                </li>
            </ol>
        </li>

        <li id="menuItem_5">
            <div>Some content (id=5)</div>
        </li>
    </ol>

    <button onclick="toArraySortable()">to Array</button>

    <script src="{{ asset('plugins/jquery/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/jq-nested/jq-nested-sortable.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('.sortable').nestedSortable({
                handle: 'div',
                items: 'li',
                toleranceElement: '> div',
                isTree: true,
                excludeRoot: true,
                maxLevels: 2
            });
        });

        function toArraySortable() {
            let arraied = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});

            console.log(arraied);
        }

        $('.deleteMenu').click(function() {
            var id = $(this).attr('data-id');
            $('#menuItem_'+id).remove();
        });
    </script>
</body>

</html>
