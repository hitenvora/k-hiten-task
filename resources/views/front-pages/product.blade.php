@extends('front-pages.layout.layout')
@section('title', 'Product')
@section('footer_class', 'margin_top50')



@section('content')
    <link rel="stylesheet" href="../assets/css/product.css">

    <main>
        <!-- product-bg seaction start -->
        <div class="product-bg">
            <div class="container">
                <h1 class="mogra-regular">Product</h1>
            </div>
        </div>
        <!-- product-bg seaction end -->

        <!-- order seaction start -->
        <section>
            <div class="pr-order margin_top70">
                <div class="container">
                    <h1>Order <span>All Sweets</span> Online from Kanaiya Dairyfarm & Sweets</h1>
                    <p>Your satisfaction is our top priority. Our friendly and knowledgeable staff will be more than happy
                        to assist you and guide you through our extensive range of sweets. Visit Kanaiya Dairyfarm and
                        Sweets today and treat yourself and your loved ones to the finest Indian sweets in Surat. Celebrate
                        the joy of togetherness
                        with sweetness that lingers on your plate and in your heart!</p>
                    <h4> CATEGORIES</h4>
                    {{-- <div class="group-payment margin_top20">
                        <input type="text" required="required" placeholder="Search the product you want " />
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <span class="search-icon">
                           
                            <a href="{{route('product.view')}}"><i class="fa fa-search"></i></a>

                        </span>

                    </div> --}}


                    <div class="group-payment margin_top20">
                        <form action="{{ route('product.view') }}" method="GET">
                            <input type="text" name="search" required="required"
                                placeholder="Search the product you want" value="{{ request()->input('search') }}" />
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <span class="search-icon">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </form>
                    </div>

                    {{-- <hr> --}}
                    {{-- <div class="d-flex justify-content-between tablist"> --}}
                    {{-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active all-tab" id="all-tab" data-bs-toggle="tab"
                                data-bs-target="#all" type="button" role="tab" aria-controls="all"
                                aria-selected="true">All Sweets</button>
                        </li>
                        @foreach ($prodcut_cetegory as $item)
                            
                      
                        <li class="nav-item" role="presentation">
                            <button class="nav-link Shrikhand-tab" id="Shrikhand-tab" data-bs-toggle="tab"
                                data-bs-target="#Shrikhand" type="button" role="tab" aria-controls="Shrikhand"
                                aria-selected="false">{{$item->name}} </button>
                        </li>
                        @endforeach --}}
                    {{-- <li class="nav-item" role="presentation">
                            <button class="nav-link Mathho-tab" id="Mathho-tab" data-bs-toggle="tab"
                                data-bs-target="#Mathho" type="button" role="tab" aria-controls="Mathho"
                                aria-selected="false">Mathho</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link Rabdi-tab" id="Rabdi-tab" data-bs-toggle="tab"
                                data-bs-target="#Rabdi" type="button" role="tab" aria-controls="Rabdi"
                                aria-selected="false">Rabdi</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link Lassi-tab" id="Lassi-tab" data-bs-toggle="tab"
                                data-bs-target="#Lassi" type="button" role="tab" aria-controls="Lassi"
                                aria-selected="false">Lassi & Coco</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link Kaju-tab" id="Kaju-tab" data-bs-toggle="tab"
                                data-bs-target="#Kaju" type="button" role="tab" aria-controls="Kaju"
                                aria-selected="false">Kaju Items</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link Penda-tab" id="Penda-tab" data-bs-toggle="tab"
                                data-bs-target="#Penda" type="button" role="tab" aria-controls="Penda"
                                aria-selected="false">Penda</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link Barfi-tab" id="Barfi-tab" data-bs-toggle="tab"
                                data-bs-target="#Barfi" type="button" role="tab" aria-controls="Barfi"
                                aria-selected="false">Barfi</button>
                        </li> --}}
                    {{-- </ul> --}}
                    {{-- <ul class="nav nav-tabs">
                    <div class="swiper mySwiper-5 margin_top50">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                        <li class="nav-item">
                            <a class="nav-link {{ !request()->has('category_id') ? 'active' : '' }}" href="{{ route('product.view') }}">All Sweets</a>
                        </li>
                        @foreach ($product_categories as $category)

                        <li class="nav-item">
                            <a class="nav-link {{ request()->input('category_id') == $category->id ? 'active' : '' }}" href="{{ route('product.view', ['category_id' => $category->id]) }}">{{ $category->name }}</a>
                        </li>
                        @endforeach
                    </div>
                    
                    </div>
                 </div>    

                    </ul>
                    
                </div> --}}











                    {{-- new section --}}
                    <div class="tablist">
                        <div class="scrollmenu">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <div class="swiper mySwiper-5 margin_top50">
                                    <div class="swiper-wrapper padding_bottom10">
                                        <div class="swiper-slide">
                                            <li class="nav-item">
                                                <a class="nav-link {{ !request()->has('category_id') ? 'active' : '' }}"
                                                    href="{{ route('product.view') }}">All Sweets</a>
                                            </li>
                                        </div>
                                        @foreach ($product_categories as $category)
                                            <div class="swiper-slide">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link {{ request()->input('category_id') == $category->id ? 'active' : '' }}"
                                                        href="{{ route('product.view', ['category_id' => $category->id]) }}">{{ $category->name }}</a>
                                                </li>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>






                    {{-- <div class="tablist">
                        <div class="scrollmenu">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <div class="swiper mySwiper-5 margin_top50">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <li class="nav-item">
                                                <a class="nav-link category-tab {{ !request()->has('category_id') ? 'active' : '' }}"
                                                    data-category-id="" href="#">All Sweets</a>
                                            </li>
                                        </div>
                                        @foreach ($product_categories as $category)
                                            <div class="swiper-slide">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link category-tab {{ request()->input('category_id') == $category->id ? 'active' : '' }}"
                                                        data-category-id="{{ $category->id }}"
                                                        href="#">{{ $category->name }}</a>
                                                </li>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div> --}}





                    <div class="row">
                        <div class="col-lg-3 padding_top70 big-screen-product">
                            <div class="populer-box">
                                <h4>POPULAR</h4>
                                @foreach ($populer_product as $item)
                                    <div class="pop-img">
                                        <div class="img-pop">
                                            {{-- @if ($item->image && file_exists($item->image))
                                                <img src="{{ asset($item->image) }}" class="card-img-top" alt="..."
                                                    height="103px" width="103px">
                                            @else
                                                <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                                    class="card-img-top" alt="..." height="103px" width="103px">
                                            @endif --}}


                                            @if (auth()->check())
                                                <!-- Check if user is authenticated -->
                                                @if ($item->image && file_exists($item->image))
                                                    <form action="{{ route('add_to_cart') }}" method="post"
                                                        class="add-to-cart-form">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                        <input type="hidden" name="product_quntity" value="1">
                                                        <a href=""
                                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                                            <img src="{{ asset($item->image) }}" class="card-img-top"
                                                                alt="..." height="103px" width="103px">
                                                        </a>
                                                    </form>
                                                @else
                                                    <a href="#" class="add-to-cart-link" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal">
                                                        @if ($item->image && file_exists($item->image))
                                                            <img src="{{ asset($item->image) }}" class="card-img-top"
                                                                alt="..." height="103px" width="103px">
                                                        @else
                                                            <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                                                class="card-img-top" alt="..." height="103px"
                                                                width="103px">
                                                        @endif
                                                    </a>
                                                @endif
                                            @else
                                                <!-- If user is not authenticated -->
                                                <a href="#" class="add-to-cart-link" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">
                                                    @if ($item->image && file_exists($item->image))
                                                        <img src="{{ asset($item->image) }}" class="card-img-top"
                                                            alt="..." height="103px" width="103px">
                                                    @else
                                                        <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                                            class="card-img-top" alt="..." height="103px"
                                                            width="103px">
                                                    @endif
                                                </a>
                                            @endif




                                        </div>
                                        <div class="pop-text">
                                            <h5>{{ $item->product_name }}</h5>
                                            <h6>Rs. {{ $item->mrp }}</h6>
                                            <div class="icon">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- <div class="pop-img">
                                <div class="img-pop">
                                    <img src="../assets/image/product/p-2.png" alt="">
                                </div>
                                <div class="pop-text">
                                    <h5>Chocolate Balls</h5>
                                    <h6>Rs. 220</h6>
                                    <div class="icon">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="pop-img">
                                <div class="img-pop">
                                    <img src="../assets/image/product/p-3.png" alt="">
                                </div>
                                <div class="pop-text">
                                    <h5>Chocolate Barfi</h5>
                                    <h6>Rs. 220</h6>
                                    <div class="icon">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="pop-img">
                                <div class="img-pop">
                                    <img src="../assets/image/product/p-4.png" alt="">
                                </div>
                                <div class="pop-text">
                                    <h5>Dryfruit Tacos</h5>
                                    <h6>Rs. 220</h6>
                                    <div class="icon">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="pop-img">
                                <div class="img-pop">
                                    <img src="../assets/image/product/p-3.png" alt="">
                                </div>
                                <div class="pop-text">
                                    <h5>Chocolate Barfi</h5>
                                    <h6>Rs. 220</h6>
                                    <div class="icon">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                            </div> --}}
                            </div>
                            <div class="off-img">
                                @foreach ($front_image as $item)
                                    @if ($item->id == 2)
                                        <img class="sec" src="{{ asset($item->image) }}" alt="">
                                    @endif
                                @endforeach
                                {{-- <img src="../assets/image/product/2 57.png" alt=""> --}}
                            </div>
                        </div>




                        <div class="col-lg-9 padding_top70">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="all" role="tabpanel"
                                    aria-labelledby="all-tab" tabindex="0">
                                    <div class="row">
                                        @foreach ($products as $item)
                                            <div class="col-lg-4" style="margin-bottom: 20px;">
                                                <div class="card">
                                                    @if ($item->image && file_exists(public_path($item->image)))
                                                        <img src="{{ asset($item->image) }}" class="card-img-top"
                                                            alt="..." width="277px" height="218px">
                                                    @else
                                                        <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                                            class="card-img-top" alt="..." height="218px"
                                                            width="277px">
                                                    @endif

                                                    <div class="card-body">
                                                        {{-- <form action="{{ route('add_to_cart') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $item->id }}">
                                                            <a href=""> <img
                                                                    src="{{ asset('assets/image/product/cart.png') }}"
                                                                    alt=""> ADD TO CART</a>
                                                        </form> --}}
                                                        @php
                                                            $userId = Auth::id();
                                                        @endphp
                                                        @if ($userId)
                                                            <form action="{{ route('add_to_cart') }}" method="post"
                                                                class="add-to-cart-form">
                                                                @csrf
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $item->id }}">
                                                                <input type="hidden" name="product_quntity"
                                                                    value="1">
                                                                <a href="#" class="add-to-cart-link"
                                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                                                    <img src="{{ asset('assets/image/product/cart.png') }}"
                                                                        alt=""> ADD TO CART
                                                                </a>
                                                            </form>
                                                        @else
                                                            <a href="#" class="add-to-cart-link"
                                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                <img src="{{ asset('assets/image/product/cart.png') }}"
                                                                    alt=""> ADD TO CART
                                                            </a>
                                                        @endif



                                                        <h5 class="card-title">{{ $item->product_name }}</h5>
                                                        <p class="card-text">Rs. {{ $item->mrp }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{ $products->withQueryString()->links('pagination::bootstrap-5', ['category_id' => request()->input('category_id')]) }}
                                </div>
                            </div>
                        </div>





                        <!-- only mobile view product -->
                        <div class="row">
                            <div class="padding_top70 mobile-product">
                                <div class="populer-box">
                                    <h4>POPULAR</h4>
                                    @foreach ($populer_product as $item)
                                        <div class="pop-img">
                                            <div class="img-pop">
                                                @if ($item->image && file_exists($item->image))
                                                    <img src="{{ asset($item->image) }}" class="card-img-top"
                                                        alt="..." height="103px" width="103px">
                                                @else
                                                    <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                                        class="card-img-top" alt="..." height="103px"
                                                        width="103px">
                                                @endif
                                            </div>
                                            <div class="pop-text">
                                                <h5>{{ $item->product_name }}</h5>
                                                <h6>Rs. {{ $item->mrp }}</h6>
                                                <div class="icon">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{-- <div class="pop-img">
                                    <div class="img-pop">
                                        <img src="../assets/image/product/p-2.png" alt="">
                                    </div>
                                    <div class="pop-text">
                                        <h5>Chocolate Balls</h5>
                                        <h6>Rs. 220</h6>
                                        <div class="icon">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="pop-img">
                                    <div class="img-pop">
                                        <img src="../assets/image/product/p-3.png" alt="">
                                    </div>
                                    <div class="pop-text">
                                        <h5>Chocolate Barfi</h5>
                                        <h6>Rs. 220</h6>
                                        <div class="icon">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="pop-img">
                                    <div class="img-pop">
                                        <img src="../assets/image/product/p-4.png" alt="">
                                    </div>
                                    <div class="pop-text">
                                        <h5>Dryfruit Tacos</h5>
                                        <h6>Rs. 220</h6>
                                        <div class="icon">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="pop-img">
                                    <div class="img-pop">
                                        <img src="../assets/image/product/p-3.png" alt="">
                                    </div>
                                    <div class="pop-text">
                                        <h5>Chocolate Barfi</h5>
                                        <h6>Rs. 220</h6>
                                        <div class="icon">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                </div> --}}
                                </div>
                                <div class="off-img">
                                    <img src="../assets/image/product/2 57.png" alt="">
                                </div>
                            </div>
                        </div>








                    </div>
                </div>

            </div>

            </div>
        </section>
        <!-- order seaction end -->
    </main>




    </section>
    <!-- order seaction end -->
    </main>

@endsection
@section('script')
    <script>
        var swiper = new Swiper('.mySwiper-5', {
            slidesPerView: 3,
            spaceBetween: 3,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            speed: 1000,
            breakpoints: {
                300: {
                    slidesPerView: 2,
                    spaceBetween: 0
                },
                576: {
                    slidesPerView: 3,
                    spaceBetween: 0
                },
                768: {
                    slidesPerView: 5,
                    spaceBetween: 5
                },
                992: {
                    slidesPerView: 6,
                    spaceBetween: 3
                },
            }
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.add-to-cart-link');

            links.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default anchor click behavior
                    this.closest('form').submit(); // Find the closest form and submit it
                });
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
        ScrollReveal().reveal('.product-bg h1', {
            origin: 'top'
        });
        ScrollReveal().reveal('.pr-order h1', {
            origin: 'top'
        });
        ScrollReveal().reveal('.pr-order p', {
            origin: 'bottom'
        });
    </script>

@endsection
