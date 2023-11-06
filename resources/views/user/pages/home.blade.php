<x-user.layout>


    <div class="row gx-5">
        <div class="col-lg-8 offset-lg-2 mb-5 mb-lg-0">

            <div class="card mb-5">
                <div class="card-header">
                    <h5>Kalkulator Usia Santri</h5>
                </div>
                <div class="card-body p-3 pb-2">                   

                    <form id="ageCalculatorForm" class="mb-3">
                        <label for="tanggalLahir">Tanggal Lahir: </label>
                        <div class="d-flex flex-rows">
                        <input type="date" id="tanggalLahir"  class="form-control me-2"  style="width:80%" required>
                        <button type="submit" class="btn btn-danger" style="width:20%">Hitung Usia</button>
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
        <script>
            document.getElementById('ageCalculatorForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const tanggalLahirInput = document.getElementById('tanggalLahir').value;
                const tanggalLahirObj = new Date(tanggalLahirInput);
                const tanggalReferensiTKA = new Date('2017-07-01');
                const tanggalReferensiTPA = new Date('2012-07-01');
                const tanggalReferensiTQA = new Date('2009-07-01');

                const usia = new Date().getFullYear() - tanggalLahirObj.getFullYear();
                let kategori = '';
                let alertClass = '';

                if (tanggalLahirObj >= tanggalReferensiTKA) {
                    kategori = 'TKA';
                    alertClass = 'alert-success';
                } else if (tanggalLahirObj >= tanggalReferensiTPA) {
                    kategori = 'TPA';
                    alertClass = 'alert-warning';
                } else if (tanggalLahirObj >= tanggalReferensiTQA) {
                    kategori = 'TQA';
                    alertClass = 'alert-danger';
                } else {
                    kategori = 'Kategori lainnya';
                    alertClass = 'alert-info';
                }

                const hasilUsia = document.getElementById('hasilUsia');
                hasilUsia.textContent = `Usia: ${usia} tahun, Kategori: ${kategori}`;
                hasilUsia.className = `alert ${alertClass}`;
            });
        </script>
    @endpush


</x-user.layout>
