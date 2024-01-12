<x-user.layout>
    <h4>No. Tagihan :
        {{ $data->id }}</h4>
    <div class="card">
        <div class="card-body row">
            <div class="col-12 col-md-6">

                @foreach ($data->orders as $order)
                    @foreach ($order->orderparticipants as $participant)
                        <div class="card mb-3">
                            <div class="card-header text-center">
                                <h5 class="mb-0">{{ $order->training->name }}</h5>
                                    {{ $order->training->start_date->isoFormat('D MMMM Y, H:mm') }}
                            </div>
                            <div class="card-body text-center d-flex align-items-center justify-content-center"
                                style="min-height:50vh">
                                <div class="d-flex flex-column">
                                    @if ($data->status == 'Lunas')
                                        <h6 class="badge text-bg-success">E-Ticket</h6>                                        
                                        {{ QrCode::size(200)->generate(route('admin.scan_training_attendance', $participant->id)) }}
                                    @endif
                                    <h4 class="mt-2 mb-0">
                                        @if ($order->training->participant_type == 'santri')
                                            {{ $participant->student->name }}
                                        @else
                                            {{ $participant->staff->name }}
                                        @endif
                                    </h4>
                                    TPA {{ $data->user->userProfile->institution_name }}
                                </div>
                            </div>
                            <div class="card-footer text-center text-muted">
                                <small>
                                    @if ($data->status == 'Lunas')
                                        Screenhoot QR Code ini lalu tunjukkan ke petugas loket untuk discan.
                                    @else
                                        Tiket belum lunas.
                                    @endif
                                </small>
                            </div>
                        </div>
                    @endforeach
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
                            @if ($data->status == 'Lunas')
                                <a href="{{ route('user.download_invoice', $data->id) }}" class="badge bg-success">
                                    Download Invoice
                                </a>
                            @endif
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
                            Kirimkan foto bukti pembayaran Anda ke nomor : <strong>0851 5768 3779</strong>
                        </span><br>

                        <a href="https://wa.me/6285157683779?text=Salam,%20Saya%20ingin%20konfirmasi%20pembayaran%20Pendaftaran%20{{ $order->training->name }}"
                            class="btn btn-success mt-2"><i class="bi bi-whatsapp"></i> Chat Admin</a>
                    </div>
                </div>

            </div>
        </div>
    </div>


</x-user.layout>
