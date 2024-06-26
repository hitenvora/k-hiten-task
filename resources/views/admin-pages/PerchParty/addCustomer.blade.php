@extends('../layouts/' . $layout)

@section('subhead')
    <title>Add Party</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex items-center">
        <h2 class="mr-auto text-lg font-medium">Add Party</h2>
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
            <form method="POST" class="customers-validate-form" action="{{ route('admin.save.perchparty') }}">
                @csrf
                <div class="intro-y box p-5">
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="name">
                            Name
                        </x-base.form-label>

                        <x-base.form-input class="form-control" id="name" type="text" name="name" required />

                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="company_name">
                            Company Name
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="company_name" type="text" name="company_name"
                            required />
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="gst_number">
                            GST No
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="gst_number" type="text" name="gst_number" required />

                    </div>
                    <div class="mt-3">
                        <x-base.form-label for="crud-form-2">Products</x-base.form-label>
                        <x-base.tom-select class="w-full" name="products[]" id="crud-form-2" multiple>
                            @foreach ($productsList as $item)
                                <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                            @endforeach
                        </x-base.tom-select>
                    </div>
                    {{-- <div class="mt-3">
                        <x-base.form-label for="crud-form-2">Ingredient</x-base.form-label>
                        <x-base.tom-select class="w-full" name="ingredient[]" id="crud-form-2" multiple>
                            @foreach ($ingredient as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </x-base.tom-select>
                    </div> --}}
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="mail">
                            Email
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="mail" type="text" name="mail" required />
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="mobail_number">
                            Contact No
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="mobail_number" required name="mobail_number"
                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                            maxlength="10" required type="text" />
                    </div>

                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="state">
                            State
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="state" type="text" name="state" required />
                    </div>

                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="citie">
                            City
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="citie" type="text" name="citie" required />
                    </div>

                    <div class="input-form">
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
                    </div>

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
