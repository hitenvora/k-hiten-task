@extends('../layouts/' . $layout)

@section('subhead')
    <title>Admin | Employee List</title>
@endsection

@section('subcontent')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
    <style>
        #dt-length-0 {
            width: 70px;
        }


        
    </style>
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Employee</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <x-base.button class="mr-2 shadow-md" onclick="goToAddCategoriePage()" variant="primary">
                Add New Employee
            </x-base.button>
        </div>
    </div>
    @if (session('success'))
        <div id="successMessage" class="alert alert-success" style="color: green;font-size: x-large;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div id="errorMessage" class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


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
                                #
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                Name
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                Email
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                Gender
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                Date of birth
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap ">
                                Status
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap ">
                                ACTIONS
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($employee as $item)
                            <tr data-tw-merge
                                class="[&amp;amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    {{ $count }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    {{ $item->name }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    {{ $item->email }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    {{ $item->gender }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 text-center">
                                    {{ $item->date_of_birth ?? '-' }}
                                </td>
                                @if ($item->active == 1)
                                    <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                        <a class="mr-3 flex items-center"
                                            href="{{ route('employee.activeStatus', $item->id) }}">
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

                                        <a class="mr-3 flex items-center"
                                            href="{{ route('employee.activeStatus', $item->id) }}">

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

                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300 ">
                                    <a class="mr-3 flex items-center" href="{{ route('employee.edit', $item->id) }}">
                                        <div class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" icon-name="check-square"
                                                data-lucide="check-square"
                                                class="lucide lucide-check-square stroke-1.5 mr-1 h-4 w-4">
                                                <polyline points="9 11 12 14 22 4"></polyline>
                                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                            </svg>
                                            Edit
                                        </div>
                                    </a>
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
            window.location.href = "{{ route('employee.add') }}";
        }
    </script>
@endonce
