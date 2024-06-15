@extends('../layouts/' . $layout)

@section('subhead')
    <title>Update Customer</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex items-center">
        <h2 class="mr-auto text-lg font-medium">Update Customer</h2>
    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-6">
            <form method="POST" action="{{ route('admin.updateCustomerData', ['id' => $customer->id ?? null]) }}"
                class="w-full max-w-lg">
                @csrf

                <div class="intro-y box p-5">
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" for="first_name">
                            First Name
                            </label>
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="first_name" type="text" name="first_name"
                            value="{{ $customer->first_name }}" />
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" for="last_name">
                            Last Name
                            </label>
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="last_name" type="text" name="last_name"
                            value="{{ $customer->last_name }}" />
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" for="email">
                            Email
                            </label>
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="email" type="email" name="email"
                            value="{{ $customer->email }}" />
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" for="contact_no">
                            Contact No</x-base.form-label>
                        <x-base.form-input class="form-control" id="contact_no" name="contact_no"
                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                            maxlength="10" required type="text" value="{{ $customer->contact_number }}" />
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" for="address">
                            Address
                        </x-base.form-label>
                        <x-base.form-textarea class="form-control" id="address" name="address"></x-base.form-textarea>
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" for="company_name">
                            Company Name
                            </label>
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="company_name" type="text" name="company_name"
                            value="{{ $customer->company_name }}" />
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" for="gst_no">
                            GST No
                            </label>
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="gst_no" type="text" name="gst_no"
                            value="{{ $customer->gst_number }}" />
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
                contact_no: {
                    required: true,
                    minlength: 2,
                    maxlength: 200,
                }
            },
            messages: {
                name: {
                    required: "Please Enter Name",
                },
                contact_no: {
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
