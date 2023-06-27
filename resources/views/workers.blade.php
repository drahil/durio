<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Durio</title>

        @vite('resources/css/app.css')
    </head>
    <body>
        <x-table>
            @php
                foreach ($workers as $worker){
                   $worker['reservations'] = '<a href="/workers/' . $worker->id . '/reservations">' . 'See reservations' . '</a>';
               }
            @endphp
            <x-dynamic-table :data="$workers" :headers="['ID', 'Name', 'Profit', 'Email', 'Reservations']"/>
        </x-table>

    </body>
</html>
