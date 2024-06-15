@extends('../layouts/' . $layout)

@section('subhead')
<title>Edit Conversion</title>
@endsection

@section('subcontent')
<div class="intro-y mt-8 flex items-center">
    <h2 class="mr-auto text-lg font-medium">Edit Conversion One to Many</h2>
</div>
<div class="mt-5 grid grid-cols-12 gap-6">
    <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <form class="customers-validate-form" action="{{ route('update.conversion',$conversion->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="intro-y box p-5">
                <div class="input-form ">
                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                        Select Conversion Product
                    </x-base.form-label>
                    <select data-tw-merge aria-label=".form-select-lg example" id="product" class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2 sm:mt-2 sm:mr-2" name="product_one_id" style="margin: 0;">

                        <option value="">Please Select Conversion Product </option>

                        @foreach($Product as $data)
                        <option value="{{ $data->id }}" {{ $conversion['product_one_id'] == $data->id ? 'selected' : '' }}>
                            {{ $data->product_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="input-form">
                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                        Quantity
                    </x-base.form-label>
                    <x-base.form-input class="form-control" id="qty" name="qty_one" type="text" placeholder="Quantity" min="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value="{{$conversion->qty_one}}" />
                </div>
                <div class="input-form">
                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                        Select Product
                    </x-base.form-label>
                    <select data-tw-merge aria-label=".form-select-lg example" id="product" class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2 sm:mt-2 sm:mr-2" name="product_two_id" style="margin: 0;">
                        <option value="">Please Select product</option>

                        @foreach($Product as $data)
                        <option value="{{ $data->id }}" {{ $conversion['product_two_id'] == $data->id ? 'selected' : '' }}>
                            {{ $data->product_name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-form">
                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                        Quantity
                    </x-base.form-label>
                    <x-base.form-input class="form-control" id="qty" name="qty_two" type="text" placeholder="Quantity" min="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value="{{$conversion->qty_two}}" />
                </div>
                <div class="input-form ">
                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="meta-title">
                        Threshold Qty
                    </x-base.form-label>
                    <x-base.form-input class="form-control" id="meta-title" name="threshold_qty" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value="{{$conversion->threshold_qty}}" 
                        type="text" placeholder="Threshold Qty" min='0' />
                </div>
                <div class="input-form ">
                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="meta-title">
                        Manufactur Qty
                    </x-base.form-label>
                    <x-base.form-input class="form-control" id="meta-title" name="manufactur_qty" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value="{{$conversion->manufactur_qty}}" 
                        type="text" placeholder="Manufactur Qty"  min='0' />
                </div>
                <!-- <div class="input-form ">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                            Volume
                        </x-base.form-label>
                        <td class="table__qty">
                            <x-base.input-group class="" inputGroup>
                                <x-base.form-input type="text" class="volume" aria-label="volume"
                                    aria-describedby="input-group-volume" placeholder="volume"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value="{{$conversion->qty_two}}"  name="volume"
                                    required  />
                                <x-base.input-group.text class="input-group-volume">
                                    KG
                                </x-base.input-group.text>
                            </x-base.input-group>
                        </td>
                    </div> -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
    $(".customers-validate-form").validate({
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.input-form').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        },
        rules: {
            qty_one: {
                required: true,
                digits: true
            },
            qty_two: {
                required: true,
                digits: true
            }
        },
        messages: {
            qty_one: {
                required: "Please enter quantity",
                digits: "Please enter only digits"
            },
            qty_two: {
                required: "Please enter quantity",
                digits: "Please enter only digits"
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