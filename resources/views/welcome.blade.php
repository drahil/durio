<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Durio</title>

        @vite('resources/css/app.css')
    </head>
    <body>
        <ul>
            <li><a href="/users">Workers</a></li>
            <li><a href="/services">Services</a></li>
            <hr>
            @auth
                <li><a href="/reservations/create">Make a reservation</a></li>
                <li><a href="/logout">Logout</a></li>
            @else
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
            @endauth
        </ul>
    </body>
</html>
