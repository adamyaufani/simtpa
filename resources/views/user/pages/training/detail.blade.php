<x-user.layout>
    <div class="col-12">
        <section class="py-2 p-md-5" id="features">
            <div class="container px-5 my-5">
                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <div class="row mb-5">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <img src="{{ route('training.image').'?q='.$training->image }}"
                            class="rounded img-thumbnail" alt="...">
                    </div>
                    <div class="col-lg-4">
                        <h4 class="mb-3">{{ $training->name }}</h4>
                        <h5>Rp. @php echo number_format($training->price_normal) @endphp </h5>
                        <div class="mb-3">
                            <span>Tanggal Mulai</span>
                            <p class="text-secondary">{{ $training->start_date->isoFormat('D MMMM Y') }} {{ $training->start_date->isoFormat('HH:MM') }}</p>
                            <span>Tanggal Selesai</span>
                            <p class="text-secondary">{{ $training->end_date->isoFormat('D MMMM Y') }} {{ $training->end_date->isoFormat('HH:MM') }}</p>
                            <p class="text-secondary">Kuota/unit : {{ $leftoverQuota }}</p>

                            <h5>Deskripsi</h5>
                            <p class="text-break">{{ $training->description }}</p>

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h5>Daftar</h5>

                                @if($leftoverQuota > 0 )
                                
                                <span class="text-secondary">
                                    Masukkan Jumlah Peserta
                                </span>
                                <br>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <input name="training_id" type="hidden" value="{{ $training->id }}"
                                            id="training_id">
                                        <input name="qty" type="number"
                                            class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}"
                                            id="qty" min="1" max="{{ $leftoverQuota }}" value='1'>
                                        <small class="invalid-feedback">
                                            {{ $errors->first('qty') }}
                                        </small>
                                    </div>
                                </div>
                                
                                <div class="d-grid gap-2 mt-3">                                    
                                    <a href="#" class="btn btn-success" id="order">
                                        Daftar
                                    </a>                                    
                                </div>
                                @else

                                <p class="alert alert-warning"><i class="bi bi-exclamation-triangle"></i> Anda sudah terdaftar.</p>

                                @endif

                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </section>
    </div>

    @push('js')
        <script>
            var link = document.getElementById("order");

            link.addEventListener("click", function () {
                var numericField = document.getElementById("qty");
                var q = numericField.value;
                var targetUrl = `{{ route('user.order_training',$training->id) }}` +
                    `?q=${q}`;

                window.location.href = targetUrl;
            });

        </script>
    @endpush
</x-user.layout>
