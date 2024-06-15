@extends('../layouts/' . $layout)

@section('subhead')
<title>Admin |  One to Many List</title>
@endsection

@section('subcontent')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
<div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
    <h2 class="mr-auto text-lg font-medium"> One to Many</h2>
    @if(session('success'))
    <div id="successMessage" class="alert alert-success" style="color: green;font-size: 23px;margin-right: 459px;">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
        <div id="errorMessage" class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
        <x-base.button class="mr-2 shadow-md" onclick="goToAddCategoriePage()" variant="primary">
            Add New Conversion
        </x-base.button>
    </div>
</div>
<!-- BEGIN: HTML Table Data -->
<div class="intro-y box mt-5 p-5">
    <div class="scrollbar-hidden overflow-x-auto">
        <div class="overflow-x-auto">
            <table data-tw-merge class="w-full text-left" id="example">
                <thead data-tw-merge class="">
                    <tr data-tw-merge class="[&amp;amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                        <th data-tw-merge class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            #
                        </th>
                        <th data-tw-merge class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Product One
                        </th>
                        <th data-tw-merge class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Product Two
                        </th>
                        <th data-tw-merge class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            QTY One
                        </th>
                        <th data-tw-merge class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            QTY Two
                        </th>
                        <!-- <th data-tw-merge class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Volume
                        </th> -->
                        <th data-tw-merge class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            ACTIONS
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $count = 1; @endphp
                    @foreach ($conversion as $item)
                    <tr data-tw-merge class="[&amp;amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                        <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                            {{ $count }}
                        </td>
                        <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                            {{ $item->GetProductOne->product_name ?? null }}
                        </td>
                        <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                            {{ $item->GetProductTwo->product_name ?? null}}
                        </td>
                        <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                            {{ $item->qty_one }}
                        </td>
                        <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                            {{ $item->qty_two }}
                        </td>
                        <!-- <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                            {{ $item->volume }}
                        </td> -->
                        <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                            {{-- <div class="flex items-center justify-center"> --}}
                            <a class="mr-3 flex items-center" href="{{ route('edit.conversion', $item->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-1 h-4 w-4">
                                    <polyline points="9 11 12 14 22 4"></polyline>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                </svg>
                                Edit
                            </a>
                            {{-- </div> --}}
                        </td>
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
</script> bvbv
@endpush
<script>
    // Function to remove the success message after 3 seconds
    setTimeout(function() {
        var successMessage = document.getElementById('successMessage');
        if(successMessage) {
            successMessage.remove();
        }
    }, 3000);

    // Function to remove the error message after 3 seconds
    setTimeout(function() {
        var errorMessage = document.getElementById('errorMessage');
        if(errorMessage) {
            errorMessage.remove();
        }
    }, 3000);
    function goToAddCategoriePage() {
        // Redirect to another page when the button is clicked
        window.location.href = "{{ route('add.conversion') }}";
    }
</script>
@endonce