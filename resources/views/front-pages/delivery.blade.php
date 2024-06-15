@extends('front-pages.layout.layout')
@section('title', 'Delivery')
@section('footer_class', 'margin_top80')

@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/delivery.css') }}">

    <style>

    </style>
    <main>
        <!-- delivery-bg seaction start -->
        <div class="delivery-bg">
            <div class="container">
                <h1 class="mogra-regular">CART</h1>
            </div>
        </div>
        <!-- shopping cart seaction start -->
        <section>
            <div class="shopoping margin_top80">
                <div class="container">
                    {{-- <img class="number-img" src="{{ asset('/assets/image/delivery/number.png') }}" alt=""> --}}
                    {{-- <h2 class="margin_top50">(1) Shopping Cart</h2> --}}
                    <div class="row">
                        <div class="col-lg-8 padding_top30">
                            <form id="deliveryForm">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group d-flex">
                                    <input type="number" class="form-control" id="deliveryPincode" name="deliveryPincode"
                                        aria-describedby="emailHelp" placeholder="Enter Delivery Pincode">
                                    <button type="button" id="checkAvailability">CHECK</button>
                                </div>
                            </form>
                            <div id="deliveryMessage"></div>


                            @php
                                $total_price = [];
                                $total_qty = [];
                                $a_total_taxes = [];
                                $total_amount = [];
                                $gst = [];
                                $cess = [];
                                $final_price = [];
                            @endphp
                            <div class="section-item">
                                <div class="overflow">
                                    @if ($cart_product != null)
                                        @foreach ($cart_product as $item)
                                            <div class="item-img margin_top30">
                                                <div class="img-item">
                                                    @if ($item->Product->image && file_exists(public_path($item->Product->image)))
                                                        <img src="{{ asset($item->Product->image) }}" width="140px"
                                                            height="140px">
                                                    @else
                                                        <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                                            height="140px" width="140px">
                                                    @endif
                                                    {{-- <img src="{{ asset('/assets/image/delivery/i-1.png') }}" alt="" width="140px"
                                                        height="140px"> --}}
                                                </div>

                                                <div class="item-desc">
                                                    <h3>{{ $item->Product->product_name ?? '' }}</h3>
                                                    <h6>From : <span>&#8377 {{ $item->Product->mrp }}.00</span></h6>
                                                    {{-- <div class="dropdown">
                                                            <button class="dropdown-toggle" type="button" id="dropdownMenu2"
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Select
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                                <button class="dropdown-item" type="button">250 g</button>
                                                                <button class="dropdown-item" type="button">500 g</button>
                                                                <button class="dropdown-item" type="button">1 KG</button>
                                                            </div>
                                                        </div> --}}
                                                    {{-- <div class="dropdown">
                                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Select
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                                <button class="dropdown-item" type="button" onclick="selectWeight('250 g')">250 g</button>
                                                                <button class="dropdown-item" type="button" onclick="selectWeight('500 g')">500 g</button>
                                                                <button class="dropdown-item" type="button" onclick="selectWeight('1 KG')">1 KG</button>
                                                            </div>
                                                        </div> --}}
                                                </div>
                                                <div class="number d-flex margin_top30">

                                                    @php
                                                        $taxesList = json_decode($item->gst);
                                                        $cess[] += $taxesList->CESS ?? 0;
                                                        $gst[] += $taxesList->GST ?? 0;

                                                        $final_price[] += $item->total_amount;
                                                        $total_amount[] += $item->total_amount;
                                                        $a_total_taxes[] += $item->taxes ?? 1;
                                                        $total_qty[] += $item->product_quntity ?? 1;
                                                        $total_price[] = $item->sub_total;
                                                    @endphp
                                                    <span class="minus"
                                                        onclick="decrementQuantity(this, {{ $item->product->mrp }},{{ $item->product->id }})">-</span>
                                                    <input type="number" value="{{ $item->product_quntity }}"
                                                        min="1" max="10" value="{{ $item->quantity ?? '1' }}"
                                                        class="quantity-input" name="product_qty"
                                                        oninput="updateTotalPrice(this, {{ $item->product->mrp }},{{ $item->product->id }})" />
                                                    <span class="plus"
                                                        onclick="incrementQuantity(this, {{ $item->product->mrp }},{{ $item->product->id }})">+</span>
                                                    <div class="list-delet">
                                                        <form
                                                            action="{{ route('delete_cart', [$item->cart_id, $item->id]) }}"    
                                                            method="post">
                                                            @csrf
                                                            <a href=""
                                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                                {{-- <i class="fa-solid fa-trash"></i> --}}
                                                                <img src="{{ asset('assets/image/delivery/delete.png') }}"
                                                                    alt="">
                                                            </a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="item-img margin_top30">
                                    <div class="img-item">
                                        <img src="{{ asset('/assets/image/delivery/i-2.png') }}" alt="" width="140px"
                                            height="140px">
                                    </div>
                                    <div class="item-desc">
                                        <h3>Dryfruit Bombay Cassata</h3>
                                        <h6>From : <span>&#8377 300.00</span></h6>
                                        <div class="dropdown">
                                            <button class="dropdown-toggle" type="button" id="dropdownMenu2"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Select
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <button class="dropdown-item" type="button">250 g</button>
                                                <button class="dropdown-item" type="button">500 g</button>
                                                <button class="dropdown-item" type="button">1 KG</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="number d-flex margin_top30">
                                        <span class="minus">-</span>
                                        <input type="text" value="1" />
                                        <span class="plus">+</span>
                                    </div>
                                </div>
                                <hr> --}}
                            {{-- <div class="item-img margin_top30">
                                    <div class="img-item">
                                        <img src="{{ asset('/assets/image/delivery/i-1.png') }}" alt="" width="140px"
                                            height="140px">
                                    </div>
                                    <div class="item-desc">
                                        <h3>Kaju Katli</h3>
                                        <h6>From : <span>&#8377 300.00</span></h6>
                                        <div class="dropdown">
                                            <button class="dropdown-toggle" type="button" id="dropdownMenu2"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Select
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <button class="dropdown-item" type="button">250 g</button>
                                                <button class="dropdown-item" type="button">500 g</button>
                                                <button class="dropdown-item" type="button">1 KG</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="number d-flex margin_top30">
                                        <span class="minus">-</span>
                                        <input type="text" value="1" />
                                        <span class="plus">+</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="item-img margin_top30">
                                    <div class="img-item">
                                        <img src="{{ asset('/assets/image/delivery/i-2.png') }}" alt="" width="140px"
                                            height="140px">
                                    </div>
                                    <div class="item-desc">
                                        <h3>Dryfruit Bombay Cassata</h3>
                                        <h6>From : <span>&#8377 300.00</span></h6>
                                        <div class="dropdown">
                                            <button class="dropdown-toggle" type="button" id="dropdownMenu2"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Select
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <button class="dropdown-item" type="button">250 g</button>
                                                <button class="dropdown-item" type="button">500 g</button>
                                                <button class="dropdown-item" type="button">1 KG</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="number d-flex margin_top30">
                                        <span class="minus">-</span>
                                        <input type="text" value="1" />
                                        <span class="plus">+</span>
                                    </div>
                                </div>
                                <hr> --}}

                        </div>
                        <div class="col-lg-4 padding_top30">
                            <div class="box">
                                <h4>Price Details (

                                    {{ isset($cart_product) ? $cart_product->count() : 0 }}
                                    Items)</h4>
                                <hr>
                                <div class="box-price-item-small">
                                    <div class="">
                                        <div class="box-price-item-small">
                                            <div class="overflow">
                                                @if ($cart_product != null)
                                                    @foreach ($cart_product as $item)
                                                        <div class="item-list margin_top20">
                                                            <div class="list-img">
                                                                {{-- <img src="{{ asset('/assets/image/delivery/list-1.png') }}" alt="" width="77px"
                                                  height="77px"> --}}
                                                                @if ($item->Product->image && file_exists(public_path($item->Product->image)))
                                                                    <img src="{{ asset($item->Product->image) }}"
                                                                        width="77px" height="77px">
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

                                                            </div>
                                                            <div class="total-price">
                                                                {{-- <h6>&#8377 {{ $item->Product->mrp }} .00</h6> --}}
                                                                <h6>&#8377;<span id="totalPrice_{{ $item->Product->id }}"
                                                                        class="priceDetails">{{ $item->total_amount }}</span>
                                                                </h6>

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="checkout margin_top50">
                                    <div class="ch-desc">
                                        <h5>
                                            <h5>{{ isset($cart_product) ? $cart_product->count() : 0 }} Items</h5>
                                            Items
                                        </h5>
                                    </div>

                                    <div class="ch-price">
                                        <h5 id="subtotal">&#8377 {{ array_sum($total_price) }}</h5>
                                        {{-- <h6>Subtotal: <span id="subtotal">&#8377;0.00</span></h6> --}}

                                    </div>
                                </div>
                                <hr>
                                <div class="d-charge">
                                    <div class="desc-charge">
                                        <h5>Delivery Charge</h5>
                                        <h5>GST & other taxes</h5>
                                    </div>
                                    {{-- {{dd($a_total_taxes)}} --}}
                                    <div class="price-charge">
                                        <h5>&#8377 0.00</h5>
                                        <h5 id="cart_taxes">&#8377 {{ array_sum($a_total_taxes) }} </h5>
                                        {{-- <h5>Total GST: <span id="total-gst">&#8377;0.00</span></h5> --}}
                                        {{-- <p class="gst">0.00 ₹</p> <!-- GST display --> --}}

                                    </div>
                                </div>
                                <hr>
                                <div class="amt">
                                    <div class="amt-desc">
                                        <h5>Amount Payable</h5>
                                    </div>
                                    <div class="amt-price">
                                        {{-- <h5 >&#8377 {{ $totalMrp }}</h5> --}}
                                        <h5 id="total_price">&#8377 {{ array_sum($total_amount) }}</h5>

                                    </div>
                                </div>
                                <hr>
                                @if (array_sum($total_amount) != 0)
                                    <div class="btn-chek">
                                        <a href="{{ route('address.view', 0) }}">
                                            <h6>CONTINUE TO CHECKOUT</h6>
                                        </a>
                                    </div>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- shopping cart seaction end -->


        <!-- related product seaction start -->
        <section>
            <div class="related margin_top80">
                <div class="container">
                    <h1>RELATED PRODUCTS</h1>
                    <p>We deliver more than 30 different types of Indian Sweets online for all occasions and festivals as
                        well as for bulk and for wholesale orders.</p>

                    <div class="swiper mySwiper-2">
                        <div class="swiper-wrapper">
                            @foreach ($related_products as $item)
                                <div class="swiper-slide margin_top50">
                                    <div class="box">
                                        <form action="{{ route('add_to_cart') }}" method="post" class="add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item->id }}">
                                            <input type="hidden" name="product_quntity" value="1">
                                            <a href=""
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                @if ($item->image && file_exists(public_path($item->image)))
                                                    <img src="{{ asset($item->image) }}"width="391px" height="266px">
                                                @else
                                                    <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                                        width="77px" height="77px">
                                                @endif
                                            </a>


                                            <h3>{{ $item->product_name ?? '' }}</h3>
                                            <h5>From: <span>&#8377 {{ $item->mrp ?? '' }}</span></h5>
                                        </form>
                                    </div>
                                </div>
                            @endforeach

                            {{-- <div class="swiper-slide margin_top50">
                                <div class="box">
                                    <img src="{{ asset('/assets/image/delivery/related-2.png') }}" alt="" width="391px"
                                        height="266px">
                                    <h3>Mohanthal</h3>
                                    <h5>From: <span>&#8377 200.00</span></h5>
                                </div>
                            </div>
                            <div class="swiper-slide margin_top50">
                                <div class="box">
                                    <img src="{{ asset('/assets/image/delivery/related-3.png') }}" alt="" width="391px"
                                        height="266px">
                                    <h3>Chocolate Penda</h3>
                                    <h5>From: <span>&#8377 200.00</span></h5>
                                </div>
                            </div>
                            <div class="swiper-slide margin_top50">
                                <div class="box">
                                    <img src="{{ asset('/assets/image/delivery/related-2.png') }}" alt="" width="391px"
                                        height="266px">
                                    <h3>Mohanthal</h3>
                                    <h5>From: <span>&#8377 200.00</span></h5>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection


@section('script')
    <script>
        function decrementQuantity(button) {
            const input = button.nextElementSibling;
            if (input.value > 1) {
                input.value--;
            }
        }

        function incrementQuantity(button) {
            const input = button.previousElementSibling;
            input.value++;
        }
    </script>

    <script>
        $(".deliveryForm").validate({
            // ignore: ':hidden:not(:checkbox)',
            ignore: ':hidden:not(:radio)',
            errorElement: 'label',
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            rules: {
                deliveryPincode: {
                    required: true,
                    minlength: 6,
                    maxlength: 6,
                },


            },
            messages: {
                deliveryPincode: {
                    required: "Please Enter Pincode",
                    minlength: "Please Enter 6 digit",
                    maxlength: "Please Enter 6 digit",

                },


            }
        });
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



    {{-- <script>
        $(document).ready(function() {
            $('#checkAvailability').click(function() {
                var pincode = $('#deliveryPincode').val();

                // Get CSRF token value from the page
                var token = $('meta[name="csrf-token"]').attr('content');

                // AJAX request to check pin code availability
                $.ajax({
                    url: '/wab/check-delivery-availability', // Replace with your route URL
                    type: 'POST',
                    data: {
                        pincode: pincode
                    },
                    headers: {
                        'X-CSRF-TOKEN': token // Include CSRF token in the request headers
                    },
                    success: function(response) {
                        var message = response.available ?
                            'Delivery is available for this pin code.' :
                            'Delivery is not available for this pin code.';
                        var color = response.available ? 'green' : 'red';
                        $('#deliveryMessage').text(message).css('color', color);
                    },
                    error: function(xhr, status, error) {
                        $('#deliveryMessage').text(
                            'An error occurred while checking delivery availability.').css(
                            'color', 'red');
                    }
                });
            });
        });
    </script> --}}



@endsection
