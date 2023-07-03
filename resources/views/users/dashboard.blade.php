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
        <li><a href="/reservations/create">Make a reservation</a></li>
        <li><a href="/change-password">Change password</a></li>
        <li><a href="/logout">Logout</a></li>
        <li class="float-right">{{ auth()->user()->name }}</li>
        @if(auth()->user()->role === 'worker')
            <div>
                @php
                    $reservations = \App\Models\Reservation::where('worker_id', '=', auth()->id())
                        ->join('users', 'reservations.user_id', '=', 'users.id')
                        ->join('services', 'reservations.service_id', '=', 'services.id')
                        ->select('users.name', 'users.email', 'reservations.date', 'services.type')
                        ->get();
                @endphp

                <x-table>
                    <x-dynamic-table :data="$reservations" :headers="['Name', 'Email', 'Date and Time', 'Service']"/>
                </x-table>
            </div>
        @endif
    </ul>
</body>
</html>
