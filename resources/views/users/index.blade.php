<x-layout>
    <body>
    <x-form.go-home-button/>
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
                <a href="{{route('createUser')}}" class="mt-6 bg-blue-500 text-white text-center uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600 w-64">
                    Add a worker
                </a>
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


