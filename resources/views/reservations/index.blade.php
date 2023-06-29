<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Services</title>

        @vite('resources/css/app.css')
    </head>
    <body>
    @php
        foreach($reservations as $reservation){
            $data[] = collect($reservation->date);
        }
    @endphp
        <x-table>
            <x-dynamic-table :data="$data" :headers="['Date and Time']"/>
        </x-table>

    </body>
</html>
