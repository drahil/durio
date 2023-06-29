<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Durio</title>

        @vite('resources/css/app.css')
    </head>
    <body>
        <x-table>
            @php
                foreach ($users as $user){
                   $user['reservations'] = '<a href="/users/' . $user->id . '/reservations">' . 'See reservations' . '</a>';
               }
            @endphp
            <x-dynamic-table :data="$users" :headers="['ID', 'Name', 'Profit', 'Email', 'Reservations']"/>
        </x-table>

    </body>
</html>
