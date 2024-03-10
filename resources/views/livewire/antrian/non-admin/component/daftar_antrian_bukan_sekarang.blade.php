@if (count($data) > 0)
    <table class="w-full table-auto mt-3">
        <thead>
            <tr class="bg-neutral-100 text-left font-bold">
                <th class="px-2 py-4 text-center">No</th>
                <th class="px-2 py-4 text-center">Layanan</th>
                <th class="px-2 py-4 text-center">Tanggal</th>
                <th class="px-2 py-4 text-center">Antrian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr class="focus-within:bg-grey-lightest hover:bg-gray-200 py-10">
                    <td class="border-t items-center text-center">
                        <!-- {{$loop->index + 1}} -->
                    </td>
                    <td class="border-t">
                        {{$item->satker->nama}}
                        <br>
                        {{$item->layanan->nama}}
                    </td>
                    <td class="border-t">
                        {{$item->tanggal}}
                    </td>
                    <td class="border-t">
                        {{$item->antrian}}
                    </td>
                <tr>
            @endforeach
        <tbody>
    </table>
@else
    <p class="hide"></p>
@endif
