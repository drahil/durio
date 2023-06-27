<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Services</title>

        @vite('resources/css/app.css')
    </head>
    <body>
        @foreach($services as $service)
            {{ $service->name . ': ' . $service->price . ' euros'}} <br>
        @endforeach
    </body>
</html>
