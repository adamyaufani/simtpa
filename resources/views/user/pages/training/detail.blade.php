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
                            <p class="text-secondary">Sisa kuota {{ $leftoverQuota }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h5>Early Bird</h5>
                                <h5>Rp. {{ $training->price_earlybird }}</h5>
                                <span class="text-secondary">
                                    Jumlah Peserta
                                </span>
                                <br>
                                <form
                                    action="{{ route('user.create_training_order',$training->id) }}"
                                    method="POST">
                                    @csrf
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <input name="training_id" type="hidden" value="{{ $training->id }}">
                                            <input name="qty" type="number"
                                                class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}"
                                                id="qty" min="1">
                                            <small class="invalid-feedback">
                                                {{ $errors->first('qty') }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 mt-3">
                                        <button type="submit" class="btn btn-success">
                                            Daftar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-8">
                        <h5>Deskripsi</h5>
                        <p class="text-break">{{ $training->description }}</p>
                    </div>
                    <div class="col-lg-4">
                        <h6>Pemateri</h6>
                        <p class="text-secondary">Pelatihan akan dibawakan oleh :</p>
                        <div class="row">
                            <div class="col-2">
                                <div style="max-width: 70px; max-height: 70px;min-width: 70px; min-height: 70px">
                                    <div class="img-thumbnail rounded-circle" style="background-image:
                                            url('https://dummyimage.com/600x400/000/fff');background-size:cover;background-position:
                                            center;height: 70px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-9 ms-3 my-auto">
                                <span> {{ $training->trainers()->first()->name }}</span>
                                <br>
                                <span class="text-secondary">{{ $training->trainers()->first()->job }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-user.layout>
