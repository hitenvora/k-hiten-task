@extends('front-pages.layout.layout')
@section('title', 'Contact')
@section('footer_class', 'margin_top100')






@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/faq.css') }}">


    <div class="contact-bg">
        <h1 class="mogra-regular">Contact Us</h1>
    </div>

    <main>
        <!-- get in seaction start -->
        <section>
            <div class="contact margin_top80">
                <div class="container">
                    <h1>Get in Touch with Us</h1>
                    <div class="row">
                        <div class="col-lg-6 padding_top70">
                            <h3 class="outfit">Store Information</h3>
                            <div class="custom-hr">
                                <hr>
                            </div>
                            <p class="outfit padding_top20">Hygienic production practices and traditional taste is our
                                speciality. We constantly improve and innovate to serve our customers better, we deliver
                                across India through this platform. With growing love of our customers we started catering
                                services in year 2017 and we have received an overwhelming response from our customers.</p>
                            <div class="phone">
                                <div class="phone-icon">
                                    <i class="fa-solid fa-phone-volume"></i>
                                </div>
                                <div class="phone-text">
                                    <h5>Hotline Free 10:00 AM to 8:00 PM:</h5>
                                    <h3>+91 99786 46421</h3>
                                </div>
                            </div>
                            <p class="outfit padding_top20">(Kanaiya Dairy and Sweets) <br>
                                G/16,Laksh Plaza, Chhaprabhatha Rd, <br>
                                Amroli Char Rasta, Surat, Gujarat 394107</p>
                            <p class="outfit">Gstin - 24AA564RGYTU</p>
                            <p class="outfit">E-mail - kanaiyadairyandsweets@gmail.com</p>
                        </div>
                        <div class="col-lg-6  padding_top70">
                            <div class="box">
                                <h2 class="outfit">Drop us a Message</h2>
                                <form action="{{ route('saveContectus') }}" class="margin_top50" method="post"
                                    id="contect_form">
                                    @csrf
                                    <div class="form-group">
                                        <label class="outfit" for="exampleInputEmail1">Name*</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            aria-describedby="emailHelp">

                                    </div>
                                    <div class="form-group">
                                        <label class="outfit" for="exampleInputEmail1">Mobile Number*</label>
                                        <input type="text" class="form-control" name="phone_no" id="phone_no"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="form-group">
                                        <label class="outfit" for="exampleInputEmail1">Email*</label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="form-group">
                                        <label class="outfit" for="exampleFormControlTextarea1">Message*</label>
                                        <textarea class="form-control" name="message" id="message" rows="3"></textarea>
                                    </div>
                                    <button class="send-btn" type="submit">
                                        <h5>Send Message</h5>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- get in seaction end -->

        <!-- map seaction start -->
        <!-- map seaction start -->
        <div class="map margin_top100">
            <div class="container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3718.8101449237424!2d72.84513847600232!3d21.23937588050989!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f5b8ad316fd%3A0xaa0648a3743b61b4!2sLaksh%20plaza!5e0!3m2!1sen!2sin!4v1715916917361!5m2!1sen!2sin"
                    width="100%" height="500" style="border-radius:10px;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <div class="faq margin_top80">
            <div class="container">
                <h1 class="text-center" style="color: #5D0C05">Frequently asked Questions (FAQ’s)</h1>
                <div class="accordion margin_top20">
                    <div class="accordion-item">
                        <button id="accordion-button-1" aria-expanded="false">
                            <span class="accordion-title">How much time it takes for an order to get delivered?</span>
                            <span class="icon" aria-hidden="true"></span>
                        </button>
                        <div class="accordion-content">
                            <p>
                                We aim to ship out all orders received before 2.30 pm on the same day. Depending on the
                                location, your order will reach you within 2-5 working days, For Mumbai, Navi Mumbai & Thane
                                orders placed before 2.30 pm will be out for shipping after 5.00 pm. We currently accept
                                payments made through all major credit and debit cards. Jhama Sweets does not store any card
                                details. We also hold the 128-bit SSL certification to ensure that you have maximum security
                            </p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button id="accordion-button-1" aria-expanded="false">
                            <span class="accordion-title">How much time it takes for an order to get delivered?</span>
                            <span class="icon" aria-hidden="true"></span>
                        </button>
                        <div class="accordion-content">
                            <p>
                                We aim to ship out all orders received before 2.30 pm on the same day. Depending on the
                                location, your order will reach you within 2-5 working days, For Mumbai, Navi Mumbai & Thane
                                orders placed before 2.30 pm will be out for shipping after 5.00 pm. We currently accept
                                payments made through all major credit and debit cards. Jhama Sweets does not store any card
                                details. We also hold the 128-bit SSL certification to ensure that you have maximum security
                            </p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button id="accordion-button-1" aria-expanded="false">
                            <span class="accordion-title">How much time it takes for an order to get delivered?</span>
                            <span class="icon" aria-hidden="true"></span>
                        </button>
                        <div class="accordion-content">
                            <p>
                                We aim to ship out all orders received before 2.30 pm on the same day. Depending on the
                                location, your order will reach you within 2-5 working days, For Mumbai, Navi Mumbai & Thane
                                orders placed before 2.30 pm will be out for shipping after 5.00 pm. We currently accept
                                payments made through all major credit and debit cards. Jhama Sweets does not store any card
                                details. We also hold the 128-bit SSL certification to ensure that you have maximum security
                            </p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button id="accordion-button-2" aria-expanded="false">
                            <span class="accordion-title">Why is the sky blue?</span>
                            <span class="icon" aria-hidden="true"></span>
                        </button>
                        <div class="accordion-content">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut.
                                Ut tortor pretium viverra suspendisse potenti.
                            </p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button id="accordion-button-3" aria-expanded="false">
                            <span class="accordion-title">Will we ever discover aliens?</span>
                            <span class="icon" aria-hidden="true"></span>
                        </button>
                        <div class="accordion-content">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut.
                                Ut tortor pretium viverra suspendisse potenti.
                            </p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button id="accordion-button-4" aria-expanded="false">
                            <span class="accordion-title">How much does the Earth weigh?</span>
                            <span class="icon" aria-hidden="true"></span>
                        </button>
                        <div class="accordion-content">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut.
                                Ut tortor pretium viverra suspendisse potenti.
                            </p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button id="accordion-button-5" aria-expanded="false">
                            <span class="accordion-title">How do airplanes stay up?</span>
                            <span class="icon" aria-hidden="true"></span>
                        </button>
                        <div class="accordion-content">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut.
                                Ut tortor pretium viverra suspendisse potenti.
                            </p>
                        </div>
                    </div>
                </div>




            </div>
        </div>

    </main>
@endsection
@section('script')

    <script>
        $("#contect_form").validate({
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
                    email: true,

                },
                phone_no: {
                    required: true,
                    minlength10: true
                },
                message: {
                    required: true
                }

            },
            messages: {
                name: {
                    required: "Please Enter Name"

                },
                email: {
                    required: "Please Enter Email",
                    email: "Please Enter a valid Email"

                },
                phone_no: {
                    required: "Please Enter Phone No",
                    minlength10: "Mobile number must be at least 10 digits long"
                },
                message: {
                    required: "Please Enter Message"
                },
            }
        });
    </script>

    <!-- faq open close -->

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
        ScrollReveal().reveal('.contact-bg h1', {
            origin: 'top'
        });
        ScrollReveal().reveal('.contact h1', {
            origin: 'top'
        });
        ScrollReveal().reveal('.contact h3', {
            origin: 'bottom'
        });
        ScrollReveal().reveal('.faq h1', {
            origin: 'top'
        });
    </script>



@endsection
