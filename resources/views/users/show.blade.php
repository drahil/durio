<x-layout>
    <body class="bg-white font-sans">
    <x-form.go-home-button/>
    <div class="container mx-auto px-4 py-8">
        <div class="text-center">
            <h1 class="text-3xl font-bold mb-4">{{ $user->name }}</h1>
            <p class="text-gray-600">{{ $user->email }}</p>
        </div>

        <div class="my-8">
            <p class="text-lg">{{ $user->description }}</p>
        </div>

        <div class="flex items-center justify-center">
            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white text-xl font-bold mr-2">{{ $user->rating }}</div>
            <span class="text-gray-600">Rating: {{ $user->rating }}/5</span>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="mb-4">
            <h1 class="text-2xl font-bold">Feedback from customers:</h1>
        </div>
        <div class="bg-white rounded-lg shadow">
            @if(count($user->feedback) > 0)
                @foreach($user->feedback as $feedback)
                    <div class="p-4 border-b">
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-gray-800">{{ $feedback->body }}</p>
                            <div class="flex items-center">
                                <span class="text-gray-500 mr-2">Rating:</span>
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $feedback->rating)
                                            <svg class="h-5 w-5 text-yellow-500 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M10 0l2.59 6.3 6.71.61-5.14 4.71 1.54 6.7L10 15.4l-5.7 3.32 1.54-6.7L1.7 7.92l6.71-.61L10 0zm0 2.1l-1.99 4.86H2.1l4.24 3.88L5.9 17.9l4.25-2.46 4.24 2.46-1.44-6.06L17.9 7.86h-6.09L10 2.1z"/>
                                            </svg>
                                        @else
                                            <svg class="h-5 w-5 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M10 0l2.59 6.3 6.71.61-5.14 4.71 1.54 6.7L10 15.4l-5.7 3.32 1.54-6.7L1.7 7.92l6.71-.61L10 0zm0 2.1l-1.99 4.86H2.1l4.24 3.88L5.9 17.9l4.25-2.46 4.24 2.46-1.44-6.06L17.9 7.86h-6.09L10 2.1z"/>
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="p-4 border-b">
                    <p class="text-gray-500">No feedback yet.</p>
                </div>
            @endif

        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        @if(count($reservations) > 0)
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
                @foreach ($reservations as $reservation)
                    @php
                        $reservation->date = \Carbon\Carbon::parse($reservation->date)->format('Y-m-d')
                    @endphp
                    <tr>
                        @if(!auth()->check())
                            @if($reservation->date >= now())
                                <td class="px-4 py-2 border-b border-gray-300">
                                    {{ $reservation->date }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-300">
                                    {{ $reservation->time }}
                                </td>
                            @endif
                        @else
                            @admin
                            <td class="px-4 py-2 border-b border-gray-300">
                                {{ $reservation->date }}
                            </td>
                            <td class="px-4 py-2 border-b border-gray-300">
                                {{ $reservation->time }}
                            </td>
                            @else
                                @if($reservation->date >= now())
                                    <td class="px-4 py-2 border-b border-gray-300">
                                        {{ $reservation->date }}
                                    </td>
                                    <td class="px-4 py-2 border-b border-gray-300">
                                        {{ $reservation->time }}
                                    </td>
                                @endif
                                @endadmin
                            @endif
                            @if(auth()->check())
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

