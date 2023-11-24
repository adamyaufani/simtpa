<x-user.layout>
    @push('css')
        <style>
            #countdownCard {
                margin: 0 auto;
            }

            .countdownBox {
                text-align: center;
                padding: 5px;
            }

            .countdownBox h2 {
                font-size: 28px;
                margin: 0;
            }

            .countdownBox p {
                margin: 0;
            }
        </style>
    @endpush

    <div class="row gx-5"> 
        <div class="col-lg-8 offset-lg-2 mb-5 mb-lg-0">

            @if (auth()->check())
                @if ($completeProfileNotification == true)
                    <div class="alert alert-warning" role="alert">
                        Mohon lengkapi data Profil TPA Anda.
                    </div>
                @endif
            @endif

            <div class="card mb-4" id="countdownCard">
                <h5 class="card-header text-center">Pendaftaran FASI ditutup dalam</h5>
                <div class="card-body">
                    <div id="countdown" class="row">
                        <div class="col-3 col-md-3">
                            <div class="countdownBox bg-light mb-3 rounded" id="daysBox">
                                <h2 id="days">00</h2>
                                <p>Hari</p>
                            </div>
                        </div>
                        <div class="col-3 col-md-3">
                            <div class="countdownBox bg-light mb-3 rounded" id="hoursBox">
                                <h2 id="hours">00</h2>
                                <p>Jam</p>
                            </div>
                        </div>
                        <div class="col-3 col-md-3">
                            <div class="countdownBox bg-light mb-3 rounded" id="minutesBox">
                                <h2 id="minutes">00</h2>
                                <p>Menit</p>
                            </div>
                        </div>
                        <div class="col-3 col-md-3">
                            <div class="countdownBox bg-light mb-3 rounded" id="secondsBox">
                                <h2 id="seconds">00</h2>
                                <p>Detik</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-5">
                <div class="card-header">
                    <h5>Laporan FASI 2023</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        

                        <div class="col-md-4">
                            <div class="card bg-light bg-gradient">
                                <div class="card-header fw-bold"><i class="bi bi-cart-fill"> </i> Keranjang ({{ $users_cart }})</div>
                                <div class="card-body">
                                    <p class="m-0">
                                         @foreach($user_with_cart as $user)
                                        {{ $user->userProfile->institution_name }}, 
                                    @endforeach</p>
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-md-4">
                            <div class="card bg-info bg-warning">
                                <div class="card-header fw-bold"><i class="bi bi-hourglass-split"></i> Proses ({{ count($user_with_pending_payment) }})</div>
                                <div class="card-body">  
                                    <p class="m-0">                                       
                                        @foreach($user_with_pending_payment as $user)
                                            {{ $user->user->userProfile->institution_name }},
                                        @endforeach 
                                    </p>
                                   
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-success bg-gradient text-white">
                                <div class="card-header fw-bold"><i class="bi bi-check-square-fill "></i>  </i> Fix ({{ count($user_with_paid_event) }})</div>
                                <div class="card-body">                                   
                                    <p class="m-0">                                        
                                        @foreach($user_with_paid_event as $user)
                                            {{ $user->user->userProfile->institution_name }}, 
                                        @endforeach                                         
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="card-body">
                    <h5 class="mb-3">Laporan Perolehan dana FASI 2023</h5>
                   
                    <div class="progress mb-2" role="progressbar" id="progressBar"
                        aria-label="Laporan Perolehan dana FASi 2023" aria-valuenow="0" aria-valuemin="0"
                        aria-valuemax="100" style="height:25px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%;"
                            id="progressBarValue">
                            <span id="progressText"></span>
                        </div>
                        <span id="terkumpul" style="margin-top:3px;"></span>
                    </div>
                    <p class="">Masih kurang <span class="text-danger fw-bold" id="kebutuhanDanaText"></span> dari total kebutuhan <span class="text-success fw-bold">Rp. 24,000,000</span>. <br>Yuk bantu kami dengan menjadi donatur atau relawan donatur. <a href="https://wa.me/6285157683779?text=Salam Admin, saya ingin berdonasi untuk FASI" target="_blank">Klik di sini.</a></p>
                </div>

            </div>


            <div class="card mb-5">
                <div class="card-header">
                    <h5>Jumlah Anggota Badko TKA-TPA Tiap Kalurahan</h5>
                </div>
                <div class="card-body px-5">
                    <canvas id="myPieChart" width="400" height="300" class="chartjs-render-monitor"></canvas>
                </div>
            </div>

            <div class="card mb-5">
                <div class="card-header">
                    <h5>Kalkulator Usia Santri</h5>
                </div>
                <div class="card-body p-3 pb-2">

                    <form id="ageCalculatorForm" class="mb-3">
                        <label for="tanggalLahir" class="mb-2">Tanggal Lahir: </label>
                        <div class="d-flex">
                            <input type="date" id="tanggalLahir" class="form-control me-2" required>
                            <button type="submit" class="btn btn-danger" style="width:230px;">Hitung Usia</button>
                        </div>
                    </form>

                    <div class="alert" id="hasilUsia" role="alert"></div>

                </div>
            </div>
            <h3 class="fw-bolder mb-4">Agenda Mendatang</h3>


            <ul class="nav nav-tabs mb-3">
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link   @if (url()->full() === route('user.homepage')) active @endif"
                        href="{{ route('user.homepage') }}">Semua Kategori</a>
                </li>

                @foreach ($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link   @if (url()->full() === route('user.homepage') . '/?category=' . $category->id) active @endif"
                            href="{{ route('user.homepage') . '?category=' . $category->id }}">{{ $category->name }}</a>
                    </li>
                @endforeach

            </ul>


            @foreach ($trainings as $training)
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('user.training_detail', $training->id) }}" class="stretched-link">
                                        {{ $training->name }}
                                    </a>
                                </h5>
                                {{-- <p class="card-text">
                                            {{ str()->limit($training->description,300) }}
                                        </p> --}}
                                {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small> --}}
                                {{-- </p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @push('js')
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
        <script>
            // Pie Chart Example
            var ctx = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: [
                        @foreach ($numberOfUsersPerVillages as $numberOfUsersPerVillage)
                            "{{ $numberOfUsersPerVillage['village'] }} ({{ $numberOfUsersPerVillage['users'] }})",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($numberOfUsersPerVillages as $numberOfUsersPerVillage)
                                "{{ $numberOfUsersPerVillage['users'] }}",
                            @endforeach
                        ],
                        backgroundColor: ['#007bff', '#6f42c1', '#dc3545', '#28a745'],
                        hoverBackgroundColor: ['#4a729d', '#7f59c3', '#dd4f5d', '#48c364'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        align: 'left',
                        display: true,
                        fullSize: true,
                        position: 'top',
                        padding: 20,
                        labels: {
                            font: {
                                size: 50
                            },
                        },
                    },
                    cutoutPercentage: 60,
                },
            });
        </script>

        <script>
            document.getElementById('ageCalculatorForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const tanggalLahirInput = document.getElementById('tanggalLahir').value;
                const tanggalLahirObj = new Date(tanggalLahirInput);
                const tanggalReferensiTKA = new Date('2017-07-01');
                const tanggalReferensiTPA = new Date('2012-07-01');
                const tanggalReferensiTQA = new Date('2009-07-01');
                const tanggalReferensiRemaja = new Date('2004-07-01');
                const tanggalReferensiDewasa = new Date('1995-07-01');

                const usia = new Date().getFullYear() - tanggalLahirObj.getFullYear();
                let kategori = '';
                let alertClass = '';

                if (tanggalLahirObj >= tanggalReferensiTKA) {
                    kategori = 'TKA';
                    alertClass = 'alert-primary';
                } else if (tanggalLahirObj >= tanggalReferensiTPA) {
                    kategori = 'TPA';
                    alertClass = 'alert-success';
                } else if (tanggalLahirObj >= tanggalReferensiTQA) {
                    kategori = 'TQA';
                    alertClass = 'alert-info';
                } else if (tanggalLahirObj >= tanggalReferensiRemaja) {
                    kategori = 'Remaja';
                    alertClass = 'alert-warning';
                } else if (tanggalLahirObj >= tanggalReferensiDewasa) {
                    kategori = 'Dewasa';
                    alertClass = 'alert-danger';
                } else {
                    kategori = 'Tua';
                    alertClass = 'alert-dark';
                }

                const hasilUsia = document.getElementById('hasilUsia');
                hasilUsia.textContent = `Usia: ${usia} tahun, Kategori: ${kategori}`;
                hasilUsia.className = `alert ${alertClass}`;
            });
        </script>

        <!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>

        <script>
            function updateCountdown() {
                // Tanggal target
                const targetDate = new Date('December 3, 2023 24:00:00').getTime();

                // Tanggal dan waktu saat ini
                const currentDate = new Date().getTime();

                // Hitung selisih waktu antara target dan saat ini
                const timeDifference = targetDate - currentDate;

                // Hitung hari, jam, menit, dan detik
                const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                // Tampilkan hasil countdown
                document.getElementById('days').innerText = days.toString().padStart(2, '0');
                document.getElementById('hours').innerText = hours.toString().padStart(2, '0');
                document.getElementById('minutes').innerText = minutes.toString().padStart(2, '0');
                document.getElementById('seconds').innerText = seconds.toString().padStart(2, '0');

                // Jika waktu telah habis, tampilkan pesan
                if (timeDifference < 0) {
                    document.getElementById('countdown').innerHTML = 'Waktu telah habis!';
                }
            }

            // Perbarui countdown setiap detik
            setInterval(updateCountdown, 1000);

            // Panggil fungsi untuk pertama kali
            updateCountdown();
        </script>

        <script>
            // Kebutuhan dan jumlah terkumpul
            const kebutuhanDana = 24000000;
            let terkumpul = 2000000;

            // Menghitung persentase terkumpul
            const persentaseTerkumpul = (terkumpul / kebutuhanDana) * 100;

            // Mengatur nilai awal progress bar
            $('#progressBar').attr('aria-valuenow', persentaseTerkumpul);
            $('#progressBarValue').css('width', persentaseTerkumpul + '%');

            // Menampilkan persentase terkumpul dan jumlah dana di dalam progress bar
            $('#progressText').text(persentaseTerkumpul.toFixed(2)   + '% ');

            // Menghitung dan menampilkan kekurangan dana
            const kekuranganDana = kebutuhanDana - terkumpul;
            $('#kebutuhanDanaText').append(' Rp. ' + kekuranganDana.toLocaleString());
            $('#terkumpul').append(' Rp. ' + terkumpul.toLocaleString());

        </script>
    @endpush

</x-user.layout>
