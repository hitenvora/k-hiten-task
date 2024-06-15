@extends('front-pages.layout.layout')
@section('title', 'Profile')
@section('footer_class', 'margin_top50')

@section('content')
    <link rel="stylesheet" href="../assets/css/profile.css">



    <div class="profile margin_top80">
        <div class="container">
            <div class="box">
                <div class="profile-img">
                    <img src="../assets/image/profile.png" alt="">
                    <h1>Your Profile</h1>
                </div>
                <div class="edit padding_top30">
                    <form action="{{ Route('profile.Update') }}" method="POST">
                        @csrf

                        <div class="back">
                            {{-- <a href=""><i class="fa-solid fa-chevron-left"></i></a> --}}
                            <h2> Your Profile</h2>
                        </div>
                        <div class="row padding_top50">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="outfit" for="exampleInputEmail1">First Name*</label>
                                    <input type="name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="name" value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="outfit" for="exampleInputEmail1"> Last Name*</label>
                                    <input type="name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="last_name" value="{{ Auth::user()->last_name }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="outfit" for="exampleInputEmail1">Email*</label>
                            <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="email" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="form-group">
                            <label class="outfit" for="exampleInputEmail1">Chage Address*</label>
                            <textarea name="address" class="form-control" id="" rows="3" name="address">{{ Auth::user()->address }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="outfit" for="exampleInputEmail1">Phone No*</label>
                                    <input type="name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="contact_number"
                                        value="{{ Auth::user()->contact_number }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="outfit" for="exampleInputEmail1">State*</label>
                                    <input type="name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="state" value="{{ Auth::user()->state }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="outfit" for="exampleInputEmail1">City*</label>
                                    <input type="name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="city" value="{{ Auth::user()->city }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="outfit" for="exampleInputEmail1">DOB*</label>
                                    <input type="name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="date_of_birth"
                                        value="{{ Auth::user()->date_of_birth }}">
                                </div>
                            </div>
                        </div>
                        <div class="gender">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" 
                                            id="flexRadioDefault1" name="gender" value="male"
                                            @if (Auth::user()->gender == 'male') checked @endif>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Male
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" 
                                            id="flexRadioDefault1" name="gender" value="female"
                                            @if (Auth::user()->gender != 'male' && Auth::user()->gender != '') checked @endif>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="update padding_top30">
                            <button type="submit" >Update</button>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
@endsection


@section('script')

@endsection
