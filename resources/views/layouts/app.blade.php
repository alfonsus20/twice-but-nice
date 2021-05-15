<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Twice But Nice</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Twice But Nice Thrifting Shop" name="keywords">
    <meta content="Twice But Nice Thrifting Shop" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/icon.png') }}">

    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('lib/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/slick/slick-theme.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/c09ccc772c.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-PvBug4sqIuZ8dl9Z"></script>
    
    {{-- Google Fonts --}}

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;700&family=Poppins:wght@300;400;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- Top bar Start -->
    <div class="top-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <i class="fa fa-envelope"></i>
                    <a href="mailto:twice_but_nice@email.com" class="text-decoration-none">twice_but_nice@email.com</a>
                </div>
                <div class="col-sm-6">
                    <i class="fa fa-phone-alt"></i>
                    <a href="tel:+628129120221" class="text-decoration-none">+628129120221</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Top bar End -->

    <!-- Nav Bar Start -->
    <div class="nav">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                <a href="#" class="navbar-brand">MENU</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto">
                        <a href="/" class="nav-item nav-link active">Home</a>
                        <a href="/products" class="nav-item nav-link">Products</a>
                        <a href="/cart" class="nav-item nav-link">Cart</a>
                        <a href="/checkout" class="nav-item nav-link">Checkout</a>
                        <a href="/order" class="nav-item nav-link">Pesanan</a>
                    </div>
                    <div class="navbar-nav ml-auto">
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                @if (@isset(auth()->user()->name))
                                    {{ auth()->user()->name }}
                                @else
                                    <i class="fas fa-sign-in-alt"></i> Login
                                @endif
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if (@isset(auth()->user()->name))
                                    <li><a class="dropdown-item" href="/profile">Akun Saya</a></li>
                                    <li><a class="dropdown-item" href="/wishlist">Wishlist</a></li>
                                    @role('admin')
                                    <li><a class="dropdown-item" href="/admin">Admin</a></li>
                                    @endrole
                                    <li>
                                        <form action="{{ route('logout') }}" class="dropdown-item" method="POST">
                                            @csrf
                                            <input type="submit" class="dropdown-item p-0" value="Logout">
                                        </form>
                                    </li>
                                @else
                                    <li><a class="dropdown-item" href="/login">Login</a></li>
                                    <li><a class="dropdown-item" href="/register">Register</a></li>
                                    <li><a class="dropdown-item" href="#">Wishlist</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Nav Bar End -->
    <!-- Bottom Bar Start -->
    <div class="bottom-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="logo">
                        <a href="/">
                            <img src="{{ asset('img/logo.svg') }}" alt="Logo" class="w-75">
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
                <div class="col-md-3">
                    <div class="user">
                        <a href="/wishlist" class="btn wishlist">
                            <i class="fa fa-heart"></i>
                            <span>
                                @php
                                    use App\Models\Wishlist;
                                    if (isset(auth()->user()->name)) {
                                        $user_wistlist_items = Wishlist::where('user_id', auth()->user()->id)->get();
                                        echo $user_wistlist_items->count();
                                    } else {
                                        echo '0';
                                    }
                                @endphp
                                @php
                                    $hello = 'hei';
                                @endphp
                            </span>
                        </a>
                        <a href="/cart" class="btn cart">
                            <i class="fa fa-shopping-cart"></i>
                            <span>
                                @php
                                    use App\Models\Cart;
                                    if (isset(auth()->user()->name)) {
                                        $user_cart_items = Cart::where('user_id', auth()->user()->id)->get();
                                        echo $user_cart_items->count();
                                    } else {
                                        echo '0';
                                    }
                                @endphp
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bottom Bar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h2>Alamat Perusahaan</h2>
                        <div class="contact-info">
                            <p><i class="fa fa-map-marker"></i>Jalan Melati No. 2, Malang, Jawa Timur</p>
                            <p><i class="fa fa-envelope"></i>twice_but_nice@email.com</p>
                            <p><i class="fa fa-phone"></i>+628129120221</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h2>Ikuti Kami</h2>
                        <div class="contact-info">
                            <div class="social">
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                                <a href=""><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h2>Informasi Perusahaan</h2>
                        <ul>
                            <li><a href="#">Tentang Kami</a></li>
                            <li><a href="#">Kebijakan Privasi</a></li>
                            <li><a href="#">Syarat dan Ketentuan</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h2>Informasi Pembelian</h2>
                        <ul>
                            <li><a href="#">Kebijakan Pembayaran</a></li>
                            <li><a href="#">Kebijakan Pengiriman</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row payment align-items-center">
                <div class="col-md-6">
                    <div class="payment-method">
                        <h2>Kami Menerima:</h2>
                        <img src="{{ asset('img/payment-method.png') }}" alt="Payment Method" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="payment-security">
                        <h2>Keamanan Transaksi:</h2>
                        <img src="{{ asset('img/godaddy.svg') }}" alt="Payment Security" />
                        <img src="{{ asset('img/norton.svg') }}" alt="Payment Security" />
                        <img src="{{ asset('img/ssl.svg') }}" alt="Payment Security" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Footer Bottom Start -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 copyright">
                    <p>Copyright &copy; <a href="https://htmlcodex.com">Twice But Nice 2021</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/slick/slick.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    @yield('script')
</body>

</html>
