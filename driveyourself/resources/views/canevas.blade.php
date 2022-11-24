<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])
</head>

<body>

    <header>

        <h2 id="test">Drive Yourself - @yield('header')</h2>

    </header>

    <nav>
        <ul>
            <li><a href="{{url('/')}}">Acceuil</a> </li>
            <li><a href="{{url('/path')}}">Parcours</a></li>

        </ul>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        DriveYourself Inc. - Esi Team
    </footer>

</body>



</html>