<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Unit TPA Badko Rayon Kasihan</title>

    <!-- Custom fonts for this template-->
    <script src="https://kit.fontawesome.com/f53b268512.js" crossorigin="anonymous"></script>
    {{-- <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}"
    rel="stylesheet"
    type="text/css"> --}}
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    @stack('page_css')

    <style>
        #qr-reader {
            width: 100% !important;
        }
    </style>

</head>

<body id="page-top" class="sidebar-toggled">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion toggled" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="http://localhost:8000/admin">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PanDa TPA <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/admin') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <x-navbar />
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Bootstrap Alert -->
                    <div class="alert alert-info mt-3" role="alert" id="result-alert" style="display: none;">
                        <span id="result-text"></span>
                    </div>
                    <div id="qr-reader" style="width:500px"></div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>
                            Copyright &copy; {{ config('app.name') }}
                            {{ date('Y') }}
                        </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script src="{{ asset('js/html5-qrcode.min.js') }}"></script>

    <script>
        function docReady(fn) {
            if (document.readyState === "complete" || document.readyState === "interactive") {
                setTimeout(fn, 1);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }

        docReady(function() {
            var resultContainer = document.getElementById('result-text');
            var alertContainer = document.getElementById('result-alert');
            var lastResult, countResults = 0;

            function showBootstrapAlert(message, alertType) {
                alertContainer.className = 'alert alert-' + alertType + ' mt-3';
                resultContainer.innerHTML = message;
                alertContainer.style.display = 'block';

                // Sembunyikan alert setelah 3 detik
                setTimeout(function () {
                    alertContainer.style.display = 'none';
                }, 3000);
            }

            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText !== lastResult) {
                    ++countResults;
                    lastResult = decodedText;

                    // Kirim data ke backend menggunakan AJAX
                    $.ajax({
                        type: 'GET',
                        url: decodedText,
                        crossDomain: true,
                        dataType: 'json', // Ubah menjadi 'json' jika respon yang diharapkan adalah JSON
                        success: function(response) {

                            if (response.status == 1) {
                                showBootstrapAlert(response.message, 'success');
                            } else {
                                showBootstrapAlert(response.message, 'danger');
                            }
                        },
                        error: function(error) {
                            showBootstrapAlert('Terjadi kesalahan', 'danger');
                        }
                    });
                }
            }

            var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
                fps: 10,
                qrbox: 250
            });
            html5QrcodeScanner.render(onScanSuccess);
        });
    </script>

    @stack('page_js')

</body>

</html>
