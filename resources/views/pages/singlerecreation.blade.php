@extends('layouts.main')

@section('title', $singlerecreation->name)

@section('content')

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>@yield('title')</h2>
                        <div class="bt-option">
                            <a href="{{url('/')}}">Home</a>
                            <span>@yield('title')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

        <!-- Recreation Details Section Begin -->
        <section class="room-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="room-details-item">
                        <img src="{{Storage::url($singlerecreation->photo)}}" alt="">
                        <div class="rd-text">
                            <div class="rd-title">
                                <h3>{{$singlerecreation->name}}</h3>
                                <div class="rdt-right">
                                    <div class="rating">
                                        <!-- <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star-half_alt"></i> -->
                                    </div>
                                    @guest
                                    <a href="{{url('guest-bookrecreation')}}">Book Now</a>
                                    @else
                                    <a href="{{route('auth.bookrecreation')}}" onclick="event.preventDefault();
                                            document.getElementById('book-form').submit();">Book Now
                                    </a>

                                    <form id="book-form" action="{{ route('auth.bookrecreation') }}" method="POST" class="d-none">
                                        @csrf
                                        <input type="hidden" name="recreation_id" value="{{$singlerecreation->id}}">
                                    </form>
                                    @endguest
                                </div>
                            </div>
                            <h2>{{$singlerecreation->price}}KSH<span>/PerDay</span></h2>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Size:</td>
                                        <td>{{$singlerecreation->size}}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Capacity:</td>
                                        <td>Max person(s) {{$singlerecreation->quantity}}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Services:</td>
                                        <td>{{$singlerecreation->services}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="f-para"> {!! nl2br(e($singlerecreation->description), false) !!}</p>
                        </div>
                    </div>
                    <!-- <div class="rd-reviews">
                        <h4>Reviews</h4>
                        <div class="review-item">
                            <div class="ri-pic">
                                <img src="img/room/avatar/avatar-1.jpg" alt="">
                            </div>
                            <div class="ri-text">
                                <span>27 Aug 2019</span>
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5>Brandon Kelley</h5>
                                <p>Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                    adipisci velit, sed quia non numquam eius modi tempora. incidunt ut labore et dolore
                                    magnam.</p>
                            </div>
                        </div>
                        <div class="review-item">
                            <div class="ri-pic">
                                <img src="img/room/avatar/avatar-2.jpg" alt="">
                            </div>
                            <div class="ri-text">
                                <span>27 Aug 2019</span>
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5>Brandon Kelley</h5>
                                <p>Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                    adipisci velit, sed quia non numquam eius modi tempora. incidunt ut labore et dolore
                                    magnam.</p>
                            </div>
                        </div>
                    </div>
                    <div class="review-add">
                        <h4>Add Review</h4>
                        <form action="#" class="ra-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Name*">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email*">
                                </div>
                                <div class="col-lg-12">
                                    <div>
                                        <h5>You Rating:</h5>
                                        <div class="rating">
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star-half_alt"></i>
                                        </div>
                                    </div>
                                    <textarea placeholder="Your Review"></textarea>
                                    <button type="submit">Submit Now</button>
                                </div>
                            </div>
                        </form>
                    </div> -->
                </div>

            </div>
        </div>
    </section>
    <!-- Room Details Section End -->

@endsection
