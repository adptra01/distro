<!DOCTYPE html>
<html lang="en">

<head>
    <title>THANKS DREAMS STORE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
    <link rel="stylesheet" href="{{ asset('shopper') }}/fonts/icomoon/style.css">

    <link rel="stylesheet" href="{{ asset('shopper') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('shopper') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('shopper') }}/css/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('shopper') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('shopper') }}/css/owl.theme.default.min.css">


    <link rel="stylesheet" href="{{ asset('shopper') }}/css/aos.css">

    <link rel="stylesheet" href="{{ asset('shopper') }}/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        img {
            overflow: hidden;
            position: relative;
            object-fit: cover;

        }
    </style>
</head>

<body>

    <div class="site-wrap">
        <header class="site-navbar" role="banner">
            <div class="site-navbar-top">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                            <form action="{{ route('user.produk.cari') }}" method="get" class="site-block-top-search">
                                @csrf
                                <span class="icon icon-search2"></span>
                                <input type="text" class="form-control border-0" name="cari" placeholder="Search">
                            </form>
                        </div>

                        <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                            <div class="font-weight-bold">
                                <a href="#" class="js-logo-clone">THANKS DREAMS</a>
                            </div>
                        </div>

                        <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                            <div class="top-right links">
                                <div class="site-top-icons">
                                    <ul>
                                        @if (Route::has('login'))
                                            @auth
                                                <li>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle" id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <span class="icon icon-person"></span>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item"
                                                                href="{{ route('user.alamat') }}">Pengaturan Alamat</a>
                                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                                                Logout
                                                            </a>

                                                            <form id="logout-form" action="{{ route('logout') }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                            </form>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <?php
                                                    $user_id = \Auth::user()->id;
                                                    $total_keranjang = \DB::table('keranjang')
                                                        ->select(DB::raw('count(id) as jumlah'))
                                                        ->where('user_id', $user_id)
                                                        ->first();
                                                    ?>
                                                    <a href="{{ route('user.keranjang') }}" class="site-cart">
                                                        <span class="icon icon-add_shopping_cart"></span>
                                                        <span class="count">{{ $total_keranjang->jumlah }}</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <?php
                                                    $user_id = \Auth::user()->id;
                                                    $total_order = \DB::table('order')
                                                        ->select(DB::raw('count(id) as jumlah'))
                                                        ->where('user_id', $user_id)
                                                        ->where('status_order_id', '!=', 5)
                                                        ->where('status_order_id', '!=', 6)
                                                        ->first();
                                                    ?>
                                                    <a href="{{ route('user.order') }}" class="site-cart">
                                                        <span class="icon icon-shopping_cart"></span>
                                                        <span class="count">{{ $total_order->jumlah }}</span>
                                                    </a>
                                                </li>
                                            @else
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" id="dropdownMenuButton"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="icon icon-person"></span>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="{{ route('login') }}">Masuk</a>
                                                        @if (Route::has('register'))
                                                            <a class="dropdown-item"
                                                                href="{{ route('register') }}">Daftar</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endauth
                                </div>
                                @endif
                                <li class="d-inline-block d-md-none ml-md-0"><a
                                        href="#"class="site-menu-toggle js-menu-toggle"><span
                                            class="icon-menu"></span></a></li>
                            </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="site-navigation text-right text-md-center" role="navigation">
                <div class="container">
                    <ul class="site-menu js-clone-nav d-none d-md-block">
                        <li class="{{ Request::path() === '/' ? '' : '' }}"><a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="{{ Request::path() === 'produk' ? '' : '' }}"><a
                                href="{{ route('user.produk') }}">Produk</a></li>
                        {{-- <li class="{{ Request::path() === 'kontak' ? '' : '' }}"><a href="{{ route('kontak') }}">Kontak</a></li> --}}
                    </ul>
                </div>
            </nav>
        </header>

        @yield('content')

        <footer class="site-footer border-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="footer-heading mb-4">Tentang Toko</h3>
                            </div>
                            <div class="col-md-6 col-lg-8">
                                <ul class="list-unstyled">
                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum adipisci dolores
                                        minus vel quia blanditiis excepturi tempora est possimus corporis! Lorem, ipsum
                                        dolor sit amet consectetur adipisicing elit. Dolore repellat cumque voluptate.
                                        Eum accusamus ea dolor eligendi exercitationem dicta laboriosam voluptate
                                        debitis odio, nulla consequuntur hic assumenda repellat, officiis labore in ex
                                        quam necessitatibus eveniet. Est nisi quod, explicabo magnam voluptas eum error
                                        assumenda eveniet harum? Voluptatum ut fuga nisi!</p>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="block-5 mb-5">
                            <h3 class="footer-heading mb-4">Contact Info</h3>
                            <ul class="list-unstyled">
                                <li class="address">
                                    {{ $lokasi->detail ?? 'quam necessitatibus eveniet. Est nisi quod, explicabo magnam voluptas eum error assumenda eveniet harum? Voluptatum ut fuga nisi!' }}
                                </li>
                                <li class="phone"><a href="tel://23923929210">+62 3392 3929 210</a></li>
                                <li class="email">ThanksDreams@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row pt-5 mt-5 text-center">
                    <div class="col-md-12">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i
                                class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                target="_blank" class="text-primary">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>

                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('shopper') }}/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <script src="{{ asset('shopper') }}/js/jquery-ui.js"></script>
    <script src="{{ asset('shopper') }}/js/popper.min.js"></script>
    <script src="{{ asset('shopper') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('shopper') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('shopper') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('shopper') }}/js/aos.js"></script>

    <script src="{{ asset('shopper') }}/js/main.js"></script>
    @yield('js')
</body>

</html>
