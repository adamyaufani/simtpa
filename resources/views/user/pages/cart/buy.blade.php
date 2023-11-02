<x-user.layout>
    <h4 class="mb-3">Detail Pembelian</h4>

    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('success') }}
                        </div>
                    @endif


                    @foreach ($orders['items'] as $order)
                        <div class="d-flex justify-content-between border rounded mb-3 px-3 py-2">

                            <div class="item-name">
                                <strong>{{ $order['training']['name'] }}</strong>
                                <div class="d-flex justify-content-between">
                                    <p class="fs-5 mb-0"><span class="">Rp</span>
                                        <span>
                                            {{ $order['training']['price_normal'] }}
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
                            <div class="d-none align-items-center">
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


                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.store_order') }}" method="POST">
                        <strong>Total</strong>
                        <p class="fs-5 text-danger fw-bold">
                            Rp {{ number_format($orders['total_price']) }}
                        </p>
                        <select name="payment_method"
                            class="form-control {{ $errors->has('payment_method') ? 'is-invalid' : '' }}">
                            <option>
                                Pilih Metode Pembayaran
                            </option>
                            @foreach ($paymentMethods as $item)
                                <option value="{{ $item->value }}">
                                    {{ $item->value }}
                                </option>
                            @endforeach
                        </select>
                        <span class="invalid-feedback">
                            {{ $errors->first('payment_method') }}
                        </span>
                        @csrf
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-primary" type="submit">
                                Bayar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-user.layout>
