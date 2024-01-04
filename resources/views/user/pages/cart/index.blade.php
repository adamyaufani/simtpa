<x-user.layout>
    <div class="col-12">
        <section class="py-5" id="features">
            <div class="container px-5 my-5">

                <h4 class="mb-3">Keranjang</h4>

                <div class="card">
                    <div class="card-body">
                        @if(session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                        @if(count($orders['items']) > 0)

                            @foreach($orders['items'] as $order)

                                <div class="d-flex justify-content-between border rounded mb-3 px-3 py-2">

                                    <div class="item-name">
                                        <strong>{{ $order['training']['name'] }}</strong>
                                        <br>
                                        <ul>
                                            @foreach(
                                                $order['items'] as $item)
                                                <li class="list-group-item">
                                                    {{ $order['training']['participant_type'] == 'santri' ? $item['student']['name'] : $item['staff']['name'] }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="d-flex justify-content-between">
                                            <p class="fs-5 mb-0"><span class="">Rp</span>
                                                <span>
                                                    {{ $order['training']['price_normal'] }}
                                                </span>

                                                x {{ count($order['items']) }} =
                                                <span class=" text-danger">
                                                    <span class="">Rp</span>
                                                    <span class="subtotal">
                                                        {{ $order['price'] }}
                                                    </span>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <form
                                            action="{{ route('user.remove_from_cart',$order['id']) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            @endforeach
                            <div class="card-footer d-flex justify-content-between">
                                <div class="di">
                                    <strong>Total</strong>
                                    <p class="fs-5 text-danger fw-bold">
                                        Rp {{ $orders['total_price'] }}
                                    </p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('user.homepage') }}"
                                        class="btn btn-primary btn-md mx-1">
                                        Tambah
                                    </a>
                                    <a href="{{ route('user.buy_cart') }}"
                                        class="btn btn-success btn-md">
                                        Lanjut bayar
                                    </a>
                                </div>
                            </div>
                        @else
                            <p class="text-center">Keranjang Anda Kosong</p>
                        @endif

                    </div>
                </div>
        </section>
    </div>
</x-user.layout>
