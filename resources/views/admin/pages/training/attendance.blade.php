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
                Detail Event
            </div>
            <div class="card-body">
                <p>Nama Event : <strong>{{ $training->name }}</strong></p>
                <p>
                    Tanggal Mulai :
                    <strong>{{ $training->start_date->format('d F Y') }}</strong>
                </p>
                <p>
                    Tanggal Selesai :
                    <strong>{{ $training->end_date->format('d F Y') }}</strong>
                </p>
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
                            <th style="width: 20%">Hadir Pukul</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($participants as $participant)
                            <tr>
                                <td></td>
                                <td>
                                    @if(
                                        $training->participant_type == 'santri')
                                        <a
                                            href="{{ route('admin.detail_student',$participant->id) }}">
                                            {{ $participant->student->name }}
                                        </a>
                                    @elseif(
                                        $training->participant_type == 'staff'
                                        )
                                        <a
                                            href="{{ route('admin.detail_staff',$participant->staff->id) }}">
                                            {{ $participant->staff->name }}
                                        </a>
                                    @endif

                                </td>
                                <td>                                  
                                    {{ $participant->eventAttendance->status ?? '' }}                                    
                                </td>
                                <td>
                                    @php 
                                        $date = $participant->eventAttendance->created_at ?? '';
                                 
                                        if($date) {
                                            $datecarbon = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date )->format('H:i:s');
                                        } else {
                                            $datecarbon = $date;
                                        }
                                        @endphp

                                        {{ $datecarbon }}
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
