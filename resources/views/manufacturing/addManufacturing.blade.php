@extends('../layouts/' . $layout)

@section('subhead')
<title>Add Manufacturing</title>
@endsection

@section('subcontent')
<div class="intro-y mt-8 flex items-center">
    <h2 class="mr-auto text-lg font-medium">Add Manufacturing</h2>
    @if(session('success'))
        <div id="successMessage" class="alert alert-success" style="color: green;font-size: 23px;margin-right: 459px;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div id="errorMessage" class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>
<div class="mt-5 grid grid-cols-12 gap-6">
    <div class="intro-y col-span-12 lg:col-span-6">
        <div class="intro-y box p-5">
            <div class="input-form">
                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="relationship">
                    Select Relationship Type
                </x-base.form-label>
                <div>
                    <label>
                        Many-to-One <input type="radio" name="relationship" value="many_to_one" required>
                    </label>
                </div>
                <div>
                    <label>
                        One-to-Many <input type="radio" name="relationship" value="one_to_many" required checked>
                    </label>
                </div>
            </div>
            <div id="manyToOne">
                
            <form class="customers-validate-form" action="{{ route('save.inventory') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                        Select Select manufacture product
                    </x-base.form-label>
                    <div class="flex flex-col items-center sm:flex-row">
                        <select data-tw-merge aria-label=".form-select-lg example" class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2 sm:mt-2 sm:mr-2" name="product_id" required>
                            <option value="">Please Select manufacture product</option>
                            @foreach ($Product as $data)
                            <option value="{{ $data[0]->product_id }}">{{ $data[0]->product_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                            Inventory
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="validation-form-1" name="inventory" type="text" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Inventory" min="0" required />
                    </div>
                    <div class="mt-5 text-right">
                       <x-base.button class="mr-1 w-24" type="button" id="cancel_btn" variant="outline-secondary">
                            Cancel
                        </x-base.button>
                        <x-base.button class="w-24" type="submit" variant="primary">
                            Save
                        </x-base.button>
                    </div>
                </form>
            </div>
            <div id="oneToMany">
                <form class="one-to-many" action="{{ route('savemanufacturing') }}" method="POST" enctype="multipart/form-data">     
                @csrf
                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                        Select manufacture product
                    </x-base.form-label>
                    <div class="flex flex-col items-center sm:flex-row">
                        <select data-tw-merge aria-label=".form-select-lg example" class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2 sm:mt-2 sm:mr-2" name="id" required>
                            <option value="">Please Select manufacture product</option>
                            @foreach ($conversionProudct as $data)
                            @if ($data->GetProductOne && $data->GetProductTwo)
                            <option value="{{ $data->id }}">{{ $data->GetProductOne->product_name }} TO
                                {{ $data->GetProductTwo->product_name }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-5 text-right">
                       <x-base.button class="mr-1 w-24" type="button" id="cancel_btn" variant="outline-secondary">
                            Cancel
                        </x-base.button>
                        <x-base.button class="w-24" type="submit" variant="primary">
                            Save
                        </x-base.button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Failed Notification Content -->
<x-base.notification class="flex hidden" id="failed-notification-content">
    <x-base.lucide class="text-danger" icon="XCircle" />
    <div class="ml-4 mr-4">
        <div class="font-medium">Add Created Product failed!</div>
        <div class="mt-1 text-slate-500">
            Please check the field form.
        </div>
    </div>
</x-base.notification>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>


<script>
    $("#cancel_btn").click(function() {
            history.go(-1);
        });
    $(document).ready(function() {
        // Show oneToMany form by default
        $('#oneToMany').show();
        $('#manyToOne').hide(); // Hide manyToOne form by default
    });

    // Function to show/hide forms based on radio button selection
    $('input[type=radio][name=relationship]').change(function() {
        if (this.value === 'many_to_one') {
            $('#manyToOne').show();
            $('#oneToMany').hide();
        } else if (this.value === 'one_to_many') {
            $('#manyToOne').hide();
            $('#oneToMany').show();
        }
    });
    </script>
   <script>
    $(document).ready(function () {
        // Validation for one-to-many form
        $('.one-to-many').validate({
            ignore: ':hidden:not(:radio)',
            errorElement: 'label',
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            rules: {
                id: {
                    required: true,
                },
            },
            messages: {
                id: {
                    required: "Please select a manufacture product",
                },
            },
            submitHandler: function (form) {
                form.submit(); // Submit the form if validation passes
            }
        });

        // Validation for many-to-one form
        $(".customers-validate-form").validate({
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
            },
            messages: {
                name: {
                    required: "Please Enter Category Name",
                },
            }
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