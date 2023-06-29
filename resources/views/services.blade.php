<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Services</title>

        @vite('resources/css/app.css')
    </head>
    <body>
        <x-table>
            <x-dynamic-table :data="$services" :headers="['id', 'Service', 'Price']"/>
        </x-table>
    </body>
</html>
