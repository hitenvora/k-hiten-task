@extends('../layouts/' . $layout)

@section('subhead')
    <title> Edit Many To One Product</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex items-center">
        <h2 class="mr-auto text-lg font-medium"> Edit Many To One Product</h2>
    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <form class="customers-validate-form" action="{{ route('updateIngredientData', $Product->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="">
                    <input type="hidden" name="product_id" value="{{ $Product->id }}">
                    <div class="intro-y box p-5">
                        <div class="intro-y grid  grid-cols-12 gap-4">
                            <div class="input-form col-span-4">
                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="meta-title">
                                    Threshold Qty
                                </x-base.form-label>
                                <x-base.form-input class="form-control" id="meta-title" name="threshold_qty" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    type="text" value="{{ $Conversion->threshold_qty ?? 0 }}" placeholder="Threshold Qty" min='0' />
                            </div>
                            <div class="input-form col-span-4">
                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="meta-title">
                                    Manufactur Qty
                                </x-base.form-label>
                                <x-base.form-input class="form-control" id="meta-title" name="manufactur_qty" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    type="text" value="{{ $Conversion->manufactur_qty ?? 0 }}" placeholder="Manufactur Qty"  min='0' />
                            </div>
                            <div class="input-form col-span-12">
                                <div class="mb-0">
                                    <div class="w-full text-end my-5">
                                        <x-base.button class="w-24" id="addQuoteItem" type="button"
                                            onclick="addTableRow()" variant="primary">
                                            + Add
                                        </x-base.button>
                                    </div>
                                    <div class="block w-full overflow-auto scrolling-touch">
                                        <table
                                            class="w-full max-w-full mb-4 bg-transparent table-striped box-shadow-none mt-4"
                                            id="billTbl">
                                            <thead>
                                                <tr class="border-b fs-7 fw-bolder text-gray-700 uppercase">
                                                    {{-- <th scope="col">#</th> --}}
                                                    <th scope="col" class="required">Product</th>
                                                    <th scope="col" class="required">volume</th>
                                                    <th scope="col" class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="quote-item-container table-body">
                                                @if ($productIngredient->count() != 0)
                                                    @foreach ($productIngredient as $list)
                                                        <tr class="border-b border-bottom-dashed tax-tr">
                                                            {{-- <td class="text-center item-number align-center">1</td> --}}
                                                            <td class="table__item-desc w-1/4">
                                                                <select data-tw-merge aria-label=".form-select-lg example"
                                                                    id="ingredient"
                                                                    class="ingredientSelect disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2 sm:mt-2 sm:mr-2"
                                                                    name="ingredient[]" style="margin: 0;">
                                                                    <option value="">Please Select Product </option>

                                                                    @foreach ($ingredient as $data)
                                                                        <option value="{{ $data->id }}"
                                                                            @if ($list->ingredient_id == $data->id) selected @endif>
                                                                            {{ $data->product_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td class="table__qty">
                                                                <x-base.input-group class="" inputGroup>
                                                                    <x-base.form-input type="text" class="quantity"
                                                                        aria-label="volume"
                                                                        aria-describedby="input-group-volume"
                                                                        placeholder="volume"
                                                                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                        name="quantity[]" min='0' required
                                                                        value="{{ $list->qty }}" />
                                                                    <x-base.input-group.text class="input-group-volume">
                                                                        @if ($list->GetProduct->lush)
                                                                            KG
                                                                        @else
                                                                            QTY
                                                                        @endif
                                                                    </x-base.input-group.text>
                                                                </x-base.input-group>
                                                            </td>
                                                            <td class="text-end">
                                                                <button type="button" title="Delete"
                                                                    class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-1 px-2 leading-tight text-xs  text-red-600 fs-3 btn-icon btn-active-color-danger delete-quote-item"
                                                                    fdprocessedid="eexzf">
                                                                    <x-base.lucide class="mr-1 h-4 w-4"
                                                                        icon="Trash" />
                                                                </button>


                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr class="border-b border-bottom-dashed tax-tr">
                                                        <td class="table__item-desc w-1/4">
                                                            <select data-tw-merge aria-label=".form-select-lg example"
                                                                id="ingredient"
                                                                class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2 sm:mt-2 sm:mr-2"
                                                                name="ingredient[]" style="margin: 0;">
                                                                <option value="">Please Select Ingredient </option>

                                                                @foreach ($ingredient as $data)
                                                                    <option value="{{ $data->id }}">
                                                                        {{ $data->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td class="table__qty">
                                                            <x-base.input-group class="" inputGroup>
                                                                <x-base.form-input type="text" class="quantity"
                                                                    aria-label="volume"
                                                                    aria-describedby="input-group-volume"
                                                                    placeholder="volume"
                                                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                    name="quantity[]" min='0' required
                                                                    value="" />
                                                                <x-base.input-group.text class="input-group-volume">
                                                                    KG
                                                                </x-base.input-group.text>
                                                            </x-base.input-group>
                                                        </td>
                                                        {{-- <td class="taxes text-center quote-item-total whitespace-no-wrap"
                                                        style="text-align:center">
                                                    </td>
                                                    <td class="tbAmount text-center quote-item-total whitespace-no-wrap"
                                                        style="text-align:center">
                                                    </td> --}}
                                                        <td class="text-end">
                                                            <button type="button" title="Delete"
                                                                class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-1 px-2 leading-tight text-xs  text-red-600 fs-3 btn-icon btn-active-color-danger delete-quote-item"
                                                                fdprocessedid="eexzf">
                                                                <x-base.lucide class="mr-1 h-4 w-4"
                                                                    icon="Trash" /><!-- <i class="fa-solid fa-trash"></i> Font Awesome fontawesome.com -->
                                                            </button>


                                                        </td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-5 text-right">
                                    <x-base.button class="mr-1 w-24" onclick="goToAddCategoriePage()" type="button"
                                        variant="outline-secondary">
                                        Cancel
                                    </x-base.button>
                                    <x-base.button class="w-24" type="submit" variant="primary">
                                        Save
                                    </x-base.button>
                                </div>
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
        function goToAddCategoriePage() {
            // Redirect to another page when the button is clicked
            window.location.href = "{{ route('products.list') }}";
        }
    </script>
    <script>
        $(document).ready(function () {
            // Function to handle change event on ingredient select
            function handleIngredientSelectChange() {
                var selectedValues = [];
                $('.ingredientSelect').each(function() {
                    var value = $(this).val();
                    if (value) {
                        selectedValues.push(value);
                    }
                });
    
                var selectedValue = $(this).val();
                if (selectedValue && selectedValues.indexOf(selectedValue) !== selectedValues.lastIndexOf(selectedValue)) {
                    $(this).val('').change();
                    alert('This option is already selected.');
                }
            }
    
            // Attach the change event listener to the table body
            $('#billTbl').on('change', '.ingredientSelect', handleIngredientSelectChange);
    
            // Trigger change event on existing select elements
            $('.ingredientSelect').change();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function handleRowInput(event) {
                var row = event.target.closest('tr');
            }

            document.querySelectorAll('.table-body').forEach(function(tableBody) {
                tableBody.addEventListener('input', function(event) {
                    if (event.target.classList.contains('quantity') || event.target.classList
                        .contains('productPrice')) {
                        handleRowInput(event);
                    }
                });
            });

            document.querySelectorAll('.table-body tr').forEach(function(row) {
                // calculateRowAmounts(row);
            });

            // updateQuoteTotal();
        });
    </script>
    <script>
        function addTableRow() {

            var templateRow = document.querySelector('.tax-tr');
            var newRow = templateRow.cloneNode(true);

            var inputs = newRow.querySelectorAll('input');
            inputs.forEach(function(input) {
                input.value = '';
            });

            var deleteButton = newRow.querySelector('.delete-quote-item');
            deleteButton.addEventListener('click', function() {
                newRow.remove();
                var sum = 0;
                var elements = document.querySelectorAll('.tbAmount');
                for (var i = 0; i < elements.length; i++) {
                    var value = parseInt(elements[i].value);
                    if (!isNaN(value)) {
                        sum += value;
                    }
                }
                $('#quoteTotal').text(sum.toFixed(0));
            });

            var taxessum = 0;
            var elements = document.querySelectorAll('.taxes');
            for (var i = 0; i < elements.length; i++) {
                var value = parseInt(elements[i].value);
                if (!isNaN(value)) {
                    taxessum += value;
                }
            }
            $('#tax').text(taxessum.toFixed(0));

            var tableBody = document.querySelector('.table-body');
            tableBody.appendChild(newRow);
        }
        document.addEventListener('change', function(event) {
            if (event.target && event.target.id === 'ingredient') {
                var ingredientId = event.target.value;
                var url = '{{ url('fetchproduct') }}';

                console.log('ingredientId ID:', ingredientId);
                console.log('URL:', url);

                jQuery.ajax({
                    url: url + '/' + ingredientId,
                    method: "GET",
                    success: function(data) {

                        console.log('AJAX Response:', data);
                        var selectedRow = event.target.closest('tr');


                        var looseValue = data.data.lush;
                        console.log('Loose Value:', looseValue);


                        
                        var unitLabel = selectedRow.querySelector('.table__qty .input-group-volume');

                        if (unitLabel) {
                            var tbAmount = selectedRow.querySelector('.tbAmount');
                            // if (looseValue == 0) {
                            //     unitLabel.innerText = 'QTY';
                            // } else {
                            //     unitLabel.innerText = 'KG';
                            // }
                            var volumeValue = data.data.volume;
                                    unitLabel.innerText = `${volumeValue}`;
                        } else {
                            console.error('Unit label not found.');
                        }

                        var sum = 0;
                        var elements = document.querySelectorAll('.tbAmount');
                        for (var i = 0; i < elements.length; i++) {     
                            var value = parseInt(elements[i].value);
                            if (!isNaN(value)) {
                                sum += value;
                            }
                        }
                        $('#quoteTotal').text(sum.toFixed(0));
                        var quoteTotal = sum.toFixed(0);

                        var taxessum = 0;
                        var elements = document.querySelectorAll('.taxes');
                        for (var i = 0; i < elements.length; i++) {
                            var value = parseInt(elements[i].value);
                            if (!isNaN(value)) {
                                taxessum += value;
                            }
                        }
                        $('#tax').text(taxessum.toFixed(0));

                        console.log("subtotal", quoteTotal);
                        var discountvel = $('#discount').val() || 0;
                        var tax = parseInt($('#tax').text()) || 0;
                        discount = quoteTotal * (discountvel / 100);

                        console.log(discount, tax, quoteTotal - discount);

                        $('#quoteTotal').text(quoteTotal);
                        $('#quoteDiscountAmount').text(discount.toFixed(0));
                        $('#quoteFinalAmount').text((quoteTotal - discount + tax).toFixed(0));

                        $('.final_amount').val((quoteTotal - discount + tax).toFixed(0));
                        $('.t_discount').val(discount.toFixed(0));
                        $('.sub_total').val(quoteTotal);
                        $('.t_tax').val(taxessum.toFixed(0));

                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error('AJAX Error:', status, error);
                    }
                });
            }
        });
    </script>
    <script>
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
