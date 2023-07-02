<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
    <head>
        <title>Services</title>

{{--        @vite('resources/css/app.css')--}}
    </head>
    <body>
            @if(isset($reservations))
                @foreach ($reservations as $reservation)
                    <tr>
                        @admin
                            <td>{{ $reservation->date }}</td><br>
                            <td>
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        @else
                            <td>@if($reservation->date >= now()) {{$reservation->date}} <br>@endif</td>
                        @endadmin
                    </tr>
                @endforeach
            @else
                {{'No reservations.'}}
            @endif

            @if(Session::has('success'))
                <div>
                    {{ Session::get('success') }}
                </div>
            @endif

            @if(Session::has('error'))
                <div>
                    {{ Session::get('error') }}
                </div>
            @endif

    </body>
</html>

