<x-user.layout>
    <div class="col-12">
        <section class="py-5" id="features">
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
                        <div class="mb-3">
                            <span>Tanggal Mulai</span>
                            <p class="text-secondary">{{ $training->start_date }}</p>
                            <span>Tanggal Selesai</span>
                            <p class="text-secondary">{{ $training->end_date }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h5>Harga</h5>
                                <h5>Rp. {{ $training->normal }}</h5>
                                <span class="text-secondary">
                                    Jumlah Peserta
                                </span>
                                <br>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <input name="training_id" type="hidden" value="{{ $training->id }}"
                                            id="training_id">
                                        <input name="qty" type="number"
                                            class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}"
                                            id="qty" min="1">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-8">
                        <h5>Deskripsi</h5>
                        <p class="text-break">{{ $training->description }}</p>
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
