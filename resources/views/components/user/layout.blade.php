<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pangkalan Data TPA Badko Rayon Kasihan</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('vendor/start-bootstrap/css/styles.css') }}" rel="stylesheet" />

    @stack('css')

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-KMVG0EYDWV"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-KMVG0EYDWV');
    </script>

    {{-- <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/6555aa25958be55aeab01514/1hfba1943';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script--> --}}

</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-3 px-md-5">
                <a class="navbar-brand" href="{{ route('user.homepage') }}">
                    <img src="{{ url('img/logo.png') }}" alt=""></a>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">

                    </div>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link @if (url()->full() === route('user.homepage')) active @endif"
                                href="{{ route('user.homepage') }}">Depan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (url()->full() === route('user.org_list')) active @endif"
                                href="{{ route('user.org_list') }}">Data TPA</a>
                        </li>

                        @if (auth()->check())
                            <li class="nav-item">
                                <a class="nav-link @if (url()->full() === route('user.profile')) active @endif"
                                    href="{{ route('user.profile') }}">Profil TPA</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if (url()->full() === route('user.organization')) active @endif"
                                    href="{{ route('user.organization') }}">Organisasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if (url()->full() === route('user.staff')) active @endif"
                                    href="{{ route('user.staff') }}">
                                    Staf Pengajar
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if (url()->full() === route('user.students')) active @endif"
                                    href="{{ route('user.students') }}">
                                    Santri
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if (url()->full() === route('user.order_index')) active @endif"
                                    href="{{ route('user.order_index') }}">
                                    Transaksi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if (url()->full() === route('user.cart_index')) active @endif"
                                    href="{{ route('user.cart_index') }}">
                                    <i class="bi bi bi-cart-check-fill"></i>
                                    Keranjang
                                </a>
                            </li>
                        @endif

                        @if (auth()->check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownPortfolio" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">Ahlan, TPA
                                    {{ auth()->user()->userProfile->institution_name }}</a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownPortfolio">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.letter_index') }}">
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
                            <li class="nav-item"><a title="Lihat Profil TPA" class="nav-link" href="{{ route('public.detail_org', auth()->id()) }}"><i class="bi bi-house"></i></a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.login_form') }}">
                                    Login
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.registration_form') }}">
                                    Daftar
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @if (!auth()->check())
            <!-- Header-->
            <header class="bg-dark py-5 @if (url()->full() != route('user.homepage')) d-none @endif ">
                <div class="container px-5">
                    <div class="row gx-5 align-items-center justify-content-center">
                        <div class="col-lg-8 col-xl-7 col-xxl-6">
                            <div class="my-5 text-center text-xl-start">
                                <h1 class="display-5 fw-bolder text-white mb-2">Pangkalan Data TPA Kapanewon Kasihan
                                </h1>
                                <p class="lead fw-normal text-white-50 mb-4">Unit TPA yang belum bergabung silakan klik
                                    tombol Daftar.</p>
                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                                    <a class="btn btn-danger btn-lg px-4 me-sm-3"
                                        href="{{ route('user.login_form') }}">Login TPA</a>
                                    <a class="btn btn-outline-light btn-lg px-4"
                                        href="{{ route('user.registration_form') }}">Daftar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/F_KZazS0RNY?si=H1C0XF-_8_tqUJ_a" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </header>
        @endif

        <div class="container-fluid">
            <section class="py-3 py-md-5">
                <div class="container px-2 px-md-5 my-2 my-md-5">
                    {{ $slot }}
                </div>
            </section>
        </div>

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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('vendor/start-bootstrap/js/scripts.js') }}"></script>

    @stack('js')
</body>

</html>
