@extends('../layouts/' . $layout)

@section('subhead')
    <title>Edit Ledger</title>
@endsection

@section('subcontent')
    <style>
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .column {
            width: 50%;
            /* Adjust as needed */
            /* background-color: #f2f2f2; */
            padding: 10px;
            /* border: 1px solid #ddd; */
            box-sizing: border-box;
        }

        .drop-zone {
            max-width: 600px;
            height: 600px;
            padding: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-family: "Quicksand", sans-serif;
            font-weight: 500;
            font-size: 20px;
            cursor: pointer;
            color: #cccccc;
            border: 4px dashed #009578;
            border-radius: 10px;
        }

        .drop-zone--over {
            border-style: solid;
        }

        .drop-zone__input {
            display: none;
        }

        .drop-zone__thumb {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            overflow: hidden;
            background-color: #cccccc;
            background-size: cover;
            position: relative;
        }

        .drop-zone__thumb::after {
            content: attr(data-label);
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 5px 0;
            color: #ffffff;
            background: rgba(0, 0, 0, 0.75);
            font-size: 14px;
            text-align: center;
        }
    </style>
    <div class="intro-y mt-8 flex items-center">
        <h2 class="mr-auto text-lg font-medium">Edit Ledger</h2>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger" style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <form class="customers-validate-form" action="{{ route('ledger.update', $Ledgers->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="intro-y box p-5 lg:col-6">
                    <div class="row">
                        <div class="column">

                            {{-- <input type="hidden" name="type" value="{{ $type }}"> --}}
                            <div class="input-form ">
                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="product-name">
                                    Name
                                    <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                        Required
                                    </span>
                                </x-base.form-label>
                                <x-base.form-input class="form-control" value="{{ $Ledgers->name }}" id="name"
                                    name="name" required type="text" placeholder="Name" required />
                                    {{-- <x-base.form-select id="modal-form-6" name="name" required>
                                        @foreach ($customerData as $item)
                                            <option value="{{ $item->id }}" {{ $Ledgers->name == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                                        @endforeach
                                    </x-base.form-select> --}}
                            </div>
                            {{-- <span class="text-danger" id="product-name_error"
                                style="color: red;></span> --}}


                            <div class="mt-3">
                                <div class="input-form">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="meta-title">
                                        Pin Code
                                        <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                            Pin code
                                        </span>
                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" id="pin_code" value="{{ $Ledgers->pin_code }}"
                                        name="pin_code" type="text" placeholder=" Pin Code" required />
                                </div>
                            </div>



                            <div class="mt-3">
                                <div class="input-form ">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="meta-title">
                                        Email
                                        <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                            Email
                                        </span>
                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" value="{{ $Ledgers->email }}" id="email"
                                        name="email" type="email" placeholder="Email" required />

                                </div>
                            </div>


                            <div class="mt-3">
                                <div class="input-form ">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="meta-title">
                                        Phone No
                                        <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                            Phone No
                                        </span>
                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" id="phone_no" value="{{ $Ledgers->phone_no }}"
                                        name="phone_no" type="Number" placeholder="Number" required />
                                </div>
                            </div>


                            <div class="mt-3">
                                <div class="input-form ">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="gst_no">
                                        Gst No
                                        <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                            Gst
                                        </span>
                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" value="{{ $Ledgers->gst_no }}" id="gst_no"
                                        name="gst_no" type="text" placeholder="Gst No." />
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="input-form ">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="state">
                                        State
                                        <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                            State
                                        </span>
                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" id="state" value="{{ $Ledgers->state }}"
                                        name="state" type="text" placeholder="State" />
                                </div>
                            </div>


                            <div class="mt-3">
                                <div class="input-form">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="balancing_method">
                                        Select Balancing Method
                                    </x-base.form-label>
                                    <select data-tw-merge aria-label=".form-select-lg example" id="balancing_method"
                                        class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2 sm:mt-2 sm:mr-2"name="balancing_method">
                                        <option value="">Please Select Balancing Method</option>
                                        <option value="1" {{ $Ledgers->balancing_method == '1' ? 'selected' : '' }}>
                                            Fifo Base
                                        </option>
                                        <option value="2" {{ $Ledgers->balancing_method == '2' ? 'selected' : '' }}>On
                                            Account
                                        </option>
                                    </select>

                                </div>
                            </div>





                            <div class="mt-3">
                                <div class="input-form ">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="mail_to">
                                        Mail To
                                        <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                            Mail To
                                        </span>
                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" id="mail_to" value="{{ $Ledgers->mail_to }}"
                                        name="mail_to" required type="text" placeholder="Mail To" required />
                                </div>
                            </div>


                            <div class="mt-3">
                                <div class="input-form">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="address">
                                        Address
                                        <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                            Address
                                        </span>
                                    </x-base.form-label>
                                    <x-base.form-textarea class="form-control" id="address" name="address"
                                        placeholder="Address">
                                        {{ $Ledgers->address }}</x-base.form-textarea>

                                </div>
                            </div>


                            {{-- <div class="input-form ">

                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                                    Select Categorie Name
                                </x-base.form-label>
                                <select data-tw-merge aria-label=".form-select-lg example" id="category"
                                    class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2 sm:mt-2 sm:mr-2"name="category">

                                    <option value="">Please Select Category Name</option>
                                    @foreach ($Category as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>

                            </div> --}}


                        </div>
                        <div class="column">
                            {{-- <div class="mt-5 text-right">
                                <x-base.button class="w-30" onclick="submitForm()" variant="primary">
                                    Add onversion
                                </x-base.button>
                            </div> --}}
                            {{-- <input type="hidden" id="add_ingredient" name="add_ingredient" value="0"> --}}
                            {{-- <div class="row"> --}}

                            <div class="input-form ">
                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="contact_person">
                                    Contact Person
                                    <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                        Contact Person
                                    </span>
                                </x-base.form-label>
                                <x-base.form-input class="form-control" id="contact_person"
                                    value="{{ $Ledgers->contact_person }}" name="contact_person" type="text"
                                    placeholder="Contact Person" />

                            </div>
                            <div class="mt-3">
                                <div class="input-form">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="designation">
                                        Designation
                                        <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                            Designation
                                        </span>
                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" id="designation"
                                        value="{{ $Ledgers->designation }}" name="designation" type="text"
                                        placeholder="Designation" />
                                </div>
                            </div>

                            <div class="mt-3">

                                <div class="input-form">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="gst_heading">
                                        GST Heading
                                        <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                            GST Heading
                                        </span>
                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" id="gst_heading"
                                        value="{{ $Ledgers->gst_heading }}" name="gst_heading" type="text"
                                        placeholder="GST Heading" required />
                                </div>

                            </div>


                            <div class="mt-3">


                                <div class="input-form ">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="note">
                                        Note
                                        <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                            Note
                                        </span>
                                    </x-base.form-label>
                                    <x-base.form-textarea class="form-control" id="note" name="note"
                                        placeholder="Note" required>{{ $Ledgers->note }}</x-base.form-textarea>
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="input-form">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="ledger_category">
                                        Select Ledger Category
                                    </x-base.form-label>
                                    <select data-tw-merge aria-label=".form-select-lg example" id="ledger_category"
                                        class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2 sm:mt-2 sm:mr-2"
                                        name="ledger_category" required>
                                        <option value="">Please Select Ledger Category</option>
                                        <option value="1" {{ $Ledgers->ledger_category == '1' ? 'selected' : '' }}>
                                            Retailers</option>
                                        <option value="2" {{ $Ledgers->ledger_category == '2' ? 'selected' : '' }}>
                                            Stock
                                            List</option>
                                        <option value="3" {{ $Ledgers->ledger_category == '3' ? 'selected' : '' }}>
                                            Distributor</option>
                                        <option value="4" {{ $Ledgers->ledger_category == '4' ? 'selected' : '' }}>
                                            Others</option>
                                    </select>
                                </div>
                            </div>




                            <div class="mt-3">

                                <div class="input-form">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="country">
                                        Country
                                        <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                            Country
                                        </span>
                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" id="country" name="country"
                                        value="{{ $Ledgers->country }}" type="text" placeholder="Country" />
                                </div>


                            </div>



                            <div class="mt-3">

                                <div class="input-form">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="pan_no">
                                        Pan NO.
                                        <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                            Pan NO.
                                        </span>
                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" id="pan_no"
                                        value="{{ $Ledgers->pan_no }}" name="pan_no" type="text"
                                        placeholder="Pan NO." />
                                </div>

                            </div>

                            {{-- </div> --}}
                        </div>
                    </div>
                    <div class="mt-5 text-right">
                        <x-base.button class="mr-1 w-24" type="button" variant="outline-secondary">
                            Cancel
                        </x-base.button>
                        <x-base.button class="w-24" type="submit" variant="primary">
                            Submit
                        </x-base.button>
                    </div>
                </div>
            </form>

            <!-- END: Form Layout -->
        </div>
        <!-- BEGIN: Failed Notification Content -->
        <x-base.notification class="flex hidden" id="failed-notification-content">
            <x-base.lucide class="text-danger" icon="XCircle" />
            <div class="ml-4 mr-4">
                <div class="font-medium">Edit Categorie failed!</div>
                <div class="mt-1 text-slate-500">
                    Please check the fileld form.
                </div>
            </div>
        </x-base.notification>
        <!-- END: Failed Notification Content -->
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <script>
        $(".customers-validate-form").validate({
            // ignore: ':hidden:not(:checkbox)',
            ignore: ':hidden:not(:radio)',
            errorElement: 'label',
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            rules: {
                name: {
                    required: true,
                    maxlength: 200,
                },

            },
            messages: {
                name: {
                    required: "Please Enter Categorie Name",
                },

            }
        });
    </script>

    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
        @if (Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif
        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    </script>
@endsection
@once
    @push('vendors')
        @vite('resources/js/vendor/pristine/index.js')
        @vite('resources/js/vendor/toastify/index.js')
    @endpush
@endonce
@once
    @push('scripts')
    @endpush
@endonce
