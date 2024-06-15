@extends('../layouts/' . $layout)

@section('subhead')
    <pincode>Admin |Order Pincode List</pincode>
@endsection

@section('subcontent')
    {{--     <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">

    <style>
        #dt-length-0 {
            width: 70px;
        }

        /* .dt-search {
                                                                                                                                                                                                                                                                                            margin-left: 505px;
                                                                                                                                                                                                                                                                                        } */
    </style>
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Order Pincode List</h2>
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
            <x-base.button class="mr-2 shadow-md" onclick="goToAddbankDetailsPage()" variant="primary">
                Add New Pincode
            </x-base.button>
        </div>

    </div>
    <x-base.dialog id="header-footer-modal-preview">
        <x-base.dialog.panel>
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <style>
                    .input-file {
                        background-color: #f8f9fc;
                        border: 1px solid #e2e9f3;
                        border-radius: 4px;
                        height: 40px;
                        width: 460px;
                        color: #565A90;
                    }

                    .input-file::file-selector-button {
                        border: none;
                        border-radius: 4px;
                        color: white;
                        background-color: #595ef1bd;
                        border: 1px solid #595ef1bd;
                        height: 40px;
                        cursor: pointer;
                        transition: all .25s ease-in;
                        cursor: pointer;
                    }

                    .input-file::file-selector-button:hover {
                        background-color: #fff;
                        color: #565A90;
                        transition: all .25s ease-in;
                    }
                </style>
                <input type="file" class="input-file" name="file" accept=".csv">
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
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                #
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Pincode
                            </th>


                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                ACTIONS
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($order_pincodeList as $item)
                            <tr data-tw-merge
                                class="[&amp;amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    {{ $count }}
                                </td>

                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    {{ $item->pincode }}
                                </td>

                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    {{-- <div class="flex items-center justify-center"> --}}
                                    <a class="mr-3 flex items-center" href="{{ route('order_pincode.edit', $item->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" icon-name="edit2"
                                            icon-name="edit2" data-lucide="edit2"
                                            class="lucide lucide-edit2 stroke-1.5 block">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                </td>
                                <td class="px-5 py-3 border-b dark:border-darkmode-300">
                                    <a class="mr-3 flex items-center" href="javascript:void(0);"
                                        data-href="{{ route('order_pincode.delete', $item->id) }}"
                                        onclick="archiveFunction(event, this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" icon-name="Trash2"
                                            data-lucide="Trash2" class="lucide lucide-Delete stroke-1.5 block">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                        Delete
                                    </a>
                                </td>
                                {{-- </div> --}}
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

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>


    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



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

        function goToAddbankDetailsPage() {
            // Redirect to another page when the button is clicked
            window.location.href = "{{ route('add.order_pincode') }}";
        }
    </script>


    <script>
        function archiveFunction(event, element) {
            event.preventDefault(); // prevent the default action

            Swal.fire({
                pincode: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the action if confirmed
                    const url = element.getAttribute('data-href');

                    fetch(url, {
                            method: 'post',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for security
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                // Optionally, you can show a success message
                                Swal.fire('Deleted!', 'Your record has been deleted.', 'success')
                                    .then(() => {
                                        window.location
                                            .reload(); // Reload the page after successful deletion
                                    });
                            } else {
                                Swal.fire('Error!', 'There was a problem deleting the record.', 'error');
                            }
                        })
                        .catch(error => {
                            Swal.fire('Error!', 'There was a problem deleting the record.', 'error');
                        });
                } else {
                    Swal.fire('Cancelled', 'Your record is safe :)', 'error');
                }
            });
        }
    </script>


@endonce
