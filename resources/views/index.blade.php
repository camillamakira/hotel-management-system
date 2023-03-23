@extends('layouts.main')

@section('title','Home')

@section('content')
    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text">
                        <h1>{{config('app.name')}} A Luxury Space</h1>
                        <p>Here are the best hotel foods and services, including recommendations and low-priced hotel rooms.</p>
                        <a href="{{url('/rooms')}}" class="primary-btn">Discover Now</a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                    <div class="booking-form">
                        <h3>Book Your Room</h3>
                        <form action="{{route('search')}}">
                            <div class="select-option">
                                <label for="guest">Name:</label>
                                <select id="name" name="name">
                                    <option value="">Choose name</option>
                                    @foreach ($allrooms as $room)
                                        <option value="{{$room->name}}">{{$room->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="select-option">
                                <label for="guest">Price(PerNight):</label>
                                <select id="price" name="price">
                                <option value="">Choose price</option>
                                    @foreach ($allrooms as $room)
                                        <option value="{{$room->price}}">{{$room->price}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="select-option">
                                <label for="guest">Guests:</label>
                                <select id="capacity" name="capacity">
                                    <option value="1">1 Adult</option>
                                    <option value="2">2 Adults</option>
                                    <option value="3">3 Adults</option>
                                    <option value="4">4 Adults</option>
                                </select>
                            </div>

                            <button type="submit">Check Availability</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="img/hero/hero-1.jpg"></div>
            <div class="hs-item set-bg" data-setbg="img/hero/hero-2.jpg"></div>
            <div class="hs-item set-bg" data-setbg="img/hero/hero-3.jpg"></div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About Us Section Begin -->
    <section class="aboutus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    @foreach($abouts as $about)
                    <div class="about-text">
                        <div class="section-title">
                            <span>About Us</span>
                            <h2>{{$about->title}}</h2>
                        </div>
                        <p class="f-para">{{$about->history}}</p>

                        <a href="{{url('about')}}" class="primary-btn about-btn">Read More</a>
                    </div>
                    @endforeach
                </div>
                <div class="col-lg-6">
                    <div class="about-pic">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="img/about/about-1.jpg" alt="">
                            </div>
                            <div class="col-sm-6">
                                <img src="img/about/about-2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Section End -->

    <!-- Services Section End -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>What We Do</span>
                        <h2>Discover Our Services</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($services as $service)
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <h4>{{$service->title }}</h4>
                        <p>{{ $service->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Home Room Section Begin -->
    <section class="hp-room-section">
        <div class="container-fluid">
            <div class="hp-room-items">
                <div class="row">
                    @foreach($rooms as $room)
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="{{Storage::url($room->photo)}}">
                            <div class="hr-text">
                                <h3>{{$room->name}}</h3>
                                <h2>{{$room->price}}KSH<span>/Pernight</span></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Size:</td>
                                            <td>{{$room->size}}</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Capacity:</td>
                                            <td>Max person {{$room->capacity}}</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Bed:</td>
                                            <td>{{$room->bed}}</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Services:</td>
                                            <td>{{$room->services}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="{{url('singleroom/'.$room->id)}}" class="primary-btn">More Details</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Home Room Section End -->

    <!-- Testimonial Section Begin -->
    <!-- <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Testimonials</span>
                        <h2>What Customers Say?</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="testimonial-slider owl-carousel">
                        <div class="ts-item">
                            <p>After a construction project took longer than expected, my husband, my daughter and I
                                needed a place to stay for a few nights. As a Chicago resident, we know a lot about our
                                city, neighborhood and the types of housing options available and absolutely love our
                                vacation at Sona Hotel.</p>
                            <div class="ti-author">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5> - Alexander Vasquez</h5>
                            </div>
                            <img src="img/testimonial-logo.png" alt="">
                        </div>
                        <div class="ts-item">
                            <p>After a construction project took longer than expected, my husband, my daughter and I
                                needed a place to stay for a few nights. As a Chicago resident, we know a lot about our
                                city, neighborhood and the types of housing options available and absolutely love our
                                vacation at Sona Hotel.</p>
                            <div class="ti-author">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5> - Alexander Vasquez</h5>
                            </div>
                            <img src="img/testimonial-logo.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Testimonial Section End -->
@endsection
