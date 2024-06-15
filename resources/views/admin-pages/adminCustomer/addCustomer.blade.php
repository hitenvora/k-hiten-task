@extends('../layouts/' . $layout)

@section('subhead')
    <title>Add Customer</title>
@endsection
<style>
    .error {
        color: red;
    }
</style>

@section('subcontent')
    <div class="intro-y mt-8 flex items-center">
        <h2 class="mr-auto text-lg font-medium">Add Customer</h2>
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
        <div class="intro-y col-span-12 lg:col-span-6">
            <form id="customer-form" method="POST" action="{{ route('admin.saveCustomerData') }}" class="w-full max-w-lg">
                @csrf
                <div class="intro-y box p-5">
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" for="first_name">
                            First Name
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="first_name" type="text" name="first_name" />
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" for="last_name">
                            Last Name
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="last_name" type="text" name="last_name" />
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" for="email">
                            Email
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="email" type="email" name="email" />
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" for="contact_no">
                            Contact No
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="contact_no" name="contact_no"
                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                            maxlength="10" required type="text" />
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
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="company_name" type="text" name="company_name" />
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" for="gst_no">
                            GST No
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="gst_no" type="text" name="gst_no" />
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
    <!-- Include jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Include jQuery Validate -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <!-- Include Toastr.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <script>
        $("#cancel_btn").click(function() {
            history.go(-1);
        });
        $(document).ready(function() {
            $('#customer-form').validate({
                rules: {
                    first_name: {
                        required: true,
                    },
                    last_name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    contact_no: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10,
                    },
                    address: {
                        required: true,
                    },
                    company_name: {
                        required: true,
                    },
                    gst_no: {
                        required: true,
                    },
                },
                messages: {
                    first_name: {
                        required: "Please enter your first name.",
                    },
                    last_name: {
                        required: "Please enter your last name.",
                    },
                    email: {
                        required: "Please enter your email address.",
                        email: "Please enter a valid email address.",
                    },
                    contact_no: {
                        required: "Please enter your contact number.",
                        digits: "Please enter only digits.",
                        minlength: "Contact number must be at least 10 digits.",
                        maxlength: "Contact number cannot exceed 10 digits.",
                    },
                    address: {
                        required: "Please enter your address.",
                    },
                    company_name: {
                        required: "Please enter your company name.",
                    },
                    gst_no: {
                        required: "Please enter your GST number.",
                    },
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
            });
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
