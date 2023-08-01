<header class="sticky-top">
    <div class="container-fluid bg-dark">
        <div class="container">
            <div class="row">           
                <div class="col-6 text-center">
                    @if(Auth::check() && Auth::user()->role == 0)
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#cart_modal">
                        <span><i class="fa fa-shopping-cart"></i></span>
                    </button>
                    <input type="hidden" id="check_user_login" value="1">
                    @else
                    <input type="hidden" id="check_user_login" value="0">
                    @endif 
                </div>
                <div class="col-6 text-center">
                    @if(Auth::check() && Auth::user()->role == 0)
                    <div class="dropdown">
                        <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                            <span><i class="fa fa-user"></i></span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#"><span><i class="fa fa-edit"></i></span> Profile Settings</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"><span><i class="fa fa-sign-out"></i></span> Logout</a>
                        </div>
                    </div>
                    @else
                    <button class="btn btn-dark" data-toggle="modal" data-target="#login_modal" id="login_btn"><span><i class="fa fa-sign-in"></i></span> Login</button>
                    <button class="btn btn-dark" data-toggle="modal" data-target="#register_modal" id="register_btn"><span><i class="fa fa-sign-in"></i></span> Register</button>
                    @endif
                </div>                            
            </div> 
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark font-weight-bolder">
                        <a class="navbar-brand pr-2" href="{{ route('home') }}"><img src="assets/uploads/logo.png" alt="" style="height: 18px;"></a>
                        <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#navb" aria-expanded="false">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="navbar-collapse collapse" id="navb" style="">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="{{ route('product') }}">Product</a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="{{ route('news') }}">News</a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="{{ route('about') }}">About</a>
                                </li>
                            </ul>
                            <div class="input-group col-lg-4 col-md-12">
                                <input type="text" id="search" class="form-control" placeholder="Enter keyword ...">
                                <span class="input-group-btn">
                                    <button class="btn btn-light" id="btn_search"><span><i class="fa fa-search"></i></span></button>
                                </span>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>            
        </div>
    </div>
</header>