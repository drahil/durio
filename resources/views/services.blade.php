<x-layout>
    <body>
        <x-table>
            <x-dynamic-table :data="$services" :headers="['id', 'Service', 'Price']"/>
        </x-table>
    </body>
</x-layout>

