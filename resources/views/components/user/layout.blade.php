<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SIM TPA</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('vendor/start-bootstrap/css/styles.css') }}" rel="stylesheet" />

    @stack('css')
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand" href="{{ route('user.homepage') }}">UNIT TPA</a>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        @if(auth()->check())
                            <a class="nav-link" href="{{ route('user.profile') }}">Profil TPA</a>
                            <a class="nav-link" href="{{ route('user.cart_index') }}">
                                <i class="bi bi bi-cart-check-fill"></i>
                                Keranjang
                            </a>
                        @endif
                    </div>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        @if(auth()->check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownPortfolio" href="#" role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">{{ auth()->user()->userProfile->institution_name }}</a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownPortfolio">
                                    <li><a class="dropdown-item"
                                            href="{{ route('user.profile') }}">Profil TPA</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('user.organization') }}">Pengurus</a></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.staff') }}">
                                            Staf Pengajar
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.students') }}">
                                            Santri
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('user.order_index') }}">
                                            Aktifitas
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('user.letter_index') }}">
                                            Surat
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.charter') }}">
                                            Piagam
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.logout') }}">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.login_form') }}">
                                    Login
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.registration_form') }}">
                                    Register
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        {{ $slot }}
    </main>
    <!-- Footer-->
    <footer class="bg-dark py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0 text-white">Copyright &copy; {{ config('app.name') }}
                        {{ date('Y') }}</div>
                </div>
                {{-- <div class="col-auto"> --}}
                {{-- <a class="link-light small" href="#!">Privacy</a> --}}
                {{-- <span class="text-white mx-1">&middot;</span> --}}
                {{-- <a class="link-light small" href="#!">Terms</a> --}}
                {{-- <span class="text-white mx-1">&middot;</span> --}}
                {{-- <a class="link-light small" href="#!">Contact</a> --}}
                {{-- </div> --}}
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('vendor/start-bootstrap/js/scripts.js') }}"></script>

    @stack('js')
</body>

</html>
