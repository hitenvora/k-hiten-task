@extends('../layouts/' . $layout)

@section('subhead')
    <title>Edit Product</title>
@endsection

@section('subcontent')
    <style>
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .column {
            width: 50%;
            /* Adjust as needed */
            /* background-color: #f2f2f2; */
            padding: 10px;
            /* border: 1px solid #ddd; */
            box-sizing: border-box;
        }

        .drop-zone {
            max-width: 600px;
            height: 600px;
            padding: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-family: "Quicksand", sans-serif;
            font-weight: 500;
            font-size: 20px;
            cursor: pointer;
            color: #cccccc;
            border: 4px dashed #009578;
            border-radius: 10px;
        }

        .drop-zone--over {
            border-style: solid;
        }

        .drop-zone__input {
            display: none;
        }

        .drop-zone__thumb {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            overflow: hidden;
            background-color: #cccccc;
            background-size: cover;
            position: relative;
        }

        .drop-zone__thumb::after {
            content: attr(data-label);
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 5px 0;
            color: #ffffff;
            background: rgba(0, 0, 0, 0.75);
            font-size: 14px;
            text-align: center;
        }
    </style>
    <div class="intro-y mt-8 flex items-center">
        <h2 class="mr-auto text-lg font-medium">Edit Product</h2>
    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <form class="customers-validate-form" id='myForm' action="{{ route('update.product', $Product->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="intro-y box p-5 lg:col-6">
                    <div class="row">
                        <div class="column">
                            <div class="input-form ">
                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="product-name">
                                    Product Name
                                    <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                        Required
                                    </span>
                                </x-base.form-label>
                                <x-base.form-input class="form-control" id="product-name" name="product_name" required
                                    type="text" placeholder="Product Name" value="{{ $Product->product_name }}"
                                    required />
                            </div>

                            <div class="input-form ">
                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="product-description">
                                    Description
                                    <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                        Description of the product
                                    </span>
                                </x-base.form-label>
                                <x-base.form-textarea class="form-control" id="product-description" name="description"
                                    placeholder="Product Description">{{ $Product->description }}</x-base.form-textarea>
                            </div>

                            <div class="input-form ">
                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="meta-title">
                                    Meta Title
                                    <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                        Meta Title of the product
                                    </span>
                                </x-base.form-label>
                                <x-base.form-input class="form-control" id="meta-title" name="meta_title" type="text"
                                    value="{{ $Product->meta_title }}" placeholder="Meta Title" />
                            </div>

                            <div class="input-form ">
                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="meta-description">
                                    Meta Description
                                    <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                        Meta Description of the product
                                    </span>
                                </x-base.form-label>
                                <x-base.form-textarea class="form-control" id="meta-description" name="meta_description"
                                    placeholder="Meta Description">{{ $Product->meta_description }}</x-base.form-textarea>
                            </div>

                            {{-- <div class="input-form ">

                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                                    Select Categorie Name
                                </x-base.form-label>
                                <select data-tw-merge aria-label=".form-select-lg example" id="category"
                                    class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2 sm:mt-2 sm:mr-2"name="category">

                                    <option value="">Please Select Category Name</option>
                                    @foreach ($Category as $data)
                                        <option value="{{ $data->id }}"
                                            @if ($data->id == $Product->category) selected @endif>
                                            {{ $data->name }}</option>
                                    @endforeach
                                </select>

                            </div> --}}
                            <div class="input-form ">

                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                                    Select Category Name
                                </x-base.form-label>
                                <select data-tw-merge aria-label=".form-select-lg example" id="sub_category"
                                    class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2 sm:mt-2 sm:mr-2"name="sub_category">

                                    <option value="">Please Select Category Name</option>
                                    @foreach ($SubCategory as $data)
                                        <option value="{{ $data->id }}"
                                            @if ($data->id == $Product->sub_category) selected @endif>
                                            {{ $data->name }}</option>
                                    @endforeach

                                </select>

                            </div>

                            {{-- <div class="input-form ">
                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="sub-category">
                                    Sub Category
                                    <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                        Sub Category of the product
                                    </span>
                                </x-base.form-label>
                                <x-base.form-input class="form-control" id="sub-category" name="sub_category" required
                                    type="text" placeholder="Sub Category" />
                            </div> --}}

                            <div class="input-form ">
                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="per-kg-price">
                                    Price
                                    <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                        Price
                                    </span>
                                </x-base.form-label>
                                <div data-tw-merge class="flex mt-2">
                                    {{-- {{ dd($Product->per_kg_price) }} --}}
                                    <input data-tw-merge required type="text"
                                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                        required name="per_kg_price" aria-label="Price" aria-describedby="input-group-price"
                                        placeholder="Price" value="{{ $Product->per_kg_price }}"
                                        class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 rounded-none [&amp;:not(:first-child)]:border-l-transparent first:rounded-l last:rounded-r z-10" />
                                    {{-- <div data-tw-merge id="input-group-price"
                                        class="py-2 px-3 bg-slate-100 border shadow-sm border-slate-200 text-slate-600 dark:bg-darkmode-900/20 dark:border-darkmode-900/20 dark:text-slate-400 rounded-none [&amp;:not(:first-child)]:border-l-transparent first:rounded-l last:rounded-r">
                                        KG
                                    </div> --}}
                                </div>
                                <label id="per_kg_price-error" class="is-invalid" for="per_kg_price"></label>
                            </div>
                            <div class="input-form ">
                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="barcode-number">
                                    MRP
                                    <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                        MRP of the product
                                    </span>
                                </x-base.form-label>
                                <x-base.form-input class="form-control" id="mrp"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    name="mrp" required type="text" placeholder="MRP" value="{{ $Product->mrp }}" />
                            </div>

                            <div class="input-form ">
                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="meta-title">
                                    Unite
                                    <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                        Unite
                                    </span>
                                </x-base.form-label>
                                <x-base.form-input class="form-control" id="meta-title" name="volume" type="text"
                                    value="{{ $Product->volume }}" placeholder="Unite" required />
                            </div>

                            <div class="input-form ">
                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="barcode-number">
                                    Barcode Number
                                    <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                        Barcode Number of the product
                                    </span>
                                </x-base.form-label>
                                <x-base.form-input class="form-control" id="barcode-number"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    name="barcode_number" required type="text" placeholder="Barcode Number"
                                    value="{{ $Product->barcodenumber }}" />
                            </div>

                            <div class="input-form ">
                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="barcode-number">
                                    HSN Code
                                    <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                                        HSN Code of the product
                                    </span>
                                </x-base.form-label>
                                <x-base.form-input class="form-control" id="hsn_cod"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    name="hsn_cod" required type="text" placeholder="HSN Code"
                                    value="{{ $Product->hsn_cod }}" />
                            </div>
                            {{-- {{dd($firm)}} --}}

                            <div class="input-form ">

                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1">
                                    GST

                                </x-base.form-label>
                                <div class="flex flex-col items-center sm:flex-row" style="display: none;">
                                    <select id="categorieid" data-tw-merge aria-label=".form-select-lg example"
                                        class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2 sm:mt-2 sm:mr-2"
                                        name="firm_id" onchange="categorieid()" required>

                                        <option value="">Please Select Firm</option>
                                        {{-- @foreach ($firm as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach --}}
                                        @foreach ($firm as $data)
                                            <option value="{{ $data->id }}"
                                                @if ($data->id == $Product->firm_id) selected @endif>
                                                {{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label id="categorieid-error" class="is-invalid" for="categorieid"></label>
                            </div>
                            {{-- {{ dd(json_decode($Product->gst)) }} --}}
                            @php

                                $gstList = json_decode($Product->gst);
                            @endphp
                            <div id="gst">
                                @foreach ($gstList as $gst)
                                    @foreach ($gst as $key => $value)
                                        <div class="flex mt-2">
                                            <input type="text"
                                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                name="gst[][{{ $key }}]" aria-label="{{ $key }}"
                                                value="{{ $value }}" aria-describedby="input-group-price"
                                                placeholder="{{ $key }}" required
                                                class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 rounded-none [&amp;:not(:first-child)]:border-l-transparent first:rounded-l last:rounded-r z-10" />
                                            <div id="input-group-price"
                                                class="py-2 px-3 bg-slate-100 border shadow-sm border-slate-200 text-slate-600 dark:bg-darkmode-900/20 dark:border-darkmode-900/20 dark:text-slate-400 rounded-none [&amp;:not(:first-child)]:border-l-transparent first:rounded-l last:rounded-r">
                                                {{ $key }}
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                                <label class="is-invalid"></label>
                            </div>


                            <div class="row">

                                <div class="input-form ">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="barcode-number">
                                        Price 1
                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" id="price_1" name="price_1" type="text"
                                        placeholder="Price 1" value="{{ $Product->price_1 }}" />
                                </div>

                                <div class="input-form ">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="barcode-number">
                                        Price 2

                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" id="price_2" name="price_2" type="text"
                                        placeholder="Price 2" value="{{ $Product->price_2 }}" />
                                </div>
                                <div class="input-form ">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="barcode-number">
                                        Price 3

                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" id="price_3" name="price_3" type="text"
                                        placeholder="Price 3" value="{{ $Product->price_3 }}" />
                                </div>
                                <div class="input-form ">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="barcode-number">
                                        Price 4
                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" id="price_4" name="price_4" type="text"
                                        placeholder="Price 4" value="{{ $Product->price_4 }}" />
                                </div>
                            </div>



                            <div class="row">

                                <div class="input-form ">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="barcode-number">
                                        Kg 1
                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" id="kg_1" name="kg_1" type="text"
                                        placeholder="Kg 1" value="{{ $Product->kg_1 }}" />
                                </div>

                                <div class="input-form ">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="barcode-number">
                                        Kg 2

                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" id="kg_2" name="kg_2" type="text"
                                        placeholder="Kg 2" value="{{ $Product->kg_2 }}" />
                                </div>
                                <div class="input-form ">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="barcode-number">
                                        Kg 3

                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" id="kg_3" name="kg_3" type="text"
                                        placeholder="Kg 3" value="{{ $Product->kg_3 }}" />
                                </div>
                                <div class="input-form ">
                                    <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="barcode-number">
                                        Kg 4
                                    </x-base.form-label>
                                    <x-base.form-input class="form-control" id="kg_4" name="kg_4" type="text"
                                        placeholder="Kg 4" value="{{ $Product->kg_4 }}" />
                                </div>
                            </div>




                        </div>
                        <div class="column">
                            {{-- <div class="mt-5 text-right">
                                <x-base.button class="w-30" onclick="submitForm()" variant="primary">
                                    Add ngredient
                                </x-base.button>
                            </div> --}}
                            <input type="hidden" id="add_ingredient" name="add_ingredient" value="0">
                            {{-- <div class="row"> --}}
                            <div class="mt-3">
                                <label>loose Product</label>
                                @if ($Product->lush == 1)
                                    <x-base.form-switch class="mt-2">
                                        <x-base.form-switch.input name="lush" type="checkbox" checked />
                                    </x-base.form-switch>
                                @else
                                    <x-base.form-switch class="mt-2">
                                        <x-base.form-switch.input name="lush" type="checkbox" />
                                    </x-base.form-switch>
                                @endif
                            </div>
                            <div class="mt-3">
                                <label>Popular Product</label>
                                @if ($Product->popular == 1)
                                    <x-base.form-switch class="mt-2">
                                        <x-base.form-switch.input name="popular" type="checkbox" checked />
                                    </x-base.form-switch>
                                @else
                                    <x-base.form-switch class="mt-2">
                                        <x-base.form-switch.input name="popular" type="checkbox" />
                                    </x-base.form-switch>
                                @endif
                            </div>
                            <div class="mt-3">
                                <label>Website Product</label>
                                @if ($Product->web == 1)
                                    <x-base.form-switch class="mt-2">
                                        <x-base.form-switch.input name="web" type="checkbox" checked />
                                    </x-base.form-switch>
                                @else
                                    <x-base.form-switch class="mt-2">
                                        <x-base.form-switch.input name="web" type="checkbox" />
                                    </x-base.form-switch>
                                @endif
                            </div>
                            <div class="mt-3">
                                <label>Decimal Amount</label>
                                @if ($Product->decimal == 1)
                                    <x-base.form-switch class="mt-2">
                                        <x-base.form-switch.input name="decimal" type="checkbox" checked />
                                    </x-base.form-switch>
                                @else
                                    <x-base.form-switch class="mt-2">
                                        <x-base.form-switch.input name="decimal" type="checkbox" />
                                    </x-base.form-switch>
                                @endif
                            </div>
                            <div class="input-form ">
                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="product-image">
                                    Product Image
                                </x-base.form-label>
                                <div class="drop-zone">

                                    <input type="file" name="image" class="drop-zone__input" required>
                                    @if ($Product->image)
                                        <img src="{{ asset($Product->image) }}"
                                            style="max-height: 490px;max-width: 490px;">
                                    @else
                                        <span class="drop-zone__prompt">Drop Product image file here or click to
                                            upload</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-right">
                        <x-base.button class="mr-1 w-24" type="button" id="cancel_btn" variant="outline-secondary">
                            Cancel
                        </x-base.button>
                        <x-base.button class="w-24" type="submit" variant="primary">
                            save
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
    <script>
        function submitForm() {
            $('#add_ingredient').val(1);
            $('#myForm').submit();
        }
    </script>

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
        $(document).ready(function() {
            jQuery('#category').change(function() {
                var category_id = jQuery(this).val();
                jQuery.ajax({
                    url: "{{ route('get.subcategories') }}",
                    method: 'GET',
                    data: {
                        category_id: category_id
                    },
                    success: function(response) {
                        var options = '<option value="">Select Subcategory</option>';
                        jQuery.each(response, function(index, subcategory) {
                            options += '<option value="' + subcategory.id + '">' +
                                subcategory.name + '</option>';
                        });
                        jQuery('#sub_category').html(options);
                    }
                });
            });
        });
    </script>
    <script>
        jQuery(document).ready(function() {
            // Define the function
            function categorieid() {
                var categorieId = jQuery('#categorieid').val();
                if (categorieId) {
                    jQuery.ajax({
                        type: "POST",
                        url: "{{ route('get.firm') }}",
                        data: {
                            categorieId: categorieId,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            console.log(response);
                            var container = document.getElementById('gst');
                            container.innerHTML = ''; // Clear the container
                            container.innerHTML = response; // Assign the response HTML to the container
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            }

            // Bind the function to the onchange event of the select element
            jQuery('#categorieid').change(function() {
                categorieid(); // Call the function when the select element's value changes
            });
        });
    </script>
    <script>
        $(".customers-validate-form").validate({
            // ignore: ':hidden:not(:checkbox)',
            ignore: ':hidden:not(:radio)',
            errorElement: 'label',
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            rules: {
                category_name: {
                    required: true,
                    minlength: 2,
                    maxlength: 200,
                }

            },
            messages: {
                category_name: {
                    required: "Please Enter Gst & Text Name",
                },
            }
        });

        document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
            const dropZoneElement = inputElement.closest(".drop-zone");

            dropZoneElement.addEventListener("click", (e) => {
                inputElement.click();
            });

            inputElement.addEventListener("change", (e) => {
                if (inputElement.files.length) {
                    const file = inputElement.files[0];
                    if (file && file.type.startsWith("image/")) {
                        updateThumbnail(dropZoneElement, file);
                    } else {
                        alert("Please select an image file.");
                        inputElement.value = ""; // Clear the file input
                    }
                }
            });

            dropZoneElement.addEventListener("dragover", (e) => {
                e.preventDefault();
                dropZoneElement.classList.add("drop-zone--over");
            });

            ["dragleave", "dragend"].forEach((type) => {
                dropZoneElement.addEventListener(type, (e) => {
                    dropZoneElement.classList.remove("drop-zone--over");
                });
            });

            dropZoneElement.addEventListener("drop", (e) => {
                e.preventDefault();

                if (e.dataTransfer.files.length) {
                    const file = e.dataTransfer.files[0];
                    if (file && file.type.startsWith("image/")) {
                        inputElement.files = e.dataTransfer.files;
                        updateThumbnail(dropZoneElement, file);
                    } else {
                        alert("Please drop an image file.");
                    }
                }

                dropZoneElement.classList.remove("drop-zone--over");
            });
        });

        /**
         * Updates the thumbnail on a drop zone element.
         *
         * @param {HTMLElement} dropZoneElement
         * @param {File} file
         */
        function updateThumbnail(dropZoneElement, file) {
            let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

            // First time - remove the prompt
            if (dropZoneElement.querySelector(".drop-zone__prompt")) {
                dropZoneElement.querySelector(".drop-zone__prompt").remove();
            }

            // First time - there is no thumbnail element, so lets create it
            if (!thumbnailElement) {
                thumbnailElement = document.createElement("div");
                thumbnailElement.classList.add("drop-zone__thumb");
                dropZoneElement.appendChild(thumbnailElement);
            }

            thumbnailElement.dataset.label = file.name;

            // Show thumbnail for image files
            if (file.type.startsWith("image/")) {
                const reader = new FileReader();

                reader.readAsDataURL(file);
                reader.onload = () => {
                    thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
                };
            } else {
                thumbnailElement.style.backgroundImage = null;
            }
        }
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
