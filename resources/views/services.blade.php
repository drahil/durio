<x-layout>
    <body>
        <x-form.go-home-button/>
        <x-table>
            <x-dynamic-table :data="$services" :headers="['id', 'Service', 'Price']"/>
        </x-table>
    </body>
</x-layout>

