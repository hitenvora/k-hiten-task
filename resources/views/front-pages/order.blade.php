@extends('front-pages.layout.layout')
@section('title', 'Order')
@section('footer_class', 'margin_top80')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/order.css') }}">


    <style>
        .gold-star {
            color: gold !important;
        }

        .dot-process {
            display: flex;
            justify-content: center;
        }

        .dot {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: gray;
            margin: 0 5px;
        }

        .confirmed {
            background-color: green;
        }

        .out-for-delivery {
            background-color: yellow;
        }

        .delivered {
            background-color: blue;
        }
    </style>

    <main>
        @if (!isset($web_order) || count($web_order) == 0)
            {{-- @if (empty($web_order)) --}}
            {{-- order not found seaction start --}}
            <section>
                <div class="ordernot-found margin_top50">
                    <div class="container">
                        <div class="not-found-img">
                            <img src="{{ asset('assets/image/order/not-found.png') }}" alt="">
                        </div>
                        <div class="coun-or">
                            <a href="{{ route('product.view') }}" class="outfit">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        {{-- order not found seaction end --}}



        <!-- order details seaction start -->
        <section>
            <div class="order-page margin_top80">
                <div class="container">
                    @if (isset($web_order) && count($web_order) > 0)
                        <h2 class="outfit">Order Details</h2>
                        @foreach ($web_order as $order)
                            <div class="order-place margin_top50">
                                <div class="date outfit">

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="box margin_top50">

                                        <div class="order-place margin_top50">
                                            <div class="date outfit">
                                                @if (!empty($order))
                                                    <p>Order Placed On <span>:
                                                            {{ \Carbon\Carbon::parse($order->created_at)->format('d F Y') }}
                                                        </span></p>
                                                @endif

                                            </div>
                                            <div class="order-num outfit">
                                                <p>Order No <span>:
                                                        @if (!empty($order))
                                                            {{ $order->id }}
                                                        @endif
                                                    </span></p>
                                            </div>
                                        </div>
                                        <h5 class="outfit margin_top30">Delivery Expected by
                                            @if (!empty($order))
                                                {{ \Carbon\Carbon::parse($order->expected_delivery_date)->format('d F Y') }}
                                            @endif
                                        </h5>


                                        @if ($order != null && $order->is_delivery == 1)
                                            <div class="first">
                                                <div class="dot-process">
                                                    <div class="dot"></div>
                                                    @if ($order != null && $order->is_delivery == 1)
                                                        <div class="dot two_dot out_for_delivery"></div>
                                                    @else
                                                        <div class="dot two_dot delivered"></div>
                                                    @endif
                                                    <div class="dot"></div>
                                                </div>

                                                <div class="confirm">
                                                    <p>Confirmed <br>
                                                        {{ $order ? \Carbon\Carbon::parse($order->created_at)->format('d F') : '' }}
                                                    </p>
                                                    <p>Out for <br> Delivery</p>
                                                    <p>Delivered</p>

                                                </div>
                                            </div>
                                        @endif



                                        @if ($order != null && $order->is_delivery == 0)
                                            <div class="third">
                                                <div class="dot-process3">
                                                    <div class="dot"></div>
                                                    <div class="dot three_dot"></div>
                                                    <div class="dot three_dot"></div>
                                                </div>
                                                <div class="confirm3">
                                                    <p>Confirmed <br>
                                                        {{ \Carbon\Carbon::parse($order->created_at)->format('d F Y') }}</p>
                                                    <p>Out for <br> Delivery</p>
                                                    <p>Delivered</p>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($order != null && $order->is_delivery == 2)
                                            <div class="four">
                                                <div class="dot-process4">
                                                    <div class="dot"></div>
                                                    <div class="dot"></div>
                                                    <div class="dot four_dot"></div>
                                                </div>
                                                <div class="confirm4">
                                                    <p>Confirmed <br>
                                                        {{ \Carbon\Carbon::parse($order->created_at)->format('d F Y') }}</p>
                                                    <p>Out for <br> Delivery</p>
                                                    <p>Delivered</p>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="small-box-order">
                                            <div class="overflow">
                                                @if (!empty($web_order))
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
                                                    {{-- @foreach ($web_order as $order) --}}
                                                    @foreach ($order->GetwebCart as $item)
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
                                                        {{-- {{ $order->cart_id, $item->cart_id }} --}}
                                                        <div class="or-detail margin_top30">
                                                            <div class="or-img">

                                                                @if ($item->Product->image && file_exists(public_path($item->Product->image)))
                                                                    <img src="{{ asset($item->Product->image) }}"
                                                                        width="96px" height="96px">
                                                                @else
                                                                    <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                                                        width="96px" height="96px">
                                                                @endif
                                                            </div>
                                                            <div class="or-text">
                                                                <h5>{{ $item->Product->product_name ?? '' }}
                                                                </h5>
                                                                <div class="waight d-flex">

                                                                    <p>Qty:{{ $item->product_quntity ?? '' }}</p>
                                                                </div>
                                                                <p>&#8377 {{ array_sum($total_price) + $totalTax }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    {{-- @endforeach --}}
                                                @endif
                                            </div>
                                        </div>




                                        <div class="col-lg-12">
                                            <div class="summary margin_top40">
                                                <h3 class="outfit">Price Summary</h3>
                                                <hr>
                                                <div class="summary-price">
                                                    <p class="outfit">Item Total</p>
                                                    <p class="outfit">&#8377 {{ array_sum($total_price) }}</p>
                                                </div>
                                                <div class="summary-price">
                                                    <p class="outfit">Delivery Charge</p>
                                                    <p class="outfit">&#8377 00.00</p>
                                                </div>
                                                <div class="summary-price">
                                                    <p class="outfit">GST & other taxes</p>
                                                    <p class="outfit">&#8377 {{ $totalTax }}</p>
                                                </div>
                                                <div class="summary-price">
                                                    <p class="outfit">Payment Method</p>
                                                    <p class="outfit">Cash on Delivery </p>
                                                </div>
                                                <div class="dash">
                                                    <hr>
                                                </div>
                                                <div class="total-payment">
                                                    <p class="outfit">Total Payable</p>
                                                    <p class="outfit">&#8377 {{ array_sum($total_price) + $totalTax }} </p>
                                                </div>
                                                {{-- <div class="address margin_top50">
                                                    <p class="outfit">Delivery to:</p>



                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <div class="row">
                        <div class="col-lg-10">
                            @if (isset($web_order) && count($web_order) > 0)
                                @foreach ($web_order as $order)
                                    @foreach ($order->GetwebCart as $item)
                                        @php
                                            $userRating = App\Models\RatingProduct::where('user_id', auth()->id())
                                                ->where('product_id', $item->Product->id)
                                                ->first();
                                        @endphp
                                    @endforeach
                                @endforeach
                                <div class="or-rating margin_top30">
                                    <h4 class="outfit">How would you like to rate
                                        Kanaiya Dairyfarm & Sweets
                                    </h4>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @php
                                            $selected = $userRating && $userRating->rating >= $i ? 'gold-star' : '';
                                        @endphp
                                        <i class="fa-regular fa-star {{ $selected }}"
                                            onclick="rateStar({{ $i }}, )"></i>
                                    @endfor
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="your-order margin_top50">
                        <div class="container">
                            @if (isset($delivery_order) && count($delivery_order) > 0)
                                <h2 class="outfit">Your Orders</h2>
                                {{-- @foreach ($delivery_order->GetwebCart as $item) --}}
                                @foreach ($delivery_order as $item)
                                    <div class="box2 margin_top30">
                                        <div class="or-place">
                                            <div class="date">
                                                <p class="outfit">Order Placed On <br><span>
                                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</span>
                                                </p>
                                                <p class="outfit">Total Price <br><span>&#8377 {{ $item->total }}</span>
                                                </p>
                                                <p class="outfit">Ship To <br><span>{{ $item->ship_to_name ?? '' }}</span>
                                                </p>
                                            </div>
                                            <div class="order-id">
                                                <p class="outfit">Order ID: {{ $item->id }}

                                                    {{-- <br><span>Order Detail <i
                                                    class="fa-solid fa-chevron-right"></i></span> --}}

                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="con-item">
                                            <div class="con-img">
                                                <img src="../assets/image/order/o-1.png" alt="" width="103px"
                                                    height="103px">
                                            </div>
                                            <div class="con-text">
                                                <p class="outfit">3 Items <span>Order Delivered</span></p>
                                                <p class="outfit">Order ID: {{ $item->id }}</p>
                                                <h5 class="outfit">Delivered on {{ $item->expected_delivery_date ?? '' }}
                                                </h5>
                                            </div>
                                        </div>
                                        {{-- <div class="share margin_top20">
                                    <div class="experirence">
                                        <div class="shopping">
                                            <h5>Share Shopping Experience</h5>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <div class="deliver">
                                            <h5>Share Shopping Experience</h5>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                    </div>

                                </div> --}}
                                    </div>
                                @endforeach

                                {{-- <div class="load-more margin_top30">
                            <a href="">Load More</a>
                        </div> --}}
                            @endif

                        </div>
                    </div>


                    <!-- payment method seaction start -->
                    <div class="shipping margin_top80">
                        <div class="container">
                            <div class="cod">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="free">
                                            <img src="../assets/image/faq/Vector (1).png" alt="">.
                                            <h5>Free Shipping</h5>
                                            <p>On Orders Above Rs. 399</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="free">
                                            <img src="../assets/image/faq/Vector.png" alt="">.
                                            <h5>COD Available</h5>
                                            <p>@ Rs. 40 Per Order</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <h2>Have any Questions or Concerns?</h2>
                                        <div class="con">
                                            <a href="{{ route('contact.view') }}">CONTACT US</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment-me">
                                <div class="row">
                                    <h3>PAYMENT</h3>
                                    <div class="vector d-flex">
                                        <div class="vector-img">
                                            <img src="../assets/image/faq/right.png" alt="">
                                        </div>
                                        <div class="vector-text">
                                            <p>100% Payment protection, Easy return policy</p>
                                        </div>
                                    </div>
                                    <div class="payment-card">
                                        <img src="../assets/image/faq/upi.png" alt="">
                                        <img src="../assets/image/faq/g-pay.png" alt="">
                                        <img src="../assets/image/faq/phonepe.png" alt="">
                                        <img src="../assets/image/faq/rupay.png" alt="">
                                        <img src="../assets/image/faq/master.png" alt="">
                                        <img src="../assets/image/faq/mobi.png" alt="">
                                        <img src="../assets/image/faq/visa.png" alt="">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- payment method seaction end -->

                </div>
        </section>
        <!-- order details seaction end -->



    </main>
@endsection


@section('script')
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


    <!-- review star fill -->
    <script>
        function rateStar(starIndex, productId) {
            var stars = document.querySelectorAll('.or-rating i');

            for (var i = 0; i < stars.length; i++) {
                if (i < starIndex) {
                    stars[i].classList.add('gold-star');
                } else {
                    stars[i].classList.remove('gold-star');
                }
            }

            // Fetch CSRF token value from the meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send AJAX request with CSRF token included in headers
            $.ajax({
                url: '/wab/save/rating', // Replace with your route URL
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    rating: starIndex, // Send the selected rating value
                    product_id: productId,
                    user_id: {{ auth()->check() ? auth()->user()->id : 'null' }}
                },
                success: function(response) {

                },
                error: function(xhr, status, error) {
                    // Handle error if needed
                }
            });
        }
    </script>

@endsection
