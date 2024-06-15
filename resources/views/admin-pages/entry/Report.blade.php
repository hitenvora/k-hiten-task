@extends('../layouts/' . $layout)

@section('subhead')
    <title>Admin | Report </title>
@endsection

@section('subcontent')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">

    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Report</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            
        </div>
    </div>


    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-6">
            <div class="intro-y mt-8 overflow-auto sm:mt-0 lg:overflow-visible">
                <x-base.table class="border-separate border-spacing-y-[10px] sm:mt-2">
                    <x-base.table.thead>
                        <x-base.table.tr>
                            <x-base.table.th class="whitespace-nowrap border-b-0">
                                Date
                            </x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap border-b-0">
                                DATE PARTY
                            </x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap border-b-0 text-center">
                                Transaction Type
                            </x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap border-b-0 text-center">
                                Check No
                            </x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap border-b-0 text-center">
                                Rtgs No
                            </x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap border-b-0 text-center">
                                Rupees
                            </x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap border-b-0 text-center">
                                Balance
                            </x-base.table.th>
                            {{-- <x-base.table.th class="whitespace-nowrap border-b-0 text-center">
                                ACTIONS
                            </x-base.table.th> --}}
                        </x-base.table.tr>
                    </x-base.table.thead>
                    <x-base.table.tbody>
                        @foreach ($entries as $key => $entry)
                            @php
                                $totalBalance = 0;
                                $totalBalance += $cumulativeBalances[$entry->id];
                            @endphp
                            <x-base.table.tr class="intro-x">
                                <x-base.table.td
                                    class="w-40 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                    {{ \Carbon\Carbon::parse($entry->created_at)->format('d F Y') }}
                                </x-base.table.td>
                                <x-base.table.td
                                    class="border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                    {{ $entry->narration }}
                                </x-base.table.td>
                                <x-base.table.td
                                    class="border-b-0 bg-white text-center shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                    @if ($entry->payment_type == '0')
                                        CASH
                                    @elseif ($entry->payment_type == '1')
                                        CHECK
                                    @elseif ($entry->payment_type == '2')
                                        RTGS
                                    @endif
                                </x-base.table.td>
                                <x-base.table.td
                                    class="border-b-0 bg-white text-center shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                    {{ $entry->check_no ?? '' }}
                                </x-base.table.td>
                                <x-base.table.td
                                    class="border-b-0 bg-white text-center shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                    {{ $entry->rtgs_no ?? '' }}
                                </x-base.table.td>

                                <x-base.table.td
                                    class="border-b-0 bg-white text-center shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                    {{ $entry->rupee }}

                                </x-base.table.td>
                                <x-base.table.td
                                    class="border-b-0 bg-white text-center shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                    {{ $cumulativeBalances[$entry->id] }}
                                </x-base.table.td>
                            </x-base.table.tr>
                        @endforeach
                    </x-base.table.tbody>
                    <x-base.table.tr>
                        <x-base.table.td colspan="5" class="text-right font-bold">Subtotal:</x-base.table.td>
                        <x-base.table.td class="text-center font-bold">{{ $totalBalance ?? '0' }}</x-base.table.td>
                    </x-base.table.tr>

                </x-base.table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    {{-- <script src="https://cdn.tailwindcss.com/3.4.1"></script> --}}
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
           new DataTable('#example', {
                paging: false,
                layout: {
                    topStart: {
                        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
                    }
                }
            });
        });
    </script>
@endsection

@once
    @push('vendors')
        @vite('resources/js/vendor/tabulator/index.js')
        @vite('resources/js/vendor/lucide/index.js')
        @vite('resources/js/vendor/xlsx/index.js')
    @endpush
@endonce

@once
    @push('scripts')
        {{-- @vite('resources/js/pages/tabulator/index.js') --}}
    @endpush


    <script>
        function goToAddentryPage() {
            // Redirect to another page when the button is clicked     
            window.location.href = "{{ route('add.entry') }}";

        }
    </script>

@endonce
