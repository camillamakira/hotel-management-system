@extends('layouts.main')

@section('title','Foods')

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
    @if(Session::has('successMsg'))
        <div class="alert alert-success"> {{ Session::get('successMsg') }}</div>
    @endif
    <!-- Rooms Section Begin -->
    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                @foreach ($foods as $food)
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="{{Storage::url($food->photo)}}" alt="">
                        <div class="ri-text">
                            <h4>{{$food->name}}</h4>
                            <h3>{{$food->price}}ksh<span>/PerPlate</span></h3>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Size:</td>
                                        <td>{{$food->size}}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Quantity:</td>
                                        <td>Max person {{$food->quantity}}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Services:</td>
                                        <td>{{$food->services}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="{{url('singlefood/'.$food->id)}}" class="primary-btn">More Details</a>
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