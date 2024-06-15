@extends('front-pages.layout.layout')
@section('title', 'Kanaiya')
@section('footer_class', '')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- bg slider -->
    <div class="bg-home">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="2000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/image/home/bg-4.png') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/image/home/bg-5.png') }}" class="d-block w-100" alt="...">
                </div>

                <div class="carousel-item">
                    <img src="{{ asset('assets/image/home/bg-6.png') }}" class="d-block w-100" alt="...">
                </div>



            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>

    <!-- discount seaction start -->
    <div class="discount">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="box-1 d-flex">
                        <div class="box-text">
                            <h5 class="padding_top20">10% Flat Discount</h5>
                            <p>On Orders Above 3,000</p>
                            <h4>Shop Now <i class="fa-solid fa-arrow-right right-icon"></i></h4>
                        </div>
                        <div class="box-img">
                            <img src="{{ asset('assets/image/home/b-1.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box-2 d-flex">
                        <div class="box-text">
                            <h5 class="padding_top20">10% Flat Discount</h5>
                            <p>On Orders Above 3,000</p>
                            <h4>Shop Now <i class="fa-solid fa-arrow-right right-icon"></i></h4>
                        </div>
                        <div class="box-img">
                            <img src="{{ asset('assets/image/home/b-2.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box-1 d-flex">
                        <div class="box-text">
                            <h5 class="padding_top20">10% Flat Discount</h5>
                            <p>On Orders Above 3,000</p>
                            <h4>Shop Now <i class="fa-solid fa-arrow-right right-icon"></i></h4>
                        </div>
                        <div class="box-img">
                            <img src="{{ asset('assets/image/home/b-3.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- discount seaction end -->

    <!-- order seaction start -->
    <div class="order margin_top80">
        <div class="container">
            <h1>Order Sweets Online or Walk-in to our Store to try</h1>
            <p>Providing Quality, Traditional and Authentic taste of all the Indian Sweets. At the same time, Innovating new
                products for the young generation.</p>

            <div class="swiper mySwiper margin_top50">
                <div class="swiper-wrapper">
                    @foreach ($product_categories as $item)
                        <div class="swiper-slide">
                            <div class="hover15">
                                <img class="or-img" src="{{ asset($item->image) }}" alt="" width="288px"
                                    height="288px">
                            </div>

                            <h4>{{ $item->name }}</h4>
                            @if (Auth::user() != null)
                                <form action="{{ route('add_to_cart') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                                    <input type="hidden" name="product_quntity" value="1">
                                    <div class="button">
                                        <a href=""
                                            onclick= "event.preventDefault(); this.closest('form').submit();">Order
                                            Now</a>
                                    </div>
                                </form>
                            @else
                                <div class="button">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">Order Now</a>
                                </div>
                            @endif
                        </div>
                    @endforeach


                    {{-- <div class="swiper-slide">
                            <img src="{{asset('assets/image/home/s-4.png')}}" alt="">
                            <h4>Kaju Katli</h4>
                            <div class="button">
                               <a href="">Order Now</a> 
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{asset('assets/image/home/s-1.png')}}" alt="">
                            <h4>Desi Ghee Sweets</h4>
                            <div class="button">
                               <a href="">Order Now</a> 
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{asset('assets/image/home/s-3.png')}}" alt="">
                            <h4>Ghari</h4>
                            <div class="button">
                               <a href="">Order Now</a> 
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{asset('assets/image/home/s-4.png')}}" alt="">
                            <h4>Kaju Katli</h4>
                            <div class="button">
                               <a href="">Order Now</a> 
                            </div>
                        </div> --}}
                </div>
            </div>
        </div>
    </div>



    <!-- order seaction end -->

    <!-- product seaction start -->
    <div class="product margin_top80 margin_bottom50">
        <div class="container">
            <div class="button">
                <div class="all-bt">
                    <a href="" id="featured-btn">
                        <h5 class="bt-1">Featured</h5>
                    </a>
                    <a href="" id="popular-btn">
                        <h5 class="bt-2">Popular</h5>
                    </a>
                    <a href="" id="newly-added-btn">
                        <h5 class="bt-3">Newly Add</h5>
                    </a>
                </div>
                <div class="view">
                    <a href="{{ route('product.view') }}">
                        <h5>View more... <i class="fa-solid fa-angles-right"></i></h5>
                    </a>

                </div>
            </div>


            {{-- big screen product home --}}

            <div class="big-screen-product-home">

                <div class="default-slider">
                    <div class="swiper mySwiper-2 margin_top50">
                        <div class="swiper-wrapper">
                            @foreach ($populer_product as $item)
                                <div class="swiper-slide">
                                    <div class="box">
                                        @if ($item->image && file_exists(public_path($item->image)))
                                            <img src="{{ asset($item->image) }}" class="card-img-top" alt="..."
                                                width="327px" height="303px">
                                        @else
                                            <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                                class="card-img-top" alt="..." width="327px" height="303px">
                                        @endif
                                        <div class="b-text">
                                            <p>{{ $item->description }}</p>
                                            <h4>{{ $item->product_name }}</h4>
                                            <div class="star">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div>
                                            <div class="price">
                                                <h4>&#8377 {{ $item->per_kg_price }} </h4>
                                                @php
                                                    $priceDifference = $item->mrp - $item->per_kg_price;
                                                @endphp
                                                @if ($priceDifference > 0)
                                                    <del>
                                                        <h5>&#8377 {{ $item->mrp }}</h5>
                                                    </del>
                                                @endif

                                                @if (Auth::user() != null)
                                                    <form action="{{ route('add_to_cart') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $item->id }}">
                                                        <input type="hidden" name="product_quntity" value="1">
                                                        <a href="{{ route('add_to_cart') }}"
                                                            onclick="event.preventDefault(); this.closest('form').submit();"><i
                                                                class="fa-solid fa-cart-plus"></i></a>
                                                    </form>
                                                @else
                                                    <a href="" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i
                                                            class="fa-solid fa-cart-plus"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>



                <div class="popular-slider">
                    <div class="swiper mySwiper-2 margin_top50">
                        <div class="swiper-wrapper">
                            @foreach ($populer_product as $item)
                                <div class="swiper-slide">
                                    <div class="box">
                                        @if ($item->image && file_exists(public_path($item->image)))
                                            <img src="{{ asset($item->image) }}" class="card-img-top" alt="..."
                                                width="327px" height="303px">
                                        @else
                                            <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                                class="card-img-top" alt="..." width="327px" height="303px">
                                        @endif
                                        <div class="b-text">
                                            <p>{{ $item->description }}</p>
                                            <h4>{{ $item->product_name }}</h4>
                                            <div class="star">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div>
                                            <div class="price">
                                                <h4>&#8377 {{ $item->per_kg_price }}</h4>
                                                @php
                                                    $priceDifference = $item->mrp - $item->per_kg_price;
                                                @endphp
                                                @if ($priceDifference > 0)
                                                    <del>
                                                        <h5>&#8377 {{ $item->mrp }}</h5>
                                                    </del>
                                                @endif

                                                @if (Auth::user() != null)
                                                    <form action="{{ route('add_to_cart') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $item->id }}">
                                                        <input type="hidden" name="product_quntity" value="1">
                                                        <a href="{{ route('add_to_cart') }}"
                                                            onclick="event.preventDefault(); this.closest('form').submit();"><i
                                                                class="fa-solid fa-cart-plus"></i></a>
                                                    </form>
                                                @else
                                                    <a href="" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i
                                                            class="fa-solid fa-cart-plus"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>




                <div class="newly-added-slider">
                    <div class="swiper mySwiper-2 margin_top50">
                        <div class="swiper-wrapper">
                            @foreach ($populer_desc as $item)
                                <div class="swiper-slide">
                                    <div class="box">
                                        @if ($item->image && file_exists(public_path($item->image)))
                                            <img src="{{ asset($item->image) }}" class="card-img-top" alt="..."
                                                width="327px" height="303px">
                                        @else
                                            <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                                class="card-img-top" alt="..." width="327px" height="303px">
                                        @endif
                                        <div class="b-text">
                                            <p>{{ $item->description }}</p>
                                            <h4 class="pr-name-short">{{ $item->product_name }}</h4>
                                            <div class="star">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div>
                                            <div class="price">
                                                <h4>&#8377 {{ $item->per_kg_price }}</h4>
                                                @php
                                                    $priceDifference = $item->mrp - $item->per_kg_price;
                                                @endphp
                                                @if ($priceDifference > 0)
                                                    <del>
                                                        <h5>&#8377 {{ $item->mrp }}</h5>
                                                    </del>
                                                @endif
                                                @if (Auth::user() != null)
                                                    <form action="{{ route('add_to_cart') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $item->id }}">
                                                        <input type="hidden" name="product_quntity" value="1">
                                                        <a href="{{ route('add_to_cart') }}"
                                                            onclick="event.preventDefault(); this.closest('form').submit();"><i
                                                                class="fa-solid fa-cart-plus"></i></a>
                                                    </form>
                                                @else
                                                    <a href="" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i
                                                            class="fa-solid fa-cart-plus"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>


            <!-- home mobile view product -->
            <div class="home-mobile-product">
                <div class="default-slider">
                    <div class="overflo">
                        @foreach ($populer_product as $item)
                            <div class="box mt-4">
                                @if ($item->image && file_exists(public_path($item->image)))
                                    <img src="{{ asset($item->image) }}" width="327px" height="303px">
                                @else
                                    <img src="{{ asset('assets/image/product_null_image/photo.png') }}" width="327px"
                                        height="303px">
                                @endif
                                <div class="b-text">
                                    <p>{{ $item->product_name }}</p>
                                    <h4>{{ $item->subCategory->name }}</h4>
                                    <div class="star">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="price d-flex">
                                        <h4>&#8377 {{ $item->per_kg_price }} </h4>
                                        @php
                                            $priceDifference = $item->mrp - $item->per_kg_price;
                                        @endphp
                                        @if ($priceDifference > 0)
                                            <del>
                                                <h5>&#8377 {{ $item->mrp }}</h5>
                                            </del>
                                        @endif
                                        @if (Auth::user() != null)
                                            <form action="{{ route('add_to_cart') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                <input type="hidden" name="product_quntity" value="1">
                                                <a href="{{ route('add_to_cart') }}"
                                                    onclick="event.preventDefault(); this.closest('form').submit();"><i
                                                        class="fa-solid fa-cart-plus"></i></a>
                                            </form>
                                        @else
                                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                    class="fa-solid fa-cart-plus"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>



                <div class="popular-slider">
                    <div class="overflo">
                        @foreach ($populer_product as $item)
                            <div class="box mt-4">
                                @if ($item->image && file_exists(public_path($item->image)))
                                    <img src="{{ asset($item->image) }}" width="327px" height="303px">
                                @else
                                    <img src="{{ asset('assets/image/product_null_image/photo.png') }}" width="327px"
                                        height="303px">
                                @endif
                                <div class="b-text">
                                    <p>{{ $item->product_name }}</p>
                                    <h4>{{ $item->subCategory->name }}</h4>
                                    <div class="star">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="price d-flex">
                                        <h4>&#8377 {{ $item->per_kg_price }} </h4>
                                        @php
                                            $priceDifference = $item->mrp - $item->per_kg_price;
                                        @endphp
                                        @if ($priceDifference > 0)
                                            <del>
                                                <h5>&#8377 {{ $item->mrp }}</h5>
                                            </del>
                                        @endif
                                        @if (Auth::user() != null)
                                            <form action="{{ route('add_to_cart') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                <input type="hidden" name="product_quntity" value="1">
                                                <a href="{{ route('add_to_cart') }}"
                                                    onclick="event.preventDefault(); this.closest('form').submit();"><i
                                                        class="fa-solid fa-cart-plus"></i></a>
                                            </form>
                                        @else
                                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                    class="fa-solid fa-cart-plus"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>




                <div class="newly-added-slider">
                    <div class="overflo">
                        @foreach ($populer_desc as $item)
                            <div class="box mt-4">
                                @if ($item->image && file_exists(public_path($item->image)))
                                    <img src="{{ asset($item->image) }}" width="327px" height="303px">
                                @else
                                    <img src="{{ asset('assets/image/product_null_image/photo.png') }}" width="327px"
                                        height="303px">
                                @endif
                                <div class="b-text">
                                    <p>{{ $item->product_name }}</p>
                                    <h4>{{ $item->subCategory->name }}</h4>
                                    <div class="star">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="price d-flex">
                                        <h4>&#8377 {{ $item->per_kg_price }} </h4>
                                        @php
                                            $priceDifference = $item->mrp - $item->per_kg_price;
                                        @endphp
                                        @if ($priceDifference > 0)
                                            <del>
                                                <h5>&#8377 {{ $item->mrp }}</h5>
                                            </del>
                                        @endif
                                        @if (Auth::user() != null)
                                            <form action="{{ route('add_to_cart') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                <input type="hidden" name="product_quntity" value="1">
                                                <a href="{{ route('add_to_cart') }}"
                                                    onclick="event.preventDefault(); this.closest('form').submit();"><i
                                                        class="fa-solid fa-cart-plus"></i></a>
                                            </form>
                                        @else
                                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                    class="fa-solid fa-cart-plus"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>






        </div>
    </div>
    <!-- product seaction end -->

    <!-- most demanded seaction start -->
    <div class="most margin_top30 margin_bottom50">
        <div class="container">
            <h1>Most Demanded</h1>
            <p>Check out and order our best selling sweets across various cities in India and across the City.</p>


            <div class="swiper mySwiper-2 margin_top50">
                <div class="swiper-wrapper">
                    @foreach ($populer_product as $item)
                        <div class="swiper-slide">
                            <div class="box">
                                @if ($item->image && file_exists(public_path($item->image)))
                                    <img src="{{ asset($item->image) }}" class="card-img-top" alt="..."
                                        width="342px" height="249px">
                                @else
                                    <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                        class="card-img-top" alt="..." width="342px" height="249px">
                                @endif
                                {{-- <img src="{{asset('assets/image/home/m-1.png')}}" alt=""> --}}
                                @if (Auth::user() != null)
                                    <form action="{{ route('add_to_cart') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                        <input type="hidden" name="product_quntity" value="1">
                                        <div class="button">
                                            <a href=""
                                                onclick= "event.preventDefault(); this.closest('form').submit();">Order
                                                Now</a>
                                        </div>
                                    </form>
                                @else
                                    <div class="button">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">Order
                                            Now</a>
                                    </div>
                                @endif
                                <h3>{{ $item->product_name }}</h3>
                                <h5>From: <span>&#8377 {{ $item->mrp }}</span></h5>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="swiper-slide">
                            <div class="box">
                                <img src="{{asset('assets/image/home/m-2.png')}}" alt="">
                                <div class="button">
                                    <a href="">Order Now</a> 
                                 </div>
                                <h3>Kaju Katli</h3>
                                <h5>From: <span>&#8377 200.00</span></h5>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="box">
                                <img src="{{asset('assets/image/home/m-3.png')}}" alt="">
                                <div class="button">
                                    <a href="">Order Now</a> 
                                 </div>
                                <h3>Milkcake</h3>
                                <h5>From: <span>&#8377 200.00</span></h5>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="box">
                                <img src="{{asset('assets/image/home/m-2.png')}}" alt="">
                                <div class="button">
                                    <a href="">Order Now</a> 
                                 </div>
                                <h3>Kaju Katli</h3>
                                <h5>From: <span>&#8377 200.00</span></h5>
                            </div>
                        </div> --}}
                </div>
            </div>

        </div>
    </div>
    <!-- most demanded seaction end -->

    <!-- offer seaction start -->
    <div class="offer margin_top80 margin_bottom50">
        <div class="container">
            <div class="offer-text d-flex">
                <h1 class="outfit"> Offers</h1>
                <div class="view">
                    <a href="{{ route('product.view') }}">
                        <h5>View more... <i class="fa-solid fa-angles-right"></i></h5>
                    </a>
                </div>
            </div>
            <div class="row padding_top50">
                <div class="col-lg-4">
                    {{-- <img class="main" src="{{ asset('assets/image/home/offer-1.png') }}" alt=""> --}}
                    {{-- <img class="sec" src="{{ asset('assets/image/home/offer-2.png') }}" alt=""> --}}
                    @foreach ($front_image as $item)
                        {{-- @if ($item->id == 1)
                            <img class="main" src="{{ asset($item->image) }}" alt="">
                        @endif --}}
                        @if ($item->id == 2)
                            <img class="sec" src="{{ asset($item->image) }}" alt="">
                        @endif
                    @endforeach

                </div>

                {{-- big screen offer product --}}
                <div class="col-lg-8">
                    <div class="big-screen-offer-product">
                        <div class="swiper mySwiper-2">
                            <div class="swiper-wrapper">
                                @foreach ($populer_product as $item)
                                    <div class="swiper-slide">
                                        <div class="box">
                                            @if ($item->image && file_exists(public_path($item->image)))
                                                <img src="{{ asset($item->image) }}" class="card-img-top" alt="..."
                                                    width="223px" height="223px">
                                            @else
                                                <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                                    class="card-img-top" alt="..."width="223px" height="223px">
                                            @endif
                                            <div class="b-text">
                                                <p>{{ $item->description }}</p>
                                                <h4>{{ $item->product_name }}</h4>
                                                <div class="star">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                                <div class="price">
                                                    <h4>&#8377 {{ $item->per_kg_price }}</h4>
                                                    @php
                                                        $priceDifference = $item->mrp - $item->per_kg_price;
                                                    @endphp
                                                    @if ($priceDifference > 0)
                                                        <del>
                                                            <h5>&#8377 {{ $item->mrp }}</h5>
                                                        </del>
                                                    @endif

                                                    @if (Auth::user() != null)
                                                        <form action="{{ route('add_to_cart') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $item->id }}">
                                                            <input type="hidden" name="product_quntity" value="1">
                                                            <a href="{{ route('add_to_cart') }}"
                                                                onclick="event.preventDefault(); this.closest('form').submit();"><i
                                                                    class="fa-solid fa-cart-plus"></i></a>
                                                        </form>
                                                    @else
                                                        <a href="" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal"><i
                                                                class="fa-solid fa-cart-plus"></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- <div class="swiper-slide">
                                        <div class="box">
                                            <img src="{{asset('assets/image/home/o-2.png')}}" alt="">
                                            <div class="b-text">
                                                <p>Milk Based Sweets</p>
                                                <h4>Soanpapdi</h4>
                                                <div class="star">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                                <div class="price d-flex">
                                                    <h4>&#8377 200.00</h4>
                                                    <del><h5>&#8377 200.00</h5></del>
                                                    <a href=""><i class="fa-solid fa-cart-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="box">
                                            <img src="{{asset('assets/image/home/o-3.png')}}" alt="">
                                            <div class="b-text">
                                                <p>Milk Based Sweets</p>
                                                <h4>Mohanthal</h4>
                                                <div class="star">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                                <div class="price d-flex">
                                                    <h4>&#8377 200.00</h4>
                                                    <del><h5>&#8377 200.00</h5></del>
                                                    <a href=""><i class="fa-solid fa-cart-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="box">
                                            <img src="{{asset('assets/image/home/o-2.png')}}" alt="">
                                            <div class="b-text">
                                                <p>Milk Based Sweets</p>
                                                <h4>Soanpapdi</h4>
                                                <div class="star">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                                <div class="price d-flex">
                                                    <h4>&#8377 200.00</h4>
                                                    <del><h5>&#8377 200.00</h5></del>
                                                    <a href=""><i class="fa-solid fa-cart-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- mobile screen offer product --}}
                <div class="col-lg-8">
                    <div class="mobile-screen-offer-product">
                        <div class="box">
                            <img src="./assets/image/home/o-1.png" alt="">
                            <div class="b-text">
                                <p>Milk Based Sweets</p>
                                <h4>Anjir Roll</h4>
                                <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <div class="price">
                                    <h4>&#8377 200.00</h4>
                                    <del>
                                        <h5>&#8377 200.00</h5>
                                    </del>
                                    <a href=""><i class="fa-solid fa-cart-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="box">
                            <img src="./assets/image/home/o-2.png" alt="">
                            <div class="b-text">
                                <p>Milk Based Sweets</p>
                                <h4>Soanpapdi</h4>
                                <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <div class="price">
                                    <h4>&#8377 200.00</h4>
                                    <del>
                                        <h5>&#8377 200.00</h5>
                                    </del>
                                    <a href=""><i class="fa-solid fa-cart-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="box">
                            <img src="./assets/image/home/o-3.png" alt="">
                            <div class="b-text">
                                <p>Milk Based Sweets</p>
                                <h4>Mohanthal</h4>
                                <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <div class="price">
                                    <h4>&#8377 200.00</h4>
                                    <del>
                                        <h5>&#8377 200.00</h5>
                                    </del>
                                    <a href=""><i class="fa-solid fa-cart-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- offer seaction end  -->

    <!-- blog seaction start -->
    {{-- <div class="blog margin_top80 margin_bottom50">
        <div class="container">
            <h1 class="outfit">Latest Blogs</h1>
            <div class="row padding_top50">

                <div class="col-lg-6">
                    @foreach ($blog as $item)
                        @if ($item->id == 1)
                            <div class="card">
                                <img src="{{ asset('assets/image/home/blog-1.png') }}" alt="">
                                <div class="card-body blog-text">
                                    <h4>{{ $item->title }}</h4>
                                    <div class="date d-flex"> --}}
    {{-- <h6>{{ $item->created_at->format('d M Y') ?? '01/01/24' }}</h6> --}}
    {{-- <h6>0 comment</h6> --}}
    {{-- </div>
                                    <p>{{ $item->message }}</p>
                                    <a href="">
                                        <h5>READ MORE <i class="fa-solid fa-arrow-right"></i></h5>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                @foreach ($blog as $item)
                    @if ($item->id !== 1)
                        <div class="col-lg-6">
                            <div class="small-blog margin_top20">
                                <div class="img">
                                    <img src="{{ asset('assets/image/home/blog-2.png') }}" alt="">
                                </div>
                                <div class="text">
                                    <h4>Authentic Taste & Finest Ingredients</h4>
                                    <p>Providing Quality, Traditional and Authentic taste of all the Indian Sweets. At the
                                        same
                                        time, Innovating new products for the young generation....</p>
                                    <a href="">
                                        <h6>READ MORE <i class="fa-solid fa-arrow-right"></i></h6>
                                    </a>
                                </div>
                            </div>
                    @endif
                @endforeach



            </div>


        </div>
    </div> --}}




    <div class="blog margin_top80 margin_bottom50">
        <div class="container">
            <h1 class="outfit">Latest Blogs</h1>
            <div class="row padding_top50">
                @foreach ($blog as $item)
                    @if ($item->id == 1)
                        <div class="col-lg-6">
                            <div class="card">
                                {{-- <img src="../assets/image/home/blog-1.png" alt=""> --}}
                                @if ($item->image && file_exists(public_path($item->image)))
                                    <img src="{{ asset($item->image) }}" class="card-img-top" alt="...">
                                @else
                                    <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                        class="card-img-top" alt="...">
                                @endif
                                <div class="card-body blog-text">
                                    <h4 class="blog-title-home">{{ $item->title }}</h4>
                                    <div class="date d-flex">
                                        {{-- <h6>22 Jan 2024</h6> --}}
                                        <h6> {{ \Carbon\Carbon::parse($item->created_at)->format('d M, Y') }}</h6>

                                        <h6>0 comment</h6>
                                    </div>
                                    <p class="blog-text-home">{{ $item->message }}</p>
                                    <a href="{{ route('blog-details.view', $item->id) }}">
                                        <h5>READ MORE <i class="fa-solid fa-arrow-right"></i></h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="col-lg-6">
                    <div class="small-box-blog">
                        <div class="overflow">
                            @foreach ($blog as $item)
                                @if ($item->id !== 1)
                                    <div class="small-blog margin_bottom50">
                                        <div class="img">
                                            {{-- <img src="../assets/image/home/blog-2.png" alt=""> --}}
                                            @if ($item->image && file_exists(public_path($item->image)))
                                                <img src="{{ asset($item->image) }}" class="card-img-top"
                                                    alt="...">
                                            @else
                                                <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                                    class="card-img-top" alt="...">
                                            @endif
                                        </div>
                                        <div class="text">
                                            <h4 class="blog-title-home">{{ $item->title }}</h4>
                                            <p class="blog-text-home">{{ $item->message }}</p>
                                            <a href="{{ route('blog.view') }}">
                                                <h6>READ MORE <i class="fa-solid fa-arrow-right"></i></h6>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- blog seaction end -->


    <!-- rating seaction start -->
    <div class="rating margin_top80 margin_bottom50">
        <div class="container">
            <div class="google">
                <img src="{{ asset('assets/image/home/google-logo.png') }}" alt="">
                <h1>Rating</h1>
            </div>
            <div class="star">
                <h1>4.5</h1>
                <img src="{{ asset('assets/image/home/star.png') }}" alt="">
                <h3>492 reviews</h3>
            </div>


            <div class="swiper mySwiper-2 margin_top50">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-text d-flex">
                                <div class="img">
                                    <img src="{{ asset('assets/image/home/r-1.png') }}" alt="">
                                </div>
                                <div class="name">
                                    <h4>Sagar Rajput</h4>
                                    <div class="star d-flex">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <h6>6 days ago</h6>
                                    </div>
                                </div>
                            </div>
                            <p class="text-p">"I highly recommend kanaiya dairy cause they consistently offer high-quality
                                products at affordable prices. Definitely worth a visit!</p>
                            <div class="small-google d-flex">
                                <div class="img">
                                    <img src="{{ asset('assets/image/home/google.png') }}" alt="">
                                </div>
                                <div class="text">
                                    <p class="post">Posted on</p>
                                    <p class="google">Google</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-text d-flex">
                                <div class="img">
                                    <img src="{{ asset('assets/image/home/r-2.png') }}" alt="">
                                </div>
                                <div class="name">
                                    <h4>Sagar Rajput</h4>
                                    <div class="star d-flex">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <h6>6 days ago</h6>
                                    </div>
                                </div>
                            </div>
                            <p class="text-p">"I highly recommend kanaiya dairy cause they consistently offer high-quality
                                products at affordable prices. Definitely worth a visit!</p>
                            <div class="small-google d-flex">
                                <div class="img">
                                    <img src="{{ asset('assets/image/home/google.png') }}" alt="">
                                </div>
                                <div class="text">
                                    <p class="post">Posted on</p>
                                    <p class="google">Google</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-text d-flex">
                                <div class="img">
                                    <img src="{{ asset('assets/image/home/r-3.png') }}" alt="">
                                </div>
                                <div class="name">
                                    <h4>Sagar Rajput</h4>
                                    <div class="star d-flex">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <h6>6 days ago</h6>
                                    </div>
                                </div>
                            </div>
                            <p class="text-p">"I highly recommend kanaiya dairy cause they consistently offer high-quality
                                products at affordable prices. Definitely worth a visit!</p>
                            <div class="small-google d-flex">
                                <div class="img">
                                    <img src="{{ asset('assets/image/home/google.png') }}" alt="">
                                </div>
                                <div class="text">
                                    <p class="post">Posted on</p>
                                    <p class="google">Google</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-text d-flex">
                                <div class="img">
                                    <img src="{{ asset('assets/image/home/r-2.png') }}" alt="">
                                </div>
                                <div class="name">
                                    <h4>Sagar Rajput</h4>
                                    <div class="star d-flex">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <h6>6 days ago</h6>
                                    </div>
                                </div>
                            </div>
                            <p class="text-p">"I highly recommend kanaiya dairy cause they consistently offer high-quality
                                products at affordable prices. Definitely worth a visit!</p>
                            <div class="small-google d-flex">
                                <div class="img">
                                    <img src="{{ asset('assets/image/home/google.png') }}" alt="">
                                </div>
                                <div class="text">
                                    <p class="post">Posted on</p>
                                    <p class="google">Google</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="swiper mySwiper-2 margin_top50">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-text d-flex">
                                <div class="img">
                                    <img src="{{ asset('assets/image/home/r-4.png') }}" alt="">
                                </div>
                                <div class="name">
                                    <h4>Sagar Rajput</h4>
                                    <div class="star d-flex">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <h6>6 days ago</h6>
                                    </div>
                                </div>
                            </div>
                            <p class="text-p">"I highly recommend kanaiya dairy cause they consistently offer high-quality
                                products at affordable prices. Definitely worth a visit!</p>
                            <div class="small-google d-flex">
                                <div class="img">
                                    <img src="{{ asset('assets/image/home/google.png') }}" alt="">
                                </div>
                                <div class="text">
                                    <p class="post">Posted on</p>
                                    <p class="google">Google</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-text d-flex">
                                <div class="img">
                                    <img src="{{ asset('assets/image/home/r-5.png') }}" alt="">
                                </div>
                                <div class="name">
                                    <h4>Sagar Rajput</h4>
                                    <div class="star d-flex">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <h6>6 days ago</h6>
                                    </div>
                                </div>
                            </div>
                            <p class="text-p">"I highly recommend kanaiya dairy cause they consistently offer high-quality
                                products at affordable prices. Definitely worth a visit!</p>
                            <div class="small-google d-flex">
                                <div class="img">
                                    <img src="{{ asset('assets/image/home/google.png') }}" alt="">
                                </div>
                                <div class="text">
                                    <p class="post">Posted on</p>
                                    <p class="google">Google</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-text d-flex">
                                <div class="img">
                                    <img src="{{ asset('assets/image/home/r-6.png') }}" alt="">
                                </div>
                                <div class="name">
                                    <h4>Sagar Rajput</h4>
                                    <div class="star d-flex">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <h6>6 days ago</h6>
                                    </div>
                                </div>
                            </div>
                            <p class="text-p">"I highly recommend kanaiya dairy cause they consistently offer high-quality
                                products at affordable prices. Definitely worth a visit!</p>
                            <div class="small-google d-flex">
                                <div class="img">
                                    <img src="{{ asset('assets/image/home/google.png') }}" alt="">
                                </div>
                                <div class="text">
                                    <p class="post">Posted on</p>
                                    <p class="google">Google</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <div class="img-text d-flex">
                                <div class="img">
                                    <img src="{{ asset('assets/image/home/r-5.png') }}" alt="">
                                </div>
                                <div class="name">
                                    <h4>Sagar Rajput</h4>
                                    <div class="star d-flex">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <h6>6 days ago</h6>
                                    </div>
                                </div>
                            </div>
                            <p class="text-p">"I highly recommend kanaiya dairy cause they consistently offer high-quality
                                products at affordable prices. Definitely worth a visit!</p>
                            <div class="small-google d-flex">
                                <div class="img">
                                    <img src="{{ asset('assets/image/home/google.png') }}" alt="">
                                </div>
                                <div class="text">
                                    <p class="post">Posted on</p>
                                    <p class="google">Google</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



        </div>
    </div>

    <!-- rating seaction end -->

@endsection

@section('script')
    {{-- <script>
        $(document).ready(function() {
            // Default slider display on page load
            $('.default-slider').show();
        });

        // Default slider display on page load
        $('.default-slider').show();
        $('.newly-added-slider').hide();
        $('.popular-slider').hide();
        // Event listener for popular button


        $('#featured-btn').click(function() {
            // Hide all sliders
            // $('.swiper').hide();
            // Show the newly added slider
            event.preventDefault();
            $('.default-slider').show();
            $('.newly-added-slider').hide();
            $('.popular-slider').hide();
            $(this).addClass('active');
        });

        $('#popular-btn').click(function() {
            // Hide all sliders
            // $('.swiper').hide();
            // Show the popular slider
            event.preventDefault();
            $(this).addClass('active');
            $('.popular-slider').show();
            $('.default-slider').hide();
            $('.newly-added-slider').hide();

        });

        // Event listener for newly added button
        $('#newly-added-btn').click(function() {
            // Hide all sliders
            // $('.swiper').hide();
            // Show the newly added slider
            event.preventDefault();
            $('.newly-added-slider').show();
            $('.popular-slider').hide();
            $('.default-slider').hide();
        });
    </script> --}}




    <script>
        $(document).ready(function() {
            // Default slider display on page load
            $('.default-slider').show();
            $('.newly-added-slider').hide();
            $('.popular-slider').hide();

            // Event listener for featured button
            $('#featured-btn').click(function(event) {
                // Prevent default link behavior
                event.preventDefault();
                // Remove 'active' class from all buttons
                $('.button a').removeClass('active');
                // Add 'active' class to the clicked button
                $(this).addClass('active');
                // Hide all sliders
                $('.newly-added-slider').hide();
                $('.popular-slider').hide();
                // Show the featured slider
                $('.default-slider').show();
            });

            // Event listener for popular button
            $('#popular-btn').click(function(event) {
                // Prevent default link behavior
                event.preventDefault();
                // Remove 'active' class from all buttons
                $('.button a').removeClass('active');
                // Add 'active' class to the clicked button
                $(this).addClass('active');
                // Hide all sliders
                $('.newly-added-slider').hide();
                $('.default-slider').hide();
                // Show the popular slider
                $('.popular-slider').show();
            });

            // Event listener for newly added button
            $('#newly-added-btn').click(function(event) {
                // Prevent default link behavior
                event.preventDefault();
                // Remove 'active' class from all buttons
                $('.button a').removeClass('active');
                // Add 'active' class to the clicked button
                $(this).addClass('active');
                // Hide all sliders
                $('.default-slider').hide();
                $('.popular-slider').hide();
                // Show the newly added slider
                $('.newly-added-slider').show();
            });

            // Trigger a click event on the featured button to make it active by default
            $('#featured-btn').trigger('click');
        });
    </script>






    {{-- product name short --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var cardTextElements = document.querySelectorAll('.pr-name-short');
            cardTextElements.forEach(function(element) {
                var originalText = element.textContent.trim();
                if (originalText.length > 25) {
                    var truncatedText = originalText.substring(0, 25);
                    element.textContent = truncatedText;
                }
            });
        });
    </script>
    {{-- google review text short --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var cardTextElements = document.querySelectorAll('.text-p');
            cardTextElements.forEach(function(element) {
                var originalText = element.textContent.trim();
                if (originalText.length > 170) {
                    var truncatedText = originalText.substring(0, 170) + '...';
                    element.textContent = truncatedText;
                }
            });
        });
    </script>
    <!-- blog text fix -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var cardTextElements = document.querySelectorAll('.blog-title-home');
            cardTextElements.forEach(function(element) {
                var originalText = element.textContent.trim();
                if (originalText.length > 37) {
                    var truncatedText = originalText.substring(0, 37) + '...';
                    element.textContent = truncatedText;
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var cardTextElements = document.querySelectorAll('.blog-text-home');
            cardTextElements.forEach(function(element) {
                var originalText = element.textContent.trim();
                if (originalText.length > 145) {
                    var truncatedText = originalText.substring(0, 145) + '...';
                    element.textContent = truncatedText;
                }
            });
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
        ScrollReveal().reveal('.box-1', {
            origin: 'top'
        });
        ScrollReveal().reveal('.box-2', {
            origin: 'bottom'
        });
        ScrollReveal().reveal('.box-3', {
            origin: 'top'
        });
        ScrollReveal().reveal('.order h1', {
            origin: 'top'
        });
        ScrollReveal().reveal('.most h1', {
            origin: 'top'
        });
        ScrollReveal().reveal('.offer h1', {
            origin: 'top'
        });
        ScrollReveal().reveal('.blog h1', {
            origin: 'top'
        });
    </script>

@endsection
