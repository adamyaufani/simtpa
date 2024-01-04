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
                                        @if($data->status == 'Lunas')
                                            <a href="{{ route('user.download_invoice',$data->id) }}"
                                                class="badge bg-success">
                                                Download Invoice
                                            </a>
                                        @endif
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
                            <h5 class="mt-3"><b>Alamat Pembayaran</b></h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="text-secondary">
                                        04820-23424-23425-456
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
                                        04820-23424-23425-456
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-user.layout>
