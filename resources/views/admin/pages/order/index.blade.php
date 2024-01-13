<x-layout>

    @push('page_css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    @endpush

    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Order</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
            </a> --}}
        </div>
    </x-slot:title>

    {{-- <div class="mb-3">
        <div class="btn-group">
            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown"
                aria-expanded="false">
                Status Pembayaran
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Lunas</a>
                <a class="dropdown-item" href="#">Menunggu Pembayaran</a>
                <a class="dropdown-item" href="#">Expired</a>
            </div>
        </div>
    </div> --}}

    <div class="col-12">
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
                            <th style="width: 5%">No. Pendaftaran</th>
                            <th style="width: 25%">Nama TPA</th>
                            <th style="width: 25%">Event & Peserta</th>
                            <th style="width: 20%">Total Pembayaran</th>
                            <th style="width: 5%">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $harga = 0 @endphp
                        @foreach($transactions as $transaction)
                        @php $harga += $transaction->payment_amount @endphp
                            <tr>
                                <td>
                                    {{ $transaction->id }}
                                </td>
                                <td>
                                    <a
                                        href="{{ route('admin.detail_order',$transaction->id) }}">
                                        {{ $transaction->user->userProfile->institution_name }}
                                    </a>
                                </td>
                                <td>
                                    <div class="card">
                                        <div class="card-body">
                                            @foreach($transaction->orders as $order)
                                                <span class="font-weight-bold text-dark">
                                                    {{ $order->training->name }}
                                                </span><br>
                                                <span class="text-dark">
                                                    @if(
                                                        $order->training->participant_type == 'santri'
                                                        )
                                                        <ul>
                                                            @foreach(
                                                                $order->orderParticipants as $participant)
                                                                <li>
                                                                    <a
                                                                        href="{{ route('admin.detail_student',$participant->student->id) }}">
                                                                        {{ $participant->student->name }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>

                                                    @elseif(
                                                        $order->training->participant_type == 'staff'
                                                        )
                                                        <ul>
                                                            @foreach(
                                                                $order->orderParticipants as $participant)
                                                                <li>
                                                                    <a
                                                                        href="{{ route('admin.detail_staff',$participant->staff->id) }}">
                                                                        {{ $participant->staff->name }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif

                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span>Rp.  {{ number_format($transaction->payment_amount) }}</span>
                                    <br>
                                    <x-user.order-status :id="$transaction->id" />
                                </td>
                                <td>
                                    <form
                                        action="{{ route('admin.delete_order',$transaction->id) }}"
                                        method="POST" onsubmit="return confirmSubmit()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    {{-- <a class="btn btn-success" href="{{ route('admin.order_qr', $transaction->user->id)  }}"><i class="fas fa-print"></i></a> --}}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <hr>

                <h2 class="btn btn-lg btn-success mt-3">Total : Rp {{ number_format($harga) }} </h2>


            </div>
        </div>
    </div>

    @push('page_js')
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

        <script>
            const table = new DataTable('#dataTable');

            function confirmSubmit() {
                var confirmSubmission = confirm(
                    "Anda yakin ingin menghapus event ini? Event yang sudah dihapus tidak dapat dikembalikan dengan cara apapun."
                );
                return confirmSubmission;
            }

        </script>
    @endpush
</x-layout>
