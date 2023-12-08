<x-layout>

    @push('page_css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    @endpush

    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Rekap Transaksi</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
            </a> --}}
        </div>
    </x-slot:title>



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
                            <th style="width: 20%">Total Pembayaran</th>
                            <th style="width: 25%">Keterangan</th>
                            <!-- <th style="width: 5%">Opsi</th> -->
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
                                    <span>Rp.  {{ number_format($transaction->payment_amount) }}</span>
                                
                                    
                                </td>
                                <td>
                                    
                                </td>
                                <!-- <td>
                                    
                                </td> -->
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    <script>
        const table = new DataTable('#dataTable', {
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ]
        });
    </script>
    @endpush
</x-layout>
