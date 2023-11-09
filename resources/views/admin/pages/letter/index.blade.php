<x-layout>
    @push('page_css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    @endpush

    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Surat</h1>
            <a href="{{ route('admin.create_letter') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Surat Baru
            </a>
        </div>
    </x-slot:title>

    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table id="dataTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 5%"></th>
                        <th style="width: 20%">Nomor Surat</th>
                        <th style="width: 45%">Judul Surat</th>
                        <th style="width: 20%">Tanggal Diterbitkan</th>
                        <th style="width: 10%">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($letters as $letter)
                        <tr>
                            <td></td>
                            <td>
                                <a href="{{ route('admin.detail_letter',$letter->id) }}">
                                    {{ $letter->letter_number }}
                                </a>
                            </td>
                            <td>{{ $letter->subject }}</td>
                            <td>{{ $letter->created_at }}</td>
                            <td>
                                <form action="{{ route('admin.delete_letter',$letter->id) }}"
                                    method="POST" onsubmit="return confirmSubmit()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @push('page_js')
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
        <script>
            function confirmSubmit() {
                var confirmSubmission = confirm(
                    "Anda yakin ingin menghapus surat ini? Surat yang sudah dihapus tidak dapat dikembalikan dengan cara apapun."
                );
                return confirmSubmission;
            }

            const table = new DataTable('#dataTable');

            table
                .on('order.dt search.dt', function () {
                    let i = 1;

                    table
                        .cells(null, 0, {
                            search: 'applied',
                            order: 'applied'
                        })
                        .every(function (cell) {
                            this.data(i++);
                        });
                })
                .draw();

        </script>
    @endpush

</x-layout>
