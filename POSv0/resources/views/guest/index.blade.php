<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Point Of Sale') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- AdminLTE & Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    @include('guest.style')
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark bg-custom-green">
            <div class="container">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <span class="brand-text font-weight-bold">{{ $title ?? 'POS System' }}</span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Search Form -->
                    <form class="form-inline navbar-search mx-auto my-3">
                        <div class="input-group w-100">
                            <input id="search-input" class="form-control" type="search"
                                placeholder="Search products, categories..." aria-label="Search">
                            <i class="fas fa-search search-icon"></i>
                        </div>
                        <div id="search-suggestions">
                            <!-- Search suggestions will be populated here -->
                        </div>
                    </form>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a class="nav-link header-icon" href="#" id="cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge">3</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link header-icon" href="#" id="history-icon">
                            <i class="fas fa-history"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#" id="profile-dropdown">
                            <div class="user-profile">
                                @if($auth->photo)
                                <img src="/storage/uploads/photo/{{ $auth->photo }}" alt="User Profile">
                                @else
                                <img src="/userNoImage.webp" alt="User Profile">
                                @endif
                                <span class="d-none d-md-inline text-white">{{ $auth != null ? $auth->nama : 'Guest' }}</span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            @if($auth != null)
                            <a href="#" onclick="onShowProfile()" class="dropdown-item">
                                <i class="fas fa-user"></i> My Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logout" class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            @else
                            <a href="/login" class="dropdown-item">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                            @endif
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Hero Section -->
        <div id="hero-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#hero-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#hero-carousel" data-slide-to="1"></li>
                <li data-target="#hero-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <!-- First Slide -->
                <div class="carousel-item active">
                    <div class="container py-5">
                        <div class="row align-items-center">
                            <div class="col-md-12 text-center position-relative">
                                <img src="https://blog.bankmega.com/wp-content/uploads/2022/11/Makanan-Khas-Tradisional.jpg"
                                    alt="POS System" style="height: 500px; width: 100%; object-fit: cover;" class="img-fluid">
                                <!-- Teks pada gambar -->
                                <div class="text-overlay p-3 text-white">
                                    <h3 class="mb-1">Makanan Khas Tradisional</h3>
                                    <p>Nikmati cita rasa tradisional yang lezat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Second Slide -->
                <div class="carousel-item">
                    <div class="container py-5">
                        <div class="row align-items-center">
                            <div class="col-md-12 text-center position-relative">
                                <img src="https://blog.bankmega.com/wp-content/uploads/2022/11/Makanan-Khas-Tradisional.jpg"
                                    alt="POS System" style="height: 500px; width: 100%; object-fit: cover;" class="img-fluid">
                                <!-- Teks pada gambar -->
                                <div class="text-overlay p-3 text-white">
                                    <h3 class="mb-1">Makanan Khas Tradisional</h3>
                                    <p>Nikmati cita rasa tradisional yang lezat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Third Slide -->
                <div class="carousel-item">
                    <div class="container py-5">
                        <div class="row align-items-center">
                            <div class="col-md-12 text-center position-relative">
                                <img src="https://blog.bankmega.com/wp-content/uploads/2022/11/Makanan-Khas-Tradisional.jpg"
                                    alt="POS System" style="height: 500px; width: 100%; object-fit: cover;" class="img-fluid">
                                <!-- Teks pada gambar -->
                                <div class="text-overlay p-3 text-white">
                                    <h3 class="mb-1">Makanan Khas Tradisional</h3>
                                    <p>Nikmati cita rasa tradisional yang lezat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a class="carousel-control-prev bg-dark" href="#hero-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next bg-dark" href="#hero-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper bg-white">
            <div class="content">
                <div class="container py-5">
                    <h2 class="text-center mb-5">Features</h2>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card feature-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-cash-register text-success fa-3x mb-3"></i>
                                    <h5 class="card-title">Quick Sales</h5>
                                    <p class="card-text">Process transactions quickly and efficiently with our
                                        intuitive
                                        interface.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card feature-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-chart-line text-success fa-3x mb-3"></i>
                                    <h5 class="card-title">Sales Analytics</h5>
                                    <p class="card-text">Get detailed insights into your business performance with
                                        advanced reporting.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card feature-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-box text-success fa-3x mb-3"></i>
                                    <h5 class="card-title">Inventory Management</h5>
                                    <p class="card-text">Keep track of your stock levels and get alerts when items are
                                        running low.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4 mb-4">
                            <div class="card feature-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-users text-success fa-3x mb-3"></i>
                                    <h5 class="card-title">Customer Management</h5>
                                    <p class="card-text">Build customer loyalty with profiles, purchase history, and
                                        targeted promotions.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card feature-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-mobile-alt text-success fa-3x mb-3"></i>
                                    <h5 class="card-title">Mobile Friendly</h5>
                                    <p class="card-text">Access your POS system from any device, anywhere, anytime.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card feature-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-shield-alt text-success fa-3x mb-3"></i>
                                    <h5 class="card-title">Secure Payments</h5>
                                    <p class="card-text">Process payments securely with multiple payment options and
                                        encryption.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="main-footer bg-light">
            <div class="container py-4">
                <div class="row">
                    <div class="col-md-6">
                        <h5>About Us</h5>
                        <p>We provide modern point of sale solutions for businesses of all sizes.</p>
                    </div>

                    <div class="col-md-6">
                        <h5>Contact</h5>
                        <p>
                            <i class="fas fa-envelope mr-2"></i> info@posystem.com<br>
                            <i class="fas fa-phone mr-2"></i> +1 (123) 456-7890
                        </p>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <p>&copy; {{ date('Y') }} POS System. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    @include('guest.profile')
    <!-- Scripts -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
     <!-- SweetAlert2 -->
     <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    @include('guest.script')
</body>

</html>
