@extends('front-pages.layout.layout')
@section('title', 'Payment')
@section('footer_class', 'margin_top80')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/payment.css') }}">


    <main>
        <!-- payment-bg seaction start -->
        <section>
            <div class="payment-bg">
                <div class="container">
                    <h1 class="mogra-regular">Payment</h1>
                </div>
            </div>
        </section>
        <!-- payment-bg seaction end -->

        <!-- payment method seaction start -->
        <section>
            <div class="payment margin_top80">
                <div class="container">
                    <img class="number-img" src="{{ asset('assets/image/payment/nub.png') }}" alt="">
                    <div class="row">
                        <div class="col-lg-8 padding_top70">
                            <div class="box-method">
                                <div class="select-method">
                                    <h3 class="outfit">Select Payment Method</h3>
                                    <p><img src="{{ asset('assets/image/payment/Vector.png') }}" alt=""> 100% safe
                                        payments</p>
                                </div>
                                <div class="extra-off margin_top20">
                                    <a href="">
                                        <h4 class="outfit">Pay online and get EXTRA Rs.16 off</h4>
                                    </a>
                                </div>
                                <!-- pay online -->
                                <div class="accordion margin_top60">
                                    <div class="pay-online">
                                        <h5 class="outfit">Pay Online</h5>
                                        <div class="accordion-item">
                                            <button id="accordion-button-1" aria-expanded="false">
                                                <span class="accordion-title"><img
                                                        src="{{ asset('assets/image/payment/upi.png') }}" alt="">
                                                    UPI (G Pay/PhonePe/Paytm)</span>
                                                <span class="icon" aria-hidden="true"></span>
                                            </button>
                                            <div class="accordion-content">
                                                <div class="group-payment">
                                                    <input type="text" required="required" placeholder="UPI ID" /><span
                                                        class="highlight"></span><span class="bar"></span>
                                                    <div class="pay-upi">
                                                        <a href="">Pay Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <button id="accordion-button-1" aria-expanded="false">
                                                <span class="accordion-title"> <i class="fa-solid fa-wallet"></i>
                                                    Wallets</span>
                                                <span class="icon" aria-hidden="true"></span>
                                            </button>
                                            <div class="accordion-content">
                                                <div class="paytm">
                                                    <h5><img src="{{ asset('assets/image/payment/paytm.png') }}"
                                                            alt=""> Paytm
                                                        Payments Bank Wallet </h5>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault" id="flexRadioDefault1">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="paytm">
                                                    <h5><img src="{{ asset('assets/image/payment/mob.png') }}"
                                                            alt=""> Mobikwik ZIP
                                                        (pay later) </h5>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault" id="flexRadioDefault1">
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <button id="accordion-button-1" aria-expanded="false">
                                                <span class="accordion-title"> <img
                                                        src="{{ asset('assets/image/payment/debit.png') }} " alt="">
                                                    Debit Card/Credit Card</span>
                                                <span class="icon" aria-hidden="true"></span>
                                            </button>
                                            <div class="accordion-content">
                                                <form action="">
                                                    <div class="form-group mt-2">
                                                        <label class="outfit" for="exampleInputEmail1">Card Holder
                                                            Name</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp" placeholder="Card Holder Name">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label class="outfit" for="exampleInputEmail1">Card Number</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp" placeholder="Card Number">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mt-2">
                                                                <label class="outfit" for="exampleInputEmail1">Expiry
                                                                    Date</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                    placeholder="MM/YY">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mt-2">
                                                                <label class="outfit" for="exampleInputEmail1">CVV</label>
                                                                <input type="password" class="form-control"
                                                                    id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                    placeholder="CVV">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pay_now">
                                                        <a href="">Pay Now</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <button id="accordion-button-2" aria-expanded="false">
                                                <span class="accordion-title"><img
                                                        src="{{ asset('assets/image/payment/net.png') }}" alt="">
                                                    Net Banking</span>
                                                <span class="icon" aria-hidden="true"></span>
                                            </button>
                                            <div class="accordion-content">
                                                <div class="net-bank">
                                                    <div class="overflow">
                                                        <div class="bank">
                                                            <a href=""><img
                                                                    src="{{ asset('assets/image/payment/hdfc.png') }}"
                                                                    alt="" width="40px" height="40px"> HDFC
                                                                Bank</a>
                                                        </div>
                                                        <hr>
                                                        <div class="bank">
                                                            <a href=""><img
                                                                    src="{{ asset('assets/image/payment/icici.png') }}"
                                                                    alt="" width="40px" height="40px"> ICICI
                                                                Bank</a>
                                                        </div>
                                                        <hr>
                                                        <div class="bank">
                                                            <a href=""><img
                                                                    src="{{ asset('assets/image/payment/stat-bank.png') }}"
                                                                    alt="" width="40px" height="40px"> State
                                                                Bank Of India</a>
                                                        </div>
                                                        <hr>
                                                        <div class="bank">
                                                            <a href=""><img
                                                                    src="{{ asset('assets/image/payment/axis.png') }}"
                                                                    alt="" width="40px" height="40px"> Axis
                                                                Bank</a>
                                                        </div>
                                                        <hr>
                                                        <div class="bank">
                                                            <a href=""><img
                                                                    src="{{ asset('assets/image/payment/hdfc.png') }}"
                                                                    alt="" width="40px" height="40px"> HDFC
                                                                Bank</a>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- pay cash -->
                                <div class="accordion">
                                    <div class="pay-cash">
                                        <h5 class="outfit cahs">Pay in Cash</h5>
                                        <div class="accordion-item">
                                            <button id="accordion-button-1" aria-expanded="false">
                                                <span class="accordion-title"> <img
                                                        src="{{ asset('assets/image/payment/rupee.png') }}"
                                                        alt=""> Cash on Delivery</span>
                                                <span class="icon" aria-hidden="true"></span>
                                            </button>
                                            <div class="accordion-content">
                                                <div class="cash">
                                                    <h5><img src="{{ asset('assets/image/payment/case.png') }}"
                                                            alt=""> Pay Cash
                                                        on Delivery </h5>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault" id="flexRadioDefault1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php

                            if (Auth::check()) {
                                // Check if user is authenticated
                                $auth = auth()->user()->id;
                                $Cart = App\Models\Cart::where('employee_id', $auth)->first();
                                if ($Cart != null) {
                                    $cart_product_count = App\Models\WebOrderCart::where('cart_id', $Cart->id)->count();
                                }
                            }
                        @endphp
                        <div class="col-lg-4 padding_top70">
                            <div class="box-price">
                                <h5 class="outfit">Price Details ({{ $cart_product_count ?? '0' }} Items)</h5>
                                <div class="cus-hr">
                                    <hr>
                                </div>
                                <div class="section-item">
                                    <div class="overflow">
                                        @foreach ($cart_product as $item)
                                            <div class="item-list margin_top20">
                                                <div class="list-img">
                                                    @if ($item->Product->image && file_exists(public_path($item->Product->image)))
                                                        <img src="{{ asset($item->Product->image) }}" width="77px"
                                                            height="77px">
                                                    @else
                                                        <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                                            width="77px" height="77px">
                                                    @endif
                                                </div>
                                                <div class="list-desc">
                                                    <h6>{{ $item->Product->product_name ?? '' }}</h6>

                                                    {{-- <h6>250 g</h6> --}}
                                                    @php
                                                        $taxes = 0;
                                                        $taxesList = json_decode($item->Product->gst);
                                                        foreach ($taxesList as $gst) {
                                                            foreach ($gst as $value) {
                                                                $taxes = $taxes + $value;
                                                            }
                                                        }

                                                        $total_taxes = [];

                                                    @endphp
                                                    <p>{{ $taxes }}% GST</p>
                                                    {{-- <p>4% GST</p> --}}
                                                </div>

                                                {{-- <div class="list-delet">
                                            <form action="{{ route('delete_cart', [$item->cart_id, $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                <a href=""
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                                    <h6><i class="fa-solid fa-trash"></i></h6>
                                                </a>
                                            </form>
                                        </div> --}}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <form action="{{ Route('confirm_order') }}" method="POST">

                                    @php
                                        $total_price = [];
                                        $total_qty = [];
                                        $a_total_taxes = [];
                                        $total_amount = [];
                                        $gst = [];
                                        $cess = [];
                                        $final_price = [];
                                        $totalMrp = 0;
                                        $totalTax = 0;
                                    @endphp
                                    @foreach ($cart_product as $item)
                                        @php
                                            $totalMrp += $item->total_amount;
                                            $taxesList = json_decode($item->Product->gst);
                                            $cess[] = isset($taxesList->CESS) ? $taxesList->CESS : 0;
                                            $gst[] = isset($taxesList->GST) ? $taxesList->GST : 0;

                                            $final_price[] = $item->total_amount;
                                            $total_amount[] = $item->total_amount;
                                            $a_total_taxes[] = $item->taxes ?? 1;
                                            $total_qty[] = $item->product_quntity ?? 1;
                                            $total_price[] = $item->sub_total;
                                            $totalTax += $item->taxes ?? 0;
                                        @endphp


                                        @csrf
                                        <input type="hidden" name="address_id" value="{{ $type ?? '0' }}">
                                        <input type="hidden" name="cart_id" value="{{ $item->cart_id }}">
                                        <input type="hidden" name="total_text" value=" {{ array_sum($total_price) }}">
                                        <input type="hidden" name="sub_total" value=" {{ $totalTax }}">
                                        <input type="hidden" name="total"
                                            value="{{ array_sum($total_price) + $totalTax }}">
                                    @endforeach

                                    @php

                                        if (Auth::check()) {
                                            // Check if user is authenticated
                                            $auth = auth()->user()->id;
                                            $Cart = App\Models\Cart::where('employee_id', $auth)->first();
                                            if ($Cart != null) {
                                                $cart_product_count = App\Models\WebOrderCart::where(
                                                    'cart_id',
                                                    $Cart->id,
                                                )->count();
                                            }
                                        }
                                    @endphp

                                    <div class="checkout margin_top50">
                                        <div class="ch-desc">
                                            <h5>{{ $cart_product_count ?? '0' }} Items</h5>
                                        </div>
                                        <div class="ch-price">
                                            <h5 id="subtotal">&#8377; {{ array_sum($total_price) }}</h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-charge">
                                        <div class="desc-charge">
                                            <h5>Delivery Charge</h5>
                                            <h5>GST & other taxes</h5>
                                        </div>
                                        <div class="price-charge">
                                            <h5>&#8377; 00.00</h5>
                                            <!-- Placeholder values, update accordingly -->
                                            <h5>&#8377; {{ $totalTax }}</h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="amt">
                                        <div class="amt-desc">
                                            <h5>Amount Payable</h5>
                                        </div>
                                        <div class="amt-price">
                                            <h5>&#8377; {{ array_sum($total_price) + $totalTax }}</h5>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="btn-chek">
                                        <a href=""onclick="event.preventDefault(); this.closest('form').submit();">
                                            <h6>CONTINUE TO CHECKOUT</h6>
                                        </a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- payment method seaction end -->
    </main>
@endsection


@section('script')
    <script>
        function updateTotalPrice(input, mrp, id) {
            var quantity = input.value;
            var totalPrice = quantity * mrp;
            // Etyathi, total price nu display karo ya output ma use karo, jem innerHTML, innerText, value, etc.
            console.log("Total Price: " + totalPrice, id);
            var totalPriceElement = document.getElementById('totalPrice_' + id);


            totalPriceElement.innerHTML = totalPrice.toFixed(2);
            // var subtotal = 0;
            // var allTotalPriceElements = document.querySelectorAll('.total-price span');
            // allTotalPriceElements.forEach(function(element) {
            //     subtotal += parseFloat(element.innerHTML.replace('₹',
            //         '')); // Remove the currency symbol before parsing
            // });

            // // Update the subtotal display
            // var subtotalElement = document.getElementById('subtotal');
            // subtotalElement.innerHTML = "&#8377;" + subtotal.toFixed(2);
            // console.log('subtotalElement', subtotalElement);
            abcd();

        }

        function abcd() {
            var subtotal = 0;
            var allTotalPriceElements = document.querySelectorAll('.total-price span');
            allTotalPriceElements.forEach(function(element) {
                subtotal += parseFloat(element.innerHTML.replace('₹',
                    '')); // Remove the currency symbol before parsing
            });

            // Update the subtotal display
            var subtotalElement = document.getElementById('subtotal');
            subtotalElement.innerHTML = "&#8377;" + subtotal.toFixed(2);
        }
    </script>

    <script>
        function updateTotalPrice(input, mrp, id) {
            var quantity = input.value;

            $.ajax({
                url: "{{ route('update_Qty') }}",
                type: "get",
                data: {
                    product_id: id,
                    product_quntity: quantity,
                },
                success: function(response) {
                    console.log(response.data);

                    var subtotalElement = document.getElementById("subtotal");
                    subtotalElement.innerHTML = "&#8377;" + response.data.cart_sub_total;

                    var subtotalElement = document.getElementById("cart_taxes");
                    subtotalElement.innerHTML = "&#8377;" + response.data.cart_taxes;

                    var subtotalElement = document.getElementById("total_price");
                    subtotalElement.innerHTML = "&#8377;" + response.data.cart_total_amount;



                    $('#response').html('<p>' + response.success + '</p><p>Name: ' + response.name +
                        '</p><p>Email: ' + response.email + '</p>');
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessages = '';
                    $.each(errors, function(key, value) {
                        errorMessages += '<p>' + value[0] + '</p>';
                    });
                    $('#response').html(errorMessages);
                }
            });

            var totalPrice = quantity * mrp;
            console.log("Total Price: " + totalPrice, id);
            var totalPriceElement = document.getElementById('totalPrice_' + id);
            totalPriceElement.innerHTML = totalPrice.toFixed(2);

        }

        function updateTotalgst(input, gst, id) {
            var quantity = input.value;
            var totalgst = quantity * gst;
            console.log("Total gst: " + totalgst, id);
            totalPriceElement.innerHTML = totalgst.toFixed(2);



        }

        function incrementQuantity(element, mrp, id) {
            var input = element.previousElementSibling;
            var currentValue = parseInt(input.value);
            var newValue = currentValue + 1;
            if (newValue <= 10) {
                input.value = newValue;
                updateTotalPrice(input, mrp, id);

            }
        }

        function decrementQuantity(element, mrp, id) {
            var input = element.nextElementSibling;
            var currentValue = parseInt(input.value);
            var newValue = currentValue - 1;
            if (newValue >= 1) {
                input.value = newValue;
                updateTotalPrice(input, mrp, id);
            }
        }

        function updateTotalPriceDisplay(totalPrice) {
            var totalPriceElement = document.getElementById("totalPrice");
            totalPriceElement.innerHTML = totalPrice.toFixed(
                2);
        }
    </script>


    <script>
        var cart = [];

        function addToCart(quantity, mrp) {
            var product = {
                quantity: quantity,
                mrp: mrp
            };
            cart.push(product); // Add product to the cart
            updateSubtotal(); // Update subtotal after adding product
        }

        // Function to calculate subtotal
        function calculateSubtotal() {
            var subtotal = 0;
            for (var i = 0; i < cart.length; i++) {
                subtotal += cart[i].quantity * cart[i].mrp; // Calculate total price for each product and add to subtotal
            }
            return subtotal;
        }

        // Function to update subtotal display  
        function updateSubtotalDisplay(subtotal) {
            var subtotalElement = document.getElementById("subtotal");
            subtotalElement.innerHTML = "&#8377;" + subtotal.toFixed(
                2); // Display subtotal with rupee symbol and 2 decimal places
        }

        // Function to update subtotal
        function updateSubtotal() {
            var subtotal = calculateSubtotal();

            console.log("subtotal", subtotal)
            updateSubtotalDisplay(subtotal);
        }


        function abcd() {
            var subtotal = 0;
            var allTotalPriceElements = document.querySelectorAll('.total-price span');
            allTotalPriceElements.forEach(function(element) {
                subtotal += parseFloat(element.innerHTML.replace('₹',
                    '')); // Remove the currency symbol before parsing
            });

            // Update the subtotal display
            var subtotalElement = document.getElementById('subtotal');
            subtotalElement.innerHTML = "&#8377;" + subtotal.toFixed(2);
        }
    </script>

    <script>
        function selectWeight(weight) {
            document.getElementById('dropdownMenu2').textContent = weight;
        }
    </script>


    <script>
        const items = document.querySelectorAll('.accordion button');

        function toggleAccordion() {
            const itemToggle = this.getAttribute('aria-expanded');
            for (i = 0; i < items.length; i++) {
                items[i].setAttribute('aria-expanded', 'false');
            }
            if (itemToggle == 'false') {
                this.setAttribute('aria-expanded', 'true');
            }
        }
        items.forEach((item) => item.addEventListener('click', toggleAccordion));
    </script>

    <script>
        // Disable back button on payment page
        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            history.go(1);
        };
    </script>


@endsection
