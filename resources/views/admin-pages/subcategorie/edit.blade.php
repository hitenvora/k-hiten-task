@extends('../layouts/' . $layout)

@section('subhead')
    <title>Edit Categories<e</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex items-center">
        <h2 class="mr-auto text-lg font-medium">Edit Categories</h2>
    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <form class="customers-validate-form" action="{{ route('update.subCategorie', $SubCategory->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="intro-y box p-5">
                    {{-- <div class="flex flex-col items-center sm:flex-row">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                            Select Categorie Name

                        </x-base.form-label>
                        <select data-tw-merge aria-label=".form-select-lg example"
                            class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2 sm:mt-2 sm:mr-2"
                            name="categorieid">

                            <option value="">Please Select Category Name</option>
                            @foreach ($cate as $data)
                                <option @if ($data->id == $SubCategory->categorieid) selected @endif value="{{ $data->id }}">
                                    {{ $data->name }}</option>
                            @endforeach
                        </select>

                    </div> --}}
                    <label id="categorieid-error" class="is-invalid" for="categorieid"></label>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                        Category Name
                            <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                Required, at least 2 characters
                            </span>
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="validation-form-1" name="name" type="text"
                            value="{{ $SubCategory->name }}" placeholder="Categorie Name" minlength="2" required />
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                        Category Image
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="image" name="image" type="file"
                            placeholder="Categorie Name" minlength="2" />
                        @if (file_exists(public_path($SubCategory->image)))
                            <img src="{{ asset($SubCategory->image) }}" alt="" height="80" width="80">
                        @endif
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
                categorieid: {
                    required: true,
                    // minlength: 2,
                    maxlength: 200,
                },
                name: {
                    required: true,
                    minlength: 2,
                    maxlength: 200,
                }

            },
            messages: {

                categorieid: {
                    required: "Please Enter Categorie Name",
                },
                name: {
                    required: "Please Enter Categorie Name",
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
