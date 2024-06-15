@extends('../layouts/' . $layout)

@section('subhead')
    <title>Add Ingredient</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex items-center">
        <h2 class="mr-auto text-lg font-medium">Edit Ingredient</h2>
    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <form class="customers-validate-form" action="{{ route('update.ingredient', $Ingredient->id) }}" method="POST">
                @csrf
                <div class="intro-y box p-5">

                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                            Name
                            <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                Required, at least 2 characters
                            </span>
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="name" name="name" type="text"
                            placeholder="Name" minlength="2" value="{{ $Ingredient->name ?? '' }}"  />
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                            MRP
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="mrp" name="mrp" type="text"
                            placeholder="MRP" min="0" value="{{ $Ingredient->mrp ?? '' }}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"/>
                    </div>
                    <div class="input-form">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                            Quantity
                        </x-base.form-label>
                        <x-base.form-input class="form-control" id="qty" name="qty" type="text"
                            placeholder="Quantity" min="0" value="{{ $Ingredient->qty ?? '' }}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                    </div>

                    <div class="mt-3">
                        <label>loose Product</label>
                        @if($Ingredient->loose == 1) 
                        <x-base.form-switch class="mt-2">
                            <x-base.form-switch.input  name="loose"  type="checkbox" checked />
                        </x-base.form-switch>
                       
                        @else
                         <x-base.form-switch class="mt-2">
                            <x-base.form-switch.input  name="loose"  type="checkbox" />
                        </x-base.form-switch>
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
                <div class="font-medium">Add Categorie failed!</div>
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
        $("#cancel_btn").click(function() {
            history.go(-1);
        });
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
                }

            },
            messages: {
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
