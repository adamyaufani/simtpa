<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Orders</h1>
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

    @foreach($transactions as $transaction)
        <div class="card mb-2">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <span class="text-dark font-weight-bold">
                        {{ $transaction->transaction_date }}
                    </span>
                    <br>
                    <span>ID Pendaftaran : {{ $transaction->id }}</span>
                </div>
                <div>
                    <x-user.order-status :id="$transaction->id" />
                </div>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.detail_order',$transaction->id) }}"
                    class="stretched-link" style="text-decoration: none;">
                    @foreach($transaction->orders as $order)
                        <span class="font-weight-bold text-dark">
                            {{ $order->training->name }}
                        </span><br>
                        <span class="text-dark">
                            {{ $order->orderparticipants->count() }} peserta
                        </span><br>
                    @endforeach
                    {{-- {{ $transaction->training()->first()->name }} --}}
                </a>
            </div>
            <div class="card-footer">
                <span>Total Pembayaran : Rp. {{ $transaction->payment_amount }}</span>
            </div>
        </div>
    @endforeach

    {{ $transactions->links() }}

</x-layout>
