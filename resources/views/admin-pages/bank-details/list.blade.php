@extends('../layouts/' . $layout)

@section('subhead')
    <title>Admin |Bank-Details List</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Bank-Details List</h2>
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
                Add New Bank-Details
            </x-base.button>
        </div>
    </div>

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
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Bank Name
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Account No

                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Opening Bank Balance
                            </th>
                            <th data-tw-merge
                                class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                ACTIONS
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($BankDetails as $item)
                            <tr data-tw-merge
                                class="[&amp;amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    {{ $count }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    <b> <a class="mr-3 flex items-center"
                                            href="{{ route('admin.show.entry.balance', $item->id) }}">
                                            {{ $item->bank_name }}
                                        </a></b>
                                    {{-- {{ $item->bank_name }} --}}

                                </td>

                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                  {{ $item->account_no }}
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    {{ $item->opning_bank_balance }} 
                                </td>
                                <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                    {{-- <div class="flex items-center justify-center"> --}}
                                    <a class="mr-3 flex items-center" href="{{ route('bank.edit', $item->id) }}">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="edit2" icon-name="edit2" data-lucide="edit2" class="lucide lucide-edit2 stroke-1.5 block"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        Edit
                                    </a>
                                    {{-- </div> --}}
                                    @php $count++; @endphp
                            </tr>
                        @endforeach

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
            window.location.href = "{{ route('add.bank') }}";
        }
    </script>
@endonce
