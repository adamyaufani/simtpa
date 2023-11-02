<x-user.layout>


    <h4 class="mb-3">Keranjang</h4>

    <div class="card">
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif

            @if (count($orders['items']) > 0)

                @foreach ($orders['items'] as $order)
                    <div class="d-block d-md-flex justify-content-between border rounded mb-3 px-3 py-2">

                        <div class="item-name">
                            <strong>{{ $order['training']['name'] }}</strong>
                            <div class="d-flex justify-content-between">
                                <p class="fs-5 mb-0"><span class="">Rp</span>
                                    <span>
                                        {{ number_format($order['training']['price_normal']) }}
                                    </span>

                                    x {{ count($order['items']) }} =
                                    <span class=" text-danger">
                                        <span class="">Rp</span>
                                        <span class="subtotal">
                                            {{ number_format($order['price']) }}
                                        </span>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-2 mt-md-0">
                            <form action="{{ route('user.remove_from_cart', $order['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
                <div class="card-footer d-block d-md-flex justify-content-between">
                    <div class="di">
                        <strong>Total</strong>
                        <p class="fs-5 text-danger fw-bold">
                            Rp {{ number_format($orders['total_price']) }}
                        </p>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('user.homepage') }}" class="btn btn-primary btn-md mx-1">
                            Tambah
                        </a>
                        <a href="{{ route('user.buy_cart') }}" class="btn btn-success btn-md">
                            Lanjut bayar
                        </a>
                    </div>
                </div>
            @else
                <p class="text-center">Keranjang Anda Kosong</p>
            @endif


        </div>
</x-user.layout>
