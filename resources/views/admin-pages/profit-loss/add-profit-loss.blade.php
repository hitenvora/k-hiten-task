@extends('../layouts/' . $layout)

@section('subhead')
    <title>Add Profite-Loss</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex items-center">
        <h2 class="mr-auto text-lg font-medium">Add Profite-Loss</h2>
        @if ($errors->any())
            <div class="alert alert-danger" style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-6">
            <form method="POST" class="customers-validate-form" action="{{ route('save.profite-loss') }}">
                @csrf
                <div class="intro-y box p-5">
                    <div class="mt-3">
                        <div class="input-form">
                            <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="profilt_lose">
                                Select Profite/Loss
                            </x-base.form-label>
                            <select data-tw-merge aria-label=".form-select-lg example" id="profilt_lose"
                                class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2 sm:mt-2 sm:mr-2"name="profilt_lose">
                                <option value="">Selete Profite/Loss</option>
                                <option value="0">Profite</option>
                                <option value="1">Loss</option>

                            </select>

                        </div>
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="amount">
                            Amount
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="amount" type="text" name="amount" />
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="description">
                            Description
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="description" type="text" name="description" />

                    </div>
                    {{-- <div class="mt-3">
                        <x-base.form-label for="crud-form-2">Products</x-base.form-label>
                        <x-base.tom-select class="w-full" name="products[]" id="crud-form-2" multiple>
                            @foreach ($productsList as $item)
                                <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                            @endforeach
                        </x-base.tom-select>
                    </div> --}}
                    {{-- <div class="mt-3">
                        <x-base.form-label for="crud-form-2">Ingredient</x-base.form-label>
                        <x-base.tom-select class="w-full" name="ingredient[]" id="crud-form-2" multiple>
                            @foreach ($ingredient as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </x-base.tom-select>
                    </div> --}}
                    {{-- <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="qty_in_sold">
                            Qty In Sold
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="qty_in_sold" type="text" name="qty_in_sold" />
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="inventry_value">
                            Inventry Value
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="inventry_value" name="inventry_value" type="text" />
                    </div>

                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="sale_value">
                            Sale Value
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="sale_value" type="text" name="sale_value" />
                    </div>

                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="avalible_stock">
                            Avalible Stocks
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="avalible_stock" type="text" name="avalible_stock" />
                    </div> --}}

                    {{-- <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="zip_cod">
                            Zip Code
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="zip_cod" type="text" name="zip_cod" required />

                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="address">
                            Address
                        </x-base.form-label>
                        <x-base.form-textarea class="form-control" id="address" required
                            name="address"></x-base.form-textarea>
                    </div> --}}

                    <div class="mt-5 text-right">
                        <x-base.button class="mr-1 w-24" type="button" id="cancel_btn" variant="outline-secondary">
                            Cancel
                        </x-base.button>
                        <x-base.button class="w-24" type="submit" variant="primary">
                            Save
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
                <div class="font-medium">Add Firm failed!</div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
    <script>
        $("#cancel_btn").click(function() {
            history.go(-1);
        });
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
                    minlength: 2,
                    maxlength: 200,
                },
                mobail_number: {
                    required: true,
                    minlength: 2,
                    maxlength: 200,
                }
            },
            messages: {
                name: {
                    required: "Please Enter Name",
                },
                mobail_number: {
                    required: "Please Enter Contact Number",
                },
            }
        });
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
