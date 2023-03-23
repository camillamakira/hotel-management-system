@extends('layouts.main')

@section('title','Search Results')

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

    <!-- Rooms Section Begin -->
    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                @foreach ($rooms as $room)
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="{{Storage::url($room->photo)}}" alt="">
                        <div class="ri-text">
                            <h4>{{$room->name}}</h4>
                            <h3>{{$room->price}}KSH<span>/Pernight</span></h3>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Size:</td>
                                        <td>{{$room->size}}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Capacity:</td>
                                        <td>Max person(s) {{$room->capacity}}</td>
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

                <div class="col-lg-12">
                    <div class="room-pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">Next <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Rooms Section End -->

@endsection