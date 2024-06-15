@extends('../layouts/' . $layout)

@section('subhead')
    <title>Admin | Order List</title>
@endsection

@section('subcontent')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">

    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Order</h2>
    </div>

    <!-- BEGIN: HTML Table Data -->
    <div class="intro-y box mt-5 p-5">
        <div class="scrollbar-hidden overflow-x-auto">
            <div class="overflow-x-auto">
                <table data-tw-merge class="w-full text-left" id="example">
                    <thead data-tw-merge class="">
                        <tr data-tw-merge
                            class="[&amp;amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                Order ID
                            </th>
                            {{--  <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                Customer Name
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                Customer Contact Number
                            </th> --}}
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                Order Date
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                Sub Total
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                Taxes
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                Total
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap ">
                                ACTIONS
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($orders as $item)
                            <tr data-tw-merge
                                class="[&amp;amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    O-ID: {{ $item->id }}
                                </td>
                                {{-- <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    {{ $item->customer_name ?? "-" }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    {{ $item->customer_contact_number ?? "-" }}
                                </td> --}}
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    {{-- {{ number_format(floatval($item->sub_total), 2) }} --}}
                                    {{ $item->sub_total ?? 0 }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    {{-- {{ number_format(floatval($item->total_text), 2) }} --}}
                                    {{ $item->total_text ?? 0 }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    {{-- {{ number_format(floatval($item->total), 2) }} --}}
                                    {{ $item->total ?? 0 }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300  "
                                    style="display: flex;">
                                    <!-- BEGIN: Medium Modal Toggle -->
                                    <x-base.button class="mb-2 mr-1" data-tw-toggle="modal"
                                        data-tw-target=".modalid-{{ $count }}" href="#" as="a"
                                        variant="primary">
                                        Order Receipt
                                    </x-base.button>
                                    <a href="{{ Route('app.print.order.web', $item->id) }}" class=" mt-2" variant="primary"
                                        target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" icon-name="printer"
                                            data-lucide="printer" class="lucide lucide-printer  mx-auto ">
                                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                            <path
                                                d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                                            </path>
                                            <rect x="6" y="14" width="12" height="8"></rect>
                                        </svg>
                                    </a>

                                    {{-- <a href="{{ route('returnProductAdd') }}"><x-base.lucide class="mx-auto block"
                                            icon="ArrowDown" /></a> --}}

                                    <a href="{{ route('returnProductAdd', $item->id) }}"><x-base.lucide
                                            class="mx-auto block" icon="RotateCw" /></a>
                                    <!-- END: Medium Modal Toggle -->
                                </td>
                                <!-- BEGIN: Medium Modal Content -->
                                <x-base.dialog id="medium-modal-size-preview" class="modalid-{{ $count }}">
                                    <x-base.dialog.panel class="p-10 text-center">
                                        @php
                                            $Allproducts = getOrderReceipt($item->id);
                                        @endphp
                                        <div class="" id="printableArea" style="padding: 5mm; width: 100mm;">
                                            @php
                                                $final_price = [];
                                                $i = 0;
                                            @endphp
                                            @foreach ($Allproducts as $key => $products)
                                                @if ($loop->index != 0)
                                                    <div class="page-break"></div>
                                                @endif

                                                <div class="bg-gray-200 mt-20 p-4" style="background-color: #d9d9d9;">
                                                    <div class="bg-gray-200 p-4">
                                                        <div class="border-b-2 border-gray-600 text-center">
                                                            <div id="logo" class="text-center">
                                                                <img src="{{ asset('invoice/Group 8398.png') }}"
                                                                    class="w-64 mx-auto" alt="Logo">
                                                            </div>
                                                            <p style="border-top: 2px solid #6c6c6c;">GSTIN :-
                                                                24DΧΟΡK2946B1ZI
                                                            </p>
                                                            <p style="border-bottom: 2px solid #6c6c6c;">FSSAI NO. :-
                                                                10721031000133</p>
                                                            <h4 class="font-bold">Kahnaiya Dairy Mota Varaccha</h4>
                                                            <p>Silverstone Archade, Near Causeway</p>
                                                            <p>Dabholi Road, Katargam</p>
                                                            <p>Surat-395004</p>
                                                            <h4 class="font-bold" style="border-bottom: 2px solid #6c6c6c;">
                                                                Phone : 079-6846483</h4>
                                                            <h4 class="font-bold">TAX INVOICE</h4>
                                                        </div>

                                                        <div class="grid grid-cols-3 text-center mt-4">
                                                            <div>Particulars</div>
                                                            <div>Qty.</div>
                                                            <div>Rate</div>
                                                        </div>

                                                        @php
                                                            $total_price = [];
                                                            $total_qty = [];
                                                            $total_taxes = [];
                                                            $total_amount = [];
                                                        @endphp

                                                        {{-- @foreach ($products as $item)
                                                            <div class="grid grid-cols-3 text-center mt-4">
                                                                <div>{{ $item->Product->product_name ?? '' }}</div>
                                                                <div>{{ $item->product_quntity ?? '1' }}</div>
                                                                <div>&#8377;{{ $item->sub_total ?? '' }}</div>
                                                            </div>
                                                            @php
                                                                $final_price[] += $item->total_amount ?? '0';
                                                                $total_amount[] += $item->total_amount ?? '0';
                                                                $total_taxes[] += $item->taxes ?? 1;
                                                                $total_qty[] += $item->product_quntity ?? 1;
                                                                $total_price[] += $item->sub_total ?? '0';
                                                            @endphp
                                                        @endforeach --}}

                                                        @if (!empty($products) && (is_array($products) || is_object($products)))
                                                            @foreach ($products as $item)
                                                                <div class="grid grid-cols-3 text-center mt-4">
                                                                    <div>{{ $item->Product->product_name ?? '' }}</div>
                                                                    <div>{{ $item->product_quntity ?? '1' }}</div>
                                                                    <div>&#8377;{{ $item->sub_total ?? '' }}</div>
                                                                </div>
                                                                @php
                                                                    $final_price[] += $item->total_amount ?? '0';
                                                                    $total_amount[] += $item->total_amount ?? '0';
                                                                    $total_taxes[] += $item->taxes ?? 1;
                                                                    $total_qty[] += $item->product_quntity ?? 1;
                                                                    $total_price[] += $item->sub_total ?? '0';
                                                                @endphp
                                                            @endforeach
                                                        @else
                                                            <p>No products available</p>
                                                        @endif



                                                        <div class="grid grid-cols-3 border-t-2  text-center mt-4"
                                                            style="border-bottom: 2px solid #6c6c6c;">
                                                            {{-- <div class="font-bold">ITEM: {{ count($products) }}
                                                            </div> --}}
                                                            <div class="font-bold">ITEM:
                                                                {{ isset($products) && (is_countable($products) ? count($products) : 0) }}
                                                            </div>

                                                            <div class="font-bold">Qty: {{ array_sum($total_qty) }}</div>
                                                            <div class="font-bold">
                                                                &#8377;{{ number_format(array_sum($total_price), 2) }}
                                                            </div>
                                                        </div>

                                                        <div class="grid grid-cols-3 text-center mt-4"
                                                            style="border-bottom: 2px solid #6c6c6c;">
                                                            <div class="font-bold">Taxes</div>
                                                            <div class="font-bold"></div>
                                                            <div class="font-bold">
                                                                &#8377;{{ number_format(array_sum($total_taxes), 2) }}
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="grid grid-cols-3 border-t-2 border-gray-600 text-center mt-4">
                                                            {{-- <div class="font-bold">ITEM: {{ count($products) }}</div> --}}
                                                            <div class="font-bold">ITEM:
                                                                {{ isset($products) && (is_countable($products) ? count($products) : 0) }}
                                                            </div>

                                                            <div class="font-bold">Qty: {{ array_sum($total_qty) }}</div>
                                                            <div class="font-bold">
                                                                &#8377;{{ number_format(array_sum($total_amount), 2) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </x-base.dialog.panel>
                                </x-base.dialog>
                                <!-- END: Medium Modal Content -->
                            </tr>
                            @php $count++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- END: HTML Table Data -->
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
                pagingType: 'simple_numbers',
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
        function goToAddCategoriePage() {
            // Redirect to another page when the button is clicked      
        }
    </script>
@endonce
