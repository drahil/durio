@props(['data', 'headers'])

<div class="overflow-x-auto mt-8">
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
        <tr>
            @foreach ($headers as $header)
                <th class="px-4 py-2 bg-blue-500 text-white uppercase font-semibold text-xs border-b border-gray-300">{{ $header }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $row)
            <tr>
                @foreach ($row->toArray() as $cell)
                    <td class="px-4 py-2 border-b border-gray-300">{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


