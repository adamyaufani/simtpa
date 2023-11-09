<x-user.layout>
    <h4>Status Pembayaran</h4>
    <div class="card">
        <div class="card-body row">
            <div class="col-12 col-md-6">              
                <h5><b>
                    No. Tagihan :
                    {{ $data->id }}
                    </b>
                </h5>
               
                @foreach ($data->orders as $order)
                               
                    <div class="card mb-3">
                        <div class="card-header"><h5>{{ $order->training->name }}</h5></div>
                        <div class="card-body p-1">
                            <ul class="list-group list-group-flush">
                                @foreach ($order->orderparticipants as $participant)
                                    <li class="list-group-item">
                                        <span>{{ $participant->student->name }}</span><br>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-12 col-md-6 mt-3 mt-md-0">
                <h5><b>Detail Pembayaran</b></h5>
                <div class="card bg-light">
                    <div class="card-body">
                        <h6 class="text-secondary">
                            Nominal : <strong>Rp. {{ number_format($data->payment_amount) }}</strong>
                        </h6>
                        <h6 class="text-secondary">
                            Status Pembayaran
                            :
                            <x-user.order-status :id="$data->id" />
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
                            Kirimkan foto bukti pembayaran Anda ke nomor : <strong>0856 256 3456</strong>
                        </span><br>
                      
                        <a href="https://wa.me/628562563456?text=Salam,%20Saya%20ingin%20konfirmasi%20pembayaran%20Pendaftaran%20FASI%202023"
                            class="btn btn-success mt-2"><i class="bi bi-whatsapp"></i> Chat Admin</a>
                    </div>
                </div>

            </div>
        </div>
    </div>


</x-user.layout>
