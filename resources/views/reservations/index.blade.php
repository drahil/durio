<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Services</title>

        @vite('resources/css/app.css')
    </head>
    <body>
        @php
            foreach($reservations as $reservation){
                $reservation['date'] = collect($reservation->date);
            }
        @endphp
            @if(isset($reservations))
                <x-table>
{{--                    <x-dynamic-table :data="$reservations" :headers="['Date and Time', 'Delete']"/>--}}
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->date }}</td>
                            <td>
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </x-table>
            @else
                {{'No reservations.'}}
            @endif
    </body>
</html>

{{--<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">--}}
{{--    <form method="POST" action="/admin/posts/{{ $post->id }}">--}}
{{--        @csrf--}}
{{--        @method('DELETE')--}}

{{--        <button class="text-xs text-gray-400">Delete</button>--}}
{{--    </form>--}}
{{--</td>--}}
