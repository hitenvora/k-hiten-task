@extends('../layouts/' . $layout)

@section('subhead')
    <title>Admin | Entry </title>
@endsection

@section('subcontent')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">

    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Entry</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <x-base.button class="mr-2 shadow-md" onclick="goToAddentryPage()" variant="primary">
                Add New Entry
            </x-base.button>
        </div>
    </div>


    <x-base.tab.list class="" variant="link-tabs">
        <!-- BEGIN: Link Tab -->
        <x-base.preview-component class="intro-y box mt-5" style="width: 100%;">
            <div class="p-5">
                <x-base.preview>
                    <x-base.tab.group>
                        <x-base.tab.list variant="link-tabs">
                            <x-base.tab id="example-5-tab" selected>
                                <x-base.tab.button class="w-full py-2" as="button">
                                    Purchase Entry
                                </x-base.tab.button>
                            </x-base.tab>
                            <x-base.tab id="example-6-tab">
                                <x-base.tab.button class="w-full py-2" as="button">
                                    Sale Entry
                                </x-base.tab.button>
                            </x-base.tab>
                        </x-base.tab.list>
                        <x-base.tab.panels class="mt-5">
                            <x-base.tab.panel class="leading-relaxed" id="example-5" selected>
                                <div class="grid grid-cols-12 gap-6">
                                    <!-- BEGIN: Weekly Top Products -->
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
                                                            AMOUNT
                                                        </x-base.table.th>
                                                    </x-base.table.tr>
                                                </x-base.table.thead>
                                                <x-base.table.tbody>
                                                    @foreach ($PurchaseEntry as $item)
                                                        <x-base.table.tr class="intro-x">
                                                            <x-base.table.td
                                                                class="w-40 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                                                {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}
                                                            </x-base.table.td>
                                                            <x-base.table.td
                                                                class="border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                                                {{ $item->narration }}
                                                            </x-base.table.td>
                                                            <x-base.table.td
                                                                class="border-b-0 bg-white text-center shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                                                @if ($item->payment_type == '0')
                                                                    CASH
                                                                @endif
                                                                @if ($item->payment_type == '1')
                                                                    CHECK
                                                                @endif
                                                                @if ($item->payment_type == '2')
                                                                    RTGS
                                                                @endif
                                                            </x-base.table.td>
                                                            <x-base.table.td
                                                                class="w-40 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                                                &#8377; {{ $item->rupee }} @if ($item->credit_debit == '0')
                                                                    Credit
                                                                @elseif($item->credit_debit == '1')
                                                                    Debit
                                                                @endif

                                                            </x-base.table.td>
                                                        </x-base.table.tr>
                                                    @endforeach
                                                </x-base.table.tbody>
                                            </x-base.table>
                                        </div>
                                    </div>
                                </div>
                            </x-base.tab.panel>
                            <x-base.tab.panel class="leading-relaxed" id="example-6">
                                <div class="grid grid-cols-12 gap-6">
                                    <!-- BEGIN: Weekly Top Products -->
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
                                                            AMOUNT
                                                        </x-base.table.th>
                                                    </x-base.table.tr>
                                                </x-base.table.thead>
                                                <x-base.table.tbody>
                                                    @foreach ($SaleEntry as $item)
                                                        <x-base.table.tr class="intro-x">
                                                            <x-base.table.td
                                                                class="w-40 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                                                {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}
                                                            </x-base.table.td>
                                                            <x-base.table.td
                                                                class="border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                                                {{ $item->narration }}
                                                            </x-base.table.td>
                                                            <x-base.table.td
                                                                class="border-b-0 bg-white text-center shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                                                @if ($item->payment_type == '0')
                                                                    CASH
                                                                @endif
                                                                @if ($item->payment_type == '1')
                                                                    CHECK
                                                                @endif
                                                                @if ($item->payment_type == '2')
                                                                    RTGS
                                                                @endif
                                                            </x-base.table.td>
                                                            <x-base.table.td
                                                                class="w-40 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                                                &#8377; {{ $item->rupee }} CR

                                                            </x-base.table.td>
                                                        </x-base.table.tr>
                                                    @endforeach
                                                </x-base.table.tbody>
                                            </x-base.table>
                                        </div>
                                    </div>
                                </div>
                            </x-base.tab.panel>
                        </x-base.tab.panels>
                    </x-base.tab.group>
                </x-base.preview>
            </div>
        </x-base.preview-component>
        <!-- END: Basic Tab -->
    </x-base.tab.list>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
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

        function getFirstClassByClassName(className) {
            var elements = $("." + className); // Select all elements with the specified class
            if (elements.length > 0) {
                var firstElementClass = elements.eq(0).attr('class'); // Get the class attribute of the first element
                var firstClass = firstElementClass.split(' ')[0]; // Extract the first class from the class attribute
                return firstClass;
            } else {
                return null; // Return null if no elements with the specified class are found
            }
        }

        // Usage
        var firstClass = getFirstClassByClassName("exampleClassName");
        console.log(firstClass);
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
    @endpush


    <script>
     
    </script>

@endonce
