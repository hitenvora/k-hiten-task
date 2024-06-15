@extends('front-pages.layout.layout')
@section('title', 'Blog Details')
@section('footer_class', 'margin_top80')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">

    <main>
        <!-- blog-bg seaction start -->
        <section>
            <div class="blog-bg">
                <div class="container">
                    <h1 class="mogra-regular">BLOGS DETAILS</h1>
                </div>
            </div>
        </section>
        <!-- blog-bg seaction end -->

        <!-- blog-details seaction start -->
        <section>
            <div class="blog-detail margin_top80">
                <div class="container">

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="big-blog">
                                {{-- <img src="{{ asset('assets/image/blog/bd1.png') }}" alt="" > --}}
                                @if ($blog->image && file_exists(public_path($blog->image)))
                                    <img src="{{ asset($blog->image) }}" class="card-img-top" alt="..." width="411px"
                                        height="297px">
                                @else
                                    <img src="{{ asset('assets/image/product_null_image/photo.png') }}" class="card-img-top"
                                        alt="..." width="411px" height="297px">
                                @endif
                                <div class="date d-flex margin_top20">
                                    <h5>{{ \Carbon\Carbon::parse($blog->created_at)->format('d M, Y') }}</h5>
                                    {{-- <h5>0 comment</h5> --}}
                                </div>
                                <p>{{ $blog->message }}</p>
                                {{-- <p>
                                    Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate
                                    eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam
                                    dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.</p> --}}
                                {{-- <div class="bd-img">
                                    <img src="{{ asset('assets/image/blog/bd2.png') }}" alt="" width="244px"
                                        height="223px">
                                    <p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec,
                                        vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae,
                                        justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.</p>
                                </div> --}}
                                {{-- <p class="margin_top20">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean
                                    commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis
                                    parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque
                                    eu, pretium quis, sem.
                                </p> --}}
                                <h3>Leave a Reply</h3>
                                <p>Your email address will not be published. Required fields are marked *</p>
                                <form action="{{ route('blogLeavereplayMailSending') }}" method="post"
                                    id="leave_reply_form">
                                    @csrf
                                    <input class="form-control form-control-lg margin_top20" type="text"
                                        placeholder="Name*" aria-label=".form-control-lg example" name="name">
                                    <input class="form-control form-control-lg margin_top20" type="text"
                                        placeholder="Email*" aria-label=".form-control-lg example" name="email">
                                    <textarea class="form-control form-control-lg margin_top20" name="comment" placeholder="Comment*" rows="3"></textarea>
                                    <div class="post margin_top20">
                                        <button type="submit">Post a Comment </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="newslatter">
                                <div class="search">
                                    <input class="form-control form-control-lg margin_top20" type="text"
                                        placeholder="Search..." aria-label=".form-control-lg example">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                                <div class="box margin_top30">
                                    <h3>Newsletter</h3>
                                    <p>Sign up our newsletter to get update information, news and free insight</p>
                                    <div class="from">
                                        <form action="" method="post" id="newsletter_form">
                                            @csrf
                                            <input class="form-control form-control-lg margin_top20" type="text"
                                                placeholder="Name" aria-label=".form-control-lg example" name="name">
                                            <input class="form-control form-control-lg margin_top20" type="email"
                                                placeholder="Email" aria-label=".form-control-lg example" name="email">
                                            <div class="sin">
                                                <a onclick="event.preventDefault(); this.closest('form').submit();"><i
                                                        class="fa-regular fa-envelope"></i> SIGN UP</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="latest margin_top50">
                                    <h3>Latest Blogs</h3>
                                    @foreach ($blog_latest as $item)
                                        <div class="latest-img d-flex margin_top30">
                                            <div class="img-bl">
                                                {{-- <img src="{{ asset('assets/image/blog/bd3.png') }}" alt=""
                                                    width="110px" height="110px"> --}}
                                                @if ($item->image && file_exists(public_path($item->image)))
                                                    <img src="{{ asset($item->image) }}" class="card-img-top" alt="..."
                                                        width="110px" height="110px">
                                                @else
                                                    <img src="{{ asset('assets/image/product_null_image/photo.png') }}"
                                                        class="card-img-top" alt="..." width="110px" height="110px">
                                                @endif
                                            </div>
                                            <div class="text-bl">
                                                <h6>{{ $item->title }}</h6>
                                                {{-- {{ dd($item->title) }} --}}
                                                <p>{{ \Carbon\Carbon::parse($item->created_at)->format('d M, Y') }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{-- <div class="latest-img d-flex margin_top30">
                                        <div class="img-bl">
                                            <img src="{{ asset('assets/image/blog/bd4.png') }}" alt=""
                                                width="110px" height="110px">
                                        </div>
                                        <div class="text-bl">
                                            <h6>Authentic Taste & Finest Ingredients</h6>
                                            <p>22 Jan 2024</p>
                                        </div>
                                    </div>
                                    <div class="latest-img d-flex margin_top30">
                                        <div class="img-bl">
                                            <img src="{{ asset('assets/image/blog/bd5.png') }}" alt=""
                                                width="110px" height="110px">
                                        </div>
                                        <div class="text-bl">
                                            <h6>Authentic Taste & Finest Ingredients</h6>
                                            <p>22 Jan 2024</p>
                                        </div>
                                    </div>
                                    <div class="latest-img d-flex margin_top30">
                                        <div class="img-bl">
                                            <img src="{{ asset('assets/image/blog/bd3.png') }}" alt=""
                                                width="110px" height="110px">
                                        </div>
                                        <div class="text-bl">
                                            <h6>Authentic Taste & Finest Ingredients</h6>
                                            <p>22 Jan 2024</p>
                                        </div>
                                    </div>
                                    <div class="latest-img d-flex margin_top30">
                                        <div class="img-bl">
                                            <img src="{{ asset('assets/image/blog/bd4.png') }}" alt=""
                                                width="110px" height="110px">
                                        </div>
                                        <div class="text-bl">
                                            <h6>Authentic Taste & Finest Ingredients</h6>
                                            <p>22 Jan 2024</p>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog-details seaction end -->
    </main>
@endsection

@section('script')
    <script>
        $("#leave_reply_form").validate({
            ignore: ':hidden:not(:radio)',
            errorElement: 'label',
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            rules: {
                name: {
                    required: true,

                },
                email: {
                    required: true,

                },
                comment: {
                    required: true,

                },


            },
            messages: {
                name: {
                    required: "Please Enter Name"

                },
                email: {
                    required: "Please Enter Email"

                },
                comment: {
                    required: "Please Enter Comment"
                },

            }
        });
    </script>
@endsection
