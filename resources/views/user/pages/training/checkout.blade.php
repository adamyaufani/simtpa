<x-user.layout>
    <form action="{{ route('user.store_completed_order',$orderId) }}" method="POST">
        <div class="col-12">
            <section class="py-5" id="features">
                <div class="container px-5 my-5 d-flex">
                    @csrf
                    <input type="hidden" name="training_id" value="{{ $training->id }}">
                    <input type="hidden" name="order_id" value="{{ $orderId }}">
                    <div class="col-9 me-3">
                        <h4>Data Peserta</h4>
                        @php
                            $i = 0;
                        @endphp
                        @foreach($participants as $participant)
                            @php
                                $i++;
                            @endphp
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5>Peserta {{ $i }}</h5>
                                    <input type="hidden" name="id[]" class="form-control"
                                        value="{{ $participant['id'] }}">
                                    <div class="mb-3">
                                        <small class="form-label text-secondary"><b>Nama lengkap</b></small>
                                        <input type="text" name="fullname[]" class="form-control">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-3">
                        <h4>Detail Pembayaran</h4>
                        <div class="card">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td><span class="text-secondary">Harga Training</span></td>
                                        <td><span class="ms-3">Rp. {{ $price }}</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-secondary">Jumlah Peserta</span></td>
                                        <td><span class="ms-3">{{ $numberOfParticipants }} orang</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-secondary">Total</span></td>
                                        <td><span class="ms-3">Rp. {{ $totalPrice }}</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="d-grid gap-2 mt-2">
                            <button class="btn btn-primary" type="submit">Lanjut ke pembayaran</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </form>

    @push('js')
        <script>

        </script>
    @endpush
</x-user.layout>
