@extends('../layouts/' . $layout)

@section('subhead')
    <title>Admin | Inventory List</title>
@endsection

@section('subcontent')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Inventory List</h2>
        @if (session('success'))
            <div id="successMessage" class="alert alert-success" style="color: green;font-size: 23px;margin-right: 459px;">
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
                Add Open Stock
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
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                #
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Product Image
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Product Name
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Qty
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                {{-- Quantity --}}
                                {{-- Volume --}}
                                Unite
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Status
                            </th>
                            {{-- <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                ACTIONS
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($firms as $item)
                            <tr data-tw-merge
                                class="[&amp;amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    {{ $count }}
                                </td>

                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    @if ($item->image)
                                        <a href="{{ asset($item->image) }}" class="btn btn-info" target="_blank">
                                            <div class="image-fit zoom-in -ml-5 h-10 w-10">
                                                <x-base.tippy
                                                    class="rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]"
                                                    src="{{ asset($item->image) }}" alt="Midone Kanaiya" as="img"
                                                    content="{{ asset($item->image) }}" />
                                            </div>
                                        </a>
                                    @else
                                        <span class="btn btn-warning">N/A</span>
                                    @endif
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    {{ $item->product_name }}
                                </td>
                                @php
                                    $qty =
                                        ($item->GetInventory ? $item->GetInventory->inventorie : 0) +
                                        ($item->GetInventory ? $item->GetInventory->opening_stock : 0);
                                @endphp

                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    {{-- {{ $qty }}  @if ($item->lush == 1) KG @else Unit @endif --}}
                                    @if (!is_null($qty))
                                        {{ $qty }}
                                    @endif
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    {{-- {{ $qty }}  @if ($item->lush == 1) KG @else Unit @endif --}}
                                    @if (!is_null($item->volume))
                                        {{ $item->volume }}
                                    @endif
                                </td>
                                @if ($item->status == 1)
                                    <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                        <a class="mr-3 flex items-center" href="{{ route('products.status', $item->id) }}">
                                            <div class="flex items-center justify-center text-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    icon-name="check-square" data-lucide="check-square"
                                                    class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4">
                                                    <polyline points="9 11 12 14 22 4"></polyline>
                                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11">
                                                    </path>
                                                </svg>
                                                Active
                                            </div>
                                        </a>
                                    </td>
                                @else
                                    <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                        <a class="mr-3 flex items-center" href="{{ route('products.status', $item->id) }}">

                                            <div class="flex items-center justify-center text-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    icon-name="check-square" data-lucide="check-square"
                                                    class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4">
                                                    <polyline points="9 11 12 14 22 4"></polyline>
                                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11">
                                                    </path>
                                                </svg>
                                                Inactive
                                            </div>
                                        </a>
                                    </td>
                                @endif
                                {{-- <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    <a class="mr-3 flex items-center" href="{{ route('edit.product', $item->id) }}">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="edit2" icon-name="edit2" data-lucide="edit2" class="lucide lucide-edit2 stroke-1.5 block"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        Edit
                                    </a>
                                </td> --}}
                                @php $count++; @endphp
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- END: HTML Table Data -->
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
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
        <script>
            new DataTable('#example', {
                paging: false,
                layout: {
                    topStart: {
                        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
                    }
                }
            });
        </script>
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
            window.location.href = "{{ route('addOpeningStock') }}";
        }
    </script>
@endonce
