@extends('front-pages.layout.layout')
@section('title', 'Blog Details')
@section('footer_class', 'margin_top80')


@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/blog.css') }}">

    <main>
        <!-- blog-bg seaction start -->
        <section>
            <div class="blog-bg">
                <div class="container">
                    <h1 class="mogra-regular">BLOGS</h1>
                </div>
            </div>
        </section>
        <!-- blog-bg seaction end -->

        <!-- blog seaction start -->
        <section>
            <div class="blog-page margin_top80">
                <div class="container">
                    <h1 class="outfit">Blogs & News</h1>
                    <div class="row padding_top50">
                        @foreach ($blog as $item)
                            <div class="col-lg-4 mb-4">
                                <div class="card ">
                                    {{-- <img src="{{ asset('/assets/image/blog/b1.png') }}" class="card-img-top" alt="..." width="411px" height="297px"> --}}
                                    @if ($item->image && file_exists(public_path($item->image)))
                                        <img src="{{ asset($item->image) }}" class="card-img-top" alt="..."
                                            width="411px" height="297px">
                                    @else
                                        <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                            class="card-img-top" alt="..." width="411px" height="297px">
                                    @endif
                                    <div class="card-body">
                                        <h5>{{ $item->title }}</h5>
                                        <p>{{ $item->message }}</p>
                                        <a href="{{ route('blog-details.view', $item->id) }}">READ MORE</a>
                                    </div>
                                    <hr>
                                    <div class="date">
                                        <h6> {{ \Carbon\Carbon::parse($item->created_at)->format('d M, Y') }}</h6>

                                        {{-- <h6>22 Jan 2024</h6> --}}
                                        {{-- <h6>0 comment</h6> --}}
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-4">
                            <div class="card">
                                <img src="{{ asset('/assets/image/blog/b2.png') }}" class="card-img-top" alt="..." width="411px" height="297px">
                                <div class="card-body">
                                  <h5 >Authentic Taste & Finest Ingredients</h5>
                                  <p>Our friendly and knowledgeable staff will be more than happy to assist you and guide you...</p>
                                  <a href="blog-detail.html">READ MORE</a>
                                </div>
                                <hr>
                                <div class="date">
                                    <h6>22 Jan 2024</h6>
                                    <h6>0 comment</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <img src="{{ asset('/assets/image/blog/b3.png') }}" class="card-img-top" alt="..." width="411px" height="297px">
                                <div class="card-body">
                                  <h5 >Authentic Taste & Finest Ingredients</h5>
                                  <p>Our friendly and knowledgeable staff will be more than happy to assist you and guide you...</p>
                                  <a href="#">READ MORE</a>
                                </div>
                                <hr>
                                <div class="date">
                                    <h6>22 Jan 2024</h6>
                                    <h6>0 comment</h6>
                                </div>
                            </div>
                        </div> --}}
                        @endforeach
                    </div>

                    {{-- <div class="row padding_top50">
                        <div class="col-lg-4">
                            <div class="card">
                                <img src="{{ asset('/assets/image/blog/b4.png') }}" class="card-img-top" alt="..." width="411px" height="297px">
                                <div class="card-body">
                                  <h5 >Authentic Taste & Finest Ingredients</h5>
                                  <p>Our friendly and knowledgeable staff will be more than happy to assist you and guide you...</p>
                                  <a href="blog-detail.html">READ MORE</a>
                                </div>
                                <hr>
                                <div class="date">
                                    <h6>22 Jan 2024</h6>
                                    <h6>0 comment</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <img src="{{ asset('/assets/image/blog/b5.png') }}" class="card-img-top" alt="..." width="411px" height="297px">
                                <div class="card-body">
                                  <h5 >Authentic Taste & Finest Ingredients</h5>
                                  <p>Our friendly and knowledgeable staff will be more than happy to assist you and guide you...</p>
                                  <a href="blog-detail.html">READ MORE</a>
                                </div>
                                <hr>
                                <div class="date">
                                    <h6>22 Jan 2024</h6>
                                    <h6>0 comment</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <img src="{{ asset('/assets/image/blog/b6.png') }}" class="card-img-top" alt="..." width="411px" height="297px">
                                <div class="card-body">
                                  <h5 >Authentic Taste & Finest Ingredients</h5>
                                  <p>Our friendly and knowledgeable staff will be more than happy to assist you and guide you...</p>
                                  <a href="blog-detail.html">READ MORE</a>
                                </div>
                                <hr>
                                <div class="date">
                                    <h6>22 Jan 2024</h6>
                                    <h6>0 comment</h6>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
        <!-- blog seaction end -->

        <!-- letest blog seaction start -->
        {{-- <div class="blog margin_top80 margin_bottom50">
            <div class="container">
                <h2>Latest Blogs</h2>
                <div class="row padding_top50">
                    <div class="col-lg-6">
                        <div class="card">
                            <img src="{{ asset('/assets/image/blog/b7.png') }}" alt="">
                            <div class="card-body blog-text">
                                <h4>Authentic Taste & Finest Ingredients</h4>
                                <div class="date d-flex">
                                    <h6>22 Jan 2024</h6>
                                    <h6>0 comment</h6>
                                </div>
                                <p>Providing Quality, Traditional and Authentic taste of all the Indian Sweets.  At the same time, Innovating new products for the young generation....</p>
                                <a href=""><h5>READ MORE  <i class="fa-solid fa-arrow-right"></i></h5></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="small-blog margin_top20">
                            <div class="img"> 
                                <img src="{{ asset('/assets/image/blog/b8.png') }}" alt="" width="160px" height="160px">
                            </div>
                            <div class="text">
                                <h4>Authentic Taste & Finest Ingredients</h4>
                                <p>Providing Quality, Traditional and Authentic taste of all the Indian Sweets.  At the same time, Innovating new products for the young generation....</p>
                                <a href=""><h6>READ MORE  <i class="fa-solid fa-arrow-right"></i></h6></a>
                            </div>
                        </div>
                        <div class="small-blog margin_top50">
                            <div class="img">
                                <img src="{{ asset('/assets/image/blog/b9.png') }}" alt=""  width="160px" height="160px">
                            </div>
                            <div class="text">
                                <h4>Authentic Taste & Finest Ingredients</h4>
                                <p>Providing Quality, Traditional and Authentic taste of all the Indian Sweets.  At the same time, Innovating new products for the young generation....</p>
                                <a href=""><h6>READ MORE  <i class="fa-solid fa-arrow-right"></i></h6></a>
                            </div>
                        </div>
                        <div class="small-blog margin_top50">
                            <div class="img">
                                <img src="{{ asset('/assets/image/blog/b10.png') }}" alt=""  width="160px" height="160px">
                            </div>
                            <div class="text">
                                <h4>Authentic Taste & Finest Ingredients</h4>
                                <p>Providing Quality, Traditional and Authentic taste of all the Indian Sweets.  At the same time, Innovating new products for the young generation....</p>
                                <a href=""><h6>READ MORE  <i class="fa-solid fa-arrow-right"></i></h6></a>
                            </div>
                        </div>
                        
                    </div>
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
                                            <h6>22 Jan 2024</h6>
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
                                                <a href="{{ route('blog-details.view', $item->id) }}">
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


        <!-- letest blog seaction end -->

    </main>
@endsection

@section('script')

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
        ScrollReveal().reveal('.blog-bg h1', {
            origin: 'top'
        });
        ScrollReveal().reveal('.blog-page h2', {
            origin: 'top'
        });
    </script>
@endsection
