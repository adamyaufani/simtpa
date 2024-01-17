<x-layout>
    @push('page_css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

        <style>
            tr.table-success td {
                background-color: inherit;
            }
        </style>
    @endpush
    <x-slot:title>
        <div class="d-flex align-items-center mb-4">
            <h1 class="h3 mb-0 mr-2 text-gray-800">Daftar TPA</h1>
            <a href="{{ route('admin.create_new_user') }}" class="btn btn-sm btn-primary">
                Tambah
            </a>
        </div>
    </x-slot:title>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="dataTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 5%"></th>
                            <th style="width: 25%">Nama TPA</th>
                            <th style="width: 25%">Alamat Email</th>
                            <th style="width: 20%">Nomor Telepon</th>
                            <th style="width: 25%">Status Pendaftaran</th>
                            <th style="width: 25%">WA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="table-{{ $user->status['badge'] }}">
                                <td></td>
                                <td>
                                    <a href="{{ route('admin.detail_user', $user->id) }}">
                                        {{ $user->userProfile->institution_name }}
                                    </a>
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->userProfile->phone_number }}
                                </td>
                                <td class="">

                                    {{ $user->status['message'] }}

                                </td>
                                <td class="">

                                    <a href="https://api.whatsapp.com/send?phone={{ $user->userProfile->phone_number }}&text=Assalamualaikum Wr Wb. %0A %0A Yth pengurus *TPA {{ $user->userProfile->institution_name }}*, %0A %0AMengharap keikutsertaan Ustadz/ah dalam acara *Training untuk Guru Al Qur'an 'Kupas Tuntas Guru Al-Qur’an,* yang akan diisi oleh *Ustadz Akbar Sandro Yudho Dhiharso, S.Sos.I, M.S.I* (Pembina Tilawah Akbar Center, Trainer dan Motivator) %0A%0AMateri :%0A▪Posisi Strategis Guru Al-Quran%0A ▪Menjadi Guru Al-Quran yang Handal dan Profesional %0A ▪Mengatasi Kendala dan Tantangan Guru Al-Quran %0A%0AInsyaAllah diadakan pada :%0A🗓 Ahad, 28 Januari 2024%0A⏰ 08.00-11.30%0A🏦 Pendopo TPQ Yaa Bunayya Keloran, Tirtonirmolo, Kasihan,Bantul%0A%0AFasilitas%0A▪Snack%0A▪Sertifikat Digital%0A%0AInvestasi%0ARp 20.000 (Anggota Badko Kasihan*)%0ARp 25.000 (Non Anggota Badko Kasihan)%0A%0A*) Anggota Badko Kasihan adalah unit TPA yang berada di Kapanewon Kasihan yang telah terdata pada Pangkalan Data TPA Rayon Kasihan %0A%0A⚠ Kehadiran Unit TPA akan dicatat sebagai keaktifan anggota Badko Kasihan%0A%0A📞 Informasi https://wa.me/6285157683779%0A%0A🖥 Pendaftaran online https://tpa.badkokasihan.web.id%0A%0A🤝Acara ini bekerjasama dengan TPQ Yaa Bunayya Keloran%0A💓Disediakan doorprize Al Qur'an Cantik bagi 10 peserta yang beruntung%0A%0AHormat Kami, %F0%9F%98%8A %0A Badko TKA-TPA Kasihan"
                                        target="_blank" class="mt-3 btn btn-warning"><i class="fab fa-whatsapp"></i>
                                        Chat Peserta</a>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    @push('page_js')
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

        <script>
            const table = new DataTable('#dataTable');

            table
                .on('order.dt search.dt', function() {
                    let i = 1;

                    table
                        .cells(null, 0, {
                            search: 'applied',
                            order: 'applied'
                        })
                        .every(function(cell) {
                            this.data(i++);
                        });
                })
                .draw();
        </script>
    @endpush

</x-layout>
