<x-layout>
    <body class="bg-white font-sans">
    <div class="container mx-auto px-4 py-8">
        @if(isset($reservations) && count($reservations) > 0)
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                <tr>
                    <th class="px-4 py-2 bg-blue-500 text-white border-b border-gray-300">Reservation Date</th>
                    <th class="px-4 py-2 bg-blue-500 text-white border-b border-gray-300">Reservation Time</th>
                    @admin
                    <th class="px-4 py-2 bg-blue-500 text-white border-b border-gray-300">Actions</th>
                    @endadmin
                </tr>
                </thead>
                <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td class="px-4 py-2 border-b border-gray-300">
                            @if(!auth()->check())
                                @if($reservation->date >= now())
                                    {{ $reservation->date }}
                                @endif
                            @else
                                @admin
                                {{ $reservation->date }}
                                @else
                                    @if($reservation->date >= now())
                                        {{ $reservation->date }}
                                    @endif
                                @endadmin
                            @endif
                        </td>
                        <td class="px-4 py-2 border-b border-gray-300">
                            @if(!auth()->check())
                                @if($reservation->time >= now())
                                    {{ $reservation->time }}
                                @endif
                            @else
                                @admin
                                    {{ $reservation->time }}
                                @else
                                    @if($reservation->time >= now())
                                        {{ $reservation->time }}
                                    @endif
                                @endadmin
                            @endif
                        </td>
                        @admin
                        <td class="px-4 py-2 border-b border-gray-300">
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                            <a href="{{ route('reservations.edit', $reservation) }}" class="ml-2 text-blue-500 hover:text-blue-700">Edit</a>
                        </td>
                        @endadmin
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


