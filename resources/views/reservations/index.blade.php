<x-layout>
    <body class="bg-white font-sans">
    <x-form.go-home-button/>
    <div class="container mx-auto px-4 py-8">

        @if(count($reservationsForWorker) > 0)
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                <tr>
                    <th class="px-4 py-2 bg-blue-500 text-white border-b border-gray-300">Reservation Date</th>
                    <th class="px-4 py-2 bg-blue-500 text-white border-b border-gray-300">Reservation Time</th>
                    @if(auth()->check())
                        @admin
                            <th class="px-4 py-2 bg-blue-500 text-white border-b border-gray-300">Actions</th>
                        @endadmin
                    @endif

                </tr>
                </thead>
                <tbody>
                @foreach ($reservationsForWorker as $reservationForWorker)
                    <tr>
                        @if(!auth()->check())
                            @if($reservationForWorker->date >= now())
                                <td class="px-4 py-2 border-b border-gray-300">
                                    {{ $reservationForWorker->date }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-300">
                                    {{ $reservationForWorker->time }}
                                </td>
                            @endif
                        @else
                            @admin
                                <td class="px-4 py-2 border-b border-gray-300">
                                    {{ $reservationForWorker->date }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-300">
                                    {{ $reservationForWorker->time }}
                                </td>
                            @else
                                @if($reservationForWorker->date >= now())
                                    <td class="px-4 py-2 border-b border-gray-300">
                                        {{ $reservationForWorker->date }}
                                    </td>
                                    <td class="px-4 py-2 border-b border-gray-300">
                                        {{ $reservationForWorker->time }}
                                    </td>
                                @endif
                            @endadmin
                        @endif
                        @if(auth()->check())
                            @admin
                                <td class="px-4 py-2 border-b border-gray-300">
                                    <form action="{{ route('reservations.destroy', $reservationForWorker->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                    </form>
                                    <a href="{{ route('reservations.edit', $reservationForWorker) }}" class="ml-2 text-blue-500 hover:text-blue-700">Edit</a>
                                </td>
                            @endadmin
                        @endif
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

