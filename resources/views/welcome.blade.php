<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Durio</title>

        @vite('resources/css/app.css')
    </head>
    <body>
        <ul>
            <li><a href="/workers">Workers</a></li>
            <li><a href="/services">Services</a></li>
        </ul>
    </body>
</html>
