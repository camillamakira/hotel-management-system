<header class="header-section">
        <div class="top-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="tn-left">
                            <li><i class="fa fa-phone"></i> (254) 768196097</li>
                            <li><i class="fa fa-envelope"></i> makiracamilla@gmail.com</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="tn-right">
                            <div class="top-social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-tripadvisor"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                            <a href="#" class="bk-btn">Booking Now</a>
                            <div class="language-option">
                                <img src="img/flag.jpg" alt="">
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-item">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="./index.html">
                                <img src="img/golf.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="nav-menu">
                            <nav class="mainmenu">
                                <ul>
                                    <li class="active"><a href="{{url('/')}}">Home</a></li>
                                    <li><a href="{{url('/about')}}">About Us</a></li>
                                    <li><a href="{{url('/rooms')}}">Rooms</a></li>
                                    <li><a href="{{url('/foods')}}">Foods</a></li>
                                    <li><a href="{{url('/recreation')}}">Recreation</a></li>
                                </ul>
                            </nav>
                            <div class="nav-right">
                            @if (Route::has('login'))
                            @auth
                            <a href="{{url('/home')}}">Home</a>
                            @else
                                <a href="{{route('login')}}">Login</a>
                            @endauth
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>