<header class="sticky-top">
    <div class="container-fluid bg-dark">
        <div class="container"> 
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-xl navbar-dark bg-dark font-weight-bolder">
                        <a class="navbar-brand pr-2" href="{{ route('admin.dashboard') }}"><img src="assets/uploads/logo.png" alt="" style="height: 18px;"></a>
                        <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#nav" aria-expanded="false">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="navbar-collapse collapse" id="nav" style="">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="{{ route('admin.category.index') }}">Sell</a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="{{ route('admin.news.index') }}">News</a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="{{ route('admin.slider.index') }}">Slider</a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="{{ route('admin.product-comment') }}">Product Comment</a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="{{ route('admin.news-comment') }}">News Comment</a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="{{ route('admin.check-out') }}">Check Out</a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="{{ route('admin.contact') }}">Contact</a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="{{ route('admin.customer') }}">Customer</a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="{{ route('admin.admin') }}">Admin</a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-light" href="{{ route('admin_logout') }}"><span><i class="fa fa-sign-out"></i></span> Lgoout</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>            
        </div>
    </div>
</header>