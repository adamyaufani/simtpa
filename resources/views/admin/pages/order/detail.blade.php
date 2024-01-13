<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Status Pembayaran</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
            </a> --}}
        </div>
    </x-slot:title>

    <div class="col-12">
        <section id="features">
            <div class="container my-5">
                @if(session()->has('success'))
                    <div class="alert alert-primary" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body row">
                        <div class="col-6">
                            <h5>Keterangan</h5>
                            <h6 class="text-secondary">
                                No :
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
                                                    @if(
                                                        $order->training->participant_type == 'santri')
                                                        <span>{{ $participant->student->name }}</span><br>
                                                    @elseif(
                                                        $order->training->participant_type == 'staff')
                                                        <span>{{ $participant->staff->name }}</span><br>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach

                            @if($data->status === 'Lunas' )

                            <a href="https://api.whatsapp.com/send?phone={{ $data->user->userProfile->phone_number }}&text=Assalamualaikum *TPA {{ $data->user->userProfile->institution_name }}*, %0APembayaran Anda untuk tagihan nomor {{ $data->id }} telah kami terima. %0A%0AKlik di sini untuk melihat nota lunasnya {{ route('user.download_invoice', $data->id) }} %0A%0A*Catatan:*%0A - Mohon membalas dengan *OK* untuk memastikan Anda sudah menerima pesan ini.%0A%0ATerima kasih %F0%9F%98%8A %0ACS Badko TPA Kasihan" target="_blank" class="mt-3 btn btn-success"><i class="fab fa-whatsapp"></i> Chat Peserta</a>
                           

                            {{-- <a href="https://api.whatsapp.com/send?phone={{ $data->user->userProfile->phone_number }}&text=Assalamualaikum *TPA {{ $data->user->userProfile->institution_name }}*, %0A%0AMengharap kehadiran Unit TPA Peserta FASI 2023 dalam acara *Technical Meeting FASI 2023*.%0A%0A🗓 Ahad, 10 Desember 2023%0A🕢 13.00 - selesai%0A📍 SMP Mataram Kasihan (Masjid)
  %0A%0A*Catatan:*%0A - Mohon membalas dengan *OK* untuk memastikan Anda sudah menerima pesan ini.%0A - Satu TPA setidaknya mengirimkan 1 orang perwakilan.%0A - Mohon tunjukkan undangan ini saat presensi.%0A%0ATerima kasih %F0%9F%98%8A %0ACS Badko TPA Kasihan" target="_blank" class="mt-3 btn btn-danger"><i class="fab fa-whatsapp"></i> Chat Undangan TM</a> --}}
                            @else

                            <a href="https://api.whatsapp.com/send?phone={{ $data->user->userProfile->phone_number }}&text=Assalamualaikum *TPA {{ $data->user->userProfile->institution_name }}*, %0Anda memiliki tagihan nomor {{ $data->id }} yang belum dibayar.%0A%0AKlik di sini untuk melihat tagihannya {{ route('user.detail_order', $data->id) }} %0A%0A*Catatan:*%0A - Mohon membalas dengan *OK* untuk memastikan Anda sudah menerima pesan ini.%0A - Silakan abaikan pesan ini jika telah membayar.%0A%0ATerima kasih %F0%9F%98%8A %0ACS Badko TPA Kasihan" target="_blank" class="mt-3 btn btn-warning"><i class="fab fa-whatsapp"></i> Chat Peserta</a>

                            @endif

                        </div>
                        <div class="col-6">
                            <h5 class="text-dark">
                                <b>Detail Pembayaran</b>
                            </h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="text-secondary">
                                        Status Pembayaran
                                        :
                                        <x-user.order-status :id="$data->id" />
                                    </h6>
                                </div>
                            </div>
                            <h5 class="mt-3 text-dark"><b>Nominal Pembayaran</b></h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="text-secondary">
                                        Rp. {{ number_format($data->payment_amount) }}
                                    </h6>

                                 
                                  
                              
                                </div>
                            </div>
                            @if($data->status == "")
                                <h5 class="mt-3 text-dark">
                                    <b>Konfirmasi Pembayaran</b>
                                </h5>
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <a href="{{ route('admin.finish_order',$data->id) }}"
                                            class="btn btn-success">
                                            Pembayaran sudah diterima
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


</x-layout>
