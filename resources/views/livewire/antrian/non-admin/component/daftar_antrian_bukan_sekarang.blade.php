<table class="w-full table-auto mt-3">
    <thead>
        <tr class="bg-neutral-100 text-left font-bold">
            <th class="px-2 py-4 text-center">No</th>
            <th class="px-2 py-4 text-center">Tanggal</th>
            <th class="px-2 py-4 text-center">Antrian</th>
        </tr>
    </thead>
    <tbody>
        <template x-for="(value, index) in {!!$data!!}">
            <tr class="focus-within:bg-grey-lightest hover:bg-gray-200 py-10">
                <td class="border-t items-center text-center">
                    <span class="py-1" x-text="index + 1"></span>
                </td>
                <td class="border-t">
                    <span class="py-1" x-text="value.tanggal"></span>
                </td>
                <td class="border-t">
                    <span class="py-1" x-text="value.antrian"></span>
                </td>
            <tr>
        </template>
    <tbody>
</table>