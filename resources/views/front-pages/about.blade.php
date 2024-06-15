@extends('front-pages.layout.layout')
@section('title', 'About')
@section('footer_class', 'margin_top80')


@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/about.css') }}">

    <!-- bg seaction start -->
    <div class="about-bg">
        <div class="container">
            <h1 class="mogra-regular">ABOUT US</h1>
        </div>
    </div>
    <!-- bg seaction end -->

    <main>
        <!-- about seaction start -->
        <section>
            <div class="about margin_top80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="image-wrapper shine">
                                <img class="ab-img" src="{{ asset('/assets/image/about/kaju katli 1.png') }}"
                                    alt="">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="about-text">
                                <h1 class="outfit">About Kanaiya Dairy & Sweets</h1>
                                <h3 class="outfit">Authentic Taste & Finest Ingredients</h3>
                                <div class="text-img">
                                    <div class="text">
                                        <h4>Providing Quality, Traditional and Authentic taste of all the Indian Sweets. At
                                            the same time, Innovating new products for the young generation.Your
                                            satisfaction is our top priority.Our friendly and knowledgeable staff .</h4>
                                    </div>
                                    <div class="hover15">
                                        <div class="ab-text-img">
                                            <img src="{{ asset('/assets/image/about/rajwadipenda 1.png') }}"
                                                alt="Image Description">
                                        </div>
                                    </div>

                                </div>
                                <p>Your satisfaction is our top priority. Our friendly and knowledgeable staff will be more
                                    than happy to assist you and guide you through our extensive range of sweets. Celebrate
                                    the joy of togetherness with sweetness that lingers on your plate and in your heart!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about seaction end -->

        <!-- our speciality start -->
        <div class="our margin_top100">
            <div class="container">
                <div class="spe-ab">
                    {{-- <img src="{{ asset('/assets/image/about/Group 8369.png') }}" alt=""> --}}
                    <h1>Our Speciality</h1>
                </div>
                <div class="row">
                    <div class="col-lg-4 padding_top50">
                        <div class="spcial">
                            <img src="{{ asset('/assets/image/about/milk 1.png') }}" alt="Shining Image">
                            <p>Our sweets and savouries honour the classic ingredients and homegrown Indian dessert. We
                                bring India's vibrant and loved traditional flavours from farm to festivities.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 padding_top50">
                        <div class="spcial">
                            <img src="{{ asset('/assets/image/about/fresh (1).png') }}" alt="">
                            <p>Our sweets and savouries honour the classic ingredients and homegrown Indian dessert recipes.
                                We bring India's vibrant and loved traditional flavours from farm to festivities.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 padding_top50">
                        <div class="spcial">
                            <img src="{{ asset('/assets/image/about/ladoo.png') }}" alt="">
                            <p>Our sweets and savouries honour the classic ingredients and homegrown Indian dessert recipes.
                                We bring India's vibrant and loved traditional flavours from farm to festivities.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- our speciality end -->

        <!-- offer seaction start -->
        <section>
            <div class="offer margin_top100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="image-wrapper shine">
                                <img class="motichoor"
                                    src="{{ asset('/assets/image/about/motichoor_ladoo_indian_sweet_03 3.png') }}"
                                    alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="what">
                                <h1><span>WHAT</span> WE OFFER?</h1>
                                <div class="custom-hr">
                                    <hr>
                                </div>
                                <div class="custom-hr2">
                                    <hr>
                                </div>
                                <p>Providing Quality, Traditional and Authentic taste of all the Indian Sweets. At the same
                                    time, Innovating new products for the young generation.</p>
                                <div class="right margin_top30">
                                    <div class="right-img">
                                        <img src="{{ asset('/assets/image/about/right.png') }}" alt="">
                                    </div>
                                    <div class="right-text">
                                        <h4>More than <span>30 years of experience</span></h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="right margin_top30">
                                    <div class="right-img">
                                        <img src="{{ asset('/assets/image/about/right.png') }}" alt="">
                                    </div>
                                    <div class="right-text">
                                        <h4>Short arrival time of <span>30 minutes or less</span></h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="right margin_top30">
                                    <div class="right-img">
                                        <img src="{{ asset('/assets/image/about/right.png') }}" alt="">
                                    </div>
                                    <div class="right-text">
                                        <h4>Honest competitive prices - <span>zero hidden fees</span></h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="right margin_top30">
                                    <div class="right-img">
                                        <img src="{{ asset('/assets/image/about/right.png') }}" alt="">
                                    </div>
                                    <div class="right-text">
                                        <h4>Friendly and <span>professional service</span></h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="right margin_top30">
                                    <div class="right-img">
                                        <img src="{{ asset('/assets/image/about/right.png') }}" alt="">
                                    </div>
                                    <div class="right-text">
                                        <h4>Friendly and <span>professional service</span></h4>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
        <!-- offer seaction end -->

        <!-- founder seaction start -->
        <section>
            <div class="founder margin_top100">
                <div class="container">
                    <h1>Founders</h1>
                    <h4>Simple, wholesome and traditional first, India Sweet House inherits its discernable personality from
                        its founding partners, Shwetha, Vishwanath and Rajesh.
                    </h4>
                    <div class="row">
                        @foreach ($founder_profile as $item)
                            <div class="col-lg-6 padding_top20">
                                {{-- <img class="found-img"
                                    src="{{ asset('/assets/image/about/businessman-with-crossed-arms 3.png') }}"
                                    alt=""> --}}
                                @if ($item->image && file_exists(public_path($item->image)))
                                    <img src="{{ asset($item->image) }}" class="card-img-top" alt="...">
                                @else
                                    <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                        class="card-img-top" alt="..."width="223px" height="223px">
                                @endif
                                <div class="box">
                                    <h2>{{ $item->name }}</h2>
                                    <h5>{{ $item->position }}</h5>
                                    <div class="icon">
                                        <a href="{{ $item->linkdin_link }}" target="_blank"> <i
                                                class="fa-brands fa-linkedin"></i></a>
                                        <a href="{{ $item->facebook_link }}" target="_blank"> <i
                                                class="fa-brands fa-facebook"></i></a>
                                        <a href="{{ $item->instagram_link }}" target="_blank"><i
                                                class="fa-brands fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- <div class="col-lg-6 padding_top20">
                            <img class="found-img"
                                src="{{ asset('/assets/image/about/businessman-with-crossed-arms 3.png') }}"
                                alt="">
                            <div class="box">
                                <h2>Mr. Jack Walter</h2>
                                <h5>Chief Executive Officer</h5>
                                <div class="icon">
                                    <i class="fa-brands fa-linkedin"></i>
                                    <i class="fa-brands fa-facebook"></i>
                                    <i class="fa-brands fa-instagram"></i>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
        <!-- founder seaction end -->

        <!-- client seaction start -->
        <section>
            <div class="client margin_top100">
                <div class="container">
                    <h1>What our Clients Say</h1>
                    <p>Providing Quality, Traditional and Authentic taste of all the Indian Sweets. At the same time,
                        Innovating new products for the young generation.</p>

                    <div class="swiper mySwiper-2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="box margin_top100">
                                    <div class="image-container">
                                        <img class="client-img" src="{{ asset('/assets/image/about/client1.png') }}"
                                            alt="">
                                    </div>
                                    <h3>Jackie Walter</h3>
                                    <h5>Guest</h5>
                                    <img src="{{ asset('/assets/image/about/Group 8372.png') }}" alt="">
                                    <p class="testimonial-text">A wonderful experience. Amazing property with great
                                        facilities and exceptional staff. Special thanks to Mr Sanjoy at the front desk & Mr
                                        Ajay Dwivedi at the Pavilion Restaurant for making the trip memorable.</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="box margin_top100">
                                    <div class="image-container">
                                        <img class="client-img" src="{{ asset('/assets/image/about/client2.png') }}"
                                            alt="">
                                    </div>
                                    <h3>Jackie Walter</h3>
                                    <h5>Guest</h5>
                                    <img src="{{ asset('/assets/image/about/Group 8372.png') }}" alt="">
                                    <p class="testimonial-text">A wonderful experience. Amazing property with great
                                        facilities and exceptional staff. Special thanks to Mr Sanjoy at the front desk & Mr
                                        Ajay Dwivedi at the Pavilion Restaurant for making the trip memorable.</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="box margin_top100">
                                    <div class="image-container">
                                        <img class="client-img" src="{{ asset('/assets/image/about/client3.png') }}"
                                            alt="">
                                    </div>
                                    <h3>Jackie Walter</h3>
                                    <h5>Guest</h5>
                                    <img src="{{ asset('/assets/image/about/Group 8372.png') }}" alt="">
                                    <p class="testimonial-text">A wonderful experience. Amazing property with great
                                        facilities and exceptional staff. Special thanks to Mr Sanjoy at the front desk & Mr
                                        Ajay Dwivedi at the Pavilion Restaurant for making the trip memorable.</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="box margin_top100">
                                    <div class="image-container">
                                        <img class="client-img" src="{{ asset('/assets/image/about/client2.png') }}"
                                            alt="">
                                    </div>
                                    <h3>Jackie Walter</h3>
                                    <h5>Guest</h5>
                                    <img src="{{ asset('/assets/image/about/Group 8372.png') }}" alt="">
                                    <p class="testimonial-text">A wonderful experience. Amazing property with great
                                        facilities and exceptional staff. Special thanks to Mr Sanjoy at the front desk & Mr
                                        Ajay Dwivedi at the Pavilion Restaurant for making the trip memorable.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- client seaction end -->

    </main>

    {{-- testimonial text  --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var cardTextElements = document.querySelectorAll('.testimonial-text');
            cardTextElements.forEach(function(element) {
                var originalText = element.textContent.trim();
                if (originalText.length > 150) {
                    var truncatedText = originalText.substring(0, 150) + '...';
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
        ScrollReveal().reveal('.about-bg h1', {
            origin: 'top'
        });
        ScrollReveal().reveal('.about h1', {
            origin: 'top'
        });
        ScrollReveal().reveal('.our .spcial', {
            origin: 'top'
        });
        ScrollReveal().reveal('.founder h1', {
            origin: 'top'
        });
        ScrollReveal().reveal('.client h1', {
            origin: 'top'
        });
        ScrollReveal().reveal('.offer h1', {
            origin: 'top'
        });
    </script>
@endsection



@section('script')
@endsection
