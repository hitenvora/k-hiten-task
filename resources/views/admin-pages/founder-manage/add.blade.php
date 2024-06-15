@extends('../layouts/' . $layout)

@section('subhead')
    <title>ADD Founder Mange</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex items-center">
        <h2 class="mr-auto text-lg font-medium">ADD Founder Mange</h2>
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
            <form method="POST" class="customers-validate-form" action="{{ route('save.founder_mange') }}"
                enctype="multipart/form-data">
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
                            for="position">
                            Position
                        </x-base.form-label>

                        <x-base.form-input class="form-control" id="position" type="text" name="position" required />

                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="linkdin_link">
                            Linkdin Link
                        </x-base.form-label>

                        <x-base.form-input class="form-control" id="linkdin_link" type="text" name="linkdin_link"
                            required />

                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="facebook_link">
                            Facebook Link
                        </x-base.form-label>

                        <x-base.form-input class="form-control" id="facebook_link" type="text" name="facebook_link"
                            required />

                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="instagram_link">
                            Instagram Link
                        </x-base.form-label>

                        <x-base.form-input class="form-control" id="instagram_link" type="text" name="instagram_link"
                            required />

                    </div>


                    {{-- <div class="input-form ">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                            Image
                        </x-base.form-label>
                        <div class="input-form ">
                            <input type="file" name="image" id="image" class="drop-zone__input" required>
                        </div>
                    </div> --}}


                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                            for="image">
                            Image
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="image" type="file" name="image" required />
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
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

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
                    required: true
                },
                position: {
                    required: true
                },

                linkdin_link: {
                    required: true
                },

                facebook_link: {
                    required: true
                },

                instagram_link: {
                    required: true
                },





            },
            messages: {
                name: {
                    required: "Please Enter Title",
                },
                position: {
                    required: "Please Enter Position",
                },
                linkdin_link: {
                    required: "Please Enter Linkdin",
                },
                facebook_link: {
                    required: "Please Enter Facebook",
                },
                instagram_link: {
                    required: "Please Enter Instagram",
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
