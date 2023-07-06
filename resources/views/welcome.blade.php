<x-layout>
    <body class="font-sans">
    <nav class="bg-blue-500 py-4">
        <div class="container mx-auto px-4">
            <ul class="flex justify-between items-center">
                <li><a href="/users" class="text-white hover:text-gray-200">Workers</a></li>
                <li><a href="/services" class="text-white hover:text-gray-200">Services</a></li>
                <li>
                    <hr class="border-gray-700">
                </li>
                @auth
                    <li><a href="/reservations/create" class="text-white hover:text-gray-200">Make a reservation</a></li>
                    <li><a href="/reservations/my-reservations" class="text-white hover:text-gray-200">My reservations</a></li>
                    <li><a href="/change-password" class="text-white hover:text-gray-200">Change password</a></li>
                    <li><a href="/logout" class="text-white hover:text-gray-200">Logout</a></li>
                    <li class="text-white">{{ auth()->user()->name }}</li>
                @else
                    <li><a href="/login" class="text-white hover:text-gray-200">Login</a></li>
                    <li><a href="/register" class="text-white hover:text-gray-200">Register</a></li>
                @endauth
            </ul>
        </div>
    </nav>
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">My Reservations</h1>
        @auth
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
                            $reservation->date = \Carbon\Carbon::parse($reservation->date)->format('Y-m-d');
                        }
                    @endphp
                    <x-table>
                        <x-dynamic-table :data="$reservations" :headers="['Name', 'Email', 'Date', 'Time', 'Service']"/>
                    </x-table>
                </div>
            @else
                <h1 class="text-4xl text-center font-semibold mt-32">Durio's Hair Salon</h1>
                <p class="text-lg text-center text-gray-600 mt-4">Welcome to our salon. We provide top-notch hair services tailored to your needs.</p>
            @endif
        @else
            <h1 class="text-4xl text-center font-semibold mt-32">Durio's Hair Salon</h1>
            <p class="text-lg text-center text-gray-600 mt-4">Welcome to our salon. We provide top-notch hair services tailored to your needs.</p>
        @endauth
    </div>
    </body>
</x-layout>



