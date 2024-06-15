<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('/assets/image/kanaiya fevicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/shortcut.css') }}">



    <!-- Swiper css  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--  font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Mogara font famaily  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Mogra&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <style>
        .toast-error {
            background-color: red;
            /* Red color for error */
        }

        .toast-success {
            background-color: green;
            /* Red color for error */
        }

        .is-invalid {
            color: red;
        }

        .dropdown-container {
            position: relative;
            display: inline-block;
        }


        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            /* Position the menu below the image */
            left: 0;
            background-color: white;
            /* box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); */
            z-index: 1;
        }

        .dropdown-item {
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            color: black;
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
        }

        /* Show the dropdown menu on hover */
        .dropdown-container:hover .dropdown-menu {
            display: block;
        }

        .kaniya-header .dropdown-container {
            position: relative;
            display: inline-block;
        }

        .kaniya-header .dropdown-menu {
            /* padding: 10px; */
            display: none;
            position: absolute;
            z-index: 1;
            width: 300px !important;
        }

        .kaniya-header .dropdown-menu .box .header-img {
            display: flex;
            gap: 10px;
        }

        .kaniya-header .dropdown-menu .box {
            padding: 10px;
            /* box-shadow: 0px 2px 14px 0px #00000040; */
        }

        .kaniya-header .dropdown-menu .box .img-use img {
            object-fit: contain;
        }

        .kaniya-header .dropdown-menu .box .header-img h5 {
            margin-top: 10px;
            font-weight: 600;
            margin-left: 20px
        }

        .kaniya-header .dropdown-menu .box .header-img h6 {
            font-weight: 500;
            margin-left: 20px
        }

        .kaniya-header .dropdown-container:hover .dropdown-menu {
            display: block;
            width: 100px;
        }

        .kaniya-header .dropdown-menu .dropdown-item img,
        i {
            margin-right: 10px;
            vertical-align: middle;
        }

        .kaniya-header .dropdown-menu .dropdown-item {
            padding: 0px 15px;
            font-weight: 400;
            gap: 10px;
        }

        .kaniya-header .dropdown-menu hr {
            margin: 10px;
        }
    </style>
</head>

<body>
    <div class="tel">
        <div class="tel-text">
            <div class="add">

                <i class="fa-solid fa-location-dot"></i> G/16,Laksh Plaza Chhaprabhatha Rd, Amroli Surat-394107
                <a href="tel:+91 99786 46421" class="text-decoration-none">
                    <i class="fa-solid fa-phone phone-icon"></i> +91 99786 46421
                </a>
                {{-- <i class="fa-solid fa-phone phone-icon"></i> +92 31304754657 --}}
            </div>
        </div>
        <div class="tel-icon">
            <i class="fa-brands fa-youtube"></i>
            <i class="fa-brands fa-instagram inst-icon"></i>
            <i class="fa-brands fa-facebook face-icon"></i>
        </div>
    </div>


    <header>
        <div class="kaniya-header">
            <div class="header">
                <nav class="navbar navbar-expand-lg">
                    <div class="container">
                        <div class="logo">
                            <a class="navbar-brand" href="/">
                                <img src="{{ asset('/assets/image/home/main-logo.png') }}" alt="logo"
                                    class="img-fluid" height="77px" width="223px">
                            </a>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-center" id="navbarTogglerDemo02">
                            <ul class="navbar-nav mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('index.view') ? 'active' : '' }}"
                                        href="{{ route('index.view') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  {{ request()->routeIs('about.view') ? 'active' : '' }}"
                                        href="{{ route('about.view') }}">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('product.view') ? 'active' : '' }}"
                                        href="{{ route('product.view') }}">Products</a>
                                </li>
                                @if (Auth::user() != null)
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('order.view') ? 'active' : '' }}"
                                            href="{{ route('order.view') }}">Order</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('contact.view') ? 'active' : '' }}"
                                        href="{{ route('contact.view') }}">Contact</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('blog.view') ? 'active' : '' }}"
                                        href="{{ route('blog.view') }}">Blog</a>
                                </li>
                            </ul>

                            {{-- mobile view --}}
                            <div class="header-icons-2 d-flex align-items-center">
                                @if (Auth::user() != null)
                                    <a href="{{ Route('profile.view') }}" class="text-decoration-none">
                                        <img src="{{ asset('/assets/image/home/user.svg') }}" alt="user"
                                            class="img-fluid">
                                    </a>

                                    <div class="cart-header">
                                        <a href="#" class="text-decoration-none"><img
                                                src="{{ asset('/assets/image/home/cart.png') }}" alt="cart"
                                                class="img-fluid">
                                            <div class="round">0</div>

                                        </a>
                                    </div>
                                @else
                                    <a href="#" class="text-decoration-none">
                                        <img src="{{ asset('/assets/image/home/user.svg') }}" alt="user"
                                            class="img-fluid" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    </a>
                                    <div class="cart-header">
                                        <a href="#" class="text-decoration-none"><img
                                                src="{{ asset('/assets/image/home/cart.png') }}" alt="user"
                                                class="img-fluid">
                                            <div class="round">0</div>

                                        </a>
                                    </div>
                                @endif

                            </div>

                        </div>
                        {{-- big screnn view --}}
                        <div class="icon-header">

                            @if (Auth::user() != null && Auth::user()->id != '')
                                <div class="header-icons d-flex align-items-center">
                                    <div class="dropdown-container">
                                        <a href="#" class="text-decoration-none">
                                            <img src="{{ asset('/assets/image/home/user.svg') }}" alt="user"
                                                class="img-fluid">
                                        </a>
                                        <div class="dropdown-menu">
                                            <div class="box">
                                                <div class="header-img">
                                                    <div class="user-details">
                                                        <h5>{{ Auth::user()->name }} {{ Auth::user()->last_name }}
                                                        </h5>
                                                        <h6>{{ Auth::user()->contact_number }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="dropdown-item" href="{{ Route('profile.view') }}"><i
                                                    class="fa-regular fa-user"></i> My Profile</a>
                                            <hr>
                                            <a class="dropdown-item" href="{{ Route('order.view') }}"><i
                                                    class="fa-solid fa-bag-shopping"></i> My Orders</a>
                                            <hr>
                                            <a class="dropdown-item" href="{{ Route('profile_address.view', 0) }}"><i
                                                    class="fa-solid fa-location-dot"></i> Manage Address</a>
                                            <hr>
                                            <a class="dropdown-item" href="{{ Route('order.view') }}"><img
                                                    src="{{ asset('/assets/image/home/Vector.png') }} "alt=""> Terms
                                                &
                                                Conditions</a>
                                            <hr>

                                            <a class="dropdown-item" href="{{ Route('privacyPolicy.view') }}"><img
                                                    src="{{ asset('/assets/image/home/Vector (1).png') }}"
                                                    alt=""> Privacy Policy</a>
                                            <hr>
                                            <a class="dropdown-item" href="{{ Route('order.view') }}"><img
                                                    src="{{ asset('/assets/image/home/Vector (2).png') }}"
                                                    alt=""> Refund and
                                                Cancellation Policy</a>
                                            <hr>
                                            <a class="dropdown-item" href="{{ Route('order.view') }}"><img
                                                    src="{{ asset('/assets/image/home/Vector (3).png') }}"
                                                    alt=""> Return
                                                Policy</a>
                                            <hr>
                                            <a class="dropdown-item" href="{{ Route('faq.view') }}"><img
                                                    src="{{ asset('/assets/image/home/Vector (4).png') }}"
                                                    alt=""> FAQ's </a>
                                            <hr>
                                            <a class="dropdown-item" href="{{ Route('contact.view') }}"><img
                                                    src="{{ asset('/assets/image/home/Vector (5).png') }}"
                                                    alt=""> Contact Us
                                            </a>
                                            <hr>
                                            <a class="dropdown-item" href="{{ Route('logout') }}"><img
                                                    src="{{ asset('/assets/image/home/Vector (6).png') }}"
                                                    alt=""> Logout </a>
                                            <hr>
                                        </div>
                                    </div>
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
                                    <div class="cart-header">
                                        <a href="{{ route('delivery.view') }}" class="text-decoration-none"><img
                                                src="{{ asset('/assets/image/home/cart.png') }}" alt="user"
                                                class="img-fluid">
                                            <div class="round">{{ $cart_product_count ?? '0' }}</div>

                                        </a>
                                    </div>
                                    {{-- <a href="#" class="text-decoration-none"><img
                                            src="{{ asset('/assets/image/home/cart.svg') }}" alt="user" class="img-fluid">
                                    </a> --}}
                                    {{-- <a href="{{ Route('logout') }}" class="text-decoration-none">
                                        <img src="{{ asset('/assets/image/home/logout.png') }}" alt="logout"
                                            class="img-fluid">
                                    </a> --}}
                                </div>
                            @else
                                <div class="header-icons d-flex align-items-center">
                                    <a href="#" class="text-decoration-none">
                                        <img src="{{ asset('/assets/image/home/user.svg') }}" alt="user"
                                            class="img-fluid" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    </a>
                                    <div class="cart-header">
                                        {{-- <a href="#" class="text-decoration-none"><img
                                                    src="{{ asset('/assets/image/home/cart.png') }}" alt="user"
                                                    class="img-fluid">
                                                <div class="round">0</div>
                                            </a> --}}

                                        <a href="#" class="text-decoration-none">
                                            <img src="{{ asset('/assets/image/home/cart.png') }}" alt="user"
                                                class="img-fluid" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
            </div>

            </nav>
        </div>
        </div>
    </header>

    <!-- new account Modal -->
    <form action="{{ route('registerUser') }}" method="POST" enctype="multipart/form-data" id="registrationForm">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="modal-left">
                                    <img src="{{ asset('/assets/image/login/image 38.png') }}" alt="Login Image">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="modal-right">
                                    <div class="modal-logo">
                                        <img src="{{ asset('/assets/image/home/logo.png') }}" alt="Logo">
                                    </div>
                                    <h2 class="outfit">Don't Have an Account?</h2>
                                    <p class="outfit">For the purpose of industry registration, your details are
                                        required
                                        and will be stored.</p>

                                    <div class="form-group">
                                        <label class="outfit" for="nameInput">Name</label>
                                        <input type="text" class="form-control" id="nameInput"
                                            aria-describedby="nameHelp" name="nameInput">
                                        <span class="text-danger">
                                            @error('nameInput')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="outfit" for="mobileInput">Mobile Number</label>
                                                <input type="text" class="form-control" id="mobileInput"
                                                    aria-describedby="mobileHelp" name="mobileInput">
                                                <span class="text-danger">
                                                    @error('mobileInput')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="outfit" for="emailInput">Email</label>
                                                <input type="email" class="form-control" id="emailInput"
                                                    aria-describedby="emailHelp" name="emailInput">
                                                <span class="text-danger">
                                                    @error('emailInput')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="outfit" for="passwordInput">Password</label>
                                                <input type="password" class="form-control" id="passwordInput"
                                                    aria-describedby="passwordHelp" name="passwordInput">
                                                <span class="text-danger">
                                                    @error('passwordInput')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="outfit" for="repeatPasswordInput">Repeat
                                                    Password</label>
                                                <input type="password" class="form-control" id="repeatPasswordInput"
                                                    aria-describedby="repeatPasswordHelp" name="repeatPasswordInput">
                                                <span class="text-danger">
                                                    @error('repeatPasswordInput')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="regist">
                                        <button class="btn btn-primary">Register</button>
                                    </div>
                                    <hr>
                                    {{-- <form action="{{ route('callback.google') }}" method="post"> --}}
                                    {{-- @csrf --}}
                                    <div class="login-google">

                                        <a href="{{ route('auth.google.view') }}"><img
                                                src="{{ asset('/assets/image/login/Group 8393.png') }}"
                                                alt="Google Login"> Login with Google</a>
                                    </div>
                                    {{-- </form> --}}
                                    <h6 class="outfit padding_top30">Already have an Account? <a href="#"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal2">Log in</a></h6>
                                </div>
                            </div>
    </form>
    </div>


    </div>
    </div>
    </div>
    </div>


    <!-- login Modal -->
    <form action="{{ route('loginUser') }}" method="POST" enctype="multipart/form-data" id="loginform">
        @csrf

        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="modal-left">
                                    <img src="{{ asset('/assets/image/login/image 37.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="modal-right">
                                    <div class="modal-logo">
                                        <img src="{{ asset('/assets/image/home/logo.png') }}" alt="">
                                    </div>
                                    <h2 class="outfit ">Login with Individual Account!</h2>
                                    <p class="outfit ">For the purpose of industry registration, your details are
                                        required
                                        and will be stored.</p>


                                    <div class="form-group">
                                        <label class="outfit" for="loginemail">Email</label>
                                        <input type="email" class="form-control" name="loginemail" id="loginemail"
                                            aria-describedby="emailHelp" required>
                                        <span class="text-danger">
                                            @error('loginemail')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label class="outfit" for="loginPassword">Password</label>
                                        <input type="password" class="form-control" name="loginPassword"
                                            id="loginPassword" aria-describedby="emailHelp">
                                    </div>
                                    <span class="text-danger">
                                        @error('loginPassword')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="fogat">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                <h6>Remember Me</h6>
                                            </label>
                                        </div>

                                        <a href="">Forgot Password</a>
                                    </div>


                                    <div class="regist">
                                        <button>Login</button>
                                    </div>
                                    <hr>
                                    <div class="login-google">
                                        <a href="{{ route('login.google') }}"><img
                                                src="{{ asset('/assets/image/login/Group 8393.png') }}"
                                                alt="">
                                            Login with Google</a>
                                    </div>
                                    <h6 class="outfit padding_top30">Already have an Account?<a href=""
                                            data-bs-toggle="modal" data-bs-target="#exampleModal"> Create
                                            Account</a></h6>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>


    @yield('content')

    <!-- footer seaction start -->
    <footer class="@yield('footer_class')">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 ">
                    <div class="footer-content">
                        <img src="{{ asset('/assets/image/home/main-logo.png') }}" alt="footer-logo" height="77px"
                            width="223px">
                        <p>Established in the year 1989, Kanaiya Dairyfarm & Sweets is in <br> Varaccha Road, and we
                            are
                            the top players in the matter of dairy <br> products. It is the best sweets shop in
                            surat
                            Since 1989 Traditional <br> taste of Gujarat.</p>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-4">
                    <div class="footer-links">
                        <h3>Website Links</h3>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('index.view') }}" class="text-decoration-none">Home</a></li>
                            <li><a href="{{ route('about.view') }}" class="text-decoration-none">About</a></li>
                            <li><a href="{{ route('contact.view') }}" class="text-decoration-none">Get in touch</a>
                            </li>
                            <li><a href="{{ route('faq.view') }}" class="text-decoration-none">FAQs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-4">
                    <div class="footer-links">
                        <h3>Quick Links</h3>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-decoration-none">Privacy Policy</a></li>
                            <li><a href="#" class="text-decoration-none">Shipping Policy</a></li>
                            <li><a href="#" class="text-decoration-none">Terms & Conditions</a></li>
                            <li><a href="#" class="text-decoration-none">Return Policy</a></li>
                            <li><a href="#" class="text-decoration-none">Refund & Cancellation</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-4">
                    <div class="footer-links">
                        <h3> Newsletter</h3>
                        <p>Subscribe to our Newsletter to get recent updates.</p>
                        <div class="footer-form">
                            <form action="{{ route('footer_mail_save') }}" method="POST" id="footer_email">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" placeholder="Email Address"
                                        aria-label="Email Address" aria-describedby="email" name="email" required>
                                    <button class="btn" type="submit" id="email"><i
                                            class="fa-regular fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>
                        {{-- <ul class="list-unstyled">
                            <li><a href="#" class="text-decoration-none">Features</a></li>
                            <li><a href="#" class="text-decoration-none">Testomonials</a></li>
                            <li><a href="#" class="text-decoration-none">Google Reviews</a></li>
                        </ul> --}}
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="footer-bottom">
        <div class="container">
            <h5 class="mt-3"><img src="{{ asset('/assets/image/home/f-Vector.png') }}" alt=""> 100%
                Payment protection, Easy return policy</h5>
            <div class="row ">
                <div class="border-bottom d-flex justify-content-between align-items-center">
                    <div class="footer-form">
                        <form action="{{ route('footer_mail_save') }}" method="POST" id="footer_email">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Enter your email"
                                    aria-label="Enter your email" aria-describedby="email" id="email"
                                    name="email" required>
                                <button class="btn" type="submit">Subscribe Now</button>
                            </div>

                        </form>
                        <a href="#"><img src="{{ asset('/assets/image/home/upi.png') }}" alt=""></a>
                        <a href="#"><img src="{{ asset('/assets/image/home/gpay.png') }}" alt=""></a>
                        <a href="#"><img src="{{ asset('/assets/image/home/phonepe.png') }}"
                                alt=""></a>
                        <a href="#"><img src="{{ asset('/assets/image/home/rupay.png') }}" alt=""></a>
                        <a href="#"><img src="{{ asset('/assets/image/home/mc.png') }}" alt=""></a>
                        <a href="#"><img src="{{ asset('/assets/image/home/Mobikwik.png') }}"
                                alt=""></a>
                        <a href="#"><img src="{{ asset('/assets/image/home/visa.png') }}" alt=""></a>
                    </div>
                    <div class="footer-social-icons d-flex">
                        <a href="#"><img src="{{ asset('/assets/image/home/fecebook.svg') }}"
                                alt=""></a>
                        <a href="#"><img src="{{ asset('/assets/image/home/instagram.svg') }}"
                                alt=""></a>
                        <a href="#"><img src="{{ asset('/assets/image/home/linkdin.svg') }}"
                                alt=""></a>
                    </div>
                    <!-- <div class="footer-language">
<a href="#" class="text-decoration-none"><span>English</span></a>
<a href="#" class="text-decoration-none"><span>Arabic</span></a>
<a href="#" class="text-decoration-none"><span>French</span></a>
</div> -->
                </div>
                <!-- copy-right  -->


                <!-- <div class="footer-language">
                    <a href="#" class="text-decoration-none"><span>English</span></a>
                    <a href="#" class="text-decoration-none"><span>Arabic</span></a>
                    <a href="#" class="text-decoration-none"><span>French</span></a>
                </div> -->
            </div>
            <!-- copy-right  -->
            <div class="copy-right text-center">
                <p>Non Copyrighted © 2024 Design and upload by ORPOL Infotech</p>

            </div>
        </div>
    </div>
    <!-- footer seaction end -->

</body>

</html>



<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('assets/jquery-validation/jquery.validate.min.js') }}"></script>

<script src="{{ asset('assets/js/main.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>



<!-- swiper js  -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

@yield('script')


<script>
    var swiper = new Swiper('.mySwiper', {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        speed: 1000,
        breakpoints: {

            300: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            576: {
                slidesPerView: 1,
                spaceBetween: 10
            },

            768: {
                slidesPerView: 2,
                spaceBetween: 20
            },

            992: {
                slidesPerView: 4,
                spaceBetween: 30
            },


        }
    });
</script>

<!-- slider2 -->
<script>
    var swiper = new Swiper('.mySwiper-2', {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        speed: 1000,
        breakpoints: {

            300: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            576: {
                slidesPerView: 1,
                spaceBetween: 10
            },

            768: {
                slidesPerView: 2,
                spaceBetween: 20
            },

            992: {
                slidesPerView: 3,
                spaceBetween: 30
            },


        }
    });
</script>
<script>
    var swiper = new Swiper('.mySwiper-3', {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        speed: 1000,
        breakpoints: {

            300: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            576: {
                slidesPerView: 1,
                spaceBetween: 10
            },

            768: {
                slidesPerView: 2,
                spaceBetween: 20
            },

            992: {
                slidesPerView: 2,
                spaceBetween: 30
            },
            1024: {
                slidesPerView: 2,
                spaceBetween: 30
            },


        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.querySelector('.kaniya-header');
        const scrollTrigger = window.innerHeight * 0.2;

        window.addEventListener('scroll', function() {
            if (window.scrollY > scrollTrigger) {
                header.classList.add('fixed-header');
            } else {
                header.classList.remove('fixed-header');
            }
        });
    });


    // document.addEventListener("DOMContentLoaded", function() {
    //     var form = document.getElementById('registrationForm');

    //     form.addEventListener('submit', function(event) {
    //         event.preventDefault();

    //         var nameInput = document.getElementById('nameInput').value;
    //         var mobileInput = document.getElementById('mobileInput').value;
    //         var emailInput = document.getElementById('emailInput').value;
    //         var passwordInput = document.getElementById('passwordInput').value;
    //         var repeatPasswordInput = document.getElementById('repeatPasswordInput').value;

    //         if (nameInput.trim() === '' || mobileInput.trim() === '' || emailInput.trim() === '' ||
    //             passwordInput.trim() === '' || repeatPasswordInput.trim() === '') {
    //             alert('Please fill in all required fields.');


    //             return;
    //         }

    //         form.submit();
    //     });

    //     $('#exampleModal').on('hidden.bs.modal', function() {
    //         form.reset();
    //     });
    // });



    //     $(".registrationForm").validate({
    //         rules: {
    //             nameInput: {
    //                 required: true,
    //                 digits: true
    //             },
    //             mobileInput: {
    //                 required: true,
    //                 digits: true
    //             },
    //             emailInput: {
    //                 required: true
    //             },
    //             passwordInput: {
    //                 required: true
    //             },
    //             repeatPasswordInput: {
    //                 required: true
    //             }
    //         },
    //         messages: {
    //             nameInput: {
    //                 required: "Please Enter quantity"

    //             },
    //             mobileInput: {
    //                 required: "Please Enter Mobile No"
    //             },
    //             emailInput: {
    //                 required: "Please Enter Email"
    //             },
    //             passwordInput: {
    //                 required: "Please Enter Password"
    //             },
    //             repeatPasswordInput: {
    //                 required: "Please Enter ConfirmPassword"
    //             }
    //         },
    //     });
    // 
</script>


<script>
    $("#registrationForm").validate({
        ignore: ':hidden:not(:radio)',
        errorElement: 'label',
        errorClass: 'is-invalid',
        validClass: 'is-valid',
        rules: {
            nameInput: {
                required: true,

            },
            mobileInput: {
                required: true,

            },
            emailInput: {
                required: true
            },
            passwordInput: {
                required: true
            },
            repeatPasswordInput: {
                required: true

            },

        },
        messages: {
            nameInput: {
                required: "Please Enter Name"

            },
            mobileInput: {
                required: "Please Enter Mobile No",

            },
            emailInput: {
                required: "Please Enter Email"
            },
            passwordInput: {
                required: "Please Enter Password"
            },
            repeatPasswordInput: {
                required: "Please Enter ConfirmPassword"
            },
        }
    });





    // $("#footer_email").validate({
    //     ignore: ':hidden:not(:radio)',
    //     errorElement: 'label',
    //     errorClass: 'is-invalid',
    //     validClass: 'is-valid',
    //     rules: {
    //         email: {
    //             required: true,

    //         },



    //     },
    //     messages: {
    //         email: {
    //             required: "Please Enter Email"

    //         },


    //     }
    // });
</script>


<script>
    $("#registrationForm").validate({
        ignore: ':hidden:not(:radio)',
        errorElement: 'label',
        errorClass: 'is-invalid',
        validClass: 'is-valid',
        rules: {
            nameInput: {
                required: true,

            },
            mobileInput: {
                required: true,

            },
            emailInput: {
                required: true
            },
            passwordInput: {
                required: true
            },
            repeatPasswordInput: {
                required: true

            },

        },
        messages: {
            nameInput: {
                required: "Please Enter Name"

            },
            mobileInput: {
                required: "Please Enter Mobile No",

            },
            emailInput: {
                required: "Please Enter Email"
            },
            passwordInput: {
                required: "Please Enter Password"
            },
            repeatPasswordInput: {
                required: "Please Enter ConfirmPassword"
            },
        }
    });





    $("#loginform").validate({
        ignore: ':hidden:not(:radio)',
        errorElement: 'label',
        errorClass: 'is-invalid',
        validClass: 'is-valid',
        rules: {
            loginemail: {
                required: true,

            },
            loginPassword: {
                required: true,

            },


        },
        messages: {
            loginemail: {
                required: "Please Enter Email"

            },
            loginPassword: {
                required: "Please Enter Password"
            },

        }
    });
</script>



@php
    $errors = Session::get('errors');
@endphp

@if ($errors && $errors->any())
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        };

        @foreach ($errors->all() as $error)
            toastr.error("{!! $error !!}");
        @endforeach
    </script>
@endif
<script>
    @if (Session::has('success'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ Session::get('success') }}");
    @endif

    @if (Session::get('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{!! \Session::get('error') !!}");
    @endif

    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
    @endif
</script>
