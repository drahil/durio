{{--<x-layout>--}}
{{--    <body class="bg-gray-100 font-sans">--}}
{{--        <nav class="bg-gray-800 py-4">--}}
{{--            <div class="container mx-auto px-4">--}}
{{--                <ul class="flex justify-between items-center">--}}
{{--                    <li><a href="/users" class="text-gray-300 hover:text-white">Workers</a></li>--}}
{{--                    <li><a href="/services" class="text-gray-300 hover:text-white">Services</a></li>--}}
{{--                    <li>--}}
{{--                        <hr class="border-gray-700">--}}
{{--                    </li>--}}

{{--                    <li><a href="/reservations/create" class="text-gray-300 hover:text-white">Make a reservation</a></li>--}}
{{--                    <li><a href="/change-password" class="text-gray-300 hover:text-white">Change password</a></li>--}}
{{--                    <li><a href="/logout" class="text-gray-300 hover:text-white">Logout</a></li>--}}
{{--                    <li class="text-gray-300">{{ auth()->user()->name }}</li>--}}

{{--                    @if(auth()->user()->role === 'worker')--}}
{{--                        <div>--}}
{{--                            @php--}}
{{--                                $reservations = \App\Models\Reservation::where('worker_id', '=', auth()->id())--}}
{{--                                    ->join('users', 'reservations.user_id', '=', 'users.id')--}}
{{--                                    ->join('services', 'reservations.service_id', '=', 'services.id')--}}
{{--                                    ->select('users.name', 'users.email', 'reservations.date', 'services.type')--}}
{{--                                    ->get();--}}
{{--                            @endphp--}}

{{--                            <x-table>--}}
{{--                                <x-dynamic-table :data="$reservations" :headers="['Name', 'Email', 'Date and Time', 'Service']"/>--}}
{{--                            </x-table>--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                </ul>--}}
{{--            </div>--}}
{{--        </nav>--}}
{{--    </body>--}}
{{--</x-layout>--}}
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
                    ->select('users.name', 'users.email', 'reservations.date', 'services.type')
                    ->get();
            @endphp

            <x-table>
                <x-dynamic-table :data="$reservations" :headers="['Name', 'Email', 'Date and Time', 'Service']"/>
            </x-table>
        </div>
    @endif
    </body>
</x-layout>


