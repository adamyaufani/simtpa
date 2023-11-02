<x-user.layout>

    <h4 class="mb-3">Transaksi</h4>
    <div class="btn-group mb-3">
        {{-- <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Status Pembayaran
                    </button> --}}
        {{-- <ul class="dropdown-menu"> --}}
        {{-- <li>
                            <a class="dropdown-item"
                                href="{{ route('user.order_index').'?q=lunas' }}">
                    Lunas
                    </a>
                    </li> --}}
        {{-- <li>
                            <a class="dropdown-item"
                                href="{{ route('user.order_index').'?q=pending' }}">
                    Menunggu Pembayaran
                    </a>
                    </li> --}}
        {{-- <li>
                            <a class="dropdown-item"
                                href="{{ route('user.order_index').'?q=expired' }}">
                    Expired
                    </a>
                    </li> --}}
        {{-- </ul> --}}
    </div>
    @foreach ($transactions as $transaction)
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <span class="text-dark font-weight-bold">
                        {{ $transaction->transaction_date->isoFormat('D MMMM Y') }}
                    </span>
                    <br>
                    <span>ID Pendaftaran : {{ $transaction->id }}</span>
                </div>
                <div>
                    <x-user.order-status :id="$transaction->id" />
                </div>
            </div>
            <div class="card-body">
                @foreach ($transaction->orders as $order)
                    <h5 class="card-title">
                        {{ $order->training->name }}
                    </h5>
                    <p class="card-text">
                        Tanggal Mulai :
                        {{ $order->training->start_date->isoFormat('D MMMM Y, H:mm') }}
                    </p>
                    <span class="card-text">
                        Tanggal Selesai :
                        {{ $order->training->end_date->isoFormat('D MMMM Y, h:mm') }}
                    </span>
                    <hr>
                @endforeach

                <div class="d-flex justify-content-end">
                    <a href="{{ route('user.detail_order', $transaction->id) }}"
                        class="btn btn-primary btn-sm stretched-link">
                        Detail
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    {{ $transactions->links() }}

</x-user.layout>
