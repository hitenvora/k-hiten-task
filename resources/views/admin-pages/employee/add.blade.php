@extends('../layouts/' . $layout)

@section('subhead')
<title>Add Employee</title>
@endsection

@section('subcontent')
<div class="intro-y mt-8 flex items-center">
    <h2 class="mr-auto text-lg font-medium">Add Employee</h2>
</div>
<div class="mt-5 grid grid-cols-12 gap-6">
    <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        @if($errors->any())
        <div class="alert alert-danger" style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- END: Failed Notification Content -->
        <form class="customers-validate-form" action="{{ route('employee.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="intro-y box p-5">
                <div class="input-form">
                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                        Name
                        <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                            Required, at least 2 characters
                        </span>
                    </x-base.form-label>
                    <x-base.form-input class="form-control" id="name" name="name" type="text" placeholder="Name" minlength="2" />
                </div>
                <div class="input-form">
                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                        Email
                    </x-base.form-label>
                    <x-base.form-input class="form-control" id="email" name="email" type="email" placeholder="Email" minlength="2" />
                </div>
                <div class="input-form">
                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                        Password
                    </x-base.form-label>
                    <x-base.form-input class="form-control" id="password" name="password" type="password" placeholder="Password" minlength="2" />
                </div>
                <div class="input-form">
                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                        Image
                    </x-base.form-label>
                    <x-base.form-input class="form-control" id="photo" name="photo" type="file" placeholder="Image" minlength="2" />
                </div>

                <div>
                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                        Gender
                    </x-base.form-label>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" required>
                        <label class="form-check-label" for="inlineRadio1">Male</label>

                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female" required>
                        <label class="form-check-label" for="inlineRadio2">Female</label>

                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="other" required>
                        <label class="form-check-label" for="inlineRadio3">Other</label>
                    </div>
                </div>
                <br>


                <div class="input-form">
                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                        Date Of Birth
                    </x-base.form-label>
                    <x-base.form-input class="form-control" id="date_of_birth" name="date_of_birth" type="date" placeholder="Date of birth" minlength="2" />
                </div>
                <div class="input-form">
                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                        Contact Number
                    </x-base.form-label>
                    <!-- <x-base.form-input class="form-control" id="contact_number" name="contact_number" type="text" placeholder="Contact Number" minlength="2" /> -->
                    <x-base.form-input class="form-control" id="contact_number" name="contact_number" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required type="text" placeholder="Contact Number" />
                </div>
                <div class="input-form">
                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                        Adhar Card Photo
                    </x-base.form-label>
                    <x-base.form-input class="form-control" id="aadhar_card_photo" name="aadhar_card_photo" type="file" placeholder="Adhar Card Photo" minlength="2" />
                </div>
                <div class="input-form ">
                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="product-description">
                        Address
                    </x-base.form-label>
                    <x-base.form-textarea class="form-control" id="address" name="address" placeholder="Address"></x-base.form-textarea>
                </div>
                <div class="mt-5 text-right">
                    <x-base.button class="mr-1 w-24" type="button" variant="outline-secondary">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
<script>
    @if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
    @endif
    @if(Session::has('info'))
    toastr.info("{{ Session::get('info') }}");
    @endif
    @if(Session::has('warning'))
    toastr.warning("{{ Session::get('warning') }}");
    @endif
    @if(Session::has('error'))
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
        email: {
            required: true,
            minlength: 2,
            maxlength: 200,
        },
        password: {
            required: true,
            minlength: 2,
            maxlength: 200,
        },
        address: {
            required: true,
            minlength: 2,
            maxlength: 200,
        },
        aadhar_card_photo: {
            required: true,
            minlength: 2,
            maxlength: 200,
        },
        contact_number: {
            required: true,
            minlength: 2,
            maxlength: 200,
        },
        date_of_birth: {
            required: true,
            minlength: 2,
            maxlength: 200,
        },
    },
    messages: {
        name: {
            required: "Please Enter Name",
        },
        email: {
            required: "Please Enter Email",
        },
        password: {
            required: "Please Enter Password",
        },
        address: {
            required: "Please Enter Address",
        },
        aadhar_card_photo: {
            required: "Please Enter Aadhar Card Photo",
        },
        contact_number: {
            required: "Please Enter Contact Number",
        },
        date_of_birth: {
            required: "Please Enter Date Of Birth",
        },

    },
    submitHandler: function(form) {
        // If the form is valid, submit it
        form.submit();
    },
    invalidHandler: function(form, validator) {
        // If the form is invalid, show SweetAlert with error message
        var errors = validator.numberOfInvalids();
        if (errors) {
            var errorMessage = "";
            for (var i = 0; i < validator.errorList.length; i++) {
                errorMessage += "<p>" + validator.errorList[i].message + "</p>";
            }
            swal({
                title: "Validation Error",
                html: errorMessage,
                icon: "error",
            });
        }
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