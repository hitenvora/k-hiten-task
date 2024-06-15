@extends('../layouts/' . $layout)

@section('subhead')
    <title>Admi | Order List</title>
@endsection

@section('subcontent')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Order</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            {{-- <x-base.button class="mr-2 shadow-md" onclick="goToAddCategoriePage()" variant="primary">
                Add New Product
            </x-base.button> --}}
            <x-base.button data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview" href="#" as="a"
                variant="primary" style="margin: 2px;">
                Add New Product
            </x-base.button>
            {{-- <x-base.button data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview-two" href="#"
                as="a" variant="primary" style="margin: 2px;">
                Add New Ingredient
            </x-base.button> --}}
        </div>
    </div>
    <x-base.dialog id="header-footer-modal-preview">
        <x-base.dialog.panel>
            {{-- <x-base.dialog.Title>
                <h2 class="mr-auto text-base font-medium">
                    Select Party
                </h2>
            </x-base.dialog.title> --}}
            <form action="{{ route('perch.order') }}" method="get">
                {{-- @csrf --}}
                <x-base.dialog.description class="grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-12">
                        <x-base.form-label for="modal-form-6">Party</x-base.form-label>
                        <x-base.form-select id="modal-form-6" name="party" required>
                            @foreach ($Partys as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </x-base.form-select>
                    </div>
                </x-base.dialog.description>
                <x-base.dialog.footer>
                    <x-base.button class="w-20 mr-1" data-tw-dismiss="modal" type="button" variant="outline-secondary">
                        Cancel
                    </x-base.button>
                    <x-base.button class="w-20" type="submit" variant="primary">
                        Send
                    </x-base.button>
                </x-base.dialog.footer>
            </form>
        </x-base.dialog.panel>
    </x-base.dialog>
    <x-base.dialog id="header-footer-modal-preview-two">
        <x-base.dialog.panel>
            {{-- <x-base.dialog.Title>
                <h2 class="mr-auto text-base font-medium">
                    Select Party
                </h2>
            </x-base.dialog.title> --}}
            <form action="{{ route('newIngredientOrder') }}" method="POST">
                @csrf
                <x-base.dialog.description class="grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-12">
                        <x-base.form-label for="modal-form-6">Party</x-base.form-label>
                        <x-base.form-select id="modal-form-6" name="party" required>
                            @foreach ($Partys as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </x-base.form-select>
                    </div>
                </x-base.dialog.description>
                <x-base.dialog.footer>
                    <x-base.button class="w-20 mr-1" data-tw-dismiss="modal" type="button" variant="outline-secondary">
                        Cancel
                    </x-base.button>
                    <x-base.button class="w-20" type="submit" variant="primary">
                        Send
                    </x-base.button>
                </x-base.dialog.footer>
            </form>
        </x-base.dialog.panel>
    </x-base.dialog>
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
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                Customer Name
                            </th>
                             {{-- <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                Customer Contact Number
                            </th> --}}
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                Order Date
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
                                Total
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
                                    {{ $item->PerchParty ? $item->PerchParty->name : '' }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M, Y') }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    {{ $item->bill_due_date }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    &#8377;{{ $item->total ?? 0 }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    @if ($item->status == '1')
                                        <a href="{{ route('update.status.perch.order', $item->id) }}"> <span
                                                class="mr-1 rounded-full border border-success px-3 py-2 text-success dark:border-success">Paid</span>
                                        </a>
                                    @elseif ($item->status == '2')
                                        <a href="{{ route('update.status.perch.order', $item->id) }}"> <span
                                                class="mr-1 rounded-full border border-warning px-3 py-2 text-warning dark:border-warning">UnPaid</span></a>
                                    @else
                                        <a href="{{ route('update.status.perch.order', $item->id) }}"><span
                                                class="mr-1 rounded-full border border-danger px-3 py-2 text-danger dark:border-danger">Panding</span>
                                        </a>
                                    @endif
                                </td>
                                @php
                                    // Assuming you have dynamic variables
                                    $recipientNumber = '+91' . $item->PerchParty->contact_number;
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
                                    @if ($item->type == 1)
                                        <a href="{{ route('editIngredientOrder', $item->id) }}"><x-base.lucide
                                                class="mx-auto block" icon="Edit2" /></a>
                                    @else
                                        <a href="{{ route('edit.perch.order', $item->id) }}"><x-base.lucide
                                                class="mx-auto block" icon="Edit2" /></a>
                                    @endif

                                    <a href="{{ route('returnPerchOrder', $item->id) }}"><x-base.lucide
                                            class="mx-auto block" icon="RotateCw" /></a>
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
        function goToAddCategoriePage() {
            // Redirect to another page when the button is clicked     
            window.location.href = "{{ route('perch.order', 'p_id') }}";
        }
    </script>
@endonce
