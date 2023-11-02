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
            <div class="card-header d-block d-md-flex justify-content-start">              
                    <span class="text-dark font-weight-bold me-3"><i class="bi bi-calendar"></i>
                        {{ $transaction->transaction_date->isoFormat('D MMMM Y') }}
                    </span>
                    <span class=" me-3"><i class="bi bi-tag"></i> No. Invoice : {{ $transaction->id }}</span>
                
                    <span><x-user.order-status :id="$transaction->id" /> </span>              
            </div>
            <div class="card-body">
                @foreach ($transaction->orders as $order)
                    <h5 class="card-title">
                        {{ $order->training->name }}
                    </h5>
                    
                @endforeach

                <div class="">
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
