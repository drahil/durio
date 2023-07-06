<x-layout>
    <body class="bg-white font-sans">
    <x-form.go-home-button/>
    <div class="container mx-auto px-4 py-8">

        @if(count($reservationsForGuest) > 0)
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                <tr>
                    <th class="px-4 py-2 bg-blue-500 text-white border-b border-gray-300">Reservation Date</th>
                    <th class="px-4 py-2 bg-blue-500 text-white border-b border-gray-300">Reservation Time</th>
                    <th class="px-4 py-2 bg-blue-500 text-white border-b border-gray-300">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($reservationsForGuest as $reservationForGuest)
                    <tr>

                        <td class="px-4 py-2 border-b border-gray-300">
                            {{ $reservationForGuest->date }}
                        </td>
                        <td class="px-4 py-2 border-b border-gray-300">
                            {{ $reservationForGuest->time }}
                        </td>

                        <td class="px-4 py-2 border-b border-gray-300">
                            @if($reservationForGuest->date < now())
                                <a href="{{ route('reservations.feedback', ['reservation' => $reservationForGuest]) }}" class="ml-2 text-blue-500 hover:text-blue-700">Give a feedback</a>
                            @else
                                <a href="{{ route('reservations.edit', $reservationForGuest) }}" class="ml-2 text-blue-500 hover:text-blue-700">Edit</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">No reservations.</p>
        @endif

        @if(Session::has('success'))
            <div class="mt-4 bg-green-200 text-green-800 px-4 py-2 rounded">
                {{ Session::get('success') }}
            </div>
        @endif
    </div>
    </body>
</x-layout>

