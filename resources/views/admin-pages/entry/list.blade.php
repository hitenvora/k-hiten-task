@extends('../layouts/' . $layout)

@section('subhead')
    <title>Admin | Entry List</title>
@endsection

@section('subcontent')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">

    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Entry</h2>

        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <a href="{{ route('add.entry', $id) }}">
                <x-base.button class="mr-2 shadow-md" variant="primary">
                    Add New Entry
                </x-base.button>
            </a>

            {{-- <x-base.button class="mr-2 shadow-md" onclick="goToAddentryPage()" variant="primary">
                Add New Entry
            </x-base.button> --}}
        </div>
    </div>



    <!-- The Modal -->
    <x-base.dialog id="header-footer-modal-preview">
        <x-base.dialog.panel>

            <form action="" method="get">
                <x-base.dialog.description class="grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-12">
                        <x-base.form-label for="modal-form-6">Type</x-base.form-label>
                        <x-base.form-select id="modal-form-6" name="type" required>
                            <option value="">Select Options</option>
                            <option value="Sundry Creditors">Sundry Creditors</option>
                            <option value="Suspense Account">Suspense Account</option>
                            <option value="Tangible Assets">Tangible Assets</option>
                            <option value="Tax">Tax</option>
                            <option value="Unsecured Loans">Unsecured Loans</option>
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
                <table data-tw-merge class="w-full text-left">

                    <thead data-tw-merge class="">
                        <tr data-tw-merge
                            class="[&amp;amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                #
                            </th>
                            {{-- <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Name
                            </th> --}}
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Bill NO
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Credit/Debit
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Rupees
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Payment Type
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Check No
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Rtgs_no
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Narration
                            </th>
                            {{-- <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                ACTIONS
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($Entry as $item)
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <tr data-tw-merge
                                class="[&amp;amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    {{ $count }}
                                </td>
                                {{-- <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    {{ $item->PerchParty ? $item->PerchParty->name : '' }}
                                </td> --}}
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    {{ $item->perch_id }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    @if ($item->credit_debit == '0')
                                        Credit
                                    @elseif($item->credit_debit == '1')
                                        Debit
                                    @endif
                                    {{-- {{ $item->credit_debit }} --}}
                                </td>

                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    {{ $item->Rupees ? $item->Rupees->total : '' }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    @if ($item->payment_type == '0')
                                        Cash
                                    @elseif($item->payment_type == '1')
                                        Check
                                    @elseif($item->payment_type == '2')
                                        RTGS
                                    @endif
                                    {{-- {{ $item->payment_type }} --}}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    {{ $item->check_no == 0 ? '-' : $item->check_no }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    {{ $item->rtgs_no == 0 ? '-' : $item->rtgs_no }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    {{ $item->narration }}
                                </td>

                                {{-- <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    <a class="mr-3 flex items-center" href="{{ route('entry.edit', $item->id) }}">
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
        function goToAddentryPage() {
            // Redirect to another page when the button is clicked     
            window.location.href = "{{ route('add.entry', 'id') }}";

        }
    </script>

@endonce
