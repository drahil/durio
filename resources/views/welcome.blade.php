<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Durio</title>

        @vite('resources/css/app.css')
    </head>
    <body>
        @foreach($workers as $worker)
            {{ $worker->name }} <br>
        @endforeach

    </body>
</html>
