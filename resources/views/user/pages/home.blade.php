<x-user.layout>
    <div class="row gx-5">
        <div class="col-lg-8 offset-lg-2 mb-5 mb-lg-0">
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
    @endpush



</x-user.layout>
