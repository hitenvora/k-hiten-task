@extends('../layouts/' . $layout)

@section('subhead')
<title>Customer Profile - Kanaiya</title>
@endsection

@section('subcontent')
<div class="intro-y mt-8 flex items-center">
    <h2 class="mr-auto text-lg font-medium">Profile Layout</h2>
</div>
<x-base.tab.group>
    <!-- BEGIN: Profile Info -->
    <div class="intro-y box mt-5 px-5 pt-5">
        <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
            <div class="mt-6 flex-1 border-t border-l border-r border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-t-0 lg:pt-0">
                <div class="text-center font-medium lg:mt-3 lg:text-left font-bold">
                    Contact Details
                </div>
                <div class="mt-4 flex flex-col items-center justify-center lg:items-start">
                <div class="flex items-center">
                    <label class="mr-2 font-bold">Name:</label>
                    {{$customer->first_name}} {{$customer->last_name}}
                </div>
                <div class="mt-3 flex items-center">
                    <label class="mr-2 font-bold">Email:</label>
                    {{$customer->email}}
                </div>
                <div class="mt-3 flex items-center">
                    <label class="mr-2 font-bold">Contact Number:</label>
                    {{$customer->contact_number }}
                </div>
                <div class="mt-3 flex items-center">
                    <label class="mr-2 font-bold">Address:</label>
                    {{$customer->address}}
                </div>
            </div>

            </div>
            <div class="mt-6 flex-1 border-t border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-0 lg:pt-0">
                <div class="text-center font-medium lg:mt-3 lg:text-left font-bold">
                    Company Details
                    </div>    
                <div class="mt-3 flex items-center">
                    <label class="mr-2 font-bold">Company Name:</label>
                    {{$customer->company_name}}
                </div>
                <div class="mt-3 flex items-center">
                    <label class="mr-2 font-bold">GST Number:</label>
                    {{$customer->gst_number}}
                </div>
            </div>
        </div>
        <x-base.tab.list class="flex-col justify-center text-center sm:flex-row " variant="link-tabs">
            <!-- BEGIN: Link Tab -->
            <x-base.preview-component class="intro-y box mt-5">
                <div class="p-5" style="width: 1014px;">
                    <x-base.preview>
                        <x-base.tab.group>
                            <x-base.tab.list variant="link-tabs">
                                <x-base.tab id="example-5-tab" selected>
                                    <x-base.tab.button class="w-full py-2" as="button">
                                        App Order List
                                    </x-base.tab.button>
                                </x-base.tab>
                                <x-base.tab id="example-6-tab">
                                    <x-base.tab.button class="w-full py-2" as="button">
                                        Admin Order List
                                    </x-base.tab.button>
                                </x-base.tab>
                            </x-base.tab.list>
                            <x-base.tab.panels class="mt-5">
                                <x-base.tab.panel class="leading-relaxed" id="example-5" selected>
                                    <table class="w-full text-center">
                                        <thead>
                                            <tr>
                                                <th class="px-5 py-3 border-b border-gray-200">Order ID</th>
                                                <th class="px-5 py-3 border-b border-gray-200">Order Date</th>
                                                <th class="px-5 py-3 border-b border-gray-200">Sub Total</th>
                                                <th class="px-5 py-3 border-b border-gray-200">Taxes</th>
                                                <th class="px-5 py-3 border-b border-gray-200">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if ($AppOrders->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center py-4">No data available</td>
                                        </tr>
                                    @else
                                        @php $count = 1; @endphp
                                        @foreach ($AppOrders as $item)
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
                                            </tr>
                                            @php $count++; @endphp
                                        @endforeach
                                    @endif

                                    </tbody>
                                        <!-- Table Body will be filled with data -->
                                    </table>
                                </x-base.tab.panel>
                                <x-base.tab.panel class="leading-relaxed" id="example-6">
                                    <table class="w-full text-center">
                                        <thead>
                                            <tr>
                                                <th class="px-5 py-3 border-b border-gray-200">Order ID</th>
                                                <th class="px-5 py-3 border-b border-gray-200">Order Date</th>
                                                <th class="px-5 py-3 border-b border-gray-200">Due Date</th>
                                                <th class="px-5 py-3 border-b border-gray-200">Total</th>
                                                <th class="px-5 py-3 border-b border-gray-200">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if ($AdminOrders->isEmpty())
                                            <tr>
                                                <td colspan="6" class="text-center py-4">No data available</td>
                                            </tr>
                                        @else
                                            @php $count = 1; @endphp
                                            @foreach ($AdminOrders as $item)
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
                                                                    class="mr-1 rounded-full border border-warning px-3 py-2 text-warning dark:border-warning">UnPaid</span> </a>
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
                                                    
                                                </tr>
                                                @php $count++; @endphp
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <!-- Table Body will be filled with data -->
                                    </table>
                                </x-base.tab.panel>
                            </x-base.tab.panels>
                        </x-base.tab.group>
                    </x-base.preview>
                </div>
            </x-base.preview-component>
            <!-- END: Basic Tab -->
        </x-base.tab.list>
    </div>

</x-base.tab.group>
@endsection
