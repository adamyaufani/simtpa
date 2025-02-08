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

                                    @php
                                        $tpa = str_replace(" ","-", $user->userProfile->institution_name);
                                    @endphp

                                </td>
                                <td class="">

                                    <a href="https://api.whatsapp.com/send?phone={{ $user->userProfile->phone_number }}&text=Assalamualaikum Wr Wb. %0A %0A Yth Direktur *TPA {{ $user->userProfile->institution_name }}*, %0A %0AMengharap keikutsertaan TPA {{ $user->userProfile->institution_name }} dalam acara *Badko Kasihan Berkisah,* bersama *Kak Bimo* (Juru Kisah Nasional) yang InsyaAllah diadakan pada :%0A🗓 Ahad, 16 Februari 2025%0A⏰ 07.00-selesai%0A🏦 Gedung Griyo Nirmolo (Kalurahan Tirtonirmolo), Kasihan%0A%0A📞 Undangan dan informasi selengkapnya di https://rsvp.walima.id/badko-kasihan-berkisah?n={{ $tpa }} %0A%0ADemikian undangan ini kami sampaikan,. atas perhariannya kami ucapkan jazakumullahu khairan.%0A%0AHormat Kami, %0A% %F0%9F%98%8A Badko TKA-TPA Kasihan"
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
