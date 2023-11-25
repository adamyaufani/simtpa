<x-layout>
    @push('page_css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    @endpush

    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kehadiran Peserta</h1>
        </div>
    </x-slot:title>



    <div class="col-12">
        @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card mb-3">
            <div class="card-header">
                data event
            </div>
            <div class="card-body">

            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="dataTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 5%"></th>
                            <th style="width: 25%">Nama</th>
                            <th style="width: 25%">Keterangan</th>
                            <th style="width: 20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($participants as $participant)
                            <tr>
                                <td></td>
                                <td>
                                    <a
                                        href="{{ route('admin.edit_training',$participant->id) }}">
                                        {{ $participant->student->name }}
                                    </a>
                                </td>
                                <td>
                                    <p>
                                        {{ $participant->eventAttendance->status ?? '' }}
                                    </p>
                                </td>
                                <td>
                                    <div class="d-flex">

                                        {{-- <form
                                            action="{{ route('admin.delete_training',$training->id) }}"
                                        method="POST" onsubmit="return confirmSubmit()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        </form> --}}
                                        {{-- <a href="{{ route('admin.training_attendance',$training->id) }}"
                                        class="btn btn-primary btn-sm ml-2">
                                        peserta
                                        </a> --}}
                                    </div>
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
            function confirmSubmit() {
                var confirmSubmission = confirm(
                    "Anda yakin ingin menghapus event ini? Event yang sudah dihapus tidak dapat dikembalikan dengan cara apapun."
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
