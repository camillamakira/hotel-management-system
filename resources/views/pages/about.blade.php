@extends('layouts.main')

@section('title','About Us')
@section('content')

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>@yield('title')</h2>
                        <div class="bt-option">
                            <a href="/">Home</a>
                            <span>@yield('title')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- About Us Page Section Begin -->
    <section class="aboutus-page-section spad">
        <div class="container">
            <div class="about-page-text">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ap-title">
                            @foreach ($abouts as $about)
                            <h2>{{$about->title}}</h2>
                            <p>{{$about->history}}
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1">
                        <ul class="ap-services">
                            @foreach ($services as $service)
                            <li><i class="icon_check"></i> {{$service->title}}</li>                                
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- About Us Page Section End -->

    <!-- Gallery Section Begin -->
    <section class="gallery-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Our Gallery</span>
                        <h2>Discover Our Work</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="gallery-item set-bg" data-setbg="img/gallery/gallery-1.jpg">
                        <div class="gi-text">
                            <h3>Room Luxury</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="gallery-item set-bg" data-setbg="img/gallery/gallery-3.jpg">
                                <div class="gi-text">
                                    <h3>Room Luxury</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="gallery-item set-bg" data-setbg="img/gallery/gallery-4.jpg">
                                <div class="gi-text">
                                    <h3>Room Luxury</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="gallery-item large-item set-bg" data-setbg="img/gallery/gallery-2.jpg">
                        <div class="gi-text">
                            <h3>Room Luxury</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Gallery Section End -->

@endsection