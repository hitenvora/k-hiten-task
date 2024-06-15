@extends('../layouts/' . $layout)

@section('subhead')
    <title>Add Entry</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex items-center">
        <h2 class="mr-auto text-lg font-medium">Add Entry</h2>
    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <form class="customers-validate-form" action="{{ route('save.entry') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="">
                    <div class="intro-y box p-5">
                        <div class="intro-y grid  grid-cols-12 gap-4">
                            {{-- <div class="input-form col-span-8">

                                <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="validation-form-1"
                                    style="margin: 2px;">
                                    Select Party
                                </x-base.form-label>
                                <select data-tw-merge aria-label=".form-select-lg example" id="partie_id"
                                    class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2 sm:mt-2 sm:mr-2"
                                    name="partie_id" style="margin: 0;" required>

                                    @foreach ($customerData as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>

                            </div> --}}
                            <input type="hidden" name="partie_id" value="{{ $id }}">

                            <div class="input-form col-span-12">
                                <div class="mb-0">

                                    <div class="block w-full overflow-auto scrolling-touch">
                                        <table
                                            class="w-full max-w-full mb-4 bg-transparent table-striped box-shadow-none mt-4"
                                            id="billTbl">
                                            <thead>
                                                <tr class="border-b fs-7 fw-bolder text-gray-700 uppercase">
                                                    {{-- <th scope="col">#</th> --}}
                                                    <th scope="col" class="required">Bill NO</th>
                                                    <th scope="col" class="required">Rupees</th>
                                                    <th scope="col" class="required">Credit Debit</th>
                                                    <th scope="col" class="required">Narration</th>
                                                </tr>
                                            </thead>
                                            <tbody class="quote-item-container table-body">
                                                <tr class="border-b border-bottom-dashed tax-tr">
                                                    <td class="table__qty">
                                                        <select aria-label=".form-select-lg example" id="perch_id"
                                                            class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full border-slate-200 shadow-sm rounded-md px-3 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2"
                                                            name="perch_id" style="margin: 0;" required>
                                                            <option value="">Selecte Bill No.</option>
                                                            @foreach ($purchse_id as $item)
                                                                <option value="{{ $item->id }}">O-ID:
                                                                    {{ $item->id }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>

                                                        <x-base.input-group class="">
                                                            <x-base.form-input type="text" class="rupee"
                                                                aria-label="volume" aria-describedby="input-group-volume"
                                                                placeholder="Rupee" name="rupee" id="rupee" required
                                                                readonly />

                                                        </x-base.input-group>
                                                    </td>
                                                    <td>
                                                        <select aria-label=".form-select-lg example" id="credit_debit"
                                                            class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full border-slate-200 shadow-sm rounded-md px-3 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2"
                                                            name="credit_debit" style="margin: 0;" required>
                                                            <option value="">Please Select Credit/Debit</option>
                                                            <option value="0">Credit</option>
                                                            <option value="1">Debit</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <x-base.input-group class="" inputGroup>
                                                            <x-base.form-input type="text" class="narration"
                                                                aria-label="volume" aria-describedby="input-group-volume"
                                                                placeholder="Narration" name="narration" required />

                                                        </x-base.input-group>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="flex flex-wrap ">
                                        <div
                                            class="lg:w-3/5 pr-4 pl-4 sm:w-full pr-4 pl-4 mt-2 lg:mt-0 align-right-for-full-screen">
                                            <div
                                                class="mb-2 xl:w-1/2 pr-4 pl-4 lg:w-4/5 pr-4 pl-4 sm:w-full pr-4 pl-4 float-left">
                                                <label for="discount" class="form-label mb-1">Payment Type:</label>
                                                <select aria-label=".form-select-lg example" id="payment_type"
                                                    class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full border-slate-200 shadow-sm rounded-md px-3 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2"
                                                    name="payment_type" style="margin: 0;" required>
                                                    <option value="">Please Select Payment Type </option>
                                                    <option value="0">Cash</option>
                                                    <option value="1">Check</option>
                                                    <option value="2">RTGS</option>
                                                </select>
                                                <div class="check_no" style="display: none;">
                                                    <label for="check_no" class="form-label mb-1">Check Number</label>
                                                    <div class="relative flex items-stretch w-full">
                                                        <x-base.form-input class="form-control" name="check_no"
                                                            id="check_no" type="text" placeholder="Check Number"
                                                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                            value="0" pattern="^\d*(\.\d{0,2})?$" name="check_no"
                                                            minlength="1" required />
                                                    </div>
                                                </div>
                                                <div class="rtgs_no" style="display: none;">
                                                    <label for="rtgs_no" class="form-label mb-1">Refrence Number</label>
                                                    <div class="relative flex items-stretch w-full">
                                                        <x-base.form-input class="form-control" name="rtgs_no"
                                                            id="rtgs_no" type="text" placeholder="Refrence Number"
                                                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                            value="0" pattern="^\d*(\.\d{0,2})?$" name="rtgs_no"
                                                            minlength="1" required />
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="bank_id" style="display: none;">
                                                <div
                                                    class="mb-2 xl:w-1/2 pr-4 pl-4 lg:w-4/5 pr-4 pl-4 sm:w-full pr-4 pl-4 float-left">
                                                    <label for="bank_id" class="form-label mb-1">Bank Name</label>
                                                    <select aria-label=".form-select-lg example" id="bank_id"
                                                        class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full border-slate-200 shadow-sm rounded-md px-3 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 text-lg py-1.5 pl-4 pr-8 sm:mt-2 sm:mr-2"
                                                        name="bank_id" style="margin: 0;">
                                                        <option value="">Please Select Bank Name </option>
                                                        @foreach ($bank_list as $item)
                                                            <option value="{{ $item->id }}">{{ $item->bank_name }}
                                                            </option>
                                                        @endforeach

                                                    </select>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-right">
                            <x-base.button class="mr-1 w-24" type="button" variant="outline-secondary" id="cancel_btn">
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
        // document.addEventListener('DOMContentLoaded', function() {
        //     function calculateRowAmounts(row) {
        //         var subtotal = 0;
        //         var discount = 0;
        //         var total = 0;

        //         var quantity = parseFloat(row.querySelector('.quantity').value) || 0;
        //         var unitPrice = parseFloat(row.querySelector('.productPrice').value) || 0;
        //         var totalGST = parseFloat(row.querySelector('.gst').value) || 0;
        //         subtotal = quantity * unitPrice;

        //         total = subtotal - discount;

        //         const gstAmount = subtotal * (totalGST / 100);

        //         row.querySelector('.taxes').value = gstAmount.toFixed(0);
        //         row.querySelector('.tbAmount').value = subtotal.toFixed(0);

        //         return subtotal;
        //     }

        //     function updateQuoteTotal() {
        //         var quoteTotal = 0;

        //         document.querySelectorAll('.table-body tr').forEach(function(row) {
        //             quoteTotal += calculateRowAmounts(row);
        //         });

        //         console.log("subtotal", quoteTotal);
        //         var discountvel = $('#discount').val() || 0;
        //         var tax = parseInt($('#tax').text()) || 0;
        //         discount = quoteTotal * (discountvel / 100);


        //         console.log(discount, tax, quoteTotal - discount);

        //         if (decimalValue == 0) {
        //             $('#quoteTotal').text(quoteTotal.toFixed(0));
        //             $('#quoteDiscountAmount').text(discount.toFixed(0));
        //             $('#quoteFinalAmount').text((quoteTotal - discount + tax).toFixed(0));

        //             $('.final_amount').val((quoteTotal - discount + tax).toFixed(0));
        //             $('.t_discount').val(discount.toFixed(0));
        //             $('.t_tax').val(taxessum);
        //             $('.sub_total').val(gstAmount.toFixed(0));
        //         } else {
        //             $('#quoteTotal').text(quoteTotal.toFixed(3));
        //             $('#quoteDiscountAmount').text(discount.toFixed(3));
        //             $('#quoteFinalAmount').text((quoteTotal - discount + tax).toFixed(3));

        //             $('.final_amount').val((quoteTotal - discount + tax).toFixed(3));
        //             $('.t_discount').val(discount.toFixed(3));
        //             $('.t_tax').val(taxessum);
        //             $('.sub_total').val(gstAmount.toFixed(3));
        //         }
        //     }


        //     function handleRowInput(event) {
        //         var row = event.target.closest('tr');
        //         calculateRowAmounts(row);
        //         updateQuoteTotal();
        //     }

        //     jQuery('#discount').change(function() {
        //         updateQuoteTotal();
        //     });
        //     document.querySelectorAll('.table-body').forEach(function(tableBody) {
        //         tableBody.addEventListener('input', function(event) {
        //             if (event.target.classList.contains('quantity') || event.target.classList
        //                 .contains('productPrice')) {
        //                 handleRowInput(event);
        //             }
        //         });
        //     });

        //     document.querySelectorAll('.table-body tr').forEach(function(row) {
        //         calculateRowAmounts(row);
        //     });

        //     updateQuoteTotal();
        // });
    </script>
    <script>
        $("#payment_type").on('change', function() {
            if (this.value === '1') {
                $('.check_no').show();
                $('.rtgs_no').hide(); // Hide rtgs_no when payment_type is 1
                $('.bank_id').show();
            } else if (this.value === '2') {
                $('.check_no').hide(); // Hide check_no when payment_type is 2
                $('.rtgs_no').show();
                $('.bank_id').show();
            } else {
                $('.check_no').hide();
                $('.rtgs_no').hide();
                $('.bank_id').hide();
            }
        });

        $("#cancel_btn").click(function() {
            history.go(-1);
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#perch_id').on('change', function() {
                var perchId = $(this).val();
                if (perchId) {
                    jQuery.ajax({
                        url: '/get-rupee/' + perchId,
                        type: 'GET',
                        success: function(response) {
                            $('#rupee').val(response.rupee);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    $('#rupee').val('');
                }
            });
        });
    </script>



    <script>
        // function addTableRow() {

        //     var templateRow = document.querySelector('.tax-tr');
        //     var newRow = templateRow.cloneNode(true);

        //     var inputs = newRow.querySelectorAll('input');
        //     inputs.forEach(function(input) {
        //         input.value = '';
        //     });

        //     var deleteButton = newRow.querySelector('.delete-quote-item');
        //     deleteButton.addEventListener('click', function() {
        //         newRow.remove();
        //         var sum = 0;
        //         var elements = document.querySelectorAll('.tbAmount');
        //         for (var i = 0; i < elements.length; i++) {
        //             var value = parseInt(elements[i].value);
        //             if (!isNaN(value)) {
        //                 sum += value;
        //             }
        //         }
        //         if (decimalValue == 0) {
        //             $('#quoteTotal').text(sum.toFixed(0));
        //         } else {
        //             $('#quoteTotal').text(sum.toFixed(3));
        //         }
        //     });

        //     var taxessum = 0;
        //     var elements = document.querySelectorAll('.taxes');
        //     for (var i = 0; i < elements.length; i++) {
        //         var value = parseInt(elements[i].value);
        //         if (!isNaN(value)) {
        //             taxessum += value;
        //         }
        //     }
        //     $('#tax').text(taxessum.toFixed(0));

        //     var tableBody = document.querySelector('.table-body');
        //     tableBody.appendChild(newRow);
        // }
        // document.addEventListener('change', function(event) {
        //     if (event.target && event.target.id === 'product') {
        //         var productId = event.target.value;
        //         var url = '{{ url('fetchproduct') }}';

        //         console.log('Product ID:', productId);
        //         console.log('URL:', url);

        //         jQuery.ajax({
        //             url: url + '/' + productId,
        //             method: "GET",
        //             success: function(data) {

        //                 console.log('AJAX Response:', data);
        //                 var selectedRow = event.target.closest(
        //                     'tr');

        //                 var priceInput = selectedRow.querySelector('.productPrice');
        //                 console.log('Price Input:', priceInput);

        //                 if (priceInput) {
        //                     var price = parseFloat(data.data
        //                         .per_kg_price);
        //                     priceInput.value = price;
        //                 } else {
        //                     console.error('Price input not found.');
        //                 }

        //                 var priceInput = selectedRow.querySelector('.productPrice');
        //                 console.log('Price Input:', priceInput);
        //                 if (priceInput) {
        //                     var price = parseFloat(data.data
        //                         .per_kg_price);
        //                     priceInput.value = price;
        //                 } else {
        //                     console.error('Price input not found.');
        //                 }

        //                 var lushValue = data.data.lush;
        //                 console.log('Lush Value:', lushValue);


        //                 var decimalValue = data.data.decimal;
        //                 console.log('Decimal Value:', decimalValue);

        //                 var quantityInput = selectedRow.querySelector('.table__qty input[type="text"]');
        //                 quantityInput.value = 1;

        //                 let totalGST = 0;

        //                 const jsonObject = JSON.parse(data.data.gst);
        //                 for (let key in jsonObject) {
        //                     if (jsonObject.hasOwnProperty(key)) {
        //                         for (let nestedKey in jsonObject[key]) {
        //                             let value = jsonObject[key][nestedKey];
        //                             totalGST += parseFloat(value);
        //                         }
        //                     }
        //                 }
        //                 console.log('GST', totalGST);
        //                 var gst = selectedRow.querySelector('.gst');
        //                 gst.value = totalGST;

        //                 const gstAmount = price * (totalGST / 100);
        //                 const totalPriceIncludingGST = price + gstAmount

        //                 var taxes = selectedRow.querySelector('.taxes');

        //                 if (taxes) {
        //                     taxes.value = gstAmount.toFixed(0);
        //                 } else {
        //                     console.error('taxes input not found.');
        //                 }

        //                 var unitLabel = selectedRow.querySelector('.table__qty .input-group-volume');

        //                 if (quantityInput) {

        //                     if (unitLabel) {
        //                         var quantity = parseFloat(quantityInput.value);
        //                         var tbAmount = selectedRow.querySelector('.tbAmount');
        //                         if (!isNaN(quantity) && !isNaN(price)) {
        //                             var tbAmount = selectedRow.querySelector('.tbAmount');
        //                             if (tbAmount) {
        //                                 var price = parseFloat(data.data.per_kg_price);
        //                                 if (decimalValue == 0) {
        //                                     tbAmount.value = totalPriceIncludingGST.toFixed(0);
        //                                 } else {
        //                                     tbAmount.value = totalPriceIncludingGST.toFixed(3);
        //                                 }
        //                             } else {
        //                                 console.error('tbAmount input not found.');
        //                             }
        //                             // if (lushValue == 0) {
        //                             //     quantityInput.style.display = 'block';
        //                             //     unitLabel.innerText = 'QTY';
        //                             // } else {
        //                             //     unitLabel.innerText = 'KG';
        //                             // }
        //                             var volumeValue = data.data.volume;
        //                             unitLabel.innerText = `${volumeValue}`;
        //                         } else {
        //                             console.error('Invalid quantity or price.');
        //                         }
        //                     } else {
        //                         console.error('Unit label not found.');
        //                     }
        //                 } else {
        //                     console.error('Quantity input not found.');
        //                 }

        //                 var sum = 0;
        //                 var elements = document.querySelectorAll('.tbAmount');
        //                 for (var i = 0; i < elements.length; i++) {
        //                     var value = parseFloat(elements[i].value);
        //                     if (!isNaN(value)) {
        //                         sum += value;
        //                     }
        //                 }
        //                 if (decimalValue == 0) {
        //                     $('#quoteTotal').text(sum.toFixed(0));
        //                     var quoteTotal = sum.toFixed(0);
        //                 } else {
        //                     $('#quoteTotal').text(sum.toFixed(3));
        //                     var quoteTotal = sum.toFixed(3);
        //                 }
        //                 var taxessum = 0;
        //                 var elements = document.querySelectorAll('.taxes');
        //                 for (var i = 0; i < elements.length; i++) {
        //                     var value = parseInt(elements[i].value);
        //                     if (!isNaN(value)) {
        //                         taxessum += value;
        //                     }
        //                 }
        //                 $('#tax').text(taxessum.toFixed(0));

        //                 console.log("subtotal", quoteTotal);
        //                 var discountvel = $('#discount').val() || 0;
        //                 var tax = parseInt($('#tax').text()) || 0;
        //                 discount = quoteTotal * (discountvel / 100);

        //                 console.log(discount, tax, quoteTotal - discount);

        //                 $('#quoteTotal').text(quoteTotal);

        //                 if (decimalValue == 0) {
        //                     $('#quoteDiscountAmount').text(discount.toFixed(0));
        //                     $('#quoteFinalAmount').text((quoteTotal - discount + tax).toFixed(0));
        //                     $('.final_amount').val((quoteTotal - discount + tax).toFixed(0));
        //                     $('.t_discount').val(discount.toFixed(0));
        //                     $('.sub_total').val(quoteTotal);
        //                     $('.t_tax').val(taxessum.toFixed(0));
        //                 } else {
        //                     $('#quoteDiscountAmount').text(discount.toFixed(3));
        //                     $('#quoteFinalAmount').text((quoteTotal - discount + tax).toFixed(3));
        //                     $('.final_amount').val((quoteTotal - discount + tax).toFixed(3));
        //                     $('.t_discount').val(discount.toFixed(3));
        //                     $('.sub_total').val(quoteTotal);
        //                     $('.t_tax').val(taxessum.toFixed(0));
        //                 }

        //             },
        //             error: function(xhr, status, error) {
        //                 // Handle errors
        //                 console.error('AJAX Error:', status, error);
        //             }
        //         });
        //     }
        // });
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

            },
            messages: {
                name: {
                    required: "Please Enter Categorie Name",
                },

            }
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#perch_id').on('change', function() {
                var perchId = $(this).val();
                var rupeeValue = '';

                // Find the corresponding rupee value based on the selected perch_id
                @foreach ($purchse_id as $item)
                    if ("{{ $item->id }}" == perchId) {
                        rupeeValue = "{{ $item->rupee }}";
                        // No need for break here
                    }
                @endforeach

                // Update the value of the rupee input field
                $('#rupee').val(rupeeValue);
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="path/to/jquery.validate.js"></script> --}}
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
