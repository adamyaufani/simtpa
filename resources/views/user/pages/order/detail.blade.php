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
                                        Rp. {{ number_format($data->payment_amount) }}
                                    </h6>
                                </div>
                            </div>
                            <h5 class="mt-3"><b>Alamat Pembayaran</b></h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="text-secondary">
                                        BSI no. <strong>714-775-842-6</strong> an Yaufani Adam
                                    </h6>
                                </div>
                            </div>
                            <h5 class="mt-3"><b>Konfirmasi Pembayaran</b></h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <span class="text-secondary">
                                        kirimkan bukti pembayaran ke nomor :
                                    </span>
                                    <h6 class="text-secondary">
                                        0856 256 3456 
                                    </h6>
                                    <a href="https://wa.me/628562563456?text=Salam,%20Saya%20ingin%20konfirmasi%20pembayaran%20Pendaftaran%20FASI" class="btn btn-success"><i class="bi bi-whatsapp"></i> Chat Admin</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-user.layout>
