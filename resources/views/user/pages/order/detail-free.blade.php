<x-user.layout>
    <div class="col-12">
        <section class="py-5" id="features">
            <div class="container px-5 my-5">
                <h4>Status Pembayaran</h4>
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
                                        <ul class="list-group list-group-flush">
                                            @foreach($order->orderparticipants as $participant)
                                                <li class="list-group-item">
                                                    <span>{{ $participant->student->name }}</span><br>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-6">
                            <span>Total yang harus dibayarkan : <strong>gratis</strong> </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-user.layout>
