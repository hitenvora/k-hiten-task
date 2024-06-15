@extends('front-pages.layout.layout')
@section('title', 'ADDRESS')
@section('footer_class', 'margin_top80')


@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/address.css') }}">

    <main>
        <!-- address-bg seaction start -->
        <div class="address-bg">
            <div class="container">
                <h1 class="mogra-regular"> Place Order</h1>
            </div>
        </div>
        <!-- address-bg seaction end -->

        <!-- address seaction start -->
        <section>
            <div class="address margin_top80">
                <div class="container">
                    {{-- <img class="number-img" src="{{ asset('assets/image/delivery/number2.png') }}" alt=""> --}}
                    {{-- <div class="current margin_top30">
                        <a href=""><img src="{{ asset('assets/image/delivery/location.png') }}" alt=""> Use
                            my current
                            location</a>
                    </div> --}}

                    <form action="{{ route('saveOrderAddressDetails') }}" method="post" id="address_form">
                        @csrf

                        <div class="row">
                            @if ($addresses != null)
                                <div class="col-lg-8">
                                    <div class="form-box margin_top40">
                                        <div class="row">
                                            <h2 class="mb-4" style="font-size: 40px;"> Delivery Address</h2>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="outfit" for="first_name">First Name*</label>
                                                    <input type="name" class="form-control" id="first_name"
                                                        name="first_name" value="{{ $addresses->first_name }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="outfit" for="last_name">Last Name*</label>
                                                    <input type="name" class="form-control" id="last_name"
                                                        name="last_name" value="{{ $addresses->last_name }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="outfit" for="email">Email*</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ $addresses->email }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="outfit" for="mobile_no">Mobile Number*</label>
                                                    <input type="name" class="form-control" id="mobile_no"
                                                        name="mobile_no" value="{{ $addresses->mobile_no }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="outfit" for="altrnate_mobile_no">Alternative Mobile
                                                        Number*</label>
                                                    <input type="name" class="form-control" id="altrnate_mobile_no"
                                                        name="altrnate_mobile_no"
                                                        value="{{ $addresses->altrnate_mobile_no }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="outfit" for="countrySelect">Country*</label>
                                                    <select class="form-control" name="contry" id="countrySelect">
                                                        <option value="">Select a country</option>
                                                        <option value="0"
                                                            @if ($addresses->contry == 0) selected @endif>India</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="outfit" for="citySelect">City*</label>
                                                    <select class="form-control" name="city" id="citySelect">
                                                        <option value="">Select a City</option>
                                                        <option value="0"
                                                            @if ($addresses->city == 0) selected @endif>Surat</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="outfit" for="stateSelect">State*</label>
                                                    <select class="form-control" id="stateSelect" name="state">
                                                        <option value="">Select a State</option>
                                                        <option value="0"
                                                            @if ($addresses->state == 0) selected @endif>Gujarat
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="outfit" for="address">Address*</label>
                                            <textarea name="addresss" class="form-control" rows="3">{{ $addresses->addresss }}</textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="outfit" for="landmark">Landmark*</label>
                                                    <input type="name" class="form-control" name="landmark"
                                                        id="landmark" value="{{ $addresses->landmark }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="outfit" for="pincode">Pincode*</label>
                                                    <input type="name" class="form-control" name="pincode"
                                                        id="pincode" value="{{ $addresses->pincode }}">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="address_id" value=" {{ $addresses->id }}">
                                        {{-- <div class="office margin_top20">
                                            <div class="office-home">
                                                <a href="" id="home"
                                                    class="office-home @if ($addresses->type == 0) selected @endif"><i
                                                        class="fa-solid fa-house"></i> HOME</a>
                                            </div>
                                            <div class="office-home">
                                                <a href="" id="office"
                                                    class="office-home @if ($addresses->type == 1) selected @endif"><i
                                                        class="fa-solid fa-briefcase"></i> OFFICE</a>
                                            </div>
                                            <div class="office-home">
                                                <a href="" id="other"
                                                    class="office-home @if ($addresses->type == 2) selected @endif"><i
                                                        class="fa-solid fa-location-arrow"></i> OTHER</a>
                                            </div>
                                        </div> --}}

                                        <div class="office margin_top20">
                                            <div class="office-home">
                                                <a href="{{ route('address.view', 0) }}" id="home"
                                                    class="office-home @if ($type == 0) selected @endif"><i
                                                        class="fa-solid fa-house"></i> HOME</a>
                                            </div>
                                            <div class="office-home">
                                                <a href="{{ route('address.view', 1) }}" id="office"
                                                    class="office-home @if ($type == 1) selected @endif"><i
                                                        class="fa-solid fa-briefcase"></i> OFFICE</a>
                                            </div>
                                            <div class="office-home">
                                                <a href="{{ route('address.view', 2) }}" id="other"
                                                    class="office-home @if ($type == 2) selected @endif"><i
                                                        class="fa-solid fa-location-arrow"></i> OTHER</a>
                                            </div>
                                        </div>

                                        {{-- <div class="save-address margin_top20">
                                            <button id="rzp-button1" type="button">Pay with Razorpay</button>
                                            <input type="hidden" id="razorpay_payment_id" name="razorpay_payment_id">
                                        </div> --}}
                                        {{-- <div class="save-address margin_top20">
                                            <button class="" type="submit"> Save Address
                                                and Continue</button>
                                        </div> --}}
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-8">
                                    <div class="form-box margin_top40">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="outfit" for="first_name">First Name*</label>
                                                    <input type="name" class="form-control" id="first_name"
                                                        name="first_name">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="outfit" for="last_name">Last Name*</label>
                                                    <input type="name" class="form-control" id="last_name"
                                                        name="last_name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="outfit" for="email">Email*</label>
                                            <input type="email" class="form-control" id="email" name="email">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="outfit" for="mobile_no">Mobile Number*</label>
                                                    <input type="name" class="form-control" id="mobile_no"
                                                        name="mobile_no">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="outfit" for="altrnate_mobile_no">Alternative Mobile
                                                        Number*</label>
                                                    <input type="name" class="form-control" id="altrnate_mobile_no"
                                                        name="altrnate_mobile_no">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="outfit" for="countrySelect">Country*</label>
                                                    <select class="form-control" name="contry" id="countrySelect">
                                                        <option value="">Select a country</option>
                                                        <option value="0">India</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="outfit" for="citySelect">City*</label>
                                                    <select class="form-control" name="city" id="citySelect">
                                                        <option value="">Select a City</option>
                                                        <option value="0">Surat</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="outfit" for="stateSelect">State*</label>
                                                    <select class="form-control" id="stateSelect" name="state">
                                                        <option value="">Select a State</option>
                                                        <option value="0">Gujarat</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="outfit" for="address">Address*</label>
                                            <textarea name="addresss" class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="outfit" for="landmark">Landmark*</label>
                                                    <input type="name" class="form-control" name="landmark"
                                                        id="landmark">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="outfit" for="pincode">Pincode*</label>
                                                    <input type="name" class="form-control" name="pincode"
                                                        id="pincode">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="address_id" value=" {{ $type ?? '0' }}">

                                        {{-- <div class="office margin_top20">
                                            <div class="office-home">
                                                <a href="" id="home"
                                                    class="office-home @if ($addresses->type == 0) selected @endif"><i
                                                        class="fa-solid fa-house"></i> HOME</a>
                                            </div>
                                            <div class="office-home">
                                                <a href="" id="office"
                                                    class="office-home @if ($addresses->type == 1) selected @endif"><i
                                                        class="fa-solid fa-briefcase"></i> OFFICE</a>
                                            </div>
                                            <div class="office-home">
                                                <a href="" id="other"
                                                    class="office-home @if ($addresses->type == 2) selected @endif"><i
                                                        class="fa-solid fa-location-arrow"></i> OTHER</a>
                                            </div>
                                        </div> --}}



                                        <div class="office margin_top20">
                                            <div class="office-home">
                                                <a href="{{ route('address.view', 0) }}" id="home"
                                                    class="office-home @if ($type == 0) selected @endif"><i
                                                        class="fa-solid fa-house"></i> HOME</a>
                                            </div>
                                            <div class="office-home">
                                                <a href="{{ route('address.view', 1) }}" id="office"
                                                    class="office-home @if ($type == 1) selected @endif"><i
                                                        class="fa-solid fa-briefcase"></i> OFFICE</a>
                                            </div>
                                            <div class="office-home">
                                                <a href="{{ route('address.view', 2) }}" id="other"
                                                    class="office-home @if ($type == 2) selected @endif"><i
                                                        class="fa-solid fa-location-arrow"></i> OTHER</a>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            @endif

                            {{-- <div class="col-lg-4 padding_top40">
                                <div class="box-price">
                                    <h5 class="outfit">Price Details ({{ $cart_product_count ?? '0' }})</h5>
                                    <div class="cus-hr">
                                        <hr>
                                    </div>
                                    <div class="section-item">
                                        <div class="overflow">
                                            @if (!is_null($cart_product))
                                                @foreach ($cart_product as $item)
                                                    <input type="hidden" name="product_id" value="{{ $item->Product->id }}">
                                                    <input type="hidden" name="cart_id" value="{{ $item->cart_id }}">
                                                    <div class="item-list margin_top20">
                                                        <div class="list-img">
                                                            @if ($item->Product->image && file_exists(public_path($item->Product->image)))
                                                                <img src="{{ asset($item->Product->image) }}" width="77px" height="77px">
                                                            @else
                                                                <img src="{{ asset('assets/image/product_null_image/photo.png') }}" width="77px" height="77px">
                                                            @endif
                                                        </div>
                                                        <div class="list-desc">
                                                            <h6>{{ $item->Product->product_name ?? '' }}</h6>
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
                                                        <div class="list-delet">
                                                            <form action="{{ route('delete_cart', [$item->cart_id, $item->id]) }}" method="POST">
                                                                @csrf
                                                                <a href="" onclick="event.preventDefault(); this.closest('form').submit();">
                                                                    <img src="{{ asset('assets/image/delivery/delete.png') }}" alt="">
                                                                </a>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                
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
                                    @if (!is_null($cart_product))
                                        @foreach ($cart_product as $item)
                                            @php
                                                $totalMrp += $item->total_amount;
                                                $taxesList = json_decode($item->Product->gst);
                                                $cess[] = isset($taxesList->CESS) ? $taxesList->CESS : 0;
                                                $gst[] = isset($taxesList->GST) ? $taxesList->GST : 0;
                
                                                $final_price[] = $item->total_amount;
                                                $total_amount[] = $item->total_amount;
                                                $a_total_taxes[] = $item->taxes ?? 1;
                                                $total_qty[] = $item->qty;
                                                $total_price[] = $item->price;
                                                $totalTax += $item->taxes;
                                            @endphp
                                        @endforeach
                                    @endif
                                    <div class="margin_top40">
                                        <p>Price ({{ array_sum($total_qty) ?? '0' }} item): <span>₹{{ array_sum($total_price) }}</span></p>
                                        <p>Taxes: <span>₹{{ array_sum($a_total_taxes) }}</span></p>
                                    </div>
                                    <div class="cus-hr">
                                        <hr>
                                    </div>
                                    <div class="total-price margin_top10">
                                        <h5>Total Amount:<span>₹{{ array_sum($total_amount) }}</span></h5>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-lg-4 " style="padding-top: 40px;">
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
                                            <input type="hidden" name="address_id" value="{{ $addresses->id }}">
                                            <input type="hidden" name="cart_id" value="{{ $item->cart_id }}">
                                            <input type="hidden" name="total_text"
                                                value=" {{ array_sum($total_price) }}">
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

                                        {{-- <div class="btn-chek">
                                            <a href=""onclick="event.preventDefault(); this.closest('form').submit();">
                                                <h6>CONTINUE TO CHECKOUT</h6>
                                            </a>
                                        </div> --}}
                                        {{-- <div class="btn-chek" style="color: #fff;
                                        background-color: #5D0C05;
                                        padding: 15px 20px;
                                        border-radius: 10px;
                                        text-align: center;">
                                            <a href="" style="text-decoration: none" onclick="event.preventDefault(); this.closest('form').submit();" ><h6>CONTINUE TO CHECKOUT</h6></a>
                                        </div> --}}

                                        <div class="save-address margin_top20"
                                            style="display: flex; justify-content: center;">
                                            <button id="rzp-button1"
                                                style="color: #fff;
                                            background-color: #5D0C05;
                                            padding: 15px 20px;
                                            border-radius: 10px;
                                            text-align: center;"
                                                type="button">Place Order</button>
                                            <input type="hidden" id="razorpay_payment_id" name="razorpay_payment_id">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Razorpay Script -->
                    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                    <script>
                        document.getElementById('rzp-button1').onclick = function(e) {
                            var options = {
                                "key": "{{ env('RAZORPAY_KEY') }}", // Enter the Key ID generated from the Dashboard
                                "amount": "{{ array_sum($total_amount) * 100 }}", // Amount is in currency subunits. For example, 1000 is 1000 paise, which equals ₹10
                                "currency": "INR",
                                "name": "Kanaiyadairy Farm And Sweets",
                                "description": "Kanaiyadairy Farm And Sweets",
                                "image": "{{ asset('/assets/image/kanaiya fevicon.png') }}",
                                "order_id": "", // Pass the order ID if you have one
                                "handler": function(response) {
                                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                                    document.getElementById('address_form').submit();
                                },
                                "prefill": {
                                    "name": "{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}",
                                    "email": "{{ Auth::user()->email }}",
                                    "contact": "{{ Auth::user()->mobile_no }}"
                                },
                                "theme": {
                                    "color": "#3399cc"
                                }
                            };
                            var rzp1 = new Razorpay(options);
                            rzp1.on('payment.failed', function(response) {
                                alert(response.error.code);
                                alert(response.error.description);
                                alert(response.error.source);
                                alert(response.error.step);
                                alert(response.error.reason);
                                alert(response.error.metadata.order_id);
                                alert(response.error.metadata.payment_id);
                            });
                            rzp1.open();
                            e.preventDefault();
                        }
                    </script>
                </div>
            </div>
        </section>



    </main>
@endsection




@section('script')

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const links = document.querySelectorAll('.office-home');
            links.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    links.forEach(link => link.classList.remove('selected'));
                    this.classList.add('selected');
                });
            });
        });
    </script> --}}

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

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const links = document.querySelectorAll('.office-home');
            links.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const addressType = this.getAttribute('data-address-type');
                    // Add 'selected' class to the clicked link
                    links.forEach(link => link.classList.remove('selected'));
                    this.classList.add('selected');

                    // Send an Ajax request to save the address type
                    saveAddressType(addressType);
                });
            });


        });
    </script> --}}





    <script>
        $("#address_form").validate({
            ignore: ':hidden:not(:radio)',
            errorElement: 'label',
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            rules: {
                first_name: {
                    required: true

                },
                last_name: {
                    required: true

                },
                email: {
                    required: true
                },

                mobile_no: {
                    required: true,
                    digits: true, // Ensures only digits are entered
                    minlength: 10 // Specifies the minimum length of the input

                },

                altrnate_mobile_no: {
                    digits: true, // Ensures only digits are entered
                    minlength: 10
                },

                contry: {
                    required: true
                },

                city: {
                    required: true
                },
                state: {
                    required: true
                },
                addresss: {
                    required: true
                },

                landmark: {
                    required: true
                },

                pincode: {
                    required: true
                },





            },
            messages: {

                first_name: {
                    required: "Please Enter First Name",

                },
                last_name: {
                    required: "Please Enter Last Name",

                },
                email: {
                    required: "Please Enter Email",
                },

                mobile_no: {
                    required: "Please Enter Mobile No",
                    digits: "Please enter a valid mobile number.",
                    minlength: "Mobile number must be 10 digits long."
                },

                altrnate_mobile_no: {

                    digits: "Please enter a valid mobile number.",
                    minlength: "Mobile number must be 10 digits long."

                },

                contry: {
                    required: "Please Selete Contry",
                },
                city: {
                    required: "Please Selete City",
                },
                state: {
                    required: "Please Selete State",
                },

                addresss: {
                    required: "Please Enter Address",
                },

                landmark: {
                    required: "Please Enter Landmark",
                },

                pincode: {
                    required: "Please Enter Pincode",
                },

            },
        });
    </script>

    <!-- scrollreveal -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- scroll website to text scroll -->
    <script>
        ScrollReveal({
            reset: false,
            distance: '50px',
            duration: 2500,
            delay: 100
        });
        ScrollReveal().reveal('.address-bg h1', {
            origin: 'top'
        });
        ScrollReveal().reveal('.address h2', {
            origin: 'top'
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



@endsection
