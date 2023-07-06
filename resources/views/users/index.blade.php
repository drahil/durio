<x-layout>
    <body>
    <x-form.go-home-button/>
    <x-table>
        @php
            foreach ($users as $user){
               $user['profile'] = '<a href="/users/' . $user->id . '">' . 'See profile' . '</a>';
           }
        @endphp
        @if(\Illuminate\Support\Facades\Auth::guest())
            @php
                $users = $users->map(function ($user) {
                     return collect([
                         'id' => $user->id,
                         'name' => $user->name,
                         'email' => $user->email,
                         'rating' => $user->rating,
                         'profile' => $user->profile,
                     ]);
                 });
            @endphp
            <x-dynamic-table :data="$users" :headers="['ID', 'Name', 'Email', 'Rating', 'Profile']"/>
        @else
            @admin
                <x-dynamic-table :data="$users" :headers="['ID', 'Name', 'Profit', 'Email', 'Rating', 'Profile']"/>
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
                             'rating' => $user->rating,
                             'profile' => $user->profile,
                         ]);
                     });
                @endphp
                <x-dynamic-table :data="$users" :headers="['ID', 'Name', 'Email', 'Rating', 'Profile']"/>
            @endadmin
        @endif

    </x-table>
    </body>
</x-layout>


