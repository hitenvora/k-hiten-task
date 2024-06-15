@extends('../layouts/' . $layout)

@section('subhead')
    <title>Admin | Order List</title>
@endsection

@section('subcontent')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Order</h2>
        @if (session('success'))
            <div id="successMessage" class="alert alert-success" style="color: green;font-size: 23px;margin-right: 530px;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div id="errorMessage" class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <x-base.button class="mr-2 shadow-md" onclick="goToAddCategoriePage()" variant="primary">
                Add New Order
            </x-base.button>
        </div>
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
                                ORDER DATE
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                DUE DATE
                            </th>
                            {{-- <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                Sub Total
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                Taxes
                            </th> --}}
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                TOTAL
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                STATUS
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
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
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M, Y') }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    {{ $item->bill_due_date }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    {{ $item->total ?? 0 }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    @if ($item->status == '1')
                                        <a href="{{ route('update.status.amin.order', $item->id) }}"> <span
                                                class="mr-1 rounded-full border border-success px-3 py-2 text-success dark:border-success">Paid</span>
                                        </a>
                                    @elseif ($item->status == '2')
                                        <a href="{{ route('update.status.amin.order', $item->id) }}"> <span
                                                class="mr-1 rounded-full border border-warning px-3 py-2 text-warning dark:border-warning">UnPaid</span>
                                        </a>
                                    @else
                                        <a href="{{ route('update.status.amin.order', $item->id) }}"><span
                                                class="mr-1 rounded-full border border-danger px-3 py-2 text-danger dark:border-danger">Pending</span>
                                        </a>
                                    @endif
                                </td>
                                @php
                                    // Assuming you have dynamic variables
                                    $recipientNumber = '+91' . $item->Customer->contact_number;
                                    $invoiceNo = 'O-ID:' . $item->id;
                                    $invoiceDate = \Carbon\Carbon::parse($item->created_at)->format('d M, Y');
                                    $dueDate = $item->bill_due_date;
                                    $totalAmount = $item->total;

                                    // Constructing the message
                                    $message = "Hello *kanaiya*,\n\n";
                                    $message .= "Thank you for doing business with *kanaiya*.\n";
                                    $message .= "Please find your invoice details below.\n\n";
                                    $message .= "Invoice No: $invoiceNo\n";
                                    $message .= "Invoice Date: $invoiceDate\n";
                                    $message .= "Due Date: $dueDate\n";
                                    $message .= "Total Amount: $totalAmount\n";
                                    $message .=
                                        'You can view the invoice PDF here: ' . route('downloadInvoice', $item->id);

                                    // URL-encode the message
                                    $encodedMessage = urlencode($message);

                                    // Constructing the dynamic WhatsApp URL
                                    $whatsappURL = "https://api.whatsapp.com/send?phone=$recipientNumber&text=$encodedMessage";
                                @endphp
                                <td data-tw-merge
                                    class="px-5 py-3 border-b dark:border-darkmode-300 flex flex-row gap-4 justify-center">
                                    <a href="{{ route('edit.new.amin.order', $item->id) }}"><x-base.lucide
                                            class="mx-auto block" icon="Edit2" /></a>
                                    <a href="{{ route('returnAdminOrder', $item->id) }}"><x-base.lucide
                                            class="mx-auto block" icon="RotateCw" /></a>
                                    <a href={{ route('downloadInvoice', $item->id) }}><x-base.lucide class="mx-auto block"
                                            icon="DownloadCloud" /></a>
                                    <a href="{{ $whatsappURL }}"><span class="[&>svg]:h-5 [&>svg]:w-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 448 512">
                                                <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
                                                <path
                                                    d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                                            </svg>


                                        </span></a>
                                </td>
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
        // Function to remove the success message after 3 seconds
        setTimeout(function() {
            var successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.remove();
            }
        }, 3000);

        // Function to remove the error message after 3 seconds
        setTimeout(function() {
            var errorMessage = document.getElementById('errorMessage');
            if (errorMessage) {
                errorMessage.remove();
            }
        }, 3000);

        function goToAddCategoriePage() {
            // Redirect to another page when the button is clicked     
            window.location.href = "{{ route('new.amin.order') }}";
        }
    </script>
@endonce
