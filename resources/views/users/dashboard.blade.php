<x-layout>
    <body class="bg-white font-sans">
    <nav class="bg-blue-500 py-4">
        <div class="container mx-auto px-4">
            <ul class="flex justify-between items-center">
                <li><a href="/users" class="text-white hover:text-gray-200">Workers</a></li>
                <li><a href="/services" class="text-white hover:text-gray-200">Services</a></li>
                <li><hr class="border-gray-700"></li>
                <li><a href="/reservations/create" class="text-white hover:text-gray-200">Make a reservation</a></li>
                <li><a href="/change-password" class="text-white hover:text-gray-200">Change password</a></li>
                <li><a href="/logout" class="text-white hover:text-gray-200">Logout</a></li>
                <li class="text-gray-300">{{ auth()->user()->name }}</li>
            </ul>
        </div>
    </nav>

    @if(auth()->user()->role === 'worker')
        <div class="container mx-auto mt-8">
            @php
                $reservations = \App\Models\Reservation::where('worker_id', '=', auth()->id())
                    ->join('users', 'reservations.user_id', '=', 'users.id')
                    ->join('services', 'reservations.service_id', '=', 'services.id')
                    ->select('users.name', 'users.email', 'reservations.date', 'reservations.time', 'services.type')
                    ->orderBy('reservations.date')
                    ->get();
                foreach ($reservations as $reservation) {
                    $reservation->date = \Carbon\Carbon::parse($reservation->date)->format('Y-m-d');;
                }
            @endphp

            <x-table>
                <x-dynamic-table :data="$reservations" :headers="['Name', 'Email', 'Date', 'Time', 'Service']"/>
            </x-table>
        </div>
    @endif
    </body>
</x-layout>


