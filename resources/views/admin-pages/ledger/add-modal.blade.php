@extends('../layouts/' . $layout)

@section('subhead')
    <title>Admin | ledger</title>
@endsection

@section('subcontent')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">

    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Ledger</h2>
        {{-- <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <x-base.button data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview" href="#" as="a"
                variant="primary" style="margin: 2px;">
                Add New Ledger
            </x-base.button>
        </div> --}}
    </div>


    <!-- BEGIN: HTML Table Data -->
    {{-- <div class="intro-y box mt-5 p-5"> --}}
    <div class="col-span-12 mt-6">
        <div class="intro-y mt-8 overflow-auto sm:mt-0 lg:overflow-visible">
            <x-base.table class="border-separate border-spacing-y-[10px] sm:mt-2">
                <x-base.table.tbody>
                    <x-base.table.tr class="intro-x">
                        <x-base.table.td
                            class="w-40 border-b-0 text-center text-white bg-primary shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                            <a href="{{ route('ledgers', 'type=SUNDRY DEBTORS') }}">
                                SUNDRY DEBTORS
                            </a>
                        </x-base.table.td>
                    </x-base.table.tr>

                    <x-base.table.tr class="intro-x">
                        <x-base.table.td
                            class="w-40 border-b-0 text-center text-white bg-primary shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                            <a href="{{ route('ledgers', 'type=SUNDRY DEBTORS (E-COMMERCE)') }}">
                                SUNDRY DEBTORS (E-COMMERCE)
                            </a>
                        </x-base.table.td>
                    </x-base.table.tr>

                    <x-base.table.tr class="intro-x">
                        <x-base.table.td
                            class="w-40 border-b-0 text-center text-white bg-primary shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                            <a href="{{ route('ledgers', 'type=SUNDRY DEBTORS (FIELD STAFF)') }}">
                                SUNDRY DEBTORS (FIELD STAFF)
                            </a>
                        </x-base.table.td>
                    </x-base.table.tr>

                    {{-- <x-base.table.tr class="intro-x">

                            <x-base.table.td
                                class="w-40 border-b-0 text-center text-white bg-primary shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                SUNDRY DEBTORS (E-COMMERCE)
                            </x-base.table.td>
                        </x-base.table.tr>
                        <x-base.table.tr class="intro-x">

                            <x-base.table.td
                                class="w-40 border-b-0 text-center text-white bg-primary shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                SUNDRY DEBTORS (FIELD STAFF)

                            </x-base.table.td>
                        </x-base.table.tr> --}}
                    <x-base.table.tr class="intro-x">
                        <x-base.table.td
                            class="w-40 border-b-0 text-center text-white bg-primary shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                            <a href="{{ route('ledgers', 'type=SUNDRY CREDITORS') }}">
                                SUNDRY CREDITORS
                            </a>
                        </x-base.table.td>
                    </x-base.table.tr>

                    <x-base.table.tr class="intro-x">
                        <x-base.table.td
                            class="w-40 border-b-0 text-center text-white bg-primary shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                            <a href="{{ route('ledgers', 'type=SUNDRY CREDITORS (E-COMMERCE)') }}">
                                SUNDRY CREDITORS (E-COMMERCE)
                            </a>
                        </x-base.table.td>
                    </x-base.table.tr>

                    <x-base.table.tr class="intro-x">
                        <x-base.table.td
                            class="w-40 border-b-0 text-center text-white bg-primary shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                            <a href="{{ route('ledgers', 'type=SUNDRY CREDITORS (EXPENSES PAYABLE)') }}">
                                SUNDRY CREDITORS (EXPENSES PAYABLE)
                            </a>
                        </x-base.table.td>
                    </x-base.table.tr>

                    <x-base.table.tr class="intro-x">
                        <x-base.table.td
                            class="w-40 border-b-0 text-center text-white bg-primary shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                            <a href="{{ route('ledgers', 'type=SUNDRY CREDITORS (FIELD STAFF)') }}">
                                SUNDRY CREDITORS (FIELD STAFF)
                            </a>
                        </x-base.table.td>
                    </x-base.table.tr>

                    <x-base.table.tr class="intro-x">
                        <x-base.table.td
                            class="w-40 border-b-0 text-center text-white bg-primary shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                            <a href="{{ route('ledgers', 'type=SUNDRY CREDITORS (MANUFACTURERS)') }}">
                                SUNDRY CREDITORS (MANUFACTURERS)
                            </a>
                        </x-base.table.td>
                    </x-base.table.tr>

                    <x-base.table.tr class="intro-x">
                        <x-base.table.td
                            class="w-40 border-b-0 text-center text-white bg-primary shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                            <a href="{{ route('ledgers', 'type=SUNDRY CREDITORS (SUPPLIERS)') }}">
                                SUNDRY CREDITORS (SUPPLIERS)
                            </a>
                        </x-base.table.td>
                    </x-base.table.tr>

                    <x-base.table.tr class="intro-x">
                        <x-base.table.td
                            class="w-40 border-b-0 text-center text-white bg-primary shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                            <a href="{{ route('bank.list') }}">
                                BANK
                            </a>
                        </x-base.table.td>
                    </x-base.table.tr>
                    <x-base.table.tr class="intro-x">
                        <x-base.table.td
                            class="w-40 border-b-0 text-center text-white bg-primary shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                            <a href="{{ route('stock-in-hand.list') }}">
                                Stock in Hand
                            </a>
                        </x-base.table.td>
                    </x-base.table.tr>
                    <x-base.table.tr class="intro-x">
                        <x-base.table.td
                            class="w-40 border-b-0 text-center text-white bg-primary shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                            <a href="{{ route('profite-loss.list') }}">
                                Profite And Loss
                            </a>
                        </x-base.table.td>
                    </x-base.table.tr>
                </x-base.table.tbody>
            </x-base.table>
        </div>
    </div>
    {{-- </div> --}}
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
        function goToAddLedgerPage() {
            // Redirect to another page when the button is clicked     
            // window.location.href = "{{ route('ledgers') }}";

        }
    </script>

@endonce
