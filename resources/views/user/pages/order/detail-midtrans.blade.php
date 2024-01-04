<x-user.layout>
    <div class="col-12">
        <section class="py-5" id="features">
            <div class="container px-5 my-5">
                <h4>Pembayaran</h4>
                <div class="card">
                    <div class="card-body row">
                        <div class="col-6">
                            <h5>Keterangan</h5>
                            <h6 class="text-secondary">
                                ID Pendaftaran :
                                {{ $data->id }}
                            </h6>
                            @foreach($data->orders as $order)
                                <div class="mt-3 d-flex">
                                    <div>
                                        <span><b>{{ $order->training->name }}</b></span>
                                    </div>
                                </div>
                                <h6>Peserta</h6>
                                <div class="card">
                                    <div class="card-body">
                                        @if(
                                            $order->training->participant_type == 'santri')
                                            <ul class="list-group list-group-flush">
                                                @foreach($order->orderparticipants as $participant)
                                                    <li class="list-group-item">
                                                        <span>{{ $participant->student->name }}</span><br>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @elseif(
                                            $order->training->participant_type == 'staff'
                                            )
                                            <ul class="list-group list-group-flush">
                                                @foreach($order->orderparticipants as $participant)
                                                    <li class="list-group-item">
                                                        <span>{{ $participant->staff->name }}</span><br>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-6">
                            <h5><b>Detail Pembayaran</b></h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="text-secondary">
                                        Status Pembayaran
                                        :
                                        <x-user.order-status :id="$data->id" />
                                    </h6>
                                </div>
                            </div>
                            <h5 class="mt-3"><b>Nominal Pembayaran</b></h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="text-secondary">
                                        Rp. {{ $data->payment_amount }}
                                    </h6>
                                </div>
                            </div>
                            @if(
                                $data->status != '')
                                <h5 class="mt-3"><b>Tanggal Pembayaran</b></h5>
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="text-secondary">
                                            {{ $data['order']['payment_date']->isoFormat("D MMMM Y, H:mm") }}
                                        </h6>
                                    </div>
                                </div>
                            @endif

                            @if(
                                $data->status == '')
                                <form action="{{ route('user.pay_order',$data->id) }}"
                                    method="GET">
                                    <div class="d-grid gap-2 mt-3">
                                        <button class="btn btn-primary" type="submit">Bayar</button>
                                    </div>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('js')
        {{-- <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ $midtransClientKey }}">
        </script>
        <script type="text/javascript">
            // For example trigger on button clicked, or any time you need
            var payButton = document.getElementById('open-payment-modal');
            var transactionToken = "{{ $data['snapToken'] }}"
            payButton.addEventListener('click', function () {
                // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                window.snap.pay(transactionToken);
                // customer will be redirected after completing payment pop-up
            });

        </script> --}}
    @endpush
</x-user.layout>
