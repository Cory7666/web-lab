<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $page_title }} / Проект</title>
    <script type="module" src="/lib/script/init_DateTimeNavbarPlaceholder.js"></script>
    <script type="module" src="/lib/script/init_ComplexSubmenu.js"></script>
    <script type="module">
        import { setCurrentDocument } from "/lib/script/init_History.js"
        setCurrentDocument("{{ $internal_path }}");
    </script>

    @yield('styles')
    @yield('scripts')
</head>

<body>
    <nav id="navbar">
        <div>
            @foreach ([['/', '/'], ['/fotos/', '/ Фотоальбом'], ['/about/', '/ О проекте']] as $item)
                <a @if ('/about/' == $item[0]) id="aboutMenuItem" @endif
                    @if ($internal_path == $item[0]) class="youre-here" @endif
                    href="{{ $item[0] }}">{{ $item[1] }}</a>
            @endforeach
        </div>
        <div>
            <a href="/test/">/ Тест</a>
            <a id="datetime-placeholder"></a>
        </div>
    </nav>

    <div id="content-container" class="flex">
        <div id="sidenav">
            @yield('sidenav')
        </div>
        <div id="content">
            @yield('content')
        </div>
    </div>
</body>

</html>
