@extends('front-pages.layout.layout')
@section('title', 'ADDRESS')
@section('footer_class', 'margin_top80')


@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/newaddress.css') }}">


    <div class="new-address margin_top100">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <h3>Save Address</h3>
                    @foreach ($view_address as $item)
                        <div class="box mt-3">
                            <h4><b> Name :- </b>{{ $item->first_name }} {{ $item->last_name }}</h4>
                            <p> <b> Address:-</b> {{ $item->addresss }}</p>
                            <p> <b> Mobile No:- </b> {{ $item->mobile_no }}</p>
                            <div class="add-edit">
                                <div class="edit">
                                    <div class="edit">
                                        {{-- <a  href="{{ route('edit_profile_address', $item->id, $item->type) }}">EDIT</a> --}}
                                        <a
                                            href="{{ route('edit_profile_address', ['id' => $item->id, 'type' => $item->address_type]) }}">EDIT</a>

                                    </div>
                                </div>
                                <div class="remove">
                                    <a href="javascript:void(0);"
                                        data-href="{{ route('delete_profile_address', $item->id) }}"
                                        onclick="archiveFunction(event, this)">REMOVE
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    {{-- <div class="add_new">
                        <a href="">+ ADD NEW ADDRESS</a>
                    </div> --}}
                </div>
            </div>

            <div class="new_adderss_form padding_top50">
                <h3>New Delivery Address</h3>
                <form action="{{ route('saveProfileaddress') }}" class="margin_top20" id="address_profile_form"
                    method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="name" class="form-control" id="first_name" name="first_name"
                                    aria-describedby="emailHelp" placeholder="First Name*" value="{{ old('first_name') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="name" class="form-control" name="last_name" id="last_name"
                                    aria-describedby="emailHelp" placeholder="Last Name*" value="{{ old('last_name') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email"
                                    aria-describedby="emailHelp" placeholder="Email ID*" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="name" class="form-control" name="mobile_no" id="mobile_no"
                                    aria-describedby="emailHelp" placeholder="Phone Number*"
                                    value="{{ old('mobile_no') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" class="form-control @error('pincode') is-invalid @enderror"
                                    name="pincode" id="pincode" aria-describedby="emailHelp" placeholder="PIN Code*"
                                    value="{{ old('pincode') }}">
                                @error('pincode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="city" id="city"
                                    aria-describedby="emailHelp" placeholder="City*" value="{{ old('city') }}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="state" id="state"
                                    aria-describedby="emailHelp" placeholder="State*" value="{{ old('state') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="addresss" name="addresss"
                            aria-describedby="emailHelp" placeholder="Address (House No. ,Building, Street, Area)"
                            value="{{ old('addresss') }}">
                    </div>

                    {{-- <input type="hidden" name="address_type" value="{{ $type ?? '0' }}">
                    <div class="office margin_top20">
                        <div class="office-home">
                            <a href="{{ route('profile_address.view', 0) }}" id="home"
                                class="office-home @if ($type == 0) selected @endif"><i
                                    class="fa-solid fa-house"></i> HOME</a>
                        </div>
                        <div class="office-home">
                            <a href="{{ route('profile_address.view', 1) }}" id="office"
                                class="office-home @if ($type == 1) selected @endif"><i
                                    class="fa-solid fa-briefcase"></i> OFFICE</a>
                        </div>
                        <div class="office-home">
                            <a href="{{ route('profile_address.view', 2) }}" id="other"
                                class="office-home @if ($type == 2) selected @endif"><i
                                    class="fa-solid fa-location-arrow"></i> OTHER</a>
                        </div>
                    </div> --}}




                    <input type="hidden" name="address_type" value="{{ $type }}">

                    <div class="office margin_top20">
                        <div class="office-home">
                            <a href="#" id="home" class="office-home " onclick="selectAddressType(0)">
                                <i class="fa-solid fa-house"></i> HOME
                            </a>
                        </div>
                        <div class="office-home">
                            <a href="#" id="office" class="office-home " onclick="selectAddressType(1)">
                                <i class="fa-solid fa-briefcase"></i> OFFICE
                            </a>
                        </div>
                        <div class="office-home">
                            <a href="#" id="other" class="office-home " onclick="selectAddressType(2)">
                                <i class="fa-solid fa-location-arrow"></i> OTHER
                            </a>
                        </div>
                    </div>


                    <div class="save_add padding_top20">
                        {{-- <a href="">SAVE ADDRESS</a> --}}
                        <button type="submit">SAVE ADDRESS</button>
                    </div>
                </form>

            </div>


            <div class="shipping padding_top80">
                <div class="cod">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="free">
                                <img src="{{ asset('/assets/image/faq/Vector (1).png') }}" alt="">.
                                <h5>Free Shipping</h5>
                                <p>On Orders Above Rs. 399</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="free">
                                <img src="{{ asset('/assets/image/faq/Vector.png') }}" alt="">.
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
                                <img src="{{ asset('/assets/image/faq/right.png') }}" alt="">
                            </div>
                            <div class="vector-text">
                                <p>100% Payment protection, Easy return policy</p>
                            </div>
                        </div>
                        <div class="payment-card">
                            <img src="{{ asset('/assets/image/faq/upi.png') }}" alt="">
                            <img src="{{ asset('/assets/image/faq/g-pay.png') }}" alt="">
                            <img src="{{ asset('/assets/image/faq/phonepe.png') }}" alt="">
                            <img src="{{ asset('/assets/image/faq/rupay.png') }}" alt="">
                            <img src="{{ asset('/assets/image/faq/master.png') }}" alt="">
                            <img src="{{ asset('/assets/image/faq/mobi.png') }}" alt="">
                            <img src="{{ asset('/assets/image/faq/visa.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection




@section('script')










    <script>
        $("#address_profile_form").validate({
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

                city: {
                    required: true
                },
                state: {
                    required: true
                },
                addresss: {
                    required: true
                },

                pincode: {
                    required: true,
                    digits: true, // Ensures only digits are entered
                    minlength: 6 // Specifies the minimum length of the input
                    // maxlength: 6 // Specifies the minimum length of the input
                },
                address_type: {
                    required: true,
                }


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

                city: {
                    required: "Please Enter City",
                },
                state: {
                    required: "Please Enter State",
                },

                addresss: {
                    required: "Please Enter Address",
                },



                pincode: {
                    required: "Please Enter Pincode",
                    digits: "Please enter a valid Pincode number.",
                    minlength: "Pincode Number must be 6 digits .",
                    // maxlength: "Pincode Number must be 6 digits ."
                },
                address_type: {
                    required: "Please Selete Type",
                }


            },
        });
    </script>

    <!-- swiper js  -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>




    <!-- slider -->
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




    <script>
        function archiveFunction(event, element) {
            event.preventDefault(); // prevent the default action

            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the action if confirmed
                    const url = element.getAttribute('data-href');

                    fetch(url, {
                            method: 'post',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for security
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                // Optionally, you can show a success message
                                Swal.fire('Deleted!', 'Your record has been deleted.', 'success')
                                    .then(() => {
                                        window.location
                                            .reload(); // Reload the page after successful deletion
                                    });
                            } else {
                                Swal.fire('Error!', 'There was a problem deleting the record.', 'error');
                            }
                        })
                        .catch(error => {
                            Swal.fire('Error!', 'There was a problem deleting the record.', 'error');
                        });
                } else {
                    Swal.fire('Cancelled', 'Your record is safe :)', 'error');
                }
            });
        }
    </script>



    {{-- <script>
        let editAddressId = null; // Variable to store the ID of the address being edited

        // Handle click event for EDIT button
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-address');
            editButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    editAddressId = this.getAttribute('data-id');
                    fetchAddressData(editAddressId);
                });
            });
        });

        // Function to fetch address data
        function fetchAddressData(addressId) {
            // Make AJAX request to fetch address data
            fetch('{{ route('fetch_address_data') }}/' + addressId)
                .then(response => response.json())
                .then(data => {
                    // Populate form fields with fetched data
                    document.getElementById('first_name').value = data.first_name;
                    document.getElementById('last_name').value = data.last_name;
                    document.getElementById('email').value = data.email;
                    document.getElementById('mobile_no').value = data.mobile_no;
                    document.getElementById('pincode').value = data.pincode;
                    document.getElementById('city').value = data.city;
                    document.getElementById('state').value = data.state;
                    document.getElementById('addresss').value = data.addresss;
                })
                .catch(error => console.error('Error fetching address data:', error));
        }

        // Function to handle form submission
        document.getElementById('address_profile_form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            // Determine if it's an edit or insert operation
            const url = editAddressId ? '{{ route('update_address') }}/' + editAddressId :
                '{{ route('save_address') }}';

            // Make AJAX request to save/update address
            fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        // Optionally, you can show a success message
                        console.log('Address saved/updated successfully');
                        // Clear form fields after successful submission
                        this.reset();
                        editAddressId = null; // Reset editAddressId
                    } else {
                        console.error('Error saving/updating address');
                    }
                })
                .catch(error => console.error('Error saving/updating address:', error));
        });
    </script> --}}



    <script>
        function selectAddressType(type) {
            // Remove 'selected' class from all links
            document.querySelectorAll('.office-home').forEach(function(link) {
                link.classList.remove('selected');
            });

            // Add 'selected' class to the clicked link
            document.getElementById(getAddressTypeElementId(type)).classList.add('selected');

            // Update the hidden input value with the selected address type
            document.querySelector('input[name="address_type"]').value = type;
        }

        function getAddressTypeElementId(type) {
            switch (type) {
                case 0:
                    return 'home';
                case 1:
                    return 'office';
                case 2:
                    return 'other';
                default:
                    return '';
            }
        }
    </script>


@endsection
