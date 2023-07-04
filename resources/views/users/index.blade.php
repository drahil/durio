<x-layout>
    <body>
    <x-table>
        @php
            foreach ($users as $user){
               $user['reservations'] = '<a href="/users/' . $user->id . '/reservations">' . 'See reservations' . '</a>';
           }
        @endphp

        @if(\Illuminate\Support\Facades\Auth::guest())
            @php
                $users = $users->map(function ($user) {
                     return collect([
                         'id' => $user->id,
                         'name' => $user->name,
                         'email' => $user->email,
                         'reservations' => $user->reservations,
                     ]);
                 });
            @endphp
            <x-dynamic-table :data="$users" :headers="['ID', 'Name', 'Email', 'Reservations']"/>
        @else
            @admin
            <x-dynamic-table :data="$users" :headers="['ID', 'Name', 'Profit', 'Email', 'Reservations']"/>
            <li><a href="/users/create">Add a worker</a></li>
            @else
                @php
                    $users = $users->map(function ($user) {
                         return collect([
                             'id' => $user->id,
                             'name' => $user->name,
                             'email' => $user->email,
                             'reservations' => $user->reservations,
                         ]);
                     });
                @endphp
                <x-dynamic-table :data="$users" :headers="['ID', 'Name', 'Email', 'Reservations']"/>
                @endadmin
            @endif

    </x-table>

    </body>
</x-layout>


